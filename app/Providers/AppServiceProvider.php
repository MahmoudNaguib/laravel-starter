<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;
use Form;
use Validator;
use Config;
use Illuminate\Pagination\Paginator;

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
    public function boot() {
        Schema::defaultStringLength(250);
        /// validation rules
        Validator::extend('mobile', function ($attribute, $value, $parameters, $validator) {
            if ($value == '') {
                return true;
            }
            if (!trim($value) && intval($value) != 0) {
                return true;
            }
            //return (preg_match('/^01[0125][0-9]{8}$/', $value));
            return (preg_match('/^0[0-9]{10}$/', $value));

        });
        Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
            if ($value == '') {
                return true;
            }
            if (!trim($value) && intval($value) != 0) {
                return true;
            }
            return (preg_match('/^([(+)0-9,\\-,+,]){4,15}$/', $value));
        });
        //////////// Custom User validator
        Validator::extend('in_degrees', function ($attribute, $value, $parameters, $validator) {
            $row=new \App\Models\BaseModel();
            return in_array($value,array_keys(educationalDegrees()));
        });

        Validator::extend('in_job_types', function ($attribute, $value, $parameters, $validator) {
            $row=new \App\Models\BaseModel();
            return in_array($value,array_keys(jobTypes()));
        });

        Validator::extend('in_years_of_experience', function ($attribute, $value, $parameters, $validator) {
            $row=new \App\Models\BaseModel();
            return in_array($value,array_keys(yearsOfExperiences()));
        });

        Validator::extend('in_salary_ranges', function ($attribute, $value, $parameters, $validator) {
            $row=new \App\Models\BaseModel();
            return in_array($value,array_keys(salaryRanges()));
        });

        Paginator::useBootstrap();
        /*$timezone=(conf('time_zone'))?:'Asia/Dubai';
        Config::set("app.timezone",$timezone);
        date_default_timezone_set($timezone);*/
    }

}
