<?php
  //getFeed.php?search=%23Tallinn

  //https://github.com/J7mbo/twitter-api-php
  require_once("twitterAPIExchange.php");

  require_once("config.php");

  $url = "https://api.twitter.com/1.1/search/tweets.json";
  $getField = "?q=%23Tallinn&result_type=recent";

  $requestMethod = "GET";

  //$config tuleb config.php failist
  $twitter = new twitterAPIExchange($config);

  $dataFromAPI = $twitter->setGetfield($getField)
               ->buildOauth($url, $requestMethod)
               ->performRequest();

  echo $dataFromAPI;

?>
