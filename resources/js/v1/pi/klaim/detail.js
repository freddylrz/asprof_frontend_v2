import { decryptData, encryptData } from "../../encrypt.js";

// Ambil token dari cookie dengan aman
const cookie = document.cookie.split('; ').find(row => row.startsWith('piat='));
const token = cookie ? cookie.split('=')[1] : null;
const klaimId = window.location.pathname.split('/').pop();

$(document).ready(function () {
  if (!klaimId) {
    alert('Klaim ID not found in URL');
    return;
  }

  $.ajax({
    url: `${apiUrl}/api/client/klaim/detail`,
    method: 'GET',
    data: { klaimId },
    headers: {
      Authorization: `Bearer ${token}`,
    },
    success: async function (res) {
      if (res.status === 200 && res.data) {
        let decrypted;
        try {
          decrypted = await decryptData(res.data);
        } catch (e) {
          console.error('Decryption failed', e);
          alert('Failed to decrypt data');
          return;
        }

        if (decrypted) {
          console.log(decrypted);

          const klaim = decrypted.klaim;
          const documents = decrypted.document || [];
          const logs = decrypted.log || [];

          // Isi detail klaim
          $.each(klaim, function(index, item) {
            $('#nomor-klaim').text(item.klaim_no || '-');
            $('#nama-peserta').text(item.nama || '-');
            $('#nomor-polis-peserta').text(item.polis_no || '-');
            $('#tanggal-lapor').text(formatDateIndo(item.report_date) || '-');
            $('#tanggal-kejadian').text(formatDateIndo(item.incident_date) || '-');
            $('#keterangan-kejadian').text(item.incident_description || '-');
            $('#klaim-status-desc').text(item.klaim_status_desc || '-');

            const $status = $('#klaim-status-desc');
            $status.removeClass('bg-primary bg-warning bg-success text-white text-dark rounded px-2 py-1');

            if ([1, 2, 7].includes(item.klaim_status_id)) {
              $status.addClass('bg-primary text-white rounded px-2 py-1');
            } else if ([3, 4, 5, 8, 9, 11, 12].includes(item.klaim_status_id)) {
              $status.addClass('bg-warning text-white rounded px-2 py-1');
            } else if ([6, 10, 13].includes(item.klaim_status_id)) {
              $status.addClass('bg-success text-white rounded px-2 py-1');
            }

            $('#nama-pic').text(item.pic_name || '-');
            $('#nomor-telpon-pic').text(item.pic_no || '-');
            $('#nomor-sip').text(item.sip_no || '-');
            $('#tempat-praktik').text(item.tempat_praktik || '-');
            $('#tanggal-awal-sip').text(formatDateIndo(item.sip_date_start) || '-');
            $('#tanggal-akhir-sip').text(formatDateIndo(item.sip_date_end) || '-');

            // Jika klaim_status_id == 3, tampilkan kolom upload dan tombol submit
            if (item.klaim_status_id === 3) {
              if ($('#tab thead tr th.upload-file').length === 0) {
                $('#tab thead tr').append('<th class="upload-file" style="text-transform: uppercase; text-align: center;">Unggah File</th>');
              }
              $('#btn-submit-doc').removeClass('d-none');
            } else {
              $('#btn-submit-doc').addClass('d-none');
              $('#tab thead tr th.upload-file').remove();
            }
          });

          // Isi tabel dokumen
          const $tbody = $('#tabFileBody');
          $tbody.empty();
          if (documents.length > 0) {
            documents.forEach((doc, index) => {
              const fileUrl = `${apiUrl}/${doc.file_path}`;
              let uploadFileColumn = '';

              if (klaim[0].klaim_status_id === 3) {
                uploadFileColumn = `<td class="text-center">
                  <input type="file"
                         class="form-control form-control-sm upload-input"
                         data-doc-id="${parseInt(doc.id)}"
                         data-file-type="${parseInt(doc.file_type)}"
                         data-file-name="${doc.file_name}"
                         data-file-path="${doc.file_path}" />
                </td>`;
              }

              const row = `
                <tr>
                  <td class="text-center">${index + 1}</td>
                  <td>${doc.document_name}</td>
                  <td><a href="${fileUrl}" target="_blank">${doc.file_name}</a></td>
                  ${uploadFileColumn}
                </tr>
              `;
              $tbody.append(row);
            });
          } else {
            let colspan = 3;
            if (klaim[0].klaim_status_id === 3) {
              colspan = 4;
            }
            $tbody.append(`<tr><td colspan="${colspan}" class="text-center">No documents found</td></tr>`);
          }

          // Isi log modal
          const $logList = $('.task-list');
          $logList.empty();

          if (logs.length > 0) {
            const latestLog = logs.reduce((prev, current) => {
              return new Date(prev.created_at) > new Date(current.created_at) ? prev : current;
            });

            logs.forEach(log => {
              const iconClass = (log.created_at === latestLog.created_at) ? 'bg-primary ti-clock' : 'bg-success ti-check';

              const logItem = `
                <li>
                  <i class="ti ${iconClass} f-w-600 task-icon"></i>
                  <p class="m-b-5">${formatDateIndo(log.created_at)}</p>
                  <h5 class="text-muted">${log.status_description}</h5>
                  <i class=" m-b-5">${log.description || ''}</i>
                </li>
              `;
              $logList.append(logItem);
            });
          } else {
            $logList.append('<li>No log data available</li>');
          }

        } else {
          alert(decrypted.message || 'Failed to get klaim data');
        }
      } else {
        alert(res.message || 'Failed to get klaim detail');
      }
    },
    error: function (xhr, status, error) {
      console.error('API call failed:', error);
      alert('Failed to fetch klaim detail');
    },
  });

  // Handler tombol submit dokumen dengan full base64 and integer file_id
  $('#btn-submit-doc').on('click', function () {
    const $btn = $(this);
    const uploadInputs = $('.upload-input');
    if (uploadInputs.length === 0) {
      alert('Tidak ada file untuk diupload.');
      return;
    }

    const uploads = [];
    const readFilePromises = [];

    // Disable button and show loading
    $btn.prop('disabled', true);
    Swal.fire({
      title: 'Sedang mengupload dokumen...',
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      }
    });

    uploadInputs.each(function () {
      const fileInput = this;
      const file = fileInput.files[0];
      const file_id = parseInt($(fileInput).data('doc-id'));
      const file_type = parseInt($(fileInput).data('file-type'));
      const file_name = file ? file.name : $(fileInput).data('file-name') || 'unknown';
      const file_path = $(fileInput).data('file-path') || '';

      const uploadObj = {
        file_id: file_id,
        file_type: file_type,
        file_name: file_name,
        file_path: file_path,
        // file_base64 will be added if file is uploaded
      };

      if (file) {
        const promise = new Promise((resolve) => {
          const reader = new FileReader();
          reader.onload = function (e) {
            // Send full base64 string as is (including data prefix)
            uploadObj.file_base64 = e.target.result;
            uploads.push(uploadObj);
            resolve();
          };
          reader.onerror = function () {
            uploads.push(uploadObj);
            resolve();
          };
          reader.readAsDataURL(file);
        });
        readFilePromises.push(promise);
      } else {
        uploads.push(uploadObj);
      }
    });

    Promise.all(readFilePromises).then(() => {
      $.ajax({
        url: `${apiUrl}/api/client/klaim/upload-document`,
        method: 'POST',
        headers: {
          Authorization: `Bearer ${token}`,
        },
        contentType: 'application/json',
        data: JSON.stringify({
          klaimId: klaimId,
          upload: uploads
        }),
        success: function (res) {
          Swal.close();
          $btn.prop('disabled', false);
          if (res.status === 200) {
            Swal.fire('Sukses', 'Dokumen berhasil diupload', 'success').then(() => {
              location.reload();
            });
          } else {
            Swal.fire('Gagal', res.message || 'Upload dokumen gagal', 'error');
          }
        },
        error: function (xhr, status, error) {
          Swal.close();
          $btn.prop('disabled', false);
          console.error('Upload dokumen gagal:', error);
          Swal.fire('Gagal', 'Terjadi kesalahan saat upload dokumen', 'error');
        }
      });
    });
  });
});

function formatDateIndo(dateStr) {
  if (!dateStr) return '-';

  const hasTime = /\d{4}-\d{2}-\d{2}[ T]\d{2}:\d{2}(:\d{2})?/.test(dateStr);

  const date = new Date(dateStr);
  if (isNaN(date)) return '-';

  const months = [
    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
  ];
  const d = date.getDate();
  const m = months[date.getMonth()];
  const y = date.getFullYear();

  const hh = date.getHours();
  const mm = date.getMinutes();

  if (!hasTime || (hh === 0 && mm === 0)) {
    return `${d} ${m} ${y}`;
  } else {
    const hhStr = String(hh).padStart(2, '0');
    const mmStr = String(mm).padStart(2, '0');
    return `${d} ${m} ${y} ${hhStr}:${mmStr}`;
  }
}
