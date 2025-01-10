<?php
require_once 'db_connect.php'; 

$filmname = isset($_GET['filmname']) ? $_GET['filmname'] : '';
$genre = isset($_GET['genre']) ? $_GET['genre'] : '';
$date = isset($_GET['date']) ? $_GET['date'] : '';

$query = "SELECT * FROM filmler WHERE 1=1";

if (!empty($filmname)) {
    $query .= " AND film_adi LIKE :filmname";
}
if (!empty($genre)) {
    $query .= " AND film_turu = :genre";
}
if (!empty($date)) {
    $query .= " AND yayinlanma_tarihi = :date";
}

$stmt = $conn->prepare($query);

if (!empty($filmname)) {
    $stmt->bindValue(':filmname', "%$filmname%", PDO::PARAM_STR);
}
if (!empty($genre)) {
    $stmt->bindValue(':genre', $genre, PDO::PARAM_STR);
}
if (!empty($date)) {
    $stmt->bindValue(':date', $date, PDO::PARAM_STR);
}

$stmt->execute();
$films = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Anasayfa</title>

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
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/owl.carousel.min.css" />
    <link rel="shortcut icon" href="img/Movie_Ticket.png" type="image/x-icon" />
  </head>
  <body>
  <body id="#body">
    <?php session_start(); ?>
  <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
    <a href="index.php" class="navbar-brand">
      <img src="img/Movie_Ticket.png" alt="" width="30px" />
      Cine<span class="text-warning">Pix</span>
    </a>

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
        <li><a href="index.php" class="nav-link ">Anasayfa</a></li>
        <li><a href="films.php" class="nav-link active">Filmler</a></li>
        <li><a href="contact.php" class="nav-link">İletişim</a></li>
      </ul>

      <!-- Kullanıcı giriş durumu kontrolü -->
      <?php if (isset($_SESSION['user_id'])): ?>
        <!-- Kullanıcı giriş yapmışsa -->
        <div class="d-flex align-items-center">
          <a href="profile.php" class="nav-link text-white me-3">
            <?php echo htmlspecialchars($_SESSION['ad']); ?>
            </a>
            <a href="logout.php" class="nav-link text-danger pe-3 my-2">
              <i class="fas fa-sign-out-alt"></i> Çıkış Yap
            </a>
          </div>
        <?php else: ?>
          <!-- Kullanıcı giriş yapmamışsa -->
          <a href="login.php" class="nav-link">
            <i class="fa-solid fa-user-plus fa-2x text-white pe-3 my-2"></i>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </nav>
    <section>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-4">
        <div class="filter-box p-4">
          <h5>Filtreler</h5>
          <form method="GET" action="films.php">
            <div class="form-group">
              <label for="filmname">Film Adı</label>
              <input
                type="text"
                name="filmname"
                id="filmname"
                class="form-control"
                placeholder="Film Adı"
                value="<?php echo htmlspecialchars($filmname); ?>"
              />
            </div>
            <div class="form-group">
              <label for="genre">Tür</label>
              <select class="form-control" id="genre" name="genre">
                <option value="">Tüm Türler</option>
                <option value="Komedi" <?php if ($genre == 'Komedi') echo 'selected'; ?>>Komedi</option>
                <option value="Aksiyon" <?php if ($genre == 'Aksiyon') echo 'selected'; ?>>Aksiyon</option>
                <option value="Dram" <?php if ($genre == 'Dram') echo 'selected'; ?>>Dram</option>
                <option value="Korku" <?php if ($genre == 'Korku') echo 'selected'; ?>>Korku</option>
                <option value="Bilim Kurgu" <?php if ($genre == 'Bilim Kurgu') echo 'selected'; ?>>Bilim Kurgu</option>
              </select>
            </div>
            <div class="form-group">
              <label for="date">Tarihi</label>
              <input
                type="date"
                name="date"
                id="date"
                class="form-control"
                value="<?php echo htmlspecialchars($date); ?>"
              />
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-4">
              Filtrele
            </button>
          </form>
        </div>
      </div>

      <div class="col-md-8">
      <div class="row">
  <?php if (!empty($films)): ?>
    <?php foreach ($films as $film): ?>
      <div class="col-md-4 mb-4">
        <a href="filmDetaylari.php?id=<?php echo $film['id']; ?>" class="movie-card">
          <?php 
          $base64Image = base64_encode($film['image']);
          ?>
          <img
            src="data:image/jpeg;base64,<?php echo $base64Image; ?>"
            alt="<?php echo htmlspecialchars($film['film_adi']); ?>"
          />
          <div class="movie-card-body">
            <div class="movie-title"><?php echo htmlspecialchars($film['film_adi']); ?></div>
            <div class="movie-description">
              <?php echo htmlspecialchars($film['film_turu']); ?>
            </div>
            <div class="movie-price mt-3">
              <span class="badge bg-success">Fiyat: <?php echo htmlspecialchars($film['bilet_fiyati']); ?>₺</span>
            </div>
          </div>
        </a>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="col-12">
      <div class="alert alert-warning">Hiç film bulunamadı.</div>
    </div>
  <?php endif; ?>
</div>

      </div>
    </div>
  </div>
</section>
<br><br>
    <footer class="main-footer bg-light mt-5">
      <div class="container py-5">
        <div class="navigations">
          <h4>Sayfalar</h4>
          <ul class="list-unstyled">
            <li class="list-item">
              <a
                class="list-group-item list-group-item-action"
                href="index.php"
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
              <a href="https://www.facebook.com/"
                ><i class="fa-brands fa-facebook fa-2x"></i
              ></a>
            </li>
            <li class="list-inline-item">
              <a href="https://www.twitter.com/"
                ><i class="fa-brands fa-x-twitter fa-2x"></i
              ></a>
            </li>
            <li class="list-inline-item">
              <a href="https://www.instagram.com/"
                ><i class="fa-brands fa-instagram fa-2x"></i
              ></a>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.5/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
