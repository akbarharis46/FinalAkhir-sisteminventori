$(document).ready(function(){
    $(".rowBar").click(function(){
      $("#sidebar").toggleClass('active');
      $(".cc").toggleClass("ccoff");
      $(".tableSize").toggleClass("ctableSize");
      $(".menubar").toggleClass("menubarres");
    });
  });