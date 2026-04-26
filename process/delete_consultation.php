<?php
require_once '../config/database.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id > 0) {
    $stmt = $conn->prepare('DELETE FROM consultations WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
}

header('Location: ../index.php?page=history');
exit;
?>