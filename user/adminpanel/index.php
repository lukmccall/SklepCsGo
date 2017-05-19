<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Panel administratora</title>
    <link rel="stylesheet" href="../resource/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resource/style.css">
    <script src="../resource/angular/angular.min.js"></script>
</head>
<body>
<?php
if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
    header("Location: logged.php");
    exit();
}
?>
<div>
    <nav class="navbar navbar-inverse bg-inverse" role="navigation" id="headerbar">
        <div class="navbar-header container">
            <a class="navbar-brand" href="index.php">SklepCsGo</a>
        </div>
    </nav>
</div>

<!-- potrzebna tabela: admins, pola: id, username, password -->

<div class="container" id="bg1">
    <div class="row">
       <div class="col"></div>
        <div class="col-4">
            <form class="form-signin" method="post" id="form-login">
                <h2 class="form-signin-heading">Login</h2>
                <label for="inputUsername" class="sr-only">Username</label>
                <input type="username" id="inputUsername" class="form-control" placeholder="Username" required="" autofocus="">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            </form>
            <?php
            session_start();
            require('php/login.php');
            ?>
        </div>
        <div class="col"></div>
    </div>

</body>
</html>