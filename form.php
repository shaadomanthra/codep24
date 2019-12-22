<?php require 'pages/blocks/header.php';  ?>
<?php  require 'lib/url.php'; ?>
<main role="main" class="flex-shrink-0">
  <div class="container">
<div class="mt-4 bg-light border p-3 rounded">
<form action="index.php" method="post">
  hash:<br>
  <input type="text" class="form-control" name="hash" value="krishnateja">
  <br>
  Input:<br>
  <input type="text" class="form-control" name="input" value="1"><br>
  C:<br>
  <input type="text" class="form-control" name="c" value="1"><br>
  Docker:<br>
  <input type="text" name="docker" class="form-control" value="1"><br>
  language:<br>
  <input type="text" name="lang" class="form-control" value="clang">
  <br>
  code:<br>
  <textarea class="form-control" name="code" id="c-code" >#include<stdio.h>
int main(void) {
  printf("Hello World!");
  return 0;
}
  </textarea>
  <input type="hidden" name="form" value="1">
  
  <input type="submit" class="btn btn-primary mt-4" value="Submit">
</form> 
<script>
    var cEditor = CodeMirror.fromTextArea(document.getElementById("c-code"), {
      lineNumbers: true,
      matchBrackets: true,
      mode: "text/x-csrc",
      theme: "material",
      indentUnit: 4
    });
  </script>
</div>
</div>
</main>

<?php require 'pages/blocks/header.php';  ?>