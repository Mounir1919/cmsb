<?php
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller2;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home/{name?}', [Controller2::class, 'index'])->name('home');
Route::get('/admin/{name?}', [Controller2::class, 'admin'])->name('admin');
Route::get('/tables/{name?}', [Controller2::class, 'tables'])->name('tables');

//Route::get('/post/{id}', 'Controller_2@show')

Route::get('/post/{id}', [Controller2::class, 'show'])->name('post.show');
Route::get('deleted/post1/{id}', [Controller2::class, 'show2'])->name('post.show2');
Route::get('/add}', [Controller2::class, 'create'])->name('add');
Route::post('/add/post}', [Controller2::class, 'store'])->name('post.store');
Route::get('/edit/post/{id}', [Controller2::class, 'edit'])->name('post.edit');
Route::put('/update/post/{id}', [Controller2::class, 'update'])->name('post.update');
Route::delete('/delete/post/{id}', [Controller2::class, 'delete'])->name('post.delete');
Route::delete('/deleted/post2/{id}', [Controller2::class, 'perma'])->name('post.perma');
Route::resource('categories', 'categorycontroller');
Route::get('/deleted/{name?}', [Controller2::class, 'index2'])->name('deleted');
Route::get('/deleted/post3/{id}', [Controller2::class, 'restore'])->name('post.restore');
Route::get('/deleted/posts/restore-all', [Controller2::class, 'restoreall'])->name('post.restoreall');
Route::get('/deleted/posts/delete-all', [Controller2::class, 'permaall'])->name('post.permaall');
Route::delete('/posts/delete-multiple', [Controller2::class, 'deleteMultiple'])->name('post.deleteMultiple');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('home');
    })->name('dashboard');
});
Auth::routes();



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
