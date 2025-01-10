<?php
session_start();

require_once 'db_connect.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

if ($id <= 0) {
    die("Geçersiz film ID.");
}

$query = "SELECT * FROM filmler WHERE id = :id LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$film = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$film) {
    die("Film bulunamadı.");
}

$bilet_fiyati = isset($film['bilet_fiyati']) ? $film['bilet_fiyati'] : 0;
$yayinlanma_saati = isset($film['yayinlanma_saati']) ? $film['yayinlanma_saati'] : '';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Mevcut biletleri çek
$biletQuery = "SELECT koltuk_no FROM biletler WHERE film_id = :film_id";
$biletStmt = $conn->prepare($biletQuery);
$biletStmt->bindParam(':film_id', $id, PDO::PARAM_INT);
$biletStmt->execute();
$doluKoltuklar = $biletStmt->fetchAll(PDO::FETCH_COLUMN);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $yayinlanma_saati = isset($_POST['yayinlanma_saati']) ? $_POST['yayinlanma_saati'] : '';
    $selectedSeats = isset($_POST['selectedSeats']) ? json_decode($_POST['selectedSeats'], true) : [];

    if (!empty($yayinlanma_saati) && !empty($selectedSeats)) {
        $insertQuery = "INSERT INTO biletler (user_id, film_id, koltuk_no, bilet_fiyati, saati) VALUES (:user_id, :film_id, :koltuk_no, :bilet_fiyati, :saati)";
        $insertStmt = $conn->prepare($insertQuery);

        foreach ($selectedSeats as $koltuk_no) {
            $insertStmt->execute([
                ':user_id' => $user_id,
                ':film_id' => $id,
                ':koltuk_no' => $koltuk_no,
                ':bilet_fiyati' => $bilet_fiyati,
                ':saati' => $yayinlanma_saati
            ]);
        }

        $basari = "Biletler başarıyla alındı!";
    } else {
        echo "Lütfen saat ve koltuk seçiniz.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bilet Al</title>
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
    .seat-map {
      display: grid;
      grid-template-columns: repeat(10, 1fr);
      gap: 8px;
      justify-content: center;
      padding: 16px;
    }
    .seat {
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid #ccc;
      border-radius: 4px;
      cursor: pointer;
      font-size: 12px;
      font-weight: bold;
    }
    .seat.selected {
      background-color: #007bff;
      color: white;
    }
    .seat.taken {
      background-color: #dc3545;
      color: white;
      cursor: not-allowed;
    }
    .seat-map-label {
      text-align: center;
      font-weight: bold;
      margin-top: 10px;
    }
  </style>
  
</head>
<body>
  <div class="container my-5">
    <h1 class="display-5 text-center mb-4">Bilet Al</h1>
    <div class="row">
      <div class="col-md-4">
        <div class="card">
        <?php
          $base64Image = base64_encode($film['image']);
          ?>
        <img
            src="data:image/jpeg;base64,<?php echo $base64Image; ?>"
            alt="Film Poster"
            class="img-fluid rounded shadow"
          />
          <div class="card-body">
          <h5 class="card-title"><?php echo $film['film_adi']; ?></h5>
            <p class="card-text">
            <strong>Tür:</strong> <?php echo $film['film_turu']; ?><br>
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-8">
        <form action="biletAl.php?id=<?php echo $id; ?>" method="post">
          <div class="mb-4">
            <label for="yayinlanma_saati" class="form-label"><strong>Yayınlanma Saati:</strong></label>
            <input type="text" class="form-control" id="yayinlanma_saati" name="yayinlanma_saati" value="<?php echo htmlspecialchars($yayinlanma_saati); ?>" readonly>
          </div>

          <div class="seat-status d-flex justify-content-center my-3">
            <div class="d-flex align-items-center me-3">
              <div class="seat selected me-2"></div> <span>Seçili</span>
            </div>
            <div class="d-flex align-items-center me-3">
              <div class="seat taken me-2"></div> <span>Dolu</span>
            </div>
            <div class="d-flex align-items-center">
              <div class="seat me-2"></div> <span>Boş</span>
            </div>
          </div>

          <div class="mb-4">
            <label for="salon" class="form-label"><strong>Koltuk Seçimi:</strong></label>
            <div class="seat-map">
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  const seatMap = document.querySelector(".seat-map");
                  const totalPriceElement = document.querySelector("#total-price");
                  const ticketPrice = <?php echo json_encode($bilet_fiyati); ?>;
                  const doluKoltuklar = <?php echo json_encode($doluKoltuklar); ?>;
                  let selectedSeats = 0;
                  let selectedSeatsArray = [];

                  for (let i = 1; i <= 50; i++) {
                    const seat = document.createElement("button");
                    seat.classList.add("seat", "btn", "btn-outline-secondary");
                    seat.textContent = `K${i}`;
                    seat.type = "button";

                    if (doluKoltuklar.includes(`K${i}`)) {
                      seat.classList.add("taken");
                      seat.disabled = true;
                    }

                    seat.onclick = () => {
                      seat.classList.toggle("selected");
                      if (seat.classList.contains("selected")) {
                        selectedSeats++;
                        selectedSeatsArray.push(`K${i}`);
                      } else {
                        selectedSeats--;
                        const index = selectedSeatsArray.indexOf(`K${i}`);
                        if (index > -1) {
                          selectedSeatsArray.splice(index, 1);
                        }
                      }
                      const totalPrice = selectedSeats * ticketPrice;
                      totalPriceElement.textContent = `${totalPrice}₺`;
                      document.querySelector("#selectedSeats").value = JSON.stringify(selectedSeatsArray);
                    };
                    seatMap.appendChild(seat);
                  }
                });
              </script>
            </div>
            <p class="seat-map-label">Lütfen koltuğunuzu seçiniz.</p>
          </div>

          <div class="mb-4">
            <p class="fs-5"><strong>Toplam Tutar:</strong> <span id="total-price">0₺</span></p>
          </div>

          <strong>
          <?php
          if (!empty($basari)) {
            echo $basari;
        }
          ?>
          </strong>

          <br><br>

          <input type="hidden" id="selectedSeats" name="selectedSeats" value="[]">
          <button type="submit" class="btn btn-primary btn-lg">Bilet Al</button>
          <button class="btn btn-warning btn-lg" onclick="window.location.href='films.php'; return false;">Geri</button>
        </form>
      </div>
    </div>
  </div>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"
  ></script>
</body>
</html>