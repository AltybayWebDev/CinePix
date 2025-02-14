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
        <li><a href="films.php" class="nav-link ">Filmler</a></li>
        <li><a href="contact.php" class="nav-link active">İletişim</a></li>
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

    <section class="container my-5">
      <div class="row">
        <div class="col-md-6">
          <h2>İletişime Geçin</h2>
          <p class="lead">
            Bizimle iletişime geçmek için aşağıdaki formu doldurun veya iletişim
            bilgilerini kullanın.
          </p>

          <div class="contact-info my-4">
            <div>
              <i class="fas fa-map-marker-alt"></i> Adres: Mah. Sinema Sok.
              No:123, İstanbul  
            </div>
            <div><i class="fas fa-phone"></i> Telefon: +90 123 456 78 90</div>
            <div><i class="fas fa-envelope"></i> E-posta: info@cinepix.com</div>
          </div>
        </div>

        <div class="col-md-6">
          <h3>Bizimle İletişime Geçin</h3>
          <form class="contact-form">
            <div class="form-group">
              <label for="name">Adınız Soyadınız</label>
              <input
                type="text"
                class="form-control mb-3"
                id="name"
                placeholder="Adınız Soyadınız"
                required
              />
            </div>
            <div class="form-group">
              <label for="email">E-posta Adresiniz</label>
              <input
                type="email"
                class="form-control mb-3"
                id="email"
                placeholder="E-posta adresiniz"
                required
              />
            </div>
            <div class="form-group">
              <label for="message">Mesajınız</label>
              <textarea
                class="form-control mb-3"
                id="message"
                rows="4"
                placeholder="Mesajınızı buraya yazın"
                required
              ></textarea>
            </div>
            <input type="submit" class="btn btn-warning">
          </form>
        </div>
      </div>
    </section>

    <footer class="main-footer bg-light">
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
