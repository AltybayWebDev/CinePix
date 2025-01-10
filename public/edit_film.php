<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] !== true) {
    header("Location: adminlogin.php");
    exit();
}

require_once 'db_connect.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

if ($id <= 0) {
    die("Geçersiz film ID.");
}

// Film bilgilerini çek
$query = "SELECT * FROM filmler WHERE id = :id LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$film = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$film) {
    die("Film bulunamadı.");
}

// Film güncelleme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_film'])) {
    $film_adi = $_POST['film_adi'];
    $film_turu = $_POST['film_turu'];
    $bilet_fiyati = $_POST['bilet_fiyati'];
    $yayinlanma_saati = $_POST['yayinlanma_saati'];
    $yayinlanma_tarihi = $_POST['yayinlanma_tarihi'];

    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        $image = file_get_contents($_FILES['image']['tmp_name']);
        $query = "UPDATE filmler SET film_adi = :film_adi, film_turu = :film_turu, bilet_fiyati = :bilet_fiyati, yayinlanma_saati = :yayinlanma_saati, yayinlanma_tarihi = :yayinlanma_tarihi, image = :image WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':image', $image, PDO::PARAM_LOB);
    } else {
        $query = "UPDATE filmler SET film_adi = :film_adi, film_turu = :film_turu, bilet_fiyati = :bilet_fiyati, yayinlanma_saati = :yayinlanma_saati, yayinlanma_tarihi = :yayinlanma_tarihi WHERE id = :id";
        $stmt = $conn->prepare($query);
    }

    $stmt->bindParam(':film_adi', $film_adi);
    $stmt->bindParam(':film_turu', $film_turu);
    $stmt->bindParam(':bilet_fiyati', $bilet_fiyati);
    $stmt->bindParam(':yayinlanma_saati', $yayinlanma_saati);
    $stmt->bindParam(':yayinlanma_tarihi', $yayinlanma_tarihi);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: admin_panel.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Film Düzenle</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  />
</head>
<body>
<div class="container mt-5">
    <h1>Film Düzenle</h1>
    <form action="edit_film.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="film_adi" class="form-label">Film Adı</label>
            <input type="text" class="form-control" id="film_adi" name="film_adi" value="<?php echo htmlspecialchars($film['film_adi']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="film_turu" class="form-label">Film Türü</label>
            <input type="text" class="form-control" id="film_turu" name="film_turu" value="<?php echo htmlspecialchars($film['film_turu']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="bilet_fiyati" class="form-label">Bilet Fiyatı</label>
            <input type="number" step="0.01" class="form-control" id="bilet_fiyati" name="bilet_fiyati" value="<?php echo $film['bilet_fiyati']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="yayinlanma_saati" class="form-label">Yayınlanma Saati</label>
            <input type="time" class="form-control" id="yayinlanma_saati" name="yayinlanma_saati" value="<?php echo $film['yayinlanma_saati']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="yayinlanma_tarihi" class="form-label">Yayınlanma Tarihi</label>
            <input type="date" class="form-control" id="yayinlanma_tarihi" name="yayinlanma_tarihi" value="<?php echo $film['yayinlanma_tarihi']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Film Afişi (Değiştirmek istemiyorsanız boş bırakın)</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" name="update_film" class="btn btn-primary">Güncelle</button>
    </form>
    <a href="admin_panel.php" class="btn btn-secondary mt-3">Geri Dön</a>
</div>
</body>
</html>