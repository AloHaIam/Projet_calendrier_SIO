<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FullCalenderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('full-calender', [FullCalenderController::class, 'index']);

Route::post('full-calender/action', [FullCalenderController::class, 'action']);

?>
