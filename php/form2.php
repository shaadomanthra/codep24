<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<form action="index.php" method="post">
  hash:<br>
  <input type="text" name="hash" value="krishnateja">
  <br>
  language:<br>
  <input type="text" name="lang" value="clang">
  <br><br>
  code:<br>
  <textarea name="payload">
  	{"language":"c","command":"clang main.c && ./a.out", "files": [{"name": "main.c", "content": "#include&lt;stdio.h> \n int main(void)\n {\n printf(\"Hello World!\");\n return 0;\n}"}]}
  </textarea>
  <input type="hidden" name="form" value="1">
  <input type="submit" value="Submit">
</form> 

<div style="padding:20px; border:1px solid silver;margin: 20px 0px;">
	<pre>
<?php if(isset($output)){ 
	echo $output;
 } ?>
</pre>
</div>
</body>
</html>