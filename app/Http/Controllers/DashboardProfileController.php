<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardProfileController extends Controller
{
    public function index()
    {
        return view("dashboard.profile.index");
    }
   
    public function update(Request $request, User $user)
    {
      $rules = [
          "name" => "required|min:3",
          "username" => "required|min:3"
        ];
      if ($request->name === auth()->user()->name && $request->username === auth()->user()->username && $request->email === auth()->user()->email) {
        return back()->with("info", "nothing updated, profile has up to date!");
      }
      if ($request->name != auth()->user()->name) {
        $rules["name"] = "required|min:3|max:255|unique:users";
      }
      if ($request->username != auth()->user()->username) {
        $rules["username"] = "required|min:3|max:255|unique:users";
      }
      $validate = $request->validate($rules);
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
