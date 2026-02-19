<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

// --- Add your routes below ---

Route::get('/add-name', function () {
    return '<form method="POST" action="/save-name">
                ' . csrf_field() . '
                <input type="text" name="name" placeholder="Enter name" required>
                <button type="submit">Save</button>
            </form>';
});

Route::post('/save-name', function (Request $request) {
    DB::table('names')->insert([
        'name' => $request->name,
        'created_at' => now(),
        'updated_at' => now()
    ]);
    return 'Name saved successfully: ' . $request->name;
});
