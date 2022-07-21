<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Contracts\Publisher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("dashboard.posts.index", [
          "posts" => Post::where("user_id", auth()->user()->id)->paginate(7)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("dashboard.posts.create", [
          "categories" => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
          "title" => "required|max:255",
          "slug" => "required|unique:posts",
          "category_id" => "required",
          "body" => "required",
          "image" => "image|file|max:3072"
        ];
        $validateData = $request->validate($rules);
        /* add newcategory */
        if (intval($validateData["category_id"]) === 0) {
          $cat = $validateData["category_id"];
          if (Category::where("name", $validateData["category_id"])->first() !== null) {
           return back()->with("error", "category named $cat has been exist!")->withInput();
          }
          $newCategory = Category::create([
              "name" => $validateData["category_id"],
              "slug" => SlugService::createSlug(Category::class, 'slug', $validateData["category_id"])
            ]);
          $validateData["category_id"] = $newCategory->id;
        }
        
        $validateData["user_id"] = auth()->user()->id;
        $validateData["excerpt"] = Str::limit(strip_tags($request->body), 200);
        
        if ($request->hasFile("image")) {
          $imageUrl = $request->file("image")->store("post-images");
          
          $validateData["image"] = $imageUrl;
        }
        Post::create($validateData);
        
        return redirect("/dashboard/posts")->with("success", "new post has been added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("dashboard.posts.show", [
          "post" => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view("dashboard.posts.edit", [
          "post" => $post,
          "categories" => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
          "title" => "required|max:255",
          "category_id" => "required",
          "body" => "required",
          "image" => "image|file|max:3072"
        ];
        if ($request->slug != $post->slug) {
          $rules["slug"] = "required|unique:posts";
        }
        
        /* validate */
        $validateData = $request->validate($rules);
        
        $validateData["excerpt"] = Str::limit(strip_tags($request->body), 200);
        
        if ($request->hasFile("image")) {
          /* delete old thumbnail */
          if ($post->image !== null) {
            storage::delete($post->image);
          }
          $imageUrl = $request->file("image")->store("post-images");
          $validateData["image"] = $imageUrl;
        }
        
        /* add newcategory */
        if (intval($validateData["category_id"]) === 0) {
          $cat = $validateData["category_id"];
          if (Category::where("name", $validateData["category_id"])->count() > 0) {
           return back()->with("error", "category named $cat has been exist!")->withInput();
          }
          $newCategory = Category::create([
              "name" => $validateData["category_id"],
              "slug" => SlugService::createSlug(Category::class, 'slug', $validateData["category_id"])
            ]);
          $validateData["category_id"] = $newCategory->id;
        }
        
        /* update */
        Post::where("id", $post->id)
          ->update($validateData);
        
        return redirect("/dashboard/posts")->with("success", "post has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        /* if has image thumbnail */
        if ($post->image != null) {
          storage::delete($post->image);
        }
        Post::destroy($post->id);
        return redirect("/dashboard/posts")->with("success", "post has been deleted!");
    }
    
    public function checkSlug(Request $request){
      $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
      return response()->json(["slug" => $slug]);
    }
}
