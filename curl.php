<?php


$curl = curl_init();
      // Set some options - we are passing in a useragent too here

$code = json_encode($code);

dd($code);
curl_setopt_array($curl, [
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => 'https://p24.in',
	CURLOPT_POST => 1,
]);

$data ='hash=krishnateja&c=1&docker=0&lang=clang&form=1&code='.$code;
      //$data ='{"files": [{"name": "main.c", "content": '.$code.'}]}';
      //echo $data;
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

      // Send the request & save response to $resp
$data = curl_exec($curl);

      // Close request to clear up some resources
curl_close($curl);