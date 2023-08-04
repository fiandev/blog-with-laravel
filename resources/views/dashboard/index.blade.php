@extends("dashboard.main")

@section("container")
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">hi, {{ auth()->user()->name }} 👋</h1>
</div>

<div class="statistic">
  <div class="chart-container">
    <canvas class="" id="popularPosts"></canvas>
  </div>
  <div class="chart-container">
    <canvas class="" id="popularCategory"></canvas>
  </div>
</div>
@endsection

<?php
use Carbon\Carbon;
$popularPostsData = [];
foreach ($popularPosts as $post) {
  $popularPostsData["visited"][] = $post->visited;
  $popularPostsData["date"][] = $post->created_at->diffForHumans();
}

?>
@section("script")
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
<script src="{{ url('/js/chartdashboard.js') }}"></script>
<script type="text/javascript" charset="utf-8">
  // Graphs
  const popularPostsCtx = document.querySelector('#popularPosts');
  const popularCategoryCtx = document.querySelector('#popularCategory');
  const popularPosts = <?= json_encode($popularPostsData); ?>;
  const popularCategory = <?= json_encode($popularCategory); ?>;
  const popularStats = makeChart(popularPostsCtx, "line", "popular posts", popularPosts.visited, popularPosts.date, "popular");
  const popularCategoryStats = makeChart(popularCategoryCtx, "bar", "popular category", popularCategory.values, popularCategory.names, "popular category");
</script>
@endsection