<?php
require_once 'config.php';

$search = trim($_GET['search'] ?? '');

if ($search !== '') {
    $stmt = $pdo->prepare("
        SELECT * FROM news
        WHERE title LIKE ? 
        OR short_description LIKE ? 
        OR content LIKE ?
        ORDER BY created_at DESC
    ");

    $keyword = "%$search%";
    $stmt->execute([$keyword, $keyword, $keyword]);
} else {
    $stmt = $pdo->prepare("SELECT * FROM news ORDER BY created_at DESC");
    $stmt->execute();
}


$newsList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>News Site</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Latest News</h1>
<form method="GET">
    <input type="text" name="search" placeholder="Search news..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Search</button>
</form>
<a href="admin.php">Admin Panel</a>

<?php foreach ($newsList as $news): ?>
    <div class="news-card">
        <h2><?= htmlspecialchars($news['title']) ?></h2>
        <small><?= htmlspecialchars($news['created_at']) ?></small>
        <p><?= htmlspecialchars($news['short_description']) ?></p>
        <a href="view.php?id=<?= $news['id'] ?>">Read more</a>
    </div>
<?php endforeach; ?>

</body>
</html>