<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] !== true) {
    header("Location: adminlogin.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <p>Burada admin paneli içeriği bulunacak.</p>
    
    <a href="logout.php" class="btn btn-danger">Çıkış Yap</a>
</div>
</body>
</html>
