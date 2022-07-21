<?php
use App\Models\Category;
function getKeywords(){
  $keys = Category::all()->load("posts");
  $result = "";
  foreach ($keys as $i => $key){
    $result .= $key->name;
    if ($key !== $keys->last()) {
      $result .= ",";
    }
  }
  return $result;
}

function icon_web(){
  return url("/")."/favicon.ico";
}

function parseFileUrl($url) {
  $result = str_replace("/", "_", $url);
  return $result;
}

function hasRole($roles, $roleSingle) {
  $arrRolesName = [];
  $roleName = $roleSingle->name;
  /* push name of all roles */
  foreach ($roles as $role) {
    array_push($arrRolesName, $role->name);
  }
  return in_array($roleName, $arrRolesName);
}