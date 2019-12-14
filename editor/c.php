<?php require '../pages/blocks/header.php';  ?>
<main role="main" class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-5 mb-5"><img src="../img/p24.png" width="100px"/></h1>
    <form action="../index.php" method="post"><textarea id="c-code" name="code">#include <stdio.h> 

int main(void) {
    printf("Hello World!\n");
    return 0; 
}</textarea>
    <input type="hidden" name="hash" value="krishnateja" />
    <input type="hidden" name="lang" value="clang" />
    <input type="hidden" name="page" value="output" />
    <input type="hidden" name="docker" value="1" />
    <input type="hidden" name="back" value="<?php echo $url; ?>" />
    <button type="submit" class="btn btn-primary btn-lg mt-4"  role="button" >Run</button>
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
</main>
<?php  require '../pages/blocks/footer.php'; ?>