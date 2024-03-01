<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . "template" . DIRECTORY_SEPARATOR . "header.php" ;
include_once __DIR__ . DIRECTORY_SEPARATOR . "template" . DIRECTORY_SEPARATOR . "db.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $postId = $_GET['id'];

    $sqlPost = "SELECT * FROM posts WHERE id = ?";
    $stmtPost = $conn->prepare($sqlPost);
    $stmtPost->bind_param('i', $postId);
    $stmtPost->execute();
    $resultPost = $stmtPost->get_result();

    if ($resultPost->num_rows > 0) {
        $post = $resultPost->fetch_assoc();

        $sqlComments = "SELECT * FROM comments WHERE postId = ?";
        $stmtComments = $conn->prepare($sqlComments);
        $stmtComments->bind_param('i', $postId);
        $stmtComments->execute();
        $resultComments = $stmtComments->get_result();

        $comments = [];
        while ($row = $resultComments->fetch_assoc()) {
            $comments[] = $row;
        }
    } else {
        echo "Aucun article trouvé.";
        exit();
    }
} else {
    echo "Identifiant d'article non valide.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $post['title'] ?></title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2><?= $post['title'] ?></h2>
    <p><?= $post['createdAt'] ?> par <?= $post['userId'] ?></p>
    <p><?= $post['body'] ?></p>

    <h3>Commentaires</h3>
    <?php foreach ($comments as $comment): ?>
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title"><?= $comment['name'] ?></h5>
                <p class="card-text"><?= $comment['body'] ?></p>
                <p class="card-text"><?= $comment['createdAt'] ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
