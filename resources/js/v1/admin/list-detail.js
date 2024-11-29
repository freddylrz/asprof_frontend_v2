import {
    decryptData,
    encryptData,
    getAccessTokenFromCookies
} from "../encrypt.js";

let token;
let searchParams = new URLSearchParams(window.location.search)
var batchId = searchParams.get('batchId')
$(document).ready(async function () {
    token = await getAccessTokenFromCookies();

    getData();
});

$('#profesi').on('change', function () {
    getProfesi()
});

$('#cari').on('click', function () {
    getData()
})

function getData() {
    $.ajax({
        "url": base_url.concat('/api/client-admin/request/detail-list'),
        "method": "GET",
        "timeout": 0,
        "headers": {
            "Authorization": "Bearer " + token
        },
        "data" : {
            "bacthId" : batchId
        }
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
                    "data": "reqId",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },

                {"data": "register_no"},
                {"data": "nama"},
                {"data": "profesi"},
                {"data": "profesi_kategori"},
                {"data": "str_no"},
                {"data": "premi"},
                {"data": "sum_insured"},
                {
                    "data": "reqId",
                    className: "text-center", // Tambahkan kelas text-center
                    render: function (data, type, row, meta) {
                        return `
                                <a class="btn btn-info btn-xs" id="detail" style="margin-right: 10px" href="/admin/detail?id=${data}">
                                    <i class="fa fa-eye"></i>
                                </a>
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

    var formData = new FormData(this);  // Membuat objek FormData dari form

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
        console.log(response)
        jobId = response['jobId']
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
        fetch(base_url +`/api/client-admin/request/progres-insert-data?jobId=${jobId}`, {
            method: 'GET',
            headers: {
                "Authorization": "Bearer " + token
            }
        })
            .then(response => {
                const reader = response.body.getReader();
                const decoder = new TextDecoder("utf-8");

                function readChunk() {
                    reader.read().then(({done, value}) => {
                        if (done) {
                            console.log('Transfer selesai.');
                            return;
                        }

                        const chunk = decoder.decode(value, {stream: true});
                        chunk.split("\n").forEach(line => {
                            if (line.startsWith("data:")) {
                                const data = JSON.parse(line.replace("data: ", "").trim());
                                const progress = data;

                                // Update progress di SweetAlert
                                progressText.textContent = `${progress}%`;

                                if (progress === 100) {
                                    Swal.fire({
                                        title: 'Finished!',
                                        text: 'The loading is complete.',
                                        icon: 'success'
                                    });
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

});

