<?php

namespace App\Nova;

use App\Models\Order as OrderModel;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class Order extends Resource
{
    public static $model = OrderModel::class;

    public static $title = 'id';

    public static $search = [
        'id', 'payment_intent_id'
    ];

    public function fields(Request $request): array
    {
        return [
            ID::make()->sortable(),
            MorphToMany::make('Voyages', 'voyages'),
            MorphToMany::make('Products', 'products'),
            Text::make('Payment Intent Id')
                ->sortable()
                ->rules('required'),
            BelongsTo::make('Buyer', 'buyer', User::class)
                ->sortable()
                ->rules('required'),
            Select::make('Status')
                ->sortable()
                ->options([
                    'pending' => 'Pending',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ])
                ->rules('required'),
        ];
    }

    public function cards(Request $request): array
    {
        return [];
    }

    public function filters(Request $request): array
    {
        return [];
    }

    public function lenses(Request $request): array
    {
        return [];
    }

    public function actions(Request $request): array
    {
        return [];
    }
}
