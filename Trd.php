<?php
require("connection.php");

$collection = $db->Event;
$query = $collection->find(['category' => 'Traditional Events']);
$events = $query->toArray();

if (count($events) > 0) {
    ?><!DOCTYPE html>
    <html>
        <head>
            <link rel="shortcut icon" href="img/lifestyleStore.png" />
            <title>M² Event</title>
            <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="css/style.css" type="text/css">
            <style>img {
      width: 650px;
      height: 300px;
    }
    h2 {
      color: aliceblue;
    }
    .figure img {
  width: 150px;
  height: 1500px;
}
body {
  color: aliceblue;
        background-color: #222;
         /* dark mode background color */
    }
    .image-with-text {
  position: relative;
} #background-video {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 500px;
                object-fit: cover;
                z-index: -1;
            }

            .container {
                position: relative;
                z-index: 1;
            }
            
    </Style>
    </head>
<body>
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
      <a href="logout.php" class="btn btn-outline-primary" type="submit">Logout</a>
    </form>
  </div>
  </nav>
<div>
<video id="background-video" autoplay muted loop>
<source src="vid/Untitled video - Made with Clipchamp (1).mp4" type="video/mp4">
</video></div><div>
<div class="container" style="position: absolute; top: 500px; left: 0; z-index: 1;">
                <h1>Traditional Events</h1>
                <div class="row">
                    <?php foreach ($events as $event) { ?>
                        <div class="col-md-4">
                            <div class="card">
                            <?php
                                $imageData = $event['image'];
                                if ($imageData instanceof MongoDB\BSON\Binary) {
                                    $imagePath = 'data:image/jpeg;base64,' . base64_encode($imageData->getData());
                                    ?>
                                    <img src="<?php echo $imagePath; ?>" class="card-img-top" alt="...">
                                    <?php
                                } else {
                                    ?>
                                    <img src="default-image.jpg" class="card-img-top" alt="...">
                                    <?php
                                }
                                ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $event['name']; ?></h5>
                                    <p class="card-text">Price: <?php echo $event['price']; ?></p>
                                    <p class="card-text">Category: <?php echo $event['category']; ?></p>
                                    <button class="btn btn-primary">
                                    <a href="book_event.php?event_id=<?php echo $event['_id']; ?>" style="color: #fff; text-decoration: none;">
                                    Book Event
                                          </a>
                                    </button>                                  </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div><br><br><br><br><br>        
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </body>
</html>
<?php
} else {
    echo "No wedding events found.";
}
?>