<?php

namespace App\Nova\Metrics\Users;

use App\Models\User;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;
use Laravel\Nova\Nova;

class Users extends Value
{
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, User::class);
    }

    public function ranges()
    {
        return [
            30 => Nova::__('30 Days'),
            60 => Nova::__('60 Days'),
            365 => Nova::__('365 Days'),
            'TODAY' => Nova::__('Today'),
            'MTD' => Nova::__('Month To Date'),
            'QTD' => Nova::__('Quarter To Date'),
            'YTD' => Nova::__('Year To Date'),
        ];
    }
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }
}
