<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\File;

class Complaint extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Complaint>
     */
    public static $model = \App\Models\Complaint::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
    
            Text::make('Title')
                ->rules('required', 'string', 'between:2,10'), 
    
            Textarea::make('Description')
                ->rules('required', 'string', 'between:10,10000'), 
    
            File::make('Screenshot') 
                ->rules('image'),
    
            DateTime::make('Created At'), 
            DateTime::make('Updated At'), 
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

    public function title()
    {
        return 'Title'; 

    }

    public function description()
    {
        return 'Description'; 
    }

    public function screenshot()
    {
        return 'screenshot'; 
    }
}
