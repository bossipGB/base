<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . "template" . DIRECTORY_SEPARATOR . "session.php" ;
if(!isAdmin()){
    header("Location: index.php");
}

include_once __DIR__ . DIRECTORY_SEPARATOR . "template" . DIRECTORY_SEPARATOR . "db.php" ;

$query = "SELECT * FROM posts";
$result = mysqli_query($conn, $query);

if ($result) {
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    include_once __DIR__ . DIRECTORY_SEPARATOR . "template" . DIRECTORY_SEPARATOR . "header.php";

    echo "<!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, initial-scale=1.0'>
              <title>Administration</title>
              <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
          </head>
          <body>
          
          <div class='container mt-5'>
              <h2>Liste des Postes</h2>

              <table class='table table-bordered'>
                  <thead class='thead-dark'>
                      <tr>
                          <th>ID</th>
                          <th>Titre</th>
                          <th>Contenu</th>
                          <th>Date de Publication</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>";

    foreach ($posts as $post) {
        echo "<tr>
                <td>{$post['id']}</td>
                <td>{$post['title']}</td>
                <td>{$post['body']}</td>
                <td>{$post['createdAt']}</td>
                <td>
                    <a href='edit_post.php?id={$post['id']}' class='btn btn-primary btn-sm'>Modifier</a>
                    <a href='delete_post.php?id={$post['id']}' class='btn btn-danger btn-sm'>Supprimer</a>
                </td>
              </tr>";
    }

    echo "</tbody>
          </table>

          <a href='add_post.php' class='btn btn-success'>Ajouter un nouveau poste</a>
          
          </div>

          <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
          <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
          <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
          </body>
          </html>";

} else {
    echo "Erreur lors de la récupération des articles.";
}

mysqli_close($conn);
?>
