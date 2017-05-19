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
    <a class="navbar-brand" href="index.php">Nazwa serwera</a> <!-- TODO funkcja podająca nazwę serwera -->
    <div class="collapse navbar-collapse">
        <ul>
            <li><a href="#" class="nav-link">cośtam kurwa</a></li>
        </ul>
        <ul>
            <li><a href="#" class="nav-link">Cośtam 2</a></li>
        </ul>
        <ul>
            <li><a href="#" class="nav-link">Kurwa 3</a></li>
        </ul>
        <ul>
            <li><a href="#" class="nav-link">No ja jebię 4</a></li>
        </ul>
        <ul>
            <li><a href="#" class="nav-link">No i chuj</a></li>
        </ul>
    </div>
</nav>

</body>
</html>