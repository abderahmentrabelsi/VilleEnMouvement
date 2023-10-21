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
        ->rules('required', 'max:255', 'unique:coupons,code', 'min:6'),

      Date::make('Expires At')
        ->sortable()
        ->rules('required', 'date'),

      Select::make('Discount Type')
        ->sortable()
        ->options([
          'Fixed' => 'Fixed',
          'Percentage' => 'Percentage',
        ])
        ->rules('required'),

      Number::make('Value')
        ->sortable()
        ->rules('required', 'numeric', 'min:0', 'max:100'),
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
