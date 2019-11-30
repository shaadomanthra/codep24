<?php



$json = run3();
//file_put_contents($file, $output);


header('Content-Type: application/json');
echo $json;


function run3(){
		return shell_exec("bash bash.sh json/b75104c");
}

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