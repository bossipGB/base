<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . "template" . DIRECTORY_SEPARATOR . "session.php";
include_once __DIR__ . DIRECTORY_SEPARATOR . "template" . DIRECTORY_SEPARATOR . "db.php";

if (!isAdmin()) {
    header("Location: index.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['id'];
    $title = $_POST['title'];
    $body = $_POST['body'];
    $modified_at = $_POST['modified_at'];

    $query = "UPDATE posts SET title = '$title', body = '$body', createdAt = '$modified_at' WHERE id = $post_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour de l'article.";
    }
} else {
    header("Location: admin.php");
    exit();
}
?>
