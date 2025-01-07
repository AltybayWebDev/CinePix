<?php
session_start();

// Eğer oturum açılmamışsa, kullanıcıyı giriş sayfasına yönlendir
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$is_admin = $_SESSION['is_admin'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        background-color: #f4f6f9;
        font-family: Arial, sans-serif;
      }
      .container {
        margin-top: 50px;
      }
      .panel-header {
        text-align: center;
        margin-bottom: 30px;
      }
      .user-info {
        margin-bottom: 20px;
      }
      .user-info span {
        font-weight: bold;
      }
    </style>
</head>
<body>

<div class="container">
    <div class="panel-header">
        <h1>Admin Paneli</h1>
    </div>

    <div class="user-info">
        <p><span>Kullanıcı ID:</span> <?php echo $user_id; ?></p>
        <p><span>Admin mi?</span> <?php echo ($is_admin === 'admin') ? 'Evet' : 'Hayır'; ?></p>
    </div>

    <div>
        <a href="logout.php" class="btn btn-danger">Çıkış Yap</a>
    </div>
</div>

</body>
</html>
