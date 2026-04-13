<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MultiClasses;
use App\Http\Controllers\FacadeController;
use App\Http\Controllers\abc;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HasOneThrough;
use App\Http\Controllers\OneToOne;
use App\Http\Controllers\OneToMany;
use App\Http\Controllers\ManyToMany;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AddMoreController;
use App\Http\Controllers\RedisController;
use Illuminate\Support\Facades\Log;



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::view('/', 'welcome');


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



/* Route::get('/products', function () {
    // return Product::all();
    return Product::create([
        'name'=>'Product 2',
         'slug'=>'product-2',
         'description'=>'Details of Product 2',
         'price'=>9.99

    ]);

}); */


Route::get('/items', [ProductController::class, 'ajaxPagination']);
Route::get('/items_add', [EmployeeController::class, 'items_add']);
Route::post('/employee_save', [EmployeeController::class, 'employee_save']);
Route::get('/test', [EmployeeController::class, 'test']);
// Route::get('ajax-pagination','AjaxController@ajaxPagination')->name('ajax.pagination');


/* =========== multi classes ============= */

Route::get('/multi_class', [MultiClasses::class, 'abc']);
// Route::get('/greet/{name}', [FacadeController::class, 'showUsingFacade']);

/* =============== facades ============
Step 1: Create a helper class (Services named: Services\CustomGreetingService)
Step 2: Register helper in AppServiceProvider (or Custom service provider named: CustomGreetingServiceProvider)
Step 3: Create a facade class (named: Facades\CustomGreetingFacade)
Step 4: Register facade in config/app.php
Step 5: Using the facade
*/
 
Route::get('/greet/{name}', function ($name) {
    return response(Greeting::greet($name), 200);
 })->name('custom-facade');
// Route::get('/greet/{name}', [FacadeController::class, 'showUsingFacade']);


Route::get('/create_log', function () {
    // logs created inside storage/logs/laravel.log
    // return Log::info('This is an info message.');
    // Log::error('This is an error message.');
    // Log::info('User data', ['user_id' => 1, 'name' => 'John Doe']);
    // $logFilePath = '/path/to/logs/logfile.json';
    // file_put_contents($logFilePath, $jsonData . PHP_EOL, FILE_APPEND);
 });

Route::get('posts_view', [PostController::class, 'posts_view']);


/* ========== One to One relationship  ========== 
File used:
Models: User and Vote
Controller OneToOne.php
Migration: create_votes_table and create_user_table
Factory: UserFactory and VoteFactory
Seeder: Database Seeder
*/

Route::prefix('onetoone')->group(function () {
    Route::get('get_user_vote', [OneToOne::class, 'get_user_vote']);  // access associated vote of a user
    Route::get('get_vote_user', [OneToOne::class, 'get_vote_user']);  // access associated user for a vote
    Route::get('create_vote', [OneToOne::class, 'create_vote']);  // create vote
    Route::get('update_vote', [OneToOne::class, 'update_vote']);  // update vote\
});



/* ========== One to Many relationship  ========== 
File used:
Models: Candidate and PoliticalParty
Controller OneToMany.php
Migration: create_political_parties and create_candidates_table
Factory: PolitclaPartyFactory and CadidateFactory
Seeder: Database Seeder
*/
Route::prefix('onetomany')->group(function () {
    Route::get('get_political_party', [OneToMany::class, 'get_political_party']);  
    Route::get('create_candidates', [OneToMany::class, 'create_candidates']);  // create candidates
});

/* ===================== Many to Many ======================= */
Route::prefix('manytomany')->group(function () {
    Route::get('index', [ManyToMany::class, 'index']);  // access associated vote of a user
});

/* ===================== HasOneThrough ======================= */
Route::prefix('hasonethrough')->group(function () {
    Route::get('index', [HasOneThrough::class, 'index']);  // 
});

Route::resource('file', FileController::class);

/* ==================== Add/Delete more =================== */
Route::get('add_more/index', [AddMoreController::class, 'index']);  
Route::post('add_more/store', [AddMoreController::class, 'store'])->name('add_more.store');  


Route::get('sms_send', [FileController::class, 'sms_send']);  

/* ==================== Add/Delete more =================== */
Route::get('handle_redis', [RedisController::class, 'handle_redis']);  



