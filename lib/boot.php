<?php


class Boot{

	function main(){
		$start_time = microtime(true);

		$payload = $this->get('payload');
		$hash = $this->get('hash');
		$lang = $this->get('lang');
		$form = $this->get('form');
		

		if($hash=='krishnateja'){
			$output = $this->run($lang,$payload);

			$end_time = microtime(true); 
			$execution_time = ($end_time - $start_time); 
			$json = json_decode($output);
			$json->time = round($execution_time,2);
			$output = json_encode($json);
			header('Content-Type: application/json');
			echo $output;
			
		
		}else{
			echo "<h1>Hello !</h1>";
			echo "<pre>Krishna Teja GS</pre>";
		}
	}

	function get($item){
		(isset($_REQUEST[$item]))? $r = $_REQUEST[$item] : $r= null;
		return $r;
	}

	function run($lang,$payload){

		$filename = 'json/'.substr(md5(mt_rand()), 0, 7).'.json';
		file_put_contents($filename, $payload);
		$cat = 'cat '.$filename;
		$cmd = $cat." |  docker run -i  glot/".$lang."  /bin/bash -c 'cat'";
		
		$output = shell_exec($cmd);
		//unlink($filename);
		return $output;
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

	function pages($page){
		$page_file = 'pages/'.$page.'.php';
		if(file_exists($page_file)){
			if($page=='form'){
				$payload = $this->get('payload');
				$hash = $this->get('hash');
				$lang = $this->get('lang');
				if($hash=='krishnateja' && $lang && $payload){
				$output = $this->run($lang,$payload);
				}
			}
			require $page_file;
		}
		else
			require 'pages/404.php';
	}

	function router(){
		if($_SERVER['REQUEST_URI']){
			$nodes = explode('/', $_SERVER['REQUEST_URI']);
			
			$this->main();
		}
	}

	function router2($i){
		
		$start_time = microtime(true);
		if($i==1){
			$lang = 'clang';
		
			$payload = '{"language":"c","command":"clang main.c && ./a.out", "files": [{"name": "main.c", "content": "#include<stdio.h> \n int main(void)\n {\n printf(\"Hello World!\");\n return 0;\n}"}]}';	
		}else{
			$lang = 'java';
		
			$payload = '{"language":"java","command":"javac Main.java && java Main", "files": [{"name": "Main.java", "content": "class Main{public static void main(String[] args) { for(int i=1;i<5;i++) System.out.println(\"Start\");}}"}]}';
		}
		

		
		$output = $this->run($lang,$payload);
		$end_time = microtime(true); 

		$execution_time = ($end_time - $start_time); 
		$json = json_decode($output);
		$json->time = round($execution_time,2);
		$output = json_encode($json);
		header('Content-Type: application/json');
		echo $output;
	}

	function router3($i){
		
		$start_time = microtime(true);
		if($i==1){
			$lang = 'clang';
		
			$payload = '{"language":"c","command":"clang main.c && ./a.out", "files": [{"name": "main.c", "content": "#include<stdio.h> \n int main(void)\n {\n printf(\"Hello World!\");\n return 0;\n}"}]}';	
		}else{
			$lang = 'java';
		
			$payload = '{"language":"java","command":"javac Main.java && java Main", "files": [{"name": "Main.java", "content": "class Main{public static void main(String[] args) { for(int i=1;i<5;i++) System.out.println(\"Start\");}}"}]}';
		}
		

		
		$output = $this->run2($lang,$payload);
		$end_time = microtime(true); 

		$execution_time = ($end_time - $start_time); 
		$json = json_decode($output);
		if(!$json)
			$json = new Boot;
		$json->time = round($execution_time,2);
		$output = json_encode($json);
		//header('Content-Type: application/json');
		echo $output;
	}

	
}