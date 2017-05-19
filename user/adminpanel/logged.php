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
session_start();
if (!isset($_SESSION['logged']) && $_SESSION['logged'] == false) {
    header("Location: index.php");
    exit();
}
?>
<nav class="navbar navbar-inverse bg-inverse" role="navigation" id="headerbar">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.php">SklepCsGo</a>
    </div>

</nav>

</body>
</html>