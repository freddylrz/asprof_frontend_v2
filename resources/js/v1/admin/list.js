import {
    decryptData,
    encryptData,
    getAccessTokenFromCookies
} from "../encrypt.js";

let token;

$(document).ready(async function () {
    token = await getAccessTokenFromCookies();

    getData();
});

function getData(stat = 0) {
    $.ajax({
        "url": base_url.concat('/api/client-admin/request/list-data'),
        "method": "GET",
        "timeout": 0,
        "headers": {
            "Authorization": "Bearer " + token
        },
    }).done(async function (responses) {
        var response = await decryptData(responses['data'])

        console.log(response)

        $('#table').DataTable({
            processing: false,
            "pageLength": 25,
            "autoWidth": false,
            order: [],
            "scrollX": true,
            "bDestroy": true,
            "searching": true,
            data: response.list,
            "columns": [
                {
                    "data": "batchId",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {"data": "nama_fasyankes"},
                {"data": "description"},
                {
                    "data": "batchId",
                    className: "text-center", // Tambahkan kelas text-center
                    render: function (data, type, row, meta) {
                        return `<a class="btn btn-info btn-xs" id="detail" style="margin-right: 10px" href="/admin/list-detail?batchId=${data}"><i class="fa fa-eye"></i></a>
                               `;
                    }
                },
            ],
        })
        Swal.close()
    })
}

var jobId
$('#fileForm').on('submit', function (event) {
    event.preventDefault();  // Menghindari pengiriman form default
    const form = this;
    Swal.fire({
        title: "Apakah anda yakin?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: `<i class="fa fa-upload"></i> Insert`,
        confirmButtonColor: '',
        customClass: {
            confirmButton: 'btn btn-danger',
            cancelButton: 'btn btn-secondary'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            insertBatch(form)
        }
    });
});

function insertBatch(elm){
    var formData = new FormData(elm);  // Membuat objek FormData dari form

    formData.append("ins_id", "2");

    var settings = {
        "url": base_url + "/api/client-admin/request/insert-data",
        "method": "POST",
        "timeout": 0,
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "headers": {
            "Authorization": "Bearer " + token
        },
        "data": formData
    };

    $.ajax(settings).done(async function (responses) {
        responses = JSON.parse(responses)
        var response = await decryptData(responses['data'])
        jobId = response['jobId']
        var batchId =response['bacthId']
        var progressText

        // SweetAlert untuk menampilkan loading
        Swal.fire({
            title: 'Loading...',
            html: 'Progress: <b id="prog">0%</b>',
            showCancelButton: false,
            showConfirmButton: false,
            didOpen: () => {
                // Menyimpan referensi progressText agar bisa diakses di luar didOpen
                const content = Swal.getHtmlContainer();
                progressText = content.querySelector('b');
            }
        });

        // Fetch dengan chunk
        fetch(base_url + `/api/client-admin/request/progres-insert-data?jobId=${jobId}`, {
            method: 'GET',
            headers: {
                "Authorization": "Bearer " + token
            }
        })
            .then(response => {
                const reader = response.body.getReader();
                const decoder = new TextDecoder("utf-8");

                function readChunk() {
                    reader.read().then(({ done, value }) => {
                        if (done) {
                            console.log('Transfer selesai.');
                            return;
                        }

                        // Decode chunk menjadi teks
                        const chunk = decoder.decode(value, { stream: true });

                        // Memproses setiap baris dalam chunk
                        chunk.split("\n").forEach(line => {
                            if (line.trim()) { // Abaikan baris kosong
                                try {
                                    // Parse JSON langsung dari respons
                                    const { progress, is_finished } = JSON.parse(line);

                                    // Update progress di SweetAlert
                                    progressText.textContent = `${progress}%`;

                                    if (is_finished) {
                                        // Jika proses selesai, tampilkan pesan sukses
                                        Swal.fire({
                                            title: 'Finished!',
                                            text: 'The loading is complete.',
                                            icon: 'success',
                                            showCancelButton: false,
                                            showConfirmButton: false,
                                        });
                                        setInterval(function () {
                                            window.location.href = '/admin/list-detail?batchId='+batchId;
                                        }, 2000);
                                        return; // Hentikan membaca chunk
                                    }
                                } catch (error) {
                                    console.error("Error parsing JSON:", error, line);
                                }
                            }
                        });

                        // Baca chunk berikutnya
                        readChunk();
                    });
                }

                // Mulai membaca chunk
                readChunk();
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'Terjadi kesalahan saat membaca progress.',
                    icon: 'error'
                });
            });
    });
}
