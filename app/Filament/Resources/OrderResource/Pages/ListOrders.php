<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrderResource\Widgets\OrderStats::class, // cette fonction permet d'afficher le widget au niveau de order
        ];
    }
    public function getTabs(): array // fonction qui filtre et affiche les orders selon qu'il soit [new, delivered, shipped, delivered, cancelled]
    {
        return [
            null => Tab::make('All'),
            'new' => Tab::make()->query(fn($query) => $query->where('status', 'new')),
            'processing' => Tab::make()->query(fn($query) => $query->where('status', 'processing')),
            'shipped' => Tab::make()->query(fn($query) => $query->where('status', 'shipped')),
            'delivered' => Tab::make()->query(fn($query) => $query->where('status', 'delivered')),
            'cancelled' => Tab::make()->query(fn($query) => $query->where('status', 'cancelled')),
        ]; 
    }
}