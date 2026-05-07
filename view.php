<?php
require_once 'config.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("News ID is missing.");
}

$stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
$stmt->execute([$id]);
$news = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$news) {
    die("News not found.");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($news['title']) ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<a href="index.php">Back to homepage</a>

<h1><?= htmlspecialchars($news['title']) ?></h1>
<small><?= htmlspecialchars($news['created_at']) ?></small>

<p><?= nl2br(htmlspecialchars($news['content'])) ?></p>

</body>
</html>