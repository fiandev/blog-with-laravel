<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;
class DashboardProfileController extends Controller
{
    
    public function edit()
    {
        return view("dashboard.profile.edit");
    }
    public function show(User $user)
    {
        return view("dashboard.profile.show");
    }
    public function shared(User $user)
    {
        return view("dashboard.profile.show");
    }
   
    public function update(Request $request, User $user)
    {
      $rules = [
          "name" => "required|min:3",
          "username" => "required|min:3",
          "email" => "required|email"
        ];
      if ($request->name === auth()->user()->name && $request->username === auth()->user()->username && $request->email === auth()->user()->email && !$request->photo ) {
        return back()->with("info", "nothing updated, profile has up to date!");
      }
      if ($request->name != auth()->user()->name) {
        $rules["name"] = "required|min:3|max:255|unique:users";
      }
      if ($request->username != auth()->user()->username) {
        $rules["username"] = "required|min:3|max:255|unique:users";
      }
      if ($request->hasFile("photo")) {
        $rules["photo"] = "image|file|max:3072";
        /* remove old photo */
        if (auth()->user()->photo !== null) {
          Storage::delete(auth()->user()->photo);
        }
      }
      $validate = $request->validate($rules);
      
      /* slug from username */
      if ($request->username != auth()->user()->username) {
        $validate["slug"] = SlugService::createSlug(User::class, 'slug', $validate["username"]);
      }
      
      if ($request->hasFile("photo")) {
        $imageUrl = $request->file("photo")->store("static");
        $validate["photo"] = $imageUrl;
      }
      User::where("id", auth()->user()->id)
          ->update($validate);
      return back()->with("success", "profile has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
