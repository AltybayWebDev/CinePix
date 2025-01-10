<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] !== true) {
    header("Location: adminlogin.php");
    exit();
}

require_once 'db_connect.php';

// Film ekleme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_film'])) {
    $film_adi = $_POST['film_adi'];
    $film_turu = $_POST['film_turu'];
    $bilet_fiyati = $_POST['bilet_fiyati'];
    $yayinlanma_saati = $_POST['yayinlanma_saati'];
    $yayinlanma_tarihi = $_POST['yayinlanma_tarihi'];
    $image = file_get_contents($_FILES['image']['tmp_name']);

    $query = "INSERT INTO filmler (film_adi, film_turu, bilet_fiyati, yayinlanma_saati, yayinlanma_tarihi, image) VALUES (:film_adi, :film_turu, :bilet_fiyati, :yayinlanma_saati, :yayinlanma_tarihi, :image)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':film_adi', $film_adi);
    $stmt->bindParam(':film_turu', $film_turu);
    $stmt->bindParam(':bilet_fiyati', $bilet_fiyati);
    $stmt->bindParam(':yayinlanma_saati', $yayinlanma_saati);
    $stmt->bindParam(':yayinlanma_tarihi', $yayinlanma_tarihi);
    $stmt->bindParam(':image', $image, PDO::PARAM_LOB);
    $stmt->execute();
}

// Film silme işlemi
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $query = "DELETE FROM filmler WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $delete_id, PDO::PARAM_INT);
    $stmt->execute();
    header("Location: admin_panel.php");
    exit();
}

// Filmleri çek
$query = "SELECT * FROM filmler";
$stmt = $conn->prepare($query);
$stmt->execute();
$filmler = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <h1>Admin Panel</h1>
    
    <h2>Film Ekle</h2>
    <form action="admin_panel.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="film_adi" class="form-label">Film Adı</label>
            <input type="text" class="form-control" id="film_adi" name="film_adi" required>
        </div>
        <div class="mb-3">
            <label for="film_turu" class="form-label">Film Türü</label>
            <input type="text" class="form-control" id="film_turu" name="film_turu" required>
        </div>
        <div class="mb-3">
            <label for="bilet_fiyati" class="form-label">Bilet Fiyatı</label>
            <input type="number" step="0.01" class="form-control" id="bilet_fiyati" name="bilet_fiyati" required>
        </div>
        <div class="mb-3">
            <label for="yayinlanma_saati" class="form-label">Yayınlanma Saati</label>
            <input type="time" class="form-control" id="yayinlanma_saati" name="yayinlanma_saati" required>
        </div>
        <div class="mb-3">
            <label for="yayinlanma_tarihi" class="form-label">Yayınlanma Tarihi</label>
            <input type="date" class="form-control" id="yayinlanma_tarihi" name="yayinlanma_tarihi" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Film Afişi</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <button type="submit" name="add_film" class="btn btn-primary">Film Ekle</button>
    </form>

    <h2 class="mt-5">Filmler</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Film Adı</th>
                <th>Film Türü</th>
                <th>Bilet Fiyatı</th>
                <th>Yayınlanma Saati</th>
                <th>Yayınlanma Tarihi</th>
                <th>Afiş</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($filmler as $film): ?>
                <tr>
                    <td><?php echo $film['id']; ?></td>
                    <td><?php echo htmlspecialchars($film['film_adi']); ?></td>
                    <td><?php echo htmlspecialchars($film['film_turu']); ?></td>
                    <td><?php echo number_format($film['bilet_fiyati'], 2, ',', '.'); ?> ₺</td>
                    <td><?php echo $film['yayinlanma_saati']; ?></td>
                    <td><?php echo $film['yayinlanma_tarihi']; ?></td>
                    <td><img src="data:image/jpeg;base64,<?php echo base64_encode($film['image']); ?>" alt="Film Afişi" style="width: 50px; height: 50px;"></td>
                    <td>
                        <a href="admin_panel.php?delete_id=<?php echo $film['id']; ?>" class="btn btn-danger btn-sm">Sil</a>
                        <a href="edit_film.php?id=<?php echo $film['id']; ?>" class="btn btn-warning btn-sm">Düzenle</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="logout.php" class="btn btn-danger">Çıkış Yap</a>
</div>
</body>
</html>