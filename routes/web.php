<?php

use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/estate', [HomeController::class, 'estate'])->name('estate');
Route::get('/service', [HomeController::class, 'service'])->name('service');
Route::get('/live-trades', [HomeController::class, 'trades'])->name('trades');
Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');
Route::get('/tos', [HomeController::class, 'tos'])->name('tos');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/faqs', [HomeController::class, 'faqs'])->name('faqs');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/publicnotice', [HomeController::class, 'publicnotice'])->name('publicnotice');
Route::get('/reasonstorecovertbc', [HomeController::class, 'reasonstorecovertbc'])->name('reasonstorecovertbc');
Route::get('/insurance', [HomeController::class, 'insurance'])->name('insurance');
Route::get('/howtorecovertbc', [HomeController::class, 'howtorecovertbc'])->name('howtorecovertbc');
Route::get('/stucked', [HomeController::class, 'stucked'])->name('stucked');
Route::get('/howtologin', [HomeController::class, 'howtologin'])->name('howtologin');
Route::get('/thebillioncoin', [HomeController::class, 'thebillioncoin'])->name('thebillioncoin');
Route::get('/features', [HomeController::class, 'features'])->name('features');
Route::get('/checktbcbalance', [HomeController::class, 'checktbcbalance'])->name('checktbcbalance');
Route::get('/tbcrate', [HomeController::class, 'tbcrate'])->name('tbcrate');
Route::get('/safeandsecure', [HomeController::class, 'safeandsecure'])->name('safeandsecure');
Route::get('/commontbcmistakes', [HomeController::class, 'commontbcmistakes'])->name('commontbcmistakes');
Route::post('/contact', [HomeController::class, 'contactValidate'])->name('contact-validate');
Route::get('/p/{slug}', [HomeController::class, 'page'])->name('page');

Route::get('/emailcontact', [HomeController::class, 'emailcontact'])->name('emailcontact');
Route::post('/emailcontact', [HomeController::class, 'emailproof'])->name('emailproof');
