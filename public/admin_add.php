<?php
$conn = new mysqli("localhost", "root", "", "bilet_satis_sistemi");

if ($conn->connect_error) {
    die("Veritabanı bağlantı hatası: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO admin (username, parola) VALUES (?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $username, $hashedPassword);

        if ($stmt->execute()) {
            echo "Admin başarıyla eklendi.";
        } else {
            echo "Admin eklenirken bir hata oluştu: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "SQL sorgusu hazırlanamadı: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Ekle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Admin Ekle</h1>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="username" class="form-label">Kullanıcı Adı:</label>
            <input
                type="text"
                id="username"
                class="form-control"
                name="username"
                placeholder="Kullanıcı Adı Girin"
                required
            />
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Şifre</label>
            <input
                type="password"
                id="password"
                class="form-control"
                name="password"
                placeholder="Şifrenizi giriniz"
                required
            />
        </div>
        <button type="submit" class="btn btn-primary">Admin Ekle</button>
    </form>
</div>
</body>
</html>
