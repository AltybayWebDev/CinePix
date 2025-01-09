<?php
// Veritabanı bağlantısını dahil et
require_once 'db_connect.php';

// id parametresini URL'den al
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Eğer id parametresi geçerli değilse, hata mesajı göster
if ($id <= 0) {
    die("Geçersiz film ID.");
}

// Film verilerini almak için SQL sorgusu
$query = "SELECT * FROM filmler WHERE id = :id LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

// Film verisini çek
$film = $stmt->fetch(PDO::FETCH_ASSOC);

// Eğer film bulunamazsa, hata mesajı göster
if (!$film) {
    die("Film bulunamadı.");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Film Detayları</title>
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
    <link rel="shortcut icon" href="img/Movie_Ticket.png" type="image/x-icon" />
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
      <div class="container">
        <a href="index.html" class="navbar-brand"
          ><img src="img/Movie_Ticket.png" alt="" width="30px" />Cine<span
            class="text-warning"
            >Pix</span
          ></a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#mobile"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div id="mobile" class="collapse navbar-collapse">
          <ul class="navbar-nav me-auto">
            <li><a href="index.html" class="nav-link">Anasayfa</a></li>
            <li><a href="films.php" class="nav-link">Filmler</a></li>
            <li><a href="contact.php" class="nav-link">İletişim</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container mt-5">
      <div class="row">
        <div class="col-md-4">
          <?php
          $base64Image = base64_encode($film['image']);
          ?>
          <img
            src="data:image/jpeg;base64,<?php echo $base64Image; ?>"
            alt="Film Poster"
            class="img-fluid rounded shadow"
          />
        </div>
        <div class="col-md-8">
          <h1 class="display-5"><?php echo htmlspecialchars($film['film_adi']); ?></h1>
          <p class="text-muted">
            <i class="fas fa-calendar-alt"></i> <?php echo htmlspecialchars($film['yayinlanma_tarihi']); ?>
          </p>
          <p>
            <strong>Tür:</strong> <?php echo htmlspecialchars($film['film_turu']); ?> <br />
          </p>
          <button
  onclick="window.location.href='biletAl.php?id=<?php echo $_GET['id']; ?>';"
  class="btn btn-primary btn-lg mt-3"
>
  <i class="fas fa-ticket-alt"></i> Bilet Al
</button>

          <button
            class="btn btn-secondary btn-lg mt-3 ms-2"
            onclick="window.open('<?php echo htmlspecialchars($film['link']); ?>', '_blank')"
          >
            <i class="fas fa-play-circle"></i> Fragmanı İzle
          </button>
        </div>
      </div>
    </div>

    <footer class="main-footer bg-light" style="margin-top: 130px;">
      <div class="container py-5">
        <div class="navigations">
          <h4>Sayfalar</h4>
          <ul class="list-unstyled">
            <li class="list-item">
              <a
                class="list-group-item list-group-item-action"
                href="index.html"
                >Anasayfa</a
              >
            </li>
            <li class="list-item">
              <a
                class="list-group-item list-group-item-action"
                href="films.php"
                >Filmler</a
              >
            </li>
            <li class="list-item">
              <a
                class="list-group-item list-group-item-action"
                href="contact.php"
                >İletişim</a
              >
            </li>
          </ul>
        </div>
        <div class="socials my-auto">
          <ul class="list-unstyled">
            <li class="list-inline-item">
              <a href="https://www.twitter.com/"><i class="fa-brands fa-facebook fa-2x"></i></a>
            </li>
            <li class="list-inline-item">
              <a href="https://www.facebook.com/"><i class="fa-brands fa-x-twitter fa-2x"></i></a>
            </li>
            <li class="list-inline-item">
              <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram fa-2x"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </footer>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
