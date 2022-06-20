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