<?php
include('db.php');

$limit = 12;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$sqlCount = "SELECT COUNT(*) as total FROM posts";
$resultCount = $conn->query($sqlCount);
$rowCount = $resultCount->fetch_assoc();
$totalPosts = $rowCount['total'];

$totalPages = ceil($totalPosts / $limit);

$sql = "SELECT posts.id, posts.title, posts.createdAt, user.name as userName
        FROM posts
        INNER JOIN user ON posts.userId = user.id
        ORDER BY posts.createdAt DESC
        LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);

$posts = [];
while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <?php foreach ($posts as $post): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 d-flex">
                    <div class="card-body">
                        <h5 class="card-title"><?= $post['title'] ?></h5>
                        <p class="card-text"><?= $post['createdAt'] ?></p>
                        <p class="card-text">Auteur : <?= $post['userName'] ?></p>
                        <a href="view_post.php?id=<?= $post['id'] ?>" class="btn btn-primary">Lire l'article</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo; Précédent</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if ($page < $totalPages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                        <span aria-hidden="true">Suivant &raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

</body>
</html>
