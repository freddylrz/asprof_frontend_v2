<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckPiat;
use App\Http\Middleware\RedirectIfPiatExists;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/login', function () {
        return view('v1.admin.login');
    });
    Route::get('/dashboard', function () {
        return view('v1.admin.list_data');
    });
    Route::get('/insert-batch', function () {
        return view('v1.admin.insert');
    });
    Route::get('/list-data', function () {
        return view('v1.admin.list_data');
    });
    Route::get('/list-detail', function () {
        return view('v1.admin.list_detail');
    });
    Route::get('/detail', function () {
        return view('v1.admin.detail');
    });
});

Route::get('/', function () {
    return view('v1.index');
});

Route::get('/faq', function () {
    return view('v1.faq');
});

Route::get('/syarat-ketentuan', function () {
    return view('v1.syarat-ketentuan');
});

Route::get('/kebijakan-privasi', function () {
    return view('v1.kebijakan-privasi');
});

Route::get('/tentang-kami', function () {
    return view('v1.tentang-kami');
});

Route::get('/asuransi-profesi', function () {
    return view('v1.asuransi-profesi');
});

Route::get('/pialang-asuransi', function () {
    return view('v1.pialang-asuransi');
});

Route::get('/asuransi-pendukung', function () {
    return view('v1.asuransi-pendukung');
});

Route::get('/pendampingan-dan-jaminan', function () {
    return view('v1.pendampingan-dan-jaminan');
});

Route::get('/tata-cara', function () {
    return view('v1.tata-cara');
});

Route::get('/hubungi-kami', function () {
    return view('v1.hubungi-kami');
});

Route::get('/pendaftaran', function () {
    return view('v1.register-soon');
});

Route::get('/detail/{reqId}', function ($reqId) {
    return view('v1.detail', ['reqId' => $reqId]);
});

Route::get('/edit/{reqId}',  function ($reqId) {
    return view('v1.update', ['reqId' => $reqId]);
});

Route::middleware([RedirectIfPiatExists::class])->group(function () {
    Route::get('/login', function () {
        return view('v1.auth.login');
    });
});

Route::middleware([CheckPiat::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('v1.dashboard.index');
    });
    Route::get('/chat', function () {
        return view('v1.dashboard.chat');
    });
    Route::get('/renewal', function () {
        return view('v1.dashboard.renewal');
    });

    Route::group(['prefix' => 'klaim', 'as' => 'klaim.'], function () {
        Route::get('/input', function () {
            return view('v1.dashboard.klaim.input');
        });
        Route::get('/data', function () {
            return view('v1.dashboard.klaim.data');
        });
    });

    Route::get('/riwayat-polis', function () {
        return view('v1.dashboard.riwayat-polis');
    });
});
