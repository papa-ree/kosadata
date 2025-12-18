<?php

use Nawasara\Kosadata\Livewire\Pages\InternetProvider\InternetProviderCru;
use Illuminate\Support\Facades\Route;
use Nawasara\Kosadata\Livewire\LandingPages\FormInternetDesa\Index as FormInternetDesaIndex;
use Nawasara\Kosadata\Livewire\Pages\InternetProvider\Index as InternetProviderIndex;
use Nawasara\Kosadata\Livewire\Pages\IspDesa\Index as IspDesaIndex;
use Nawasara\Kosadata\Livewire\Pages\IspDesa\IspDesaCru;
use Nawasara\Kosadata\Livewire\Pages\Overview\Index;

Route::middleware(['web'])->as('kosadata.')->group(function () {

    Route::name('form-internet-desa.')->group(function () {
        Route::get('form-internet-desa', FormInternetDesaIndex::class)->name('index');
    });

    Route::middleware(['auth'])->group(function () {

        Route::group(['middleware' => ['permission:dashboard']], function () {
            Route::name('internet-desa-overview.')->group(function () {
                Route::get('internet-desa-overview', Index::class)->name('index');
            });

            Route::name('internet-provider.')->group(function () {
                Route::get('internet-provider', InternetProviderIndex::class)->name('index');
                Route::get('internet-provider.create', InternetProviderCru::class)->name('create');
                Route::get('internet-provider.edit.{isp?}', InternetProviderCru::class)->name('edit');
            });

            Route::name('isp-desa.')->group(function () {
                Route::get('isp-desa', IspDesaIndex::class)->name('index');
                Route::get('isp-desa.create', IspDesaCru::class)->name('create');
                Route::get('isp-desa.edit.{desa?}', IspDesaCru::class)->name('edit');
            });
        });
    });
});
