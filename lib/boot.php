<?php


class Boot{


	function main(){
		$start_time = microtime(true);

		$code= $this->get('code');
		$hash = $this->get('hash');
		$lang = $this->get('lang');
		$form = $this->get('form');
		$page = $this->get('page');
		$docker = $this->get('docker');

		$payload = $this->payload($lang,$code);


		if($hash=='krishnateja'){
			if($docker)
				$output = $this->run_docker($lang,$payload);
			else
				$output = $this->run_plain($lang,$payload);

			$end_time = microtime(true); 
			$execution_time = ($end_time - $start_time); 
			$json = json_decode($output);
			$json->time = round($execution_time,2);
			

			if($page=='output'){
				$output = $json->stdout;
				$error = $json->stderr;
				$time = $json->time;
				$back = $this->get('back');
				require 'pages/blocks/page.php';
			}else{
				header('Content-Type: application/json');
				echo $output;
			}
			
		
		}else{
			require 'pages/blocks/page.php';
		}
	}

	function get($item){
		(isset($_REQUEST[$item]))? $r = $_REQUEST[$item] : $r= null;
		return $r;
	}

	function payload($lang,$code){
		$code = json_encode($code);
		$payload = null;
		if($lang=='java')
			$payload = '{"language":"java","command":"javac Main.java && java Main", "files": [{"name": "Main.java", "content": '.$code.'}]}';
		else if($lang=='clang' && $this->get('c')==1)
			$payload = '{"language":"c","command":"clang main.c && ./a.out", "files": [{"name": "main.c", "content": '.$code.'}]}';
		else if($lang =='clang' && $this->get('c')==0)
			$payload = '{"language":"c","command":"clang++ main.cpp && ./a.out", "files": [{"name": "main.cpp", "content": '.$code.'}]}';
		else if($lang =='python')
			$payload = '{"language": "python", "files": [{"name": "main.py", "content": '.$code.'}]}';
		else if($lang =='perl')
			$payload = '{"language":"perl","command":"perl main.pl", "files": [{"name": "main.pl", "content": '.$code.';}]}';
		return $payload;
	}

	function run_docker($lang,$payload){

		$filename = 'json/'.substr(md5(mt_rand()), 0, 7).'.json';
		file_put_contents($filename, $payload);
		file_put_contents('json/payload.json', $payload);

		$cat = 'cat '.$filename;
		$cmd = $cat." |  docker run -i  glot/".$lang."  /bin/bash -c 'cat'";

		$output = shell_exec($cmd);
		file_put_contents('json/output.json', $output);
		
		unlink($filename);
		return $output;
	}

	function run_plain($lang,$payload){

		$file = 'json/'.substr(md5(mt_rand()), 0, 7);
		$filename = $file.'.json';
		file_put_contents($filename, $payload);
		file_put_contents('json/payload.json', $payload);
		
		$cmd = "bash bash.sh ".$file;

		$output = shell_exec($cmd);
		file_put_contents('json/output.json', $output);
		
		unlink($filename);
		return $output;
		
	}

	function code(){
		$start_time = microtime(true);
			$payload = $this->get('payload');
			$hash = $this->get('hash');
			$lang = $this->get('lang');
			$docker = $this->get('docker');
			$output = false;
			if($hash=='krishnateja'){
				if($docker)
					$output = $this->run_docker($lang,$payload);
				else
					$output = $this->run_plain($lang,$payload);

				$end_time = microtime(true); 
				$execution_time = ($end_time - $start_time); 
				
			}
			return $output;
	}

	function pages($page){
		$page_file = 'pages/'.$page.'.php';
		if(file_exists($page_file)){
			require 'pages/blocks/page.php';
		}
		else
			require 'pages/404.php';
	}

	function router(){
		if($_SERVER['REQUEST_URI']){
			$nodes = explode('/', $_SERVER['REQUEST_URI']);
			if(isset($nodes[1])){
				if($nodes[1]!='index.php' && $nodes[1]!=''){
					$url = $this->url();
					$back = $this->get('back');
					$this->pages($nodes[1]);
				}
				else{
					$this->main();
				}
			}
			else
				$this->main();
		}
	}

	function router2($i){
		
		$start_time = microtime(true);
		if($i==1){
			$lang = 'clang';
		
			$payload = '{"language":"c","command":"clang main.c && ./a.out", "files": [{"name": "main.c", "content": "#include<stdio.h> \n int main(void)\n {\n int i; for(i=0;i<30;i++)printf(\"%d \",(i*30/2 -1));\n return 0;\n}"}]}';	
		}else{
			$lang = 'java';
		
			$payload = '{"language":"java","command":"javac Main.java && java Main", "files": [{"name": "Main.java", "content": "class Main{public static void main(String[] args) { for(int i=1;i<5;i++) System.out.println(\"Start\");}}"}]}';
		}
		

		
		$output = $this->run_docker($lang,$payload);
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
		
			$payload = '{"language":"c","command":"clang main.c && ./a.out", "files": [{"name": "main.c", "content": "#include<stdio.h> \n int main(void)\n {\n int i; for(i=0;i<30;i++)printf(\"%d \",(i*30/2 -1));\n return 0;\n}"}]}';	
		}else{
			$lang = 'java';
		
			$payload = '{"language":"java","command":"javac Main.java && java Main", "files": [{"name": "Main.java", "content": "class Main{public static void main(String[] args) { for(int i=1;i<100000;i++) System.out.println(i*2);}}"}]}';
		}
		

		
		$output = $this->run_plain($lang,$payload);
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

	function url(){
		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    	else  
         $url = "http://";   
	    // Append the host(domain name, ip) to the URL.   
	    $url.= $_SERVER['HTTP_HOST'];   
	    
	    // Append the requested resource location to the URL   
	    $url.= $_SERVER['REQUEST_URI'];    
	      
	    return $url;  
	}

	
}