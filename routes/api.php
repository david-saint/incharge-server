<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

foreach (array_diff(scandir(base_path('routes/api/')), array('..', '.')) as $routefile) {
    Route::prefix($routefile)
        ->name("$routefile::")
        ->domain(config('app.api-domain'))
        ->namespace(ucfirst(($routefile)))
        ->group(function ($router) use ($routefile) {
            foreach (array_diff(scandir(base_path('routes/api/' . $routefile)), array('..', '.')) as $file) {
                $router->group(['prefix' => pathinfo($file)['filename']], function () use ($file, $routefile) {
                    require base_path("routes/api/$routefile/$file");
                });

            }
        });
}
