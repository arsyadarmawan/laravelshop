<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // yang boleh manage users cuma admin
        Gate::define('manage-users', function($user){
            return count(array_intersect(["ADMIN"], json_decode($user->roles)));
    
            });
        
        // yang boleh manage category cuma admin dan staff
        Gate::define('manage-categories', function($user){
            return count(array_intersect(["ADMIN", "STAFF"], json_decode($user->roles)));
    
            });
               
        // yang boleh manage category cuma admin dan staff
        Gate::define('manage-books', function($user){
            return count(array_intersect(["ADMIN", "STAFF"],json_decode($user->roles)));
    
            });
            
        // yang boleh manage orders cuma admin dan staff
        Gate::define('manage-orders', function($user){
            return count(array_intersect(["ADMIN", "STAFF"], json_decode($user->roles)));
            });
    }


    // Nah dengan menggunakan array_intersect dikombinasikan dengan count kita bisa mengecek apakah
    // $user->roles memiliki salah satu dari beberapa role yang kita cari.

           
   
}
