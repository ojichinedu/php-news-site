<?php
require_once 'config.php';

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
            INSERT INTO news (title, short_description, content)
            VALUES (?, ?, ?)
        ");

        $stmt->execute([$title, $short_description, $content]);

        header("Location: admin.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add News</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Add News</h1>

<a href="admin.php">Back to Admin</a>

<?php if ($error): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST">
    <label>Title</label>
    <input type="text" name="title" maxlength="255">

    <label>Short Description</label>
    <textarea name="short_description"></textarea>

    <label>Content</label>
    <textarea name="content"></textarea>

    <button type="submit">Save News</button>
</form>

</body>
</html>