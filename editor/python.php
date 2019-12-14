<?php require '../pages/blocks/header.php';  ?>
<?php  require '../lib/url.php'; ?>
<main role="main" class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-5 mb-5"><a href="../index.php"><img src="../img/p24.png" width="100px"/></a></h1>
     <div class="alert alert-info" role="alert">
  C++ Program to print half pyramid a using numbers
</div>
    <form action="../index.php" method="post"><textarea id="python-code" name="code">def squaresum(n) : 
  
    # Iterate i from 1  
    # and n finding  
    # square of i and 
    # add to sum. 
    sm = 0
    for i in range(1, n+1) : 
        sm = sm + (i * i) 
      
    return sm 
  
# Driven Program 
n = 4
print(squaresum(n)) </textarea>
    <input type="hidden" name="hash" value="krishnateja" />
    <input type="hidden" name="lang" value="python" />
    <input type="hidden" name="page" value="output" />
    <input type="hidden" name="docker" value="1" />
    <input type="hidden" name="back" value="<?php echo url(); ?>" />
    <a class="btn btn-success btn-lg" href="../index.php" role="button">back</a>
    <button type="submit" class="btn btn-primary btn-lg mt-4 mb-4"  role="button" >Run</button>
  </form>

  <script>
    var cEditor = CodeMirror.fromTextArea(document.getElementById("python-code"), {
      lineNumbers: true,
      matchBrackets: true,
      mode: "python",
      theme: "material",
      indentUnit: 4
    });
  </script>
  
</div>
</main>
<?php  require '../pages/blocks/footer.php'; ?>