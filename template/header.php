<?php
include_once "session.php" ;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Blog ECF</title>
</head>
<body>
    
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
        </li>
        <?php
        if (isLogged()){
          echo '<li class="nav-item">';
          echo '<a class="nav-link active" aria-current="page" href="login.php?logout=1">Logout</a>
          </li>';
        } else {
          echo '<li class="nav-item">';
          echo '<a class="nav-link active" aria-current="page" href="login.php">Login</a>
          </li>';
        }
        if (isAdmin()){
          echo '<li class="nav-item">';
          echo '<a class="nav-link active" aria-current="page" href="admin.php">Administration</a>
          </li>';
        }
        ?>
        </ul>
    </div>
  </div>
</nav>

</body>
</html>