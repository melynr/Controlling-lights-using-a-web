<?php  
include 'config.php';
$sql = mysqli_query($dbcon, "SELECT * FROM tb_control");
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css"/>

    <title>Smart Lamp</title>
</head>
<body>
<div class="container">
    <nav class="navbar bg-primary mb-5" data-bs-theme="dark">
        <!-- Navbar content -->
        <div class="container-fluid justify-content-center">
            <span class="navbar-text">
              <h4 style="color: antiquewhite;">Kontrol Lampu dengan Website</h4>
            </span>
        </div>
    </nav>
    <div class="row justify-content-center">
        <?php
        while ($row = mysqli_fetch_assoc($sql)) {
            ?>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="card text-center">
                <div class="card-header">
                  <h4>Smart Lamp</h4>
                </div>
                <div class="card-body">
                <h5 class="card-title">
                  <?php 
                  if($row['lampu'] == 1){
                    $status = "ON";
                  }else{
                    $status = "OFF";
                  }  
                  ?>
                  <?=$status;?>
                  </h5>
                        <p class="card-text"><?= $row['lampu']; ?></p>
                        <a href="aksi.php?channel=1&state=1" class="btn btn-success">ON</a>
                        <a href="aksi.php?channel=1&state=0" class="btn btn-danger">OFF</a>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
-->
</body>
</html>
