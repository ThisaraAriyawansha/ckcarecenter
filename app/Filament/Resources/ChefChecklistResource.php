<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChefChecklistResource\Pages;
use App\Models\ChefChecklist;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class ChefChecklistResource extends Resource
{
    protected static ?string $model = ChefChecklist::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationGroup = 'Daily Operations';

    protected static ?string $navigationLabel = 'Chef Checklists';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        $isChef = auth()->user()->hasRole('chef');
        $isManager = auth()->user()->hasAnyRole(['admin', 'manager']);

        return $form
            ->schema([
                Forms\Components\Section::make('Checklist Information')
                    ->schema([
                        Forms\Components\Placeholder::make('info')
                            ->label('')
                            ->content(function ($record) use ($isChef) {
                                if ($record) {
                                    return "**Date:** {$record->date->format('l, F d, Y')} | **Week:** {$record->week_number} | **Chef:** {$record->chef->name}";
                                }
                                return "**Today's Checklist** - " . now()->format('l, F d, Y');
                            })
                            ->visible($isChef),

                        Forms\Components\Select::make('chef_id')
                            ->label('Chef')
                            ->relationship(
                                'chef',
                                'name',
                                function ($query) {
                                    $user = auth()->user();

                                    // Filter to show only users with 'chef' role
                                    $query->whereHas('roles', function ($roleQuery) {
                                        $roleQuery->where('name', 'chef');
                                    });

                                    // Managers can only select chefs from their branch
                                    if ($user->hasRole('manager') && !$user->hasRole('admin')) {
                                        $query->where('branch_id', $user->branch_id);
                                    }
                                }
                            )
                            ->default(fn() => $isChef ? auth()->id() : null)
                            ->disabled(fn($operation) => $operation === 'edit' || $isChef)
                            ->dehydrated()
                            ->required()
                            ->searchable()
                            ->preload()
                            ->visible(!$isChef),

                        Forms\Components\DatePicker::make('date')
                            ->label('Date')
                            ->required()
                            ->default(today())
                            ->disabled(fn($operation) => $operation === 'edit' || $isChef)
                            ->dehydrated()
                            ->native(false)
                            ->visible(!$isChef),

                        Forms\Components\Hidden::make('chef_id')
                            ->default(auth()->id())
                            ->visible($isChef),

                        Forms\Components\Hidden::make('date')
                            ->default(today())
                            ->visible($isChef),

                        Forms\Components\Hidden::make('week_number')
                            ->default(fn() => Carbon::now()->weekOfMonth),

                        Forms\Components\Hidden::make('month')
                            ->default(fn() => Carbon::now()->format('F Y')),
                    ])
                    ->columns(2)
                    ->visible(fn($operation) => $operation === 'create' || !$isChef),

                Forms\Components\Section::make('Daily Tasks - DINING')
                    ->schema([
                        Forms\Components\CheckboxList::make('dining_tasks')
                            ->options([
                                'wipe_table' => 'Wipe down table & chairs',
                                'sweep_floor' => 'Sweep/ Vacuum floor',
                                'clean_windows' => 'Clean windows',
                                'clean_baseboards' => 'Clean baseboards',
                                'set_table' => 'Set table',
                            ])
                            ->columns(2)
                            ->gridDirection('row')
                            ->disabled($isManager && !$isChef),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Daily Tasks - KITCHEN & DINNING')
                    ->schema([
                        Forms\Components\CheckboxList::make('kitchen_dinning_tasks')
                            ->options([
                                'clean_kitchen' => 'Clean kitchen after food preparation',
                                'vacuum_spills' => 'VACUUM / Mop up spills',
                                'wash_dishes' => 'Wash Dishes',
                                'laundry' => 'Do laundry & put away cloths',
                                'take_trash' => 'Take out trash',
                                'make_bed' => 'Make & change bed as needed',
                                'wipe_bathroom' => 'Wipe down bathroom sink & shower',
                                'clean_appliances' => 'Clean refrigerator/Toaster/Etc',
                                'sanitize_switch' => 'Sanitize light switch',
                                'mail_bills' => 'RETRIEVE mail & help with bill payments',
                            ])
                            ->columns(2)
                            ->gridDirection('row')
                            ->disabled($isManager && !$isChef),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Daily Tasks - BATHROOMS')
                    ->schema([
                        Forms\Components\CheckboxList::make('bathroom_tasks')
                            ->options([
                                'clean_windows_mirror' => 'Clean Windows / mirror',
                                'dust_surface' => 'Dust & wipe surface',
                                'empty_trash' => 'Empty Trash',
                                'make_bed' => 'Make bed',
                                'flip_mattress' => 'Flip rotate mattress',
                            ])
                            ->columns(2)
                            ->gridDirection('row')
                            ->disabled($isManager && !$isChef),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Daily Tasks - COMMON AREAS')
                    ->schema([
                        Forms\Components\CheckboxList::make('common_area_tasks')
                            ->options([
                                'clean_drains' => 'Clean drains',
                                'sanitize_basin' => 'Sanitize Wash basin/toilet',
                                'clean_fixtures' => 'Dust & wipe down light fixtures / ceiling fans',
                                'sweep_mop' => 'Sweep & mop floors / Clean mirrors',
                                'vacuum_corners' => 'Vacuum under furniture and in corners',
                                'tv_lobby' => 'TV Lobby / Stair Case / Book Shelves /Pic Frames',
                                'garden_outside' => 'Garden /Outside & other service Areas',
                                'reports' => 'Reports / Day end sharing to admin group',
                            ])
                            ->columns(2)
                            ->gridDirection('row')
                            ->disabled($isManager && !$isChef),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Signatures & Notes')
                    ->schema([
                        Forms\Components\Toggle::make('chef_signed')
                            ->label('Chef Signature (Required)')
                            ->disabled($isManager && !$isChef)
                            ->required()
                            ->accepted()
                            ->validationMessages([
                                'accepted' => 'You must sign the checklist before submitting.',
                            ])
                            ->helperText($isChef ? 'Please toggle this to sign and confirm you have completed the tasks.' : null)
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $set('chef_signed_at', now());
                                }
                            }),

                        Forms\Components\Toggle::make('manager_signed')
                            ->label('Manager Signature')
                            ->disabled(!$isManager)
                            ->helperText($isManager ? 'Toggle to approve and sign this checklist.' : null)
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $set('manager_signed_at', now());
                                    $set('manager_id', auth()->id());
                                }
                            }),

                        Forms\Components\Textarea::make('notes')
                            ->label('Additional Notes')
                            ->rows(3)
                            ->columnSpanFull()
                            ->placeholder('Add any additional comments or observations here...'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('chef.name')
                    ->label('Chef')
                    ->searchable()
                    ->sortable()
                    ->visible(fn() => auth()->user()->hasAnyRole(['admin', 'manager'])),

                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date('M d, Y')
                    ->sortable()
                    ->badge()
                    ->color(fn($record) => $record->date->isToday() ? 'success' : null)
                    ->formatStateUsing(function ($record) {
                        if ($record->date->isToday()) {
                            return 'TODAY - ' . $record->date->format('M d, Y');
                        }
                        return $record->date->format('M d, Y');
                    }),

                Tables\Columns\TextColumn::make('month')
                    ->label('Month')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('week_number')
                    ->label('Week')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\IconColumn::make('chef_signed')
                    ->label('Chef Signed')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\IconColumn::make('manager_signed')
                    ->label('Manager Signed')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('manager.name')
                    ->label('Signed By Manager')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('chef')
                    ->relationship('chef', 'name', function ($query) {
                        $user = auth()->user();

                        // Filter to show only users with 'chef' role
                        $query->whereHas('roles', function ($roleQuery) {
                            $roleQuery->where('name', 'chef');
                        });

                        // Managers can only see chefs from their branch
                        if ($user->hasRole('manager') && !$user->hasRole('admin')) {
                            $query->where('branch_id', $user->branch_id);
                        }
                    })
                    ->searchable()
                    ->preload()
                    ->visible(fn() => auth()->user()->hasAnyRole(['admin', 'manager'])),

                Tables\Filters\Filter::make('date')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('From Date'),
                        Forms\Components\DatePicker::make('until')
                            ->label('Until Date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                            );
                    }),

                Tables\Filters\TernaryFilter::make('chef_signed')
                    ->label('Chef Signed'),

                Tables\Filters\TernaryFilter::make('manager_signed')
                    ->label('Manager Signed'),
            ])
            ->actions([
                Tables\Actions\Action::make('download_pdf')
                    ->label('Download PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(function ($record) {
                        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.chef-checklist', [
                            'checklist' => $record
                        ]);

                        $pdf->setPaper('a4', 'portrait');

                        $filename = 'checklist-' . $record->chef->name . '-' . $record->date->format('Y-m-d') . '.pdf';

                        return response()->streamDownload(function () use ($pdf) {
                            echo $pdf->output();
                        }, $filename);
                    }),

                Tables\Actions\ViewAction::make()
                    ->visible(fn() => auth()->user()->hasAnyRole(['admin', 'manager'])),

                Tables\Actions\EditAction::make()
                    ->visible(function ($record) {
                        $isChef = auth()->user()->hasRole('chef') && !auth()->user()->hasAnyRole(['admin', 'manager']);
                        $isManager = auth()->user()->hasAnyRole(['admin', 'manager']);

                        // Managers can edit any checklist
                        if ($isManager) {
                            return true;
                        }

                        // Chefs can only edit today's checklist
                        if ($isChef) {
                            return $record->date->isToday();
                        }

                        return false;
                    })
                    ->label(function ($record) {
                        $isChef = auth()->user()->hasRole('chef') && !auth()->user()->hasAnyRole(['admin', 'manager']);
                        return $isChef && $record->date->isToday() ? 'Update Today' : 'Edit';
                    }),

                Tables\Actions\DeleteAction::make()
                    ->visible(fn() => auth()->user()->hasAnyRole(['admin', 'manager'])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn() => auth()->user()->hasAnyRole(['admin', 'manager'])),
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                $user = auth()->user();

                // Chefs can only see their own checklists
                if ($user->hasRole('chef') && !$user->hasAnyRole(['admin', 'manager'])) {
                    $query->where('chef_id', $user->id);
                }

                // Managers can only see checklists from chefs in their branch
                if ($user->hasRole('manager') && !$user->hasRole('admin')) {
                    $query->whereHas('chef', function ($chefQuery) use ($user) {
                        $chefQuery->where('branch_id', $user->branch_id);
                    });
                }

                return $query;
            })
            ->defaultSort('date', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChefChecklists::route('/'),
            'create' => Pages\CreateChefChecklist::route('/create'),
            'view' => Pages\ViewChefChecklist::route('/{record}'),
            'edit' => Pages\EditChefChecklist::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'manager', 'chef']);
    }
}
