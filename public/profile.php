<?php
session_start();

require_once 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Kullanıcının biletlerini çek
$query = "
    SELECT b.id, f.film_adi, b.saati, b.koltuk_no, b.bilet_fiyati, f.yayinlanma_tarihi
    FROM biletler b
    JOIN filmler f ON b.film_id = f.id
    WHERE b.user_id = :user_id
";
$stmt = $conn->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilim</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"
    />
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
        <a href="index.php" class="navbar-brand">Cine<span class="text-warning">Pix</span></a>
        <div>
            <a href="logout.php" class="btn btn-danger">Çıkış Yap</a>
        </div>
    </div>
</nav>

<div class="container my-5">
    <h1 class="display-5 text-center mb-4">Profil</h1>
    <?php if (!empty($result)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Film Adı</th>
                    <th>Seans Saati</th>
                    <th>Seans Tarihi</th>
                    <th>Koltuk No</th>
                    <th>Bilet Fiyatı</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['film_adi']); ?></td>
                        <td><?php echo $row['saati']; ?></td>
                        <td><?php echo $row['yayinlanma_tarihi']; ?></td>
                        <td><?php echo $row['koltuk_no']; ?></td>
                        <td><?php echo number_format($row['bilet_fiyati'], 2, ',', '.'); ?> ₺</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-muted">Henüz satın alınmış bir bilet bulunmamaktadır.</p>
    <?php endif; ?>
  </div>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9
