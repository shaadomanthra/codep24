<?php

$output = shell_exec("bash bash.sh");
//file_put_contents($file, $output);

$json = json_encode($output);
header('Content-Type: application/json');
echo $json;
