<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Livewire::component(
            'app.filament.resources.client-resource.pages.generate-invoice',
            \App\Filament\Resources\ClientResource\Pages\GenerateInvoice::class
        );
    }
}
