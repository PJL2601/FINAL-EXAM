<?php
include 'session.php';
if (isset($_GET['id'])) {
    include 'db.php';
    $id = $_GET['id'];
    $conn->query("DELETE FROM destinations WHERE id = $id");
    header('Location: dashboard.php');
    exit;
}
?>
