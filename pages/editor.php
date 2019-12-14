<main role="main" class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-5 mb-5"><img src="img/p24.png" width="100px"/></h1>
    <form><textarea id="c-code" name="code">
#include <stdio.h> 

int main(void) {
 printf("Hello World!\n");
  return 0; 
}</textarea></form>

   <script>

var cEditor = CodeMirror.fromTextArea(document.getElementById("c-code"), {
        lineNumbers: true,
        matchBrackets: true,
        mode: "text/x-csrc",
        theme: "material",
          indentUnit: 4
      });
      var cppEditor = CodeMirror.fromTextArea(document.getElementById("cpp-code"), {
        lineNumbers: true,
        matchBrackets: true,
        mode: "text/x-c++src",
        theme: "material",
          indentUnit: 4
      });
      var javaEditor = CodeMirror.fromTextArea(document.getElementById("java-code"), {
        lineNumbers: true,
        matchBrackets: true,
        mode: "text/x-java",
        theme: "material",
          indentUnit: 4
      });

</script>
    <a class="btn btn-primary btn-lg" href="#" role="button">Code Editor</a>
  </div>
</main>