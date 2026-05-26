<?php

namespace App\Filament\Resources\EnquiryResource\Pages;

use App\Filament\Resources\EnquiryResource;
use App\Exports\EnquiriesExport;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Notifications\Notification;

class ListEnquiries extends ListRecords
{
    protected static string $resource = EnquiryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('export_excel')
                ->label('Export to Excel')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->action(function () {
                    $query = $this->getFilteredTableQuery();
                    $enquiries = $query->with('handler')->get();

                    Notification::make()
                        ->title('Exporting ' . $enquiries->count() . ' enquiries')
                        ->success()
                        ->send();

                    return Excel::download(
                        new EnquiriesExport($enquiries),
                        'enquiries-export-' . now()->format('Y-m-d-His') . '.xlsx'
                    );
                }),
            Actions\CreateAction::make(),
        ];
    }
}
