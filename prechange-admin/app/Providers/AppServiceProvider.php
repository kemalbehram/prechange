<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use View;
use Illuminate\Contracts\Auth\Guard;
use App\Models\Tickets;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Guard $guard)
    {
        View::composer('*', function($view) use($guard) {

            if (!empty($guard->user()))
            {
                $userTicketsCount = Tickets::on('mysql2')->where([
                ['status', 0],
                ['user_id', $guard->user()->id],
                ])->count(); 
              
                $view->with('userTicketsCount', $userTicketsCount);

            }
            else
            { 
                $adminTicketsCount = Tickets::on('mysql2')->where('status', 0)->count(); 
                
                $view->with('adminTicketsCount', $adminTicketsCount);

            } 
         
         });

        Schema::defaultStringLength(191);
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
