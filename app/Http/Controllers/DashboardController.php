<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Role;
use App\Models\Category;
use Carbon\Carbon;
use DB;
class DashboardController extends Controller
{
    public function index(){
      /* statistic user post */
      $popularPosts = Post::orderBy("visited", "DESC")
        ->paginate(3);
      $categories = Category::all()->load("posts");
      $popularCategory = [];
      foreach ($categories as $category) {
        $popularCategory["names"][] = $category->name;
        $popularCategory["values"][] = $category->posts->sortBy("visited")->count();
      }
      return view("dashboard.index", [
        "roles" => Role::all(),
        "popularPosts" => $popularPosts,
        "popularCategory" => $popularCategory
      ]);
    } 
}
