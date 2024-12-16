<?php
include('fct_session.php'); 
include('fct_upload.php'); 
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News-Beitrag Erstellen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container mt-5">
    <h2>News-Beitrag Erstellen</h2>

    <?php 
    // Hier kannst du eine Erfolgs- oder Fehlermeldung ausgeben, falls erforderlich
    if (isset($upload_message)) {
        echo $upload_message;
    }
    ?>

    <!-- Formular für den Bildupload -->
    <form action="site_upload.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Titel des Beitrags</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Bild hochladen (nur JPEG)</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/jpeg" required>
        </div>

        <button type="submit" class="btn btn-primary">Beitrag erstellen</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

</body>
</html>
