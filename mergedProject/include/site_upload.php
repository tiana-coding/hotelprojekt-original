

<?php include 'header.php';
include 'fct_upload.php';?>

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
        <div class="mb-3">
            <label for="text">Artikeltext:</label>
            <textarea class="form-control" id="text" name="text" rows="15" placeholder="Schreib hier den Artikeltext..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Beitrag erstellen</button>
    </form>
</div>
<?php include 'footer.php'; ?>