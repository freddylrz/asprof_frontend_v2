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

          // Fill klaim details
          $.each(klaim, function(index, item) {
            $('#nomor-klaim').text(item.klaim_no || '-');
            $('#nama-peserta').text(item.nama || '-');
            $('#nomor-polis-peserta').text(item.polis_no || '-');
            $('#tanggal-lapor').text(formatDateIndo(item.report_date) || '-');
            $('#tanggal-kejadian').text(formatDateIndo(item.incident_date) || '-');
            $('#keterangan-kejadian').text(item.incident_description || '-');
            $('#klaim-status-desc').text(item.klaim_status_desc || '-');
            $('#nama-pic').text(item.pic_name || '-');
            $('#nomor-telpon-pic').text(item.pic_no || '-');
            $('#nomor-sip').text(item.sip_no || '-');
            $('#tempat-praktik').text(item.tempat_praktik || '-');
            $('#tanggal-awal-sip').text(formatDateIndo(item.sip_date_start) || '-');
            $('#tanggal-akhir-sip').text(formatDateIndo(item.sip_date_end) || '-');
          });

          // Fill documents table
          const $tbody = $('#tabFileBody');
          $tbody.empty();
          if (documents.length > 0) {
            documents.forEach((doc, index) => {
              const fileUrl = `${apiUrl}/${doc.file_path}`;
              const row = `
                <tr>
                  <td class="text-center">${index + 1}</td>
                  <td>${doc.document_name}</td>
                  <td><a href="${fileUrl}" target="_blank">${doc.file_name}</a></td>
                </tr>
              `;
              $tbody.append(row);
            });
          } else {
            $tbody.append('<tr><td colspan="3" class="text-center">No documents found</td></tr>');
          }

            // Fill log modal
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
                            <p class="m-b-5">${log.created_at}</p>
                            <h5 class="text-muted">${log.status_description}</h5>
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
});

function formatDateIndo(dateStr) {
    if (!dateStr) return '-';
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

    if (hh === 0 && mm === 0) {
        return `${d} ${m} ${y}`;
    } else {
        const hhStr = String(hh).padStart(2, '0');
        const mmStr = String(mm).padStart(2, '0');
        return `${d} ${m} ${y} ${hhStr}:${mmStr}`;
    }
}
