<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kayıt Ol</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
      integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <style>
      body {
        background: linear-gradient(120deg, #2ecc71, #3498db);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        font-family: Arial, sans-serif;
      }
      .register-container {
        background: white;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
      }
      .register-container h1 {
        text-align: center;
        margin-bottom: 1.5rem;
        font-weight: bold;
      }
      .register-container .btn-success {
        width: 100%;
        margin-top: 1rem;
      }
      .register-container .extra-links {
        text-align: center;
        margin-top: 1rem;
        font-size: 0.9rem;
      }
      .register-container .extra-links a {
        color: #3498db;
        text-decoration: none;
      }
      .register-container .extra-links a:hover {
        text-decoration: underline;
      }

      input[type="number"]::-webkit-outer-spin-button,
      input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
      }
    </style>
  </head>
  <body>
    <div class="register-container">
      <h1>Kayıt Ol</h1>
      <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <?php if (!empty($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
    <form method="POST" action="">
  <div class="mb-3">
    <label for="name" class="form-label">Ad</label>
    <input
      type="text"
      id="name"
      name="name"
      class="form-control"
      placeholder="Adınızı giriniz"
      required
    />
  </div>
  <div class="mb-3">
    <label for="surname" class="form-label">Soyad</label>
    <input
      type="text"
      id="surname"
      name="surname"
      class="form-control"
      placeholder="Soyadınızı giriniz"
      required
    />
  </div>
  <div class="mb-3">
    <label for="idNumber" class="form-label">Kimlik Numarası:</label>
    <input
      type="number"
      id="idNumber"
      name="idNumber"
      class="form-control"
      maxlength="11"
      placeholder="Kimlik Numarası Girin"
      required
    />
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Şifre</label>
    <input
      type="password"
      id="password"
      name="password"
      class="form-control"
      placeholder="Bir şifre belirleyin"
      required
    />
  </div>
  <div class="mb-3">
    <label for="confirm-password" class="form-label">Şifrenizi Onaylayın</label>
    <input
      type="password"
      id="confirm-password"
      name="confirm-password"
      class="form-control"
      placeholder="Şifrenizi tekrar girin"
      required
    />
  </div>
  <button type="submit" class="btn btn-success">Kayıt Ol</button>
  <button
    type="button"
    class="mt-2 btn btn-warning w-100"
    onclick="goToIndex()"
  >
    Geri
  </button>
</form>

      <div class="extra-links">
        Zaten bir hesabınız var mı? <a href="giris.html">Giriş Yap</a>
      </div>
    </div>
    <script>
      function goToIndex() {
        window.location.href = "index.html";
      }
    </script>
  </body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $conn = new mysqli("localhost", "root", "", "bilet_satis_sistemi");
        if ($conn->connect_error) {
            throw new Exception("Veritabanı bağlantı hatası: " . $conn->connect_error);
        }

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $idNumber = $_POST['idNumber'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm-password'];

        if ($password !== $confirmPassword) {
            throw new Exception("Şifreler uyuşmuyor.");
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO users (ad, soyad, kimlik_no, parola) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $surname, $idNumber, $hashedPassword);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Kayıt başarılı! Giriş yapmak için <a href='login.php'>buraya tıklayın</a>.</div>";
        } else {
            throw new Exception("Kayıt sırasında bir hata oluştu: " . $stmt->error);
        }
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>" . $e->getMessage() . "</div>";
    } finally {
        $conn->close();
    }
}
?>