<?php

namespace App\Filament\Pages;

use App\Models\Client;
use App\Models\ClientDailyChecklist;
use Filament\Pages\Page;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Database\Eloquent\Builder;

class ClientChecklistDetail extends Page implements HasTable
{
    use InteractsWithTable;

    protected static bool $shouldRegisterNavigation = false;

    protected static string $view = 'filament.pages.client-checklist-detail';

    protected static string $routePath = 'client-checklist-detail/{client}';

    public ?Client $client = null;

    public function mount(int | string $client): void
    {
        $this->client = Client::with(['branch', 'officerInCharge'])->findOrFail($client);

        // Check authorization - managers can only view clients from their branch
        $user = auth()->user();
        if ($user->hasRole('manager') && !$user->hasRole('admin')) {
            if ($this->client->branch_id !== $user->branch_id) {
                abort(403, 'Unauthorized access to this client.');
            }
        }
    }

    public static function canAccess(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'manager']);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->columns([
                TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->color('primary')
                    ->weight('bold')
                    ->searchable(),

                TextColumn::make('task_name')
                    ->label('Task')
                    ->searchable()
                    ->wrap(),

                IconColumn::make('completed')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                TextColumn::make('completedBy.name')
                    ->label('Completed By')
                    ->default('Not completed')
                    ->toggleable(),

                TextColumn::make('completed_at')
                    ->label('Completed At')
                    ->dateTime('M d, Y h:i A')
                    ->default('N/A')
                    ->toggleable(),

                TextColumn::make('notes')
                    ->label('Notes')
                    ->limit(50)
                    ->toggleable()
                    ->default('-'),
            ])
            ->filters([
                // Add filters if needed
            ])
            ->defaultSort('category', 'asc')
            ->defaultGroup('category');
    }

    protected function getTableQuery(): Builder
    {
        return ClientDailyChecklist::query()
            ->where('client_id', $this->client->id)
            ->whereDate('date', now()->toDateString())
            ->with(['completedBy']);
    }

    public function getTitle(): string
    {
        return "Daily Checklist - {$this->client->name}";
    }

    protected function getHeaderActions(): array
    {
        return [
            // Add actions if needed
        ];
    }
}
