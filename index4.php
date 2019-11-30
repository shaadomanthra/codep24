<?php


$start_time = microtime(true);
			$lang = 'clang';
		
			$payload = '{"language":"c","command":"clang main.c && ./a.out", "files": [{"name": "main.c", "content": "#include<stdio.h> \n int main(void)\n {\n printf(\"Hello World!\");\n return 0;\n}"}]}';	
		
		

		
		$output = run2($lang,$payload);
		$end_time = microtime(true); 

		$execution_time = ($end_time - $start_time); 
		$json = json_decode($output);
		if(!$json)
			$json = new Boot;
		$json->time = round($execution_time,2);
		$output = json_encode($json);
		//header('Content-Type: application/json');
		echo $output;

	function run2($lang,$payload){

		$file = 'json/'.substr(md5(mt_rand()), 0, 7);
		$filename = $file.'.json';
		file_put_contents($filename, $payload);
		
		$cmd = "bash bash.sh ".$file;

		echo $cmd;
		echo "\n";
		$output = shell_exec($cmd);
		unlink($filename);
		return $output;
		
	}