<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

Route::get('/search/local/{ceps}', [SearchController::class, 'search']);

