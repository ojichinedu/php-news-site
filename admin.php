<?php
require_once 'config.php';

$stmt = $pdo->prepare("SELECT * FROM news ORDER BY created_at DESC");
$stmt->execute();
$newsList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Admin Panel</h1>

<a href="index.php">Homepage</a>
<a href="create.php">Add News</a>

<table>
    <tr>
        <th>Title</th>
        <th>Date</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($newsList as $news): ?>
        <tr>
            <td><?= htmlspecialchars($news['title']) ?></td>
            <td><?= htmlspecialchars($news['created_at']) ?></td>
            <td>
                <a href="edit.php?id=<?= $news['id'] ?>">Edit</a>
                <a href="delete.php?id=<?= $news['id'] ?>" onclick="return confirm('Delete this news?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>