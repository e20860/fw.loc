<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php vendor\fw\core\base\View::getMeta()?>
    <link rel="stylesheet" href="/fw.loc/public/bootstrap/css/bootstrap.min.css">
    
  </head>
  <body>
      <div class="container">
         <h1>Admin side</h1>
         <?=$content?>
      </div>  
      <script src="/fw.loc/public/js/jquery_3_2_1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="/fw.loc/public/bootstrap/js/bootstrap.min.js"></script>
    <?php 
        foreach ($scripts as $script) {
            echo $script;
        }
    ?>
  </body>
</html>