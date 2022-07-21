<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Role;
use App\Models\Role_user;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("dashboard.users.index", [
            "users" => User::paginate(10)
          ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("dashboard.users.create", [
          "roles" => Role::all()
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
          "name" => "required|min:3|max:255|unique:users",
          "username" => "required|min:3|max:255|unique:users",
          "email" => "required|email|unique:users",
          "password" => "required|min:5",
          "roles" => "required"
        ];
        if ($request->hasFile("photo")) {
          $rules["photo"] = "image|file|max:3072";
        }
        $validate = $request->validate($rules);
        /* encrypt password */
        $validate["password"] = bcrypt($validate["password"]);
        
        /* slug from username */
        $validate["slug"] = SlugService::createSlug(User::class, 'slug', $validate["username"]);
      
        /* upload photo */
        if ($request->hasFile("photo")) {
          $imageUrl = $request->file("photo")->store("post-images");
          $validate["photo"] = $imageUrl;
        }
        $newUser = User::create($validate);
        if ($request->roles) {
           /* delete first all role */
           Role_user::where("user_id", $newUser->id)
             ->delete();
           foreach ($request->roles as $role) {
             Role_user::create([
                 "user_id" => $newUser->id,
                 "role_id" => intval($role)
               ]);
           }
         }
        return redirect()->to(url("/dashboard/users/"))->with("success", "new user with name $newUser->name has been added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view("dashboard.users.show", [
            "user" => $user
          ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view("dashboard.users.edit", [
          "user" => $user,
          "roles" => Role::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
      $rules = [
        "roles" => "required",
        "name" => "required",
        "username" => "required",
        "email" => "required"
      ];
      if ($request->name != $user->name) {
        $rules["name"] = "required|min:3|max:255|unique:users";
      }
      if ($request->username != $user->username) {
        $rules["username"] = "required|min:3|max:255|unique:users";
      }
      if ($request->email != $user->email) {
        $rules["email"] = "required|email|unique:users";
      }
      if ($request->hasFile("photo")) {
        $rules["photo"] = "image|file|max:3072";
        /* remove old photo */
        if ($user->photo !== null) {
          Storage::delete($user->photo);
        }
      }
      /* check if data not change */
      if (($request->name === $user->name && $request->username === $user->username && $request->email === $user->email && !$request->photo) && !$request->roles) {
        if (!$request->roles) {
          return back()->with("error", "roles select can't nullable");
        }
        return back()->with("info", "nothing updated, profile has up to date!");
      }
      
      $validate = $request->validate($rules);
      
      /* unset roles */
      unset($validate["roles"]);
      
      /* if username changed */
      if ($request->username != $user->username) {
        /* slug from username */
       $validate["slug"] = SlugService::createSlug(User::class, 'slug', $validate["username"]);
      }
      /* upload photo */
      if ($request->hasFile("photo")) {
        $imageUrl = $request->file("photo")->store("post-images");
        $validate["photo"] = $imageUrl;
      }
       /* change roles */
       if ($request->roles) {
         /* delete first all role */
         Role_user::where("user_id", $user->id)
           ->delete();
         foreach ($request->roles as $role) {
           Role_user::create([
               "user_id" => $user->id,
               "role_id" => intval($role)
             ]);
         }
       }
      User::where("id", $user->id)
          ->update($validate);
      return redirect()->to(url("/dashboard/users/"))->with("success", "profile $user->name has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        /* delete photo */
        if ($user->photo !== null) {
          Storage::delete($user->photo);
        }
        /* if has posts */
        $admins = Role_user::where("role_id", 1)->get();
        $randomAdmin = $admins[rand(0, $admins->count() - 1)];
        /* user receive posts */
        if ($user->posts->count() > 0) {
          $userReceived = User::where("id", $randomAdmin->user_id)->firstOrFail();
          $updatePosts = Post::where("user_id", $user->id)
            ->update([
             "user_id" => $randomAdmin->user_id
            ]);
          User::destroy("id", $user->id);
          
          return redirect("/dashboard/users")->with("success", "user with name $user->name has been deleted! and ".$user->posts->count()." posts redirect to admin named $userReceived->name");
        } else {
        User::destroy("id", $user->id);
        
        return redirect("/dashboard/users")->with("success", "user with name $user->name has been deleted!");
        }
    }
}
