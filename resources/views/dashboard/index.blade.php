@extends("dashboard.main")

@section("container")
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">hi, {{ auth()->user()->name }} 👋</h1>
</div>
@endsection