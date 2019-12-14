<main role="main" class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-5"><img src="img/p24.png" width="100px"/></h1>
    <div class="jumbotron jumbotron-fluid rounded p-4 mt-5">
      <?php if($output){ ?>
        <h5> Output</h5>
<pre><code><?php echo $output; ?></code></pre>
    <?php }else{ ?>
      <h5>Error</h5>
<pre><code><?php echo $error; ?></code></pre>
    <?php } ?>
    </div>
    <div class="p-4">
      <pre>
        <code>
          output genererated in <span class="text-primary""><?php echo $time; ?></span> sec
        </code>
      </pre>
    </div>
    <a class="btn btn-success btn-lg" href="<?php echo $back; ?>" role="button">back</a>
    <a class="btn btn-primary btn-lg" href="index.php" role="button">Homepage</a>
  </div>
</main>