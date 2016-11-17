<?php

namespace App\Providers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $all_categories = DB::table('categories')-> select('id','name')->get();
        view()->share('all_categories', $all_categories);

        $all_tags = DB::table('tags')->select('id','name','description')->get();
        view()->share('all_tags',$all_tags);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
