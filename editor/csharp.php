<?php require '../pages/blocks/header.php';  ?>
<?php  require '../lib/url.php'; ?>
<main role="main" class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-5 mb-5"><a href="../index.php"><img src="../img/p24.png" width="100px"/></a></h1>
     <div class="alert alert-info" role="alert">
  C# Program to print half pyramid a using numbers
</div>
    <form action="../index.php" method="post"><textarea id="c-code" name="code">/*c# basic program to print messages*/
using System;

class HelloWorld {
  static void Main() {
    //print text without inserting new line after the message
    Console.Write("Hello World,");
    Console.Write("How are you?");
    //print new line
    Console.WriteLine();
    //print text with new line after the message
    Console.WriteLine("Hello World");
    Console.WriteLine("How are you?");
    //print new line using escape sequence just like C language
    Console.WriteLine("Hello World\nHow are you?");
  }
}</textarea>
    <input type="hidden" name="hash" value="krishnateja" />
    <input type="hidden" name="lang" value="csharp" />
    <input type="hidden" name="page" value="output" />
    <input type="hidden" name="c" value="0" />
    <input type="hidden" name="docker" value="1" />
    <input type="hidden" name="back" value="<?php echo url(); ?>" />
    <a class="btn btn-success btn-lg" href="../index.php" role="button">back</a>
    <button type="submit" class="btn btn-primary btn-lg mt-4 mb-4"  role="button" >Run</button>
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