<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bilet Detayları</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
</head>
<body>
  <div class="container my-5">
    <h1 class="display-5 text-center mb-4">Bilet Detaylarınız</h1>
    <div class="card mx-auto" style="max-width: 500px;">
      <div class="card-body">
        <h5 class="card-title">Bilet Bilgileri</h5>
        <p class="card-text">
          <strong>Film Adı:</strong> Film Adı<br>
          <strong>Seans:</strong> <span id="seans"></span><br>
          <strong>Koltuk:</strong> <span id="koltuk"></span><br>
          <strong>Bilet Türü:</strong> <span id="bilet"></span><br>
        </p>
      </div>
    </div>
    <div class="d-flex justify-content-center mt-4">
      <a href="index.php" class="btn btn-secondary me-2">Anasayfa</a>
      <button onclick="showTickets()" class="btn btn-primary">Biletlerimi Görüntüle</button>
    </div>
  </div>

  <script>
    function getQueryParam(param) {
      const urlParams = new URLSearchParams(window.location.search);    
      return urlParams.get(param) || "Belirtilmedi";
    }

    document.getElementById("seans").textContent = getQueryParam("seans");
    document.getElementById("koltuk").textContent = getQueryParam("koltuk");  
    document.getElementById("bilet").textContent = getQueryParam("bilet");

    function showTickets() {
      alert("Biletlerim: Henüz başka bilet eklenmedi.");
    }
  </script>
</body>
</html>
