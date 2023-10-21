<?php

namespace App\Nova;

use App\Models\Coupon as CouponModel;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class Coupon extends Resource
{
    public static $model = CouponModel::class;

    public static $title = 'id';

    public static $search = [
        'id', 'code', 'discount_type'
    ];

    public function fields(Request $request): array
    {
        return [
            ID::make()->sortable(),

            Text::make('Code')
                ->sortable()
                ->rules('required'),

            Date::make('Expires At')
                ->sortable()
                ->rules('required', 'date'),

            Select::make('Discount Type')
                ->sortable()
                ->options([
                    'fixed' => 'Fixed',
                    'percent' => 'Percentage',
                ])
                ->rules('required'),

            Number::make('Value')
                ->sortable()
                ->rules('required', 'numeric'),
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
