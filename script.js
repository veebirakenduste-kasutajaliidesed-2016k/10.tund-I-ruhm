var $grid;

$(function() {


    console.log("leht on laetud");

    getTweets();

    $grid = $('#feed').isotope({
      itemSelector: '.item'
    });


});

var getTweets = function(){
  console.log('getting tweets...');

  $.ajax({
    url: "getFeed.php",
    success: function(result){
      //console.log(JSON.parse(result).api.statuses);

      printTweets(JSON.parse(result).api.statuses);

    },
    error: function(xhr,status,error){
      console.log(error);
    }
  });

};

var printTweets = function(ajaxStatuses){

  var items = '';

  //foreach
  $.each(ajaxStatuses, function(index, tweet){

    /*
      <div class="item">
        <img class="profile-img" src="" alt="">
        <div class="author"></div>
        <p class="text"></p>
      </div>
    */

    items +=  '<div class="item">'+
                  '<div class="profile-img" style="background-image: url('+tweet.user.profile_image_url.replace("_normal","")+')" ></div>'+
                  '<div class="author">'+tweet.user.name+'</div>'+
                  '<p class="text">'+tweet.text+'</p>'+
                '</div>';

    //console.log($(item));

  });

  //kõik korraga
  var temp = $(items);

  $grid.prepend(temp)
       .isotope( 'prepended', temp )
       .isotope('layout');

  //get new every 5 seconds
  window.setTimeout(function(){
    //getTweets sees peaks kontrollima ja meeles hoidma millised tweedid on olemas
    getTweets();
  }, 5000);

};
