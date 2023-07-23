<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        // Check if all values in the array are valid checkbox values
        Validator::extend('checkbox_values', function($attribute, $value, $parameters, $validator){
            foreach($value as $checkboxValue){
                if(!is_numeric($checkboxValue) || !ctype_digit((string) $checkboxValue)){
                    return false;
                }
            }
            return true;
        });
    }
}
