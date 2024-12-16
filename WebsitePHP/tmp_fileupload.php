<?php
  // store the path to your upload directory in a variable
  $uploadDir = /* YOUR CODE */;

  // try to check if your upload directory already exitsts
  // if it does not exist
  // https://www.php.net/manual/en/function.file-exists.php
  if (/* YOUR CODE */) {
    // create the directory
    // https://www.php.net/manual/de/function.mkdir.php
    /* YOUR CODE */
  }

  // Use the global server variable to check if it is a post request
  // and also check if the filem with the name on your input isset
  // https://www.php.net/manual/de/reserved.variables.server
  // https://www.php.net/manual/de/reserved.variables.files
  // https://www.php.net/manual/de/function.isset.php
  if (/* YOUR CODE */) {
    // store the path where you want to upload the file in a variable as string
    $uploadFile = /* YOUR CODE */
    // upload the file
    // https://www.php.net/manual/de/function.move-uploaded-file.php
    // use the the tmp_name to get the uploaded file
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <title>File Upload</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col">
          <h1>File Upload</h1>
        </div>
      </div>
      <!-- set the enctype -->
      <form method="post" enctype="YOUR CODE">
        <div class="mb-3">
          <label for="file" class="form-label">File</label>
          <!-- set the accepted file types -->
          <input  accept="YOUR CODE" class="form-control" type="file" id="file" name="file">
        </div>
        <button class="btn btn-primary" type="submit">Upload</button>
      </form>
      <div class="row mt-3">
        <div class="col">
          <h2>Files</h2>
        </div>
      </div>
        <div class="row">
          <div class="col">
            <ul class="list-group">
            <?php
              if (file_exists($uploadDir)) {
                $files = scandir($uploadDir);

                for ($i = 2; isset($files[$i]); $i++) {
                  echo '<li class="list-group-item">' . $files[$i] .'</li>';
                }

                if (count($files) == 2) {
                  var_dump($files);
                      echo '<li class="list-group-item">No files...</li>';
                  }
              }
            ?>
            </ul>
          </div>
      </div>
    </div>
  </body>
</html>