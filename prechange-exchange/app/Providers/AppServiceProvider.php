<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use View;
use Illuminate\Contracts\Auth\Guard;
use App\Admin;
use App\User;
use App\SuperAdmin;

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
    public function boot(Guard $guard)
    {
          View::composer('*', function($view) use($guard) {
            $view->with('sitename', 'Yourxchanger');
   
            $site_logo = 'logo1.png';
            $view->with('site_logo', $site_logo);


            if (!empty($guard->user()))
            {
               
               $user = User::where('id', $guard->user()->id)->first();
               $username = explode('@', $user->email);
  

                $view->with('login_user_name', $username[0]);

            }
            else
            {
              //  $admin = Admin::where('id', 1)->first();
                $adminTicketsCount = \DB::table('ticket_chats')->where([
                ['admin_status', 0],
                ])->count();

                $view->with('adminTicketsCount', $adminTicketsCount);

            }
         });
    }
}
