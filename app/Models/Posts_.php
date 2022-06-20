<?php
namespace App\Models;

class Posts {
  private static $blog_posts = [
    [
      "title" => "article satu",
      "slug" => "article-satu",
      "author" => "ryuudev",
      "body" => "Hello world"
    ],
    [
      "title" => "article dua",
      "slug" => "article-dua",
      "author" => "ryuudev",
      "body" => "Hello world"
    ]
  ];
  public static function all() {
    return collect(self::$blog_posts);
  }
  public static function find($slug) {
    $posts = static::all();
    return $posts->firstWhere("slug", $slug);
  }
}