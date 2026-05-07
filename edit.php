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

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $short_description = trim($_POST['short_description'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if ($title === '' || $short_description === '' || $content === '') {
        $error = "All fields are required.";
    } elseif (strlen($title) > 255) {
        $error = "Title must not be longer than 255 characters.";
    } else {
        $stmt = $pdo->prepare("
            UPDATE news
            SET title = ?, short_description = ?, content = ?
            WHERE id = ?
        ");

        $stmt->execute([$title, $short_description, $content, $id]);

        header("Location: admin.php");
        exit;
    }
}
?>
<h1>Edit News</h1>

<a href="admin.php">Back to Admin</a>

<?php if ($error): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST">
    <label>Title</label>
    <input 
        type="text" 
        name="title" 
        maxlength="255"
        value="<?= htmlspecialchars($news['title']) ?>"
    >

    <label>Short Description</label>
    <textarea name="short_description"><?= htmlspecialchars($news['short_description']) ?></textarea>

    <label>Content</label>
    <textarea name="content"><?= htmlspecialchars($news['content']) ?></textarea>

    <button type="submit">Update News</button>
</form>

</body>
</html>