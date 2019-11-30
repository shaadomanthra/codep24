<?php

$json = shell_exec("bash bash.sh c");
//file_put_contents($file, $output);


header('Content-Type: application/json');
echo $json;
