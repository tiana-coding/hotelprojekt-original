<?php
session_start();

// Hardcoded news items
$news_items = [
    [
        "title" => "Entspannung pur – Ihr Wellness-Erlebnis im Hotel Blick und Glück",
        "text" => "Im hektischen Alltag ist es wichtiger denn je, sich Momente der Ruhe und Entspannung zu gönnen. Im Hotel Blick und Glück haben wir genau das Richtige für Sie vorbereitet. Unser hauseigenes Wellnesscenter bietet eine Vielzahl von Anwendungen, die Körper und Geist in Einklang bringen.

Beginnen Sie Ihren Tag mit einer belebenden Yoga-Session in unserem lichtdurchfluteten Studio oder lassen Sie den Stress bei einer wohltuenden Massage hinter sich. Unsere erfahrenen Therapeuten stehen Ihnen mit individuellen Behandlungen zur Verfügung, die auf Ihre Bedürfnisse abgestimmt sind. Nach einer entspannenden Sitzung können Sie im Whirlpool relaxen oder einen Spaziergang durch unsere gepflegten Gartenanlagen genießen.

Für das leibliche Wohl sorgen unsere gesunden und köstlichen Speisen im hoteleigenen Restaurant. Frische, regionale Zutaten und kreative Rezepte machen jedes Gericht zu einem Genuss. Lassen Sie sich von unserem Wellness-Angebot verwöhnen und tanken Sie neue Energie im Hotel Blick und Glück – Ihrem Rückzugsort für Körper und Seele.",
        "image" => "uploads/thumbnails/3.jpg"
    ],
    [
        "title" => "Gutes Essen macht gute Laune",
        "text" => "Gutes Essen ist ein wichtiger Bestandteil eines gelungenen Aufenthalts, und im Hotel Blick und Glück legen wir besonderen Wert auf kulinarische Exzellenz. Unser Küchenteam zaubert täglich frische und abwechslungsreiche Gerichte, die keine Wünsche offenlassen.

Beginnen Sie Ihren Tag mit einem reichhaltigen Frühstücksbuffet, das von regionalen Spezialitäten bis hin zu internationalen Köstlichkeiten alles bietet. Für das Mittag- und Abendessen bieten wir wechselnde Menüs, die saisonal angepasst werden und die besten Zutaten der Region hervorheben.

Besonders stolz sind wir auf unsere Themenabende, bei denen Sie besondere kulinarische Erlebnisse genießen können. Ob mediterrane Nächte, asiatische Fusionsküche oder traditionelle deutsche Hausmannskost – lassen Sie sich von unseren kreativen Gerichten überraschen",
        "image" => "uploads/thumbnails/6.jpg"
    ],
    [
        "title" => "Gutes Essen macht gute Laune",
        "text" => "Das Hotel Blick und Glück liegt ideal gelegen, um sowohl Erholungssuchende als auch Abenteuerlustige gleichermaßen zu begeistern. Die malerische Umgebung bietet eine Vielzahl von Aktivitäten, die Ihren Aufenthalt unvergesslich machen.

Für Naturliebhaber gibt es zahlreiche Wander- und Radwege, die durch atemberaubende Landschaften führen. Erkunden Sie die umliegenden Wälder, Seen und Berge und genießen Sie die frische Luft und die beeindruckende Natur. Im Winter verwandelt sich die Region in ein Paradies für Skifahrer und Snowboarder mit bestens präparierten Pisten und gemütlichen Berghütten.",
        "image" => "uploads/thumbnails/hero.jpg"
    ],
];
?>

<?php include("../include/header.php"); ?>
<?php include("../include/nav.php"); ?>

<div class="container">
    <h1 class="text-center my-5">Blog</h1>

    <?php if ($news_items): ?>
        <div class="row">
            <?php foreach (array_reverse($news_items) as $news): // Show newest first ?>
                <div class="col-md-6">
                    <div class="card mb-4 box-shadow">
                        <?php if (!empty($news['image'])): ?>
                            <img src="<?= htmlspecialchars($news['image']) ?>" class="card-img-top" alt="News Image">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($news['title']) ?></h5>
                            <p class="card-text"><?= nl2br(htmlspecialchars($news['text'])) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center">Keine News-Beiträge verfügbar.</p>
    <?php endif; ?>
</div>

<?php include("include/footer.php"); ?>
