<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("admin");
        return view("dashboard.categories.index", [
          "categories" => Category::paginate(100)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validateData = $request->validate([
            "category_id" => "required"
          ]);
        $cat = $validateData["category_id"];
        if (Category::where("name", $validateData["category_id"])->count() > 0) {
          return back()->with("error", "category named $cat has been exist!")->withInput();
        }
        $newCategory = Category::create([
            "name" => $validateData["category_id"],
            "slug" => SlugService::createSlug(Category::class, 'slug', $validateData["category_id"])
          ]);
        return back()->with("success", "category $newCategory->name has been added !");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validateData = $request->validate([
            "category_id" => "required"
          ]);
        $cat = $validateData["category_id"];
        if (Category::where("name", $validateData["category_id"])->count() > 0) {
          return back()->with("error", "category named $cat has been exist!")->withInput();
        }
        $newCategory = Category::where("id", $category->id)
        ->update([
            "name" => $validateData["category_id"],
            "slug" => SlugService::createSlug(Category::class, 'slug', $validateData["category_id"])
          ]);
        return back()->with("success", "category $cat has been updated !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        return back()->with("success", "category $category->name has been deleted !");
    }
}
