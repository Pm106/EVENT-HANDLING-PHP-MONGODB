<?php
session_start();

require("connection.php");

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/lifestyleStore.png" />
        <title>M² Event</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <style>
            #background-video {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 700px;
                object-fit: cover;
                z-index: -1;
            }

            .container {
                position: relative;
                z-index: 1;
            }
        </style>
    </head>
    <body>
        <div>
            <video id="background-video" autoplay muted loop>
                <source src="vid/M² Event.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <?php
            require 'header.php';
            ?>
            <!--<div class="container">
                <div id="bannerImage">
                    <div class="container">
                        <center>
                        <div id="bannerContent">
                            <h1>We sell lifestyle.</h1>
                            <p>Flat 40% OFF on all premium brands.</p>
                            <a href="products.php" class="btn btn-danger">Shop Now</a>
                        </div>
                        </center>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-xs-4">
                        <div  class="thumbnail">
                            <a href="login.php">
                                <img src="img/raymond.jpg" alt="Camera">
                            </a>
                            <center>
                                <div class="caption">
                                    <p id="autoResize">Collection</p>
                                    <p>Choose among the best available in the world.</p>
                                </div>
                            </center>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="thumbnail">
                            <a href="login.php">
                                <img src="img/olympus.jpg" alt="Watch">
                            </a>
                            <center>
                                <div class="caption">
                                    <p id="autoResize">Formal</p>
                                    <p>Original Formals from the best brands.</p>
                                </div>
                            </center>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="thumbnail">
                            <a href="login.php">
                                <img src="img/pink.jpg" alt="Shirt">
                            </a>
                            <center>
                                <div class="caption">
                                    <p id="autoResize">Shirts</p>
                                    <p>Our exquisite collection of shirts.</p>
                                </div>
                            </center>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        <footer class="footer">
               <div class="container">
               <center>
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