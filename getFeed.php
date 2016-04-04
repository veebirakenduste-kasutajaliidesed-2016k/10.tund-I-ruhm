<?php
  //getFeed.php?search=%23Tallinn

  //https://github.com/J7mbo/twitter-api-php
  require_once("twitterAPIExchange.php");

  require_once("config.php");

  $url = "https://api.twitter.com/1.1/search/tweets.json";
  $getField = "?q=%23Tallinn&result_type=recent";

  $requestMethod = "GET";


  $file_name = "cache.txt";
  $data_json = file_get_contents("cache.txt");
  $data = json_decode($data_json);


  if(strtotime(date('c')) - strtotime($data->date_written) > 10){
    // kui rohkem kui 10s möödas lae uuesti, muidu näita välja mis oli failis
  }


  //$config tuleb config.php failist
  $twitter = new twitterAPIExchange($config);

  $dataFromAPI = $twitter->setGetfield($getField)
               ->buildOauth($url, $requestMethod)
               ->performRequest();

  //echo $dataFromAPI;

  $o = new StdClass();
  $o->date_written = date('c');
  $o->api = $dataFromAPI;

  //teen objekti stringiks ja salvestan faili
  file_put_contents($file_name, json_encode($o));

  echo json_encode($o);

?>
