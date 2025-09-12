$(document).ready(function () {
    let currentPage = 0;
    const pages = $('.page-section');
    const totalPages = pages.length;
    let isAnimating = false; // Flag untuk mencegah multiple click

    // Sembunyikan semua halaman, lalu tampilkan yang pertama
    pages.hide().eq(currentPage).show();

    // Update tampilan tombol navigasi
    function updateNavigation() {
        $('#prev-btn').toggle(currentPage > 0);
        $('#next-btn').toggle(currentPage < totalPages - 1);
    }

    // Daftar animasi masuk dan keluar
    const animations = [
        { in: 'fadeIn', out: 'fadeOut' },
        { in: 'fadeInDown', out: 'fadeOutUp' },
        { in: 'fadeInUp', out: 'fadeOutDown' },
        { in: 'fadeInLeft', out: 'fadeOutLeft' },
        { in: 'fadeInRight', out: 'fadeOutRight' },
        { in: 'zoomIn', out: 'zoomOut' },
        { in: 'slideInUp', out: 'slideOutDown' },
        { in: 'slideInLeft', out: 'slideOutRight' },
        { in: 'bounceIn', out: 'bounceOut' },
        { in: 'flipInX', out: 'flipOutX' },
        { in: 'lightSpeedInRight', out: 'lightSpeedOutLeft' },
        { in: 'lightSpeedInLeft', out: 'lightSpeedOutRight' },
        { in: 'rotateIn', out: 'rotateOut' },
        { in: 'rollIn', out: 'rollOut' }
    ];

    // Pindah ke halaman tertentu dengan animasi acak
    function goToPage(index) {
        if (index < 0 || index >= totalPages || isAnimating) return;

        isAnimating = true; // Mulai animasi
        $('#prev-btn, #next-btn').prop('disabled', true); // Nonaktifkan tombol

        const randomAnim = animations[Math.floor(Math.random() * animations.length)];

        // Animasi keluar halaman saat ini
        pages.eq(currentPage).addClass('animate__animated animate__' + randomAnim.out).one('animationend', function () {
            $(this).removeClass('animate__animated animate__' + randomAnim.out).hide();
        });

        // Animasi masuk halaman baru
        pages.eq(index).show().addClass('animate__animated animate__' + randomAnim.in).one('animationend', function () {
            $(this).removeClass('animate__animated animate__' + randomAnim.in);
            isAnimating = false; // Selesai animasi
            $('#prev-btn, #next-btn').prop('disabled', false); // Aktifkan tombol
        });

        currentPage = index;
        updateNavigation();
    }

    // Event handler tombol Next
    $(document).on('click', '#next-btn', function () {
        if (currentPage < totalPages - 1 && !isAnimating) {
            goToPage(currentPage + 1);
        }
    });

    // Event handler tombol Previous
    $(document).on('click', '#prev-btn', function () {
        if (currentPage > 0 && !isAnimating) {
            goToPage(currentPage - 1);
        }
    });

    // Inisialisasi tombol navigasi
    updateNavigation();
});
