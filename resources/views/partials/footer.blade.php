<?php
use App\Models\Category;
$categories = Category::all()->load("posts");
?>
<div class="rounded border-top border-3 border-info shadow-sm footer pt-3 container px-0">
  <h1 class="text-center text-info footer-header mb-3">MyBlog</h1>
  <div class="row mx-0 px-0">
    <div class="col-md-6 footer-item d-md-flex align-items-center flex-column px-3">
      <h1>categories</h1>
      <ul class="d-md-flex flex-column justify-content-between">
        @foreach($categories as $i => $category)
        <li class="py-1">
          <a class="d-flex justify-content-between" href="/posts/?category={{ $category->slug }}">{{ $category->name }} <span>({{ $category->posts->count()  }})</span></a>
          </li>
        @endforeach
      </ul>
    </div>
    <div class="footer-item col-md-6 d-flex align-items-center flex-column gap-3 text-center">
      <h1>follow us on</h1>
      <div class="medsos">
        <a href="#"><i class="fa-brands fa-facebook"></i></a>
        <a href="#"><i class="fa-brands fa-instagram"></i></a>
        <a href="#"><i class="fa-brands fa-twitter"></i></a>
        <a href="#"><i class="fa-brands fa-discord"></i></a>
        <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
        <a href="#"><i class="fa-brands fa-pinterest"></i></a>
        <a href="#"><i class="fa-brands fa-google"></i></a>
        <a href="#"><i class="fa-brands fa-youtube"></i></a>
        <a href="#"><i class="fa-brands fa-tiktok"></i></a>
        <a href="#"><i class="fa-brands fa-messager"></i></a>
        <a href="#"><i class="fa-brands fa-line"></i></a>
        <a href="#"><i class="fa-brands fa-telegram"></i></a>
        <a href="#"><i class="fa-brands fa-github"></i></a>
      </div>
    </div>
    
  </div>
  <div class="bg-info text-center py-2 copyright text-light">
    &copy; <span>2022</span> | MyBlog
  </div>
</div>