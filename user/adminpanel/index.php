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
<nav class="navbar navbar-inverse bg-inverse" role="navigation" id="headerbar">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.php">SklepCsGo</a>
    </div>
</nav>


<!-- potrzebna tabela id, username, password -->

<div id="container">
    <?php if (isset($fmsg)) { ?>
        <div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
    <div>
        <form class="form-signin" method="POST">
            <h2 class="form-signin-heading">Login</h2>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="text" name="username" id="inputLogin" class="form-control" placeholder="Nazwa użytkownika" required
                   autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Podaj hasło"
                   required>
            <?php if (isset($smsg)) { ?>
                <div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
            <?php if (isset($fmsg)) { ?>
                <div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Zarejestruj się!</button>
        </form>
        <?php
        session_start();
        require('../resource/php/login.php');
        ?>
    </div>

</body>
</html>