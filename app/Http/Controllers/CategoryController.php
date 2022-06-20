<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
      return view("categories", [
        "title" => "posts category",
        "active" => "categories",
        "categories" => Category::all(),
    ]);
    }
    public function show(Category $category){
      return view("posts", [
        "title" => "post by category : $category->name",
        "active" => "categories",
        "posts" => $category->posts->load("category", "author")
      ]);
    }
}
