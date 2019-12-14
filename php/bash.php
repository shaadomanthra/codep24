<?php

$json = shell_exec("bash bash.sh json/b75104c");
//file_put_contents($file, $output);


header('Content-Type: application/json');
echo $json;
