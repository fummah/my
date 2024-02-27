<?php
// You can download this file from here https://cdn.dataforseo.com/v3/examples/php/php_RestClient.zip
require('RestClient.php');
$api_url = 'https://api.dataforseo.com/';
// Instead of 'login' and 'password' use your credentials from https://app.dataforseo.com/api-dashboard
$client = new RestClient($api_url, null, 'login', 'password');
$post_array = array();
// example #1 - a simple way to set a task
// this way requires you to specify a location, a language of search, and a keyword.
$post_array[] = array(
    "url_path" => "Hotel_Review-g60763-d23462501-Reviews-Margaritaville_Times_Square-New_York_City_New_York.html",
    "location_code" => 1003854,
    "pingback_url" => 'https://your-server.com/pingback.php?id=$id&tag=$tag',
    "tag" => "some_string_123"
);
// example #2 - a way to set a task with additional parameters
// high priority allows us to complete a task faster, but you will be charged more money.
// after a task is completed, we will send a GET request to the address you specify. Instead of $id and $tag, you will receive actual values that are relevant to this task.
$post_array[] = array(
    "url_path" => "Hotel_Review-g60763-d23462501-Reviews-Margaritaville_Times_Square-New_York_City_New_York.html",
    "location_code" => 1003854,
    "pingback_url" => 'https://your-server.com/pingback.php?id=$id&tag=$tag',
    "tag" => "some_string_123",
    "priority" => 2
);
// example #3 - an alternative way to set a task
// after a task is completed, we will send the results according to the address you set in the 'postback_url' field.
$post_array[] = array(
   "url_path" => "Hotel_Review-g60763-d23462501-Reviews-Margaritaville_Times_Square-New_York_City_New_York.html",
   "location_code" => 1003854,
   "postback_url" => "https://your-server.com/postbackscript"
);
// this example has a 3 elements, but in the case of large number of tasks - send up to 100 elements per POST request
if (count($post_array) > 0) {
   try {
      // POST /v3/business_data/tripadvisor/reviews/task_post
      $result = $client->post('/v3/business_data/tripadvisor/reviews/task_post', $post_array);
      print_r($result);
      // do something with post result
   } catch (RestClientException $e) {
      echo "n";
      print "HTTP code: {$e->getHttpCode()}n";
      print "Error code: {$e->getCode()}n";
      print "Message: {$e->getMessage()}n";
      print  $e->getTraceAsString();
      echo "n";
   }
}
$client = null;
?>