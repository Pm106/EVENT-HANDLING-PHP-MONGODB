<?php
session_start(); // Start the session

require("connection.php"); // Include the connection file

?><!DOCTYPE html>
<html>
<head>
    <title>M² Event - User Home</title>
    <link rel="shortcut icon" href="img/lifestyleStore.png" />
        <title>M² Event</title>
        <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <Style>
         img {
      width: 650px;
      height: 700px;
    }
    h2 {
      color: aliceblue;
    }
    .figure img {
  width: 900px;
  height: 600px;
}
body {
        background-color: #222;
         /* dark mode background color */
    }
    .image-with-text {
  position: relative;
}
    </Style>
    </head>
<body>
<?php
             //   require 'header2.php';
            ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand fs-2" href="Uhome.php" style="font-family:'Great Vibes', cursive;">M² Event</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Events
          </a>
          <ul class="dropdown-menu bg-dark">
            <li><a class="dropdown-item bg-dark" href="Birthday.php" style="color: #fff;">Birthday Events</a></li>
            <li><a class="dropdown-item bg-dark" href="Wedding.php" style="color: #fff;">Wedding Events</a></li>
            <li><a class="dropdown-item bg-dark" href="Formal.php" style="color: #fff;">Formal Events</a></li>
            <li><a class="dropdown-item bg-dark" href="Trd.php" style="color: #fff;">Traditional Events</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <form >
      <a href="cart_event.php" class="btn btn-outline-primary" type="submit">Your Events</a>
      <a href="logout.php" class="btn btn-outline-primary" type="submit">Logout</a>
    </form>
  </div>
  </nav>
<div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/WhatsApp Image 2025-03-04 at 12.34.30_99874c5d.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>DJ Night Event</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/WhatsApp Image 2025-03-04 at 12.34.34_19bf5950.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Wedding Event</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/WhatsApp Image 2025-03-06 at 00.01.26_c23c36ca.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Birthday Event</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div><br>

<figure class="figure d-grid grid-template-columns-1fr-1fr gap-3">
<figcaption class="figure-caption">
  <div class="image-with-text"><a href="Birthday.php">
  <img src="img/WhatsApp Image 2025-03-06 at 12.21.35_22774172.jpg" class="figure-img img-fluid rounded" alt="...">
<h1 style="font-size: 60px; font-family: Arial Rounded MT Bold; color: #fff; text-align:left; position: absolute; top: 30%; right: -1%; transform: translate(-50%, -50%);">Birthday Events</h1>
</a></div>
    <span class="text">
    </div>  
  </figcaption>
  </figure>
<div class="d-flex justify-content-end">
    <figure class="figure d-grid grid-template-columns-1fr-1fr gap-3">
    <figcaption class="figure-caption">
    <div class="image-with-text"><a href="Wedding.php">
        <img src="img/WhatsApp Image 2025-03-06 at 11.08.36_afff3230.jpg" class="figure-img img-fluid rounded" alt="Wedding.php">
        <h1 style="font-size: 60px; font-family: Arial Rounded MT Bold; color: #fff; text-align: center; position: absolute; top: 30%; left: -28%; transform: translate(-50%, -50%);">Weeding Events</h1>
</a></div>  
        </figcaption>  
      </figure>
</div>
<figure class="figure d-grid grid-template-columns-1fr-1fr gap-3">
<figcaption class="figure-caption">
  <div class="image-with-text"><a href="Formal.php">
  <img src="img/WhatsApp Image 2025-03-06 at 00.25.02_5cfff923.jpg" class="figure-img img-fluid rounded" alt="...">
<h1 style="font-size: 60px; font-family: Arial Rounded MT Bold; color: #fff; text-align:left; position: absolute; top: 30%; right: 1%; transform: translate(-50%, -50%);">Formal Events</h1>
</a></div>
<div class="d-flex justify-content-end">
    <figure class="figure d-grid grid-template-columns-1fr-1fr gap-3">
    <figcaption class="figure-caption">
    <div class="image-with-text"><a href="Trd.php">
        <img src="img/WhatsApp Image 2025-03-07 at 13.57.40_1cb282f5.jpg" class="figure-img img-fluid rounded" alt="...">
        <h1 style="font-size: 60px; font-family: Arial Rounded MT Bold; color: #fff; text-align: center; position: absolute; top: 30%; left: -28%; transform: translate(-50%, -50%);">Traditional Events</h1>
    </a></div>  
        </figcaption>  
      </figure>
</div>
    <span class="text">
    </div>  
  </figcaption>
  </figure>
<footer class="footer">
               <div class="container">
               <center style="color: #fff;">
                   <p>Copyright &copy M² Event. All Rights Reserved. | Contact Us: +91 90000 00000</p>
                   <p>This website is developed by MIHIR PATEL</p>
               </center>
               </div>
           </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>