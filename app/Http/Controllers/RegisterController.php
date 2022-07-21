<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role_user;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    function index(){
      return view("register.index", [
          "title" => "register page",
          "active" => "login",
        ]);
    }
    function store(Request $request){
      $validate = $request->validate([
        "name" => "required|min:3|max:255|unique:users",
        "username" => "required|min:3|max:255|unique:users",
        "email" => "required|email|unique:users",
        "password" => "required|min:5|max:255"
      ]);
      $validate["password"] = bcrypt($validate["password"]);
      
      $newUser = User::create($validate);
      /* give default role #member */
       Role_user::create([
         "user_id" => $newUser->id,
         "role_id" => 3
       ]);
      return redirect("/login/")->with("registered", "registrasion successfully!, please login.");
    }
}
