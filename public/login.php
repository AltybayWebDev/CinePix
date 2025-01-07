  <?php
  session_start();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Veritabanı bağlantısı
      $conn = new mysqli("localhost", "root", "", "bilet_satis_sistemi");

      if ($conn->connect_error) {
          die("Veritabanı bağlantı hatası: " . $conn->connect_error);
      }

      // Kullanıcıdan gelen veriler
      $idNumber = $conn->real_escape_string($_POST['idNumber']);
      $password = $_POST['password'];

      // Kullanıcıyı sorgula
      $sql = "SELECT * FROM users WHERE kimlik_no = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $idNumber);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
          $user = $result->fetch_assoc();

          // Şifre doğrulama
          if (password_verify($password, $user['parola'])) {
              // Oturum başlat ve yönlendir
              $_SESSION['user_id'] = $user['id'];
              $_SESSION['is_admin'] = $user['admin_mi'];

              if ($user['admin_mi'] == "admin") {
                  header("Location: admin_panel.php");
              } else {
                  header("Location: index.html");
              }
              exit();
          } else {
              $error = "Şifre hatalı.";
          }
      } else {
          $error = "Kimlik numarası bulunamadı.";
      }

      $stmt->close();
      $conn->close();
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Giriş Yap</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <style>
        body {
          background: linear-gradient(120deg, #3498db, #8e44ad);
          min-height: 100vh;
          display: flex;
          justify-content: center;
          align-items: center;
          font-family: Arial, sans-serif;
        }
        .login-container {
          background: white;
          padding: 2rem;
          border-radius: 8px;
          box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
          max-width: 400px;
          width: 100%;
        }
        .login-container h1 {
          text-align: center;
          margin-bottom: 1.5rem;
          font-weight: bold;
        }
        .form-check-label {
          font-size: 0.9rem;
        }
        .login-container .btn-primary {
          width: 100%;
          margin-top: 1rem;
        }
        .login-container .extra-links {
          display: flex;
          justify-content: space-between;
          margin-top: 1rem;
          font-size: 0.9rem;
        }
        .login-container .extra-links a {
          color: #3498db;
          text-decoration: none;
        }
        .login-container .extra-links a:hover {
          text-decoration: underline;
        }
      </style>
  </head>
  <body>
  <div class="login-container">
      <h1>Giriş Yap</h1>
      <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
      <form method="POST" action="">
          <div class="mb-3">
              <label for="idNumber" class="form-label">Kimlik Numarası:</label>
              <input
                  type="text"
                  id="idNumber"
                  class="form-control"
                  name="idNumber"
                  pattern="\d{11}"
                  title="Kimlik numarası 11 haneli bir sayı olmalıdır"
                  placeholder="Kimlik Numarası Girin"
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
          <div class="form-check mb-3">
              <input type="checkbox" id="remember" class="form-check-input" />
              <label for="remember" class="form-check-label">Beni Hatırla</label>
          </div>
          <button type="submit" class="btn btn-primary">Giriş Yap</button>
          <button
              type="button"
              class="mt-2 btn btn-warning w-100"
              onclick="goToIndex()"
          >
          Geri
          </button>
      </form>
      <div class="extra-links" style="display: block">
          Yeni Misiniz? Hemen <a href="register.php">Kayıt Olun.</a>
      </div>
  </div>
  <script>
      function goToIndex() {
          window.location.href = "index.html";
      }
  </script>
  </body>
  </html>
