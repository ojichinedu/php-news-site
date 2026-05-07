<?php
require_once 'config.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("News ID is missing.");
}

$stmt = $pdo->prepare("DELETE FROM news WHERE id = ?");
$stmt->execute([$id]);

header("Location: admin.php");
exit;