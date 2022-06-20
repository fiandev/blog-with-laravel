@extends("layouts/main")

@section("container")
  <div class="d-flex flex-column justify-content-center align-items-start overflow-scroll" id="about">
  </div>
@endsection

@section("script")
  <script type="text/javascript" charset="utf-8">
    $.get("https://raw.githubusercontent.com/fiandev/fiandev/main/README.md", function(readme){
      let converter = new showdown.Converter()
      let result = converter.makeHtml(readme)
      $("#about").html(result)
    })
  </script>
@endsection