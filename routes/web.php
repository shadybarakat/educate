<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Checkname;
use App\Http\Controllers\CustomAuthController;

// Route::resource('CustomAuth', CustomAuthController::class, ['except' => ['create', 'edit']]);

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('category', categoryController::class);
Route::resource('instructor', instructorController::class);
Route::resource('course', courseController::class);

Route::prefix('front')->group(function () {
    Route::get('/index','frontController@index');
    Route::get('/first','frontController@first');
    Route::get('/detail/{id}','frontController@detail')->name('detail');
    Route::get('/feature/{id}','frontController@feature')->name('feature');
    Route::get('/instructor/{id}','frontController@instructor')->name('instructor');
    Route::get('/cart/{id}','frontController@cart')->name('cart');
    Route::get('/delete/{id}','frontController@destroy')->name('delete');
    Route::get('/my_cart','frontController@my_cart')->name('my_cart');
});

// Route::group(['prefix' => 'instructor'], function () {
//   Route::get('/login', 'InstructorAuth\LoginController@showLoginForm')->name('login');
//   Route::post('/login', 'InstructorAuth\LoginController@login');
//   Route::post('/logout', 'InstructorAuth\LoginController@logout')->name('logout');

  // Route::get('/register', 'InstructorAuth\RegisterController@showRegistrationForm')->name('register');
  // Route::post('/register', 'InstructorAuth\RegisterController@register');

  // Route::post('/password/email', 'InstructorAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  // Route::post('/password/reset', 'InstructorAuth\ResetPasswordController@reset')->name('password.email');
  // Route::get('/password/reset', 'InstructorAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  // Route::get('/password/reset/{token}', 'InstructorAuth\ResetPasswordController@showResetForm');
// });

// Route::group(['prefix' => 'manager'], function () {
//   Route::get('/login', 'ManagerAuth\LoginController@showLoginForm')->name('login');
//   Route::post('/login', 'ManagerAuth\LoginController@login');
//   Route::post('/logout', 'ManagerAuth\LoginController@logout')->name('logout');

//   Route::get('/register', 'ManagerAuth\RegisterController@showRegistrationForm')->name('register');
//   Route::post('/register', 'ManagerAuth\RegisterController@register');

//   Route::post('/password/email', 'ManagerAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
//   Route::post('/password/reset', 'ManagerAuth\ResetPasswordController@reset')->name('password.email');
//   Route::get('/password/reset', 'ManagerAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
//   Route::get('/password/reset/{token}', 'ManagerAuth\ResetPasswordController@showResetForm');
// });

// Route::group(['prefix' => 'instructorauth'], function () {
//   Route::get('/login', 'InstructorauthAuth\LoginController@showLoginForm')->name('login');
//   Route::post('/login', 'InstructorauthAuth\LoginController@login');
//   Route::post('/logout', 'InstructorauthAuth\LoginController@logout')->name('logout');

//   Route::get('/register', 'InstructorauthAuth\RegisterController@showRegistrationForm')->name('register');
//   Route::post('/register', 'InstructorauthAuth\RegisterController@register');

//   Route::post('/password/email', 'InstructorauthAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
//   Route::post('/password/reset', 'InstructorauthAuth\ResetPasswordController@reset')->name('password.email');
//   Route::get('/password/reset', 'InstructorauthAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
//   Route::get('/password/reset/{token}', 'InstructorauthAuth\ResetPasswordController@showResetForm');
// });
