<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
      $title = "all posts";
      $_author = str_replace("-", " ", request("author"));
      $_category = str_replace("-", " ", request("category"));
      if (request("author")) {
        $title .= " by $_author";
      }
      if (request("category")) {
        $title .= " in $_category";
      }
      
      /* parameter null */
      if (request("category")) {
        if (request("category") == null) {
          abort(404);
        }
      }
      if (request("author")) {
        if (request("author") == null) {
          abort(404);
        }
      }
      // return Post::latest()->filter(request(["search", "category", "author"]))->paginate(7)->withQueryString();
      return view('posts', [
        "title" => $title,
        "active" => "posts",
        "posts" => Post::latest()->filter(request(["search", "category", "author"]))->paginate(7)->withQueryString(),
        "popular" => Post::orderBy('visited', 'desc')->filter(request(["search", "category", "author"]))->paginate(10)->withQueryString(),
        "recomendation" => Post::orderBy('title', 'asc')->filter(request(["search", "category", "author"]))->paginate(10)->withQueryString()
      ]);
    }
    public function show(Post $post) {
      Post::where("id", $post->id)
      ->update(["visited" => $post->visited + 1]);
      return view('post', [
        "title" => "posts",
        "active" => "posts",
        "post" => $post->load("author", "category")
      ]);
    }
}
