<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\AdminCategoriesController;
use App\Http\Controllers\DashboardProfileController;
use App\Http\Controllers\AdminUserController;
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

Route::get('/', function (){
  return redirect("/home/");
});
Route::get('/about', function () {
    return view('about', [
        "title" => "about",
        "active" => "about",
        "author" => "fian",
        "email" => "fiandev1234@gmail.com",
        "message" => "hi 👋"
      ]);
});
Route::get('/blog', [PostController::class, "index"]);
Route::get('/home', [PostController::class, "index"]);
Route::get("/posts", [PostController::class, "index"]);
Route::get("/posts/{post:slug}", [PostController::class, "show"]);
Route::get("/categories/", [CategoryController::class, "index"]);
Route::get("/categories/{category:slug}", [CategoryController::class, "show"]);

Route::get("/authors/{author:username}", function(User $author){
  return view('posts', [
      "title" => "post by : $author->name",
      "active" => "posts",
      "author" => $author,
      "totalPost" => $author->posts->count(),
      "posts" => $author->posts->load("author", "category")
    ]);
});

Route::get("/login", [LoginController::class, "index"])->name("login")->middleware("guest");
Route::post("/login", [LoginController::class, "authenticate"]);
Route::post("/logout", [LoginController::class, "logout"]);

Route::get("/dashboard/", [DashboardController::class, "index"])->middleware("auth");
Route::get("/dashboard/posts/checkSlug", [DashboardPostController::class, "checkSlug"])->middleware("auth");
Route::resource("/dashboard/posts", DashboardPostController::class)->middleware("member");

Route::get("/dashboard/profile", [DashboardProfileController::class, "show"])->middleware("auth");
Route::get("/dashboard/profile/edit", [DashboardProfileController::class, "edit"])->middleware("auth");
Route::post("/dashboard/profile", [DashboardProfileController::class, "update"])->middleware("auth");
Route::get("/authors/profile/{user:slug}", [DashboardProfileController::class, "shared"])->middleware("member");

Route::resource("/dashboard/categories", AdminCategoriesController::class)->except("show")->middleware("admin");

Route::resource("/dashboard/users", AdminUserController::class)->middleware("admin");

Route::get("/register", [RegisterController::class, "index"])->middleware("guest");
Route::post("/register", [RegisterController::class, "store"]);




Route::get('post-images/{filename}', function($filename){
    $path = storage_path('app/public/' . "post-images/" . $filename);
    
    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
Route::get('/{path}', function($path){
    $path = str_replace("_", "/", $path);
    $pathfile = storage_path('app/public/' .$path);
    if (!File::exists($pathfile)) {
        abort(404);
    }

    $file = File::get($pathfile);
    $type = File::mimeType($pathfile);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
