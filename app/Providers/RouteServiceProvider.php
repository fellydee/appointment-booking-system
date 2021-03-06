<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        Route::get('api/myBookings','App\Http\Controllers\ApiController@myBookings');
        Route::get('api/getBusinessInfo/{id}','App\Http\Controllers\ApiController@getBusinessInfo');
        Route::get('api/getBusinesses','App\Http\Controllers\ApiController@getBusinesses');
        Route::get('api/test','App\Http\Controllers\ApiController@test');
        Route::get('api/getAvailableTimes/{employee_id}/{service_id}/{date}','App\Http\Controllers\ApiController@getAvailableTimes');
        Route::get('api/getEmployeeHours/{employee_id}','App\Http\Controllers\ApiController@getEmployeeHours');
        Route::get('api/getAllEmployeeHours/{business_id}','App\Http\Controllers\ApiController@getAllEmployeeHours');
        Route::get('api/getAllBookings/{business_id}','App\Http\Controllers\ApiController@getAllBookings');
        //$this->mapApiRoutes();
        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
