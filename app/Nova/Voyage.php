<?php

namespace App\Nova;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\BelongsTo; // Ajout du champ BelongsTo pour user_id
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class Voyage extends Resource
{
  public static $model = \App\Models\Voyage::class;

  public static $title = 'id';

  public static $search = [
    'id',
    'lieu_depart',
    'lieu_arrive',
  ];

  public function fields(NovaRequest $request)
  {
    return [
      ID::make()->sortable(),

      Text::make('Departure Place', 'lieu_depart')
        ->sortable(),

      Text::make('Arrival Place', 'lieu_arrive')
        ->sortable(),

      Date::make('Date', 'date_voyage')
        ->sortable(),

      Number::make('Number of Places', 'nbr_places')
        ->sortable(),

      Number::make('Price', 'prix')
        ->sortable(),

      Text::make('Telephone', 'telephone')
        ->sortable(),

      BelongsTo::make('User', 'user', 'App\Nova\User')
        ->sortable(),

      MorphToMany::make('Orders'),
    ];
  }

  public function cards(NovaRequest $request)
  {
    return [];
  }

  public function filters(NovaRequest $request)
  {
    return [];
  }

  public function lenses(NovaRequest $request)
  {
    return [];
  }

  public function actions(NovaRequest $request)
  {
    return [];
  }
}
