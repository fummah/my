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
  "location_code" => 1023191,
  "language_code" => "en",
  "keyword" => mb_convert_encoding("cheap hotel", "UTF-8")
);
// example #2 - a way to set a task with additional parameters
$post_array[] = array(
  "location_name" => "New York,New York,United States",
  "language_name" => "English",
  "keyword" => mb_convert_encoding("cheap hotel", "UTF-8"),
  "check_in" => "2021-06-01",
  "check_out" => "2021-06-30",
  "currency" => "USD",
  "adults" => 2,
  "children" => [14],
  "sort_by" => "highest_rating",
  "tag" => "example"
);
// this example has 2 elements, but in the case of large number of tasks - send up to 100 elements per POST request
if (count($post_array) > 0) {
  try {
    // POST /v3/business_data/google/hotel_searches/live
    $result = $client->post('/v3/business_data/google/hotel_searches/live', $post_array);
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