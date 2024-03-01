<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . "template" . DIRECTORY_SEPARATOR . "session.php";

if (!isAdmin()) {
    header("Location: index.php");
}

include_once __DIR__ . DIRECTORY_SEPARATOR . "template" . DIRECTORY_SEPARATOR . "db.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $post_id = $_GET['id'];

    $query = "SELECT * FROM posts WHERE id = $post_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $post = mysqli_fetch_assoc($result);

        include_once __DIR__ . DIRECTORY_SEPARATOR . "template" . DIRECTORY_SEPARATOR . "header.php";
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Modifier l'article</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        </head>

        <body>

            <div class="container mt-5">
                <h2>Modifier l'article</h2>

                <form action="update_post.php" method="post">
                    <input type="hidden" name="id" value="<?= $post['id']; ?>">

                    <div class="form-group">
                        <label for="title">Titre :</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= $post['title']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="body">Contenu :</label>
                        <textarea class="form-control" id="body" name="body" rows="5" required><?= $post['body']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="modified_at">Date de Modification :</label>
                        <input type="text" class="form-control" id="modified_at" name="modified_at" value="<?= $post['createdAt']; ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    <a href="admin.php" class="btn btn-secondary">Annuler</a>
                </form>

            </div>
        </body>

        </html>

<?php
    } else {
        echo "Erreur lors de la récupération des détails de l'article.";
    }
} else {
    echo "ID d'article non valide.";
}
?>
