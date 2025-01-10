<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Kullanıcı giriş yapmamışsa login sayfasına yönlendirme
    header("Location: login.php");
    exit;
}

require 'db_connection.php'; // Veritabanı bağlantısını sağlayan dosya

$user_id = $_SESSION['user_id'];

// Kullanıcının satın aldığı biletleri sorgulama
$sql = "SELECT b.id, b.seans, b.koltuk_no, b.bilet_turu, b.tarih, f.film_adi 
        FROM biletler b 
        INNER JOIN filmler f ON b.film_id = f.id 
        WHERE b.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
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
    <h1 class="mb-4">Hoşgeldiniz, <?php echo htmlspecialchars($_SESSION['ad']); ?>!</h1>

    <h3 class="mb-4">Satın Alınan Biletler</h3>
    <?php if ($result->num_rows > 0): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Film Adı</th>
                    <th>Seans</th>
                    <th>Koltuk Numarası</th>
                    <th>Bilet Türü</th>
                    <th>Tarih</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['film_adi']); ?></td>
                        <td><?php echo $row['seans']; ?></td>
                        <td><?php echo $row['koltuk_no']; ?></td>
                        <td>
                            <?php
                            // Bilet türünü daha okunabilir hale getirme
                            switch ($row['bilet_turu']) {
                                case 1: echo "Yetişkin"; break;
                                case 2: echo "Öğrenci"; break;
                                case 3: echo "Çocuk"; break;
                                default: echo "Bilinmiyor";
                            }
                            ?>
                        </td>
                        <td><?php echo $row['tarih']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-muted">Henüz satın alınmış bir bilet bulunmamaktadır.</p>
    <?php endif; ?>
</div>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"
></script>
</body>
</html>
