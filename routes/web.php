<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $users1 = DB::table('users')->get();
 

    $users = DB::connection('mysql2_connection')->table('users')->get();
    dd($users,$users1);
});
