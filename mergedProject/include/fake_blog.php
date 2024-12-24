<?php 
include 'header.php';
include('../config/dbaccess.php');

// Blog-Artikel aus der Datenbank abrufen
$sql = "SELECT * FROM blog_posts ORDER BY created_at DESC";
$result = $db_obj->query($sql);
$news_items = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $news_items[] = $row;
    }
} else {
    $news_items = false; // Keine Artikel vorhanden
}
?>

<main role="main" class="container mt-5 pt-5">
  <div class="row">
    <div class="col-md-8 blog-main">
      <?php if ($news_items): ?>
        <?php foreach ($news_items as $news): ?>
          <div class="blog-post">
            <h2 class="blog-post-title"><?= htmlspecialchars($news['title']) ?></h2>
            <p class="blog-post-meta"><?= htmlspecialchars($news['created_at']) ?> by <a href="#">Admin</a></p>
            <?php if (!empty($news['image'])): ?>
              <img src="<?= htmlspecialchars($news['image']) ?>" class="img-thumbnail mb-3" style="width: 100%; max-width: 300px; height: auto;" alt="Blog Thumbnail">
            <?php endif; ?>
            <p><?= nl2br(htmlspecialchars(mb_substr($news['text'], 0, 200))) ?>...</p>
            <a href="article.php?id=<?= $news['id'] ?>" class="btn btn-primary">Weiterlesen</a>
            <hr>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-muted">Zurzeit sind keine Artikel verfügbar. Bitte schauen Sie später noch einmal vorbei.</p>
      <?php endif; ?>
    </div>

    <aside class="col-md-4 blog-sidebar">
      <div class="p-4 mb-3 bg-light rounded">
        <h4>About</h4>
        <p class="mb-0">Das Hotel Blick und Glück bietet nicht nur Entspannung, sondern auch spannende Geschichten in unserem Blog.</p>
      </div>
      <div class="p-4">
        <h4>Archives</h4>
        <ol class="list-unstyled mb-0">
          <li><a href="#">March 2024</a></li>
          <li><a href="#">February 2024</a></li>
          <li><a href="#">January 2024</a></li>
        </ol>
      </div>
    </aside>
  </div>
</main>

<?php $db_obj->close(); ?>
<?php include 'footer.php'; ?>
