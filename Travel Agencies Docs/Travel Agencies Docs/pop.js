$(document).ready(function(){
    //active start button
    $('.start-btn').click(function(){
      $('.modal-box').toggleClass("show-modal");
      $('.start-btn').toggleClass("show-modal");
    });
    // active cancle button
    $('.fa-times').click(function(){
      $('.modal-box').toggleClass("show-modal");
      $('.start-btn').toggleClass("show-modal");
    });
  });