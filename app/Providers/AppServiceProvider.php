<?php

namespace App\Providers;
use App\Models\TableProductType;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\TableProduct;
use App\Models\TableComment;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $limit = 12;
        Paginator::useBootstrap();
        $min_price = TableProduct::min('price_regular');
        $max_price = TableProduct::max('price_regular');
        $min_price_range = $min_price + 1000000;
        $max_price_range = $max_price + 1000000;
        $dsProductType = TableProductType::select('id', 'name')->get();
        $dsProduct = TableProduct::latest()->paginate($limit);
        View::share([
            'min_price'=>$min_price,
            'max_price'=>$max_price,
            'min_price_range'=>$min_price_range,
            'max_price_range'=>$max_price_range,
            'dsProductType'=>$dsProductType,
            'dsProduct'=>$dsProduct,
            'limit'=>$limit
        ]);
    }
}
