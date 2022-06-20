$(document).ready(function (){
  $("#btnAddCategory").on("click", function (){
    $(this).remove()
    $("#addCategory").toggleClass("d-none")
  })
})