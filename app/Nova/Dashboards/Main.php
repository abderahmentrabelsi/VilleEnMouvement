<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\Coupons\TotalCoupons;
use App\Nova\Metrics\CouponsPerType;
use App\Nova\Metrics\Orders\AverageOrderAmount;
use App\Nova\Metrics\OrderTrend;
use App\Nova\Metrics\ProductPerCompany;
use App\Nova\Metrics\Products;
use App\Nova\Metrics\ProductTrend;
use App\Nova\Metrics\Users\Users;
use App\Nova\Metrics\Users\UserTrend;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
          new Users,
          new UserTrend,
          new TotalCoupons,
          new CouponsPerType,
          new Products,
          new ProductPerCompany,
          new ProductTrend,
          new AverageOrderAmount,
          new OrderTrend,
        ];
    }
}
