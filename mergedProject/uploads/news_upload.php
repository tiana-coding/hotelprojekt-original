<?php
session_start();

// Define directories and file settings
$upload_dir = "uploads/";
$thumbnail_dir = "uploads/thumbnails/";
$data_file = "news.json";
$allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
$max_size = 2 * 1024 * 1024; // Max 2MB
$errors = [];
$success = "";

// Ensure directories exist
if (!file_exists($upload_dir)) mkdir($upload_dir, 0755, true);
if (!file_exists($thumbnail_dir)) mkdir($thumbnail_dir, 0755, true);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $text = $_POST['text'] ?? '';
    $image = $_FILES['image'] ?? null;

    // Validate inputs
    if (empty($title) || empty($text)) {
        $errors[] = "Title and text are required.";
    }

    if ($image && $image['error'] === UPLOAD_ERR_OK) {
        $image_type = mime_content_type($image['tmp_name']);
        if (!in_array($image_type, $allowed_types)) {
            $errors[] = "Only JPG, PNG, and GIF formats are allowed.";
        } elseif ($image['size'] > $max_size) {
            $errors[] = "File size exceeds 2MB.";
        } else {
            // Upload image
            $image_path = $upload_dir . basename($image['name']);
            $thumbnail_path = $thumbnail_dir . basename($image['name']);

            if (move_uploaded_file($image['tmp_name'], $image_path)) {
                // Create thumbnail
                if (create_thumbnail($image_path, $thumbnail_path, $image_type)) {
                    $success = "Image uploaded and thumbnail created successfully.";
                } else {
                    $errors[] = "Failed to create thumbnail.";
                }
            } else {
                $errors[] = "Failed to upload the image.";
            }
        }
    }

    // Save news to JSON file if no errors
    if (empty($errors)) {
        $news_items = file_exists($data_file) ? json_decode(file_get_contents($data_file), true) : [];
        $new_item = [
            "title" => $title,
            "text" => $text,
            "image" => !empty($image_path) ? $thumbnail_path : ""
        ];
        $news_items[] = $new_item;
        file_put_contents($data_file, json_encode($news_items, JSON_PRETTY_PRINT));
        $success .= " News item added successfully.";
    }
}

// Function to create a thumbnail
function create_thumbnail($src, $dest, $type)
{
    list($width, $height) = getimagesize($src);
    $thumb_width = 150;
    $thumb_height = (int)(($height / $width) * $thumb_width);

    $thumbnail = imagecreatetruecolor($thumb_width, $thumb_height);
    $source = null;

    switch ($type) {
        case 'image/jpeg':
            $source = imagecreatefromjpeg($src);
            break;
        case 'image/png':
            $source = imagecreatefrompng($src);
            break;
        case 'image/gif':
            $source = imagecreatefromgif($src);
            break;
    }

    if ($source) {
        imagecopyresampled($thumbnail, $source, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
        switch ($type) {
            case 'image/jpeg':
                imagejpeg($thumbnail, $dest);
                break;
            case 'image/png':
                imagepng($thumbnail, $dest);
                break;
            case 'image/gif':
                imagegif($thumbnail, $dest);
                break;
        }
        imagedestroy($thumbnail);
        imagedestroy($source);
        return true;
    }

    return false;
}
?>

<?php include("header.php"); ?>
<?php include("nav.php"); ?>

<div class="container">
    <h1>Upload News</h1>

    <?php if ($errors): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>

    <form action="news_upload.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="text">Text:</label>
            <textarea name="text" id="text" rows="5" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php include("footer.php"); ?>
