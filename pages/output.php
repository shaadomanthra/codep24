<main role="main" class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-5"><img src="img/p24.png" width="100px"/></h1>
    <div class="jumbotron jumbotron-fluid rounded p-4 mt-5">
      <?php if($output){ ?>
      <pre>
        <h1> Output</h1>
        <code>
      <?php echo $output; ?>
      </code>
      </pre>
    <?php }else{ ?>
      <pre>
        <h1>Error</h1>
        <code>
          <?php echo $error; ?>
        </code>
      </pre>
    <?php } ?>
    </div>
    <a class="btn btn-primary btn-lg" href="index.php" role="button">Homepage</a>
  </div>
</main>