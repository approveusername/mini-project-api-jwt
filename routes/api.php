<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
/* Route::post('/products', function () {

    return Product::create([
        'name'=>'Product thr',
         'slug'=>'product-thr',
         'description'=>'Details of Product thr',
         'price'=>9.99

    ]);

});// // Route::resource('products', ProductController::class);
// Route::get('/products/{id}', [ProductController::class,'show']);

//Protected routes-Only authenticated users can have access to protected routes//
Route::group(['middleware' => ['auth:sanctum']], function () {
    //  Route::post('/products',[ProductController::class,'store']);
     Route::put('/products/{id}',[ProductController::class,'update']);
     Route::delete('/products/{id}',[ProductController::class,'delete']);
 });

*/
/* ============= mini project routes start ======================= */
Route::post('/auth/register', [AuthController::class,'register']);
Route::post('/auth/login', [AuthController::class,'login'])->name('login');
Route::get('/auth/profile', [AuthController::class,'profile'])->name('profile');

Route::middleware(['jwt'])->group(function () {
    Route::get('/auth/profile', [AuthController::class, 'profile']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    
    // Book CRUD routes
    Route::post('/books', [BookController::class, 'store']);
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/{id}', [BookController::class, 'show']);
    Route::put('/books/{id}', [BookController::class, 'update']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);
});
/* ============= mini project routes end ======================= */




/* =========================== test routes (myself) ================================== */
/* //  Route::post('/register',[AuthController::class,'register']);
Route::post('/register', [JWTAuthController::class,'register']);
Route::post('/login', [JWTAuthController::class,'login'])->name('login');
Route::get('posts', [PostController::class, 'index']);
Route::get('posts/{id}', [PostController::class, 'show']);
Route::post('posts', [PostController::class, 'store']);
Route::put('posts/{id}', [PostController::class, 'update']);
Route::delete('posts/{id}', [PostController::class, 'destroy']);

Route::group(['middleware' => 'jwt'], function () {
    Route::any('/show_users', [JWTAuthController::class,'getUser']);
}); */
