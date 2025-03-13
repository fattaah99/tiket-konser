<?php

use Illuminate\Support\Facades\Route;

if (! function_exists('set_active')) {
    function set_active($route)
    {
        return Route::currentRouteNamed($route) ? 'active' : '';
    }
}