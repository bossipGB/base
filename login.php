<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . "template" . DIRECTORY_SEPARATOR . "session.php" ;
if(isset($_GET['logout']) && $_GET['logout']){
    $_SESSION=[];
    session_destroy();
    header("Location: index.php");
    exit;
}
include_once __DIR__ . DIRECTORY_SEPARATOR . "template" . DIRECTORY_SEPARATOR . "header.php";
include_once __DIR__ . DIRECTORY_SEPARATOR . "template" . DIRECTORY_SEPARATOR . "db.php"; 
include_once __DIR__ . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "User.php";



$error = null;
if (!empty($_POST)) {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password']; 
        if (empty($username) || empty($password)) {
            $error = "Veuillez saisir votre nom d'utilisateur et votre mot de passe.";
        } else {
            try {
                $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
                $stmt->bind_param('s', $username);
                $stmt->execute();

                $result = $stmt->get_result();
                if($result->num_rows>0){
                    $user = $result->fetch_assoc();
                    var_dump($user);
                    
                    if ($user && $user['password'] && $user['password'] === $password) {
                        $_SESSION['user'] = $user;
                        header("Location: index.php");
                        exit;
                    }
                } else {
                    $error = "Nom d'utilisateur ou mot de passe incorrect.";
                }
            } catch (PDOException $e) {
                echo "Erreur de base de données : " . $e->getMessage();
            }
        }
    }
}
?>

<?php if ($error) : ?>
    <div class="row">
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    </div>
<?php endif; ?>

<form method="POST" action="login.php">
    <h1>Se connecter</h1>
    <div class="mb-3">
        <label for="inputUsername" class="form-label">Nom d'utilisateur</label>
        <input required type="text" class="form-control" id="inputUsername" name="username" aria-describedby="usernameHelp">
    </div>
    <div class="mb-3">
        <label for="inputPassword" class="form-label">Mot de passe</label>
        <input required type="password" class="form-control" id="inputPassword" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>