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
        <li><a href="index.php" class="nav-link active">Anasayfa</a></li>
        <li><a href="films.php" class="nav-link">Filmler</a></li>
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

      <form class="d-flex align-items-center" action="films.php" method="GET">
        <input
          type="text"
          class="form-control me-1"
          placeholder="Film Ara"
          name="filmname"
          style="max-width: 200px"
        />
        <button class="btn btn-warning">
          <i class="fas fa-magnifying-glass"></i>
        </button>
      </form>
    </div>
  </div>
</nav>
    <header class="main-header" style="height: 90vh">
      <div
        class="container d-flex justify-content-center align-items-center text-white h-100"
      >
        <div class="bg-warning text-center p-4 rounded">
          <h1 class="text-white">CinePix'e Hoş Geldiniz!</h1>
        </div>
      </div>
    </header>

    <section class="section-a">
      <div class="container mt-5">
        <h2>Yeni Eklenenlere Bir Göz Atın</h2>
        <div class="references owl-carousel owll-theme mt-5">
          <a href="films.php">
            <div>
              <div class="card"><img src="img/ayla.jpg" alt="" /></div>
            </div>
          </a>
          <a href="films.php">
            <div>
              <div class="card">
                <img src="img/kurtlar_imparatorluğu.jpeg" alt="" />
              </div>
            </div>
          </a>
          <a href="films.php">
            <div>
              <div class="card"><img src="img/matrix.webp" alt="" /></div>
            </div>
          </a>
          <a href="films.php">
            <div>
              <div class="card"><img src="img/mortal_kombat.jpg" alt="" /></div>
            </div>
          </a>
          <a href="films.php">
            <div>
              <div class="card">
                <img src="img/the_god_father.jpeg" alt="" />
              </div>
            </div>
          </a>
          <a href="films.php">
            <div>
              <div class="card"><img src="img/venom.jpeg" alt="" /></div>
            </div>
          </a>
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

    <script src="js/jquery.min.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script>
      $(document).ready(function () {
        $(".references").owlCarousel({
          items: 3,
          loop: true,
          margin: 10,
          nav: true,
          autoplay: true,
          autoplayTimeout: 2000,
          dots: true,
          responsive: {
            0: {
              items: 1,
            },
            576: {
              items: 2,
            },
            768: {
              items: 3,
            },
            1200: {
              items: 4,
            },
          },
        });
      });
    </script>
  </body>
</html>
