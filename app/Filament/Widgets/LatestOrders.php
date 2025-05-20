<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Actions\Action as ActionsAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Arr;

class LatestOrders extends BaseWidget
{

    protected int | string | array $columnSpan = 'full';
    protected static ? int $sort = 2;
    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(10)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->label('Order ID')
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),

                TextColumn::make('grand_total')
                    ->money('EUR'),
                    
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state):string => match($state){
                        'new' => 'info',
                        'processing' => 'warning',
                        'shipped' => 'success',
                        'delivered' => 'success',
                        'cancelled' => 'danger'
                    })
                    ->icon(fn(string $state):string => match($state){
                        'new' => 'heroicon-m-sparkles',
                        'processing' => 'heroicon-m-arrow-path',
                        'shipped' => 'heroicon-m-truck',
                        'delivered' => 'heroicon-m-check-badge',
                        'cancelled' => 'heroicon-m-x-circle'
                    })
                    ->sortable(),
                TextColumn::make('payment_method')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('payment_status')
                    ->sortable()
                    ->badge()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Order Data')
                    ->dateTime(),
            ])
            ->actions([
                ActionsAction::make('View Order')
                    ->url(fn(Order $record):string => OrderResource::getUrl('view', ['record' => $record]))
                    ->color('info')
                    ->icon('heroicon-o-eye'),
               Tables\Actions\DeleteAction::make(),
            ])
            ;
    }
}