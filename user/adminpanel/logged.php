<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Panel administratora</title>
    <link rel="stylesheet" href="../resource/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resource/style.css">
    <script src="../resource/angular/angular.min.js"></script>
    <script src="../resource/scripts.js"></script>
</head>
<body>
<?php
//if (!isset($_SESSION['logged']) && $_SESSION['logged'] == false) {
//    header("Location: index.php");
//    exit();
//}
?>
<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse" role="navigation" id="headerbar">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand ml-lg-2" href="index.php">Nazwa serwera</a> <!-- TODO funkcja podająca nazwę serwera -->
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto mt-2 mt-md-0 ml-lg-5">
            <!-- TODO na ile działów i jakie dzielimy admin panel? -->
            <li class="nav-item"><a href="" class="nav-link">kutas</a></li>
            <li class="nav-item"><a href="" class="nav-link">beniz</a></li>
            <li class="nav-item"><a href="" class="nav-link">chuj</a></li>
            <li class="nav-item"><a href="" class="nav-link">ci w dupę</a></li>
        </ul>
        <ul class="navbar-nav mt-2 mt-md-0 mr-lg-2">
            <li class="nav-item"><a href="#" class="btn btn-outline-secondary">wyloguj</a></li>
        </ul>
    </div>
</nav>

</body>
</html>