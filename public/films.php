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
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
      <div class="container">
        <a href="index.php" class="navbar-brand"
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
            <li><a href="index.php" class="nav-link">Anasayfa</a></li>
            <li><a href="films.php" class="nav-link active">Filmler</a></li>
            <li><a href="contact.php" class="nav-link">İletişim</a></li>
          </ul>
        </div>

        <a href="login.php" class="nav-link">
          <i class="fa-solid fa-user-plus fa-2x text-white me-3"></i>
        </a>
      </div>
    </nav>

    <section>
      <div class="container">
        <div class="row mt-5">
          <div class="col-md-4">
            <div class="filter-box p-4">
              <h5>Filtreler</h5>
              <form>
                <div class="form-group">
                <label for="filmname">Film Adı</label>
                <input type="text" name="filmname" id="filmname" class="form-control" placeholder="Film Adı">
                </div>
                <div class="form-group">
                  <label for="genre">Tür</label>
                  <select class="form-control" id="genre">
                    <option>Komedi</option>
                    <option>Aksiyon</option>
                    <option>Dram</option>
                    <option>Korku</option>
                    <option>Bilim Kurgu</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="date">Tarihi</label>
                  <input type="date" name="date" id="date" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-4">
                  Filtrele
                </button>
              </form>
            </div>
          </div>

          <div class="col-md-8">
            <div class="row">
              <div class="col-md-4 mb-4">
                <a href="filmDetaylari.php" class="movie-card">
                  <img
                    src="https://picsum.photos/300/250?random=1"
                    alt="Film 1"
                  />
                  <div class="movie-card-body">
                    <div class="movie-title">Film Adı 1</div>
                    <div class="movie-description">
                      Aksiyon dolu bir film. Eğlenceli bir deneyim.
                    </div>
                    <div class="movie-price mt-3">
                      <span class="badge bg-success">Fiyat: 500₺</span>
                    </div>
                  </div>
                </a>
              </div>

              <div class="col-md-4 mb-4">
                <a href="filmDetaylari.php" class="movie-card">
                  <img
                    src="https://picsum.photos/300/250?random=2"
                    alt="Film 2"
                  />
                  <div class="movie-card-body">
                    <div class="movie-title">Film Adı 2</div>
                    <div class="movie-description">
                      Drama ve gerilim dolu bir film.
                    </div>
                    <div class="movie-price mt-3">
                      <span class="badge bg-success">Fiyat: 500₺</span>
                    </div>
                  </div>
                </a>
              </div>

              <div class="col-md-4 mb-4">
                <a href="filmDetaylari.php" class="movie-card">
                  <img
                    src="https://picsum.photos/300/250?random=3"
                    alt="Film 3"
                  />
                  <div class="movie-card-body">
                    <div class="movie-title">Film Adı 3</div>
                    <div class="movie-description">
                      Korku türünde bir başyapıt.
                    </div>
                    <div class="movie-price mt-3">
                      <span class="badge bg-success">Fiyat: 500₺</span>
                    </div>
                  </div>
                </a>
              </div>

              <div class="col-md-4 mb-4">
                <a href="filmDetaylari.php" class="movie-card">
                  <img
                    src="https://picsum.photos/300/250?random=4"
                    alt="Film 4"
                  />
                  <div class="movie-card-body">
                    <div class="movie-title">Film Adı 4</div>
                    <div class="movie-description">
                      Bilim kurgu dolu bir hikaye.
                    </div>
                    <div class="movie-price mt-3">
                      <span class="badge bg-success">Fiyat: 500₺</span>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
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
