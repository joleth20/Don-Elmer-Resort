<script type="text/javascript">
function preventBack() { window.history.forward(); }
setTimeout("preventBack()", 0);
window.onunload = function () { null };
</script>




<?php 
session_start();
require '../connection.php';
include('../includes/header.php'); 
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer</title>
    <link href="css/styles.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- Font Awesome 5 -->
    <script src="https://kit.fontawesome.com/bbf859ee9d.js" crossorigin="anonymous"></script>
    </head>




    <body>
        <main>
            <nav
                class="navbar navbar-dark bg-primary navbar-expand-lg d-flex flex-wrap align-items-center justify-content-center justify-content-md-between p-3">

                <a href="index.php"
                    class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-decoration-none text-light fst-italic">
                    <h5 class="align-items-center mb-0">Don Elmer's Resort</h5>
                </a>

                <ul class="nav col-12 col-md-auto mb-xl-2 mb-sm-0 justify-content-center mb-md-0">
                    <li><a href="index.php" class="nav-link px-2 link-light">Home</a></li>
                    <li><a href="reservation.php" class="nav-link px-2 link-light">Reservations</a></li>
                    <li><a href="../logout.php" class="nav-link px-2 link-light">Logout</a></li>
                </ul>

            </nav>

            <!-- Carousel -->
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                <?php include('../message.php'); ?>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img src="https://i.pinimg.com/564x/c2/de/ba/c2deba2341c274980632a7fe76f3a9e5.jpg"
                            class="d-block w-100" height="450" alt="...">
                    </div>
                    <div class="carousel-item" data-bs-interval="10000">
                        <img src="https://i.pinimg.com/564x/aa/30/64/aa30642da8b05528505d35e9c92fabd3.jpg"
                            class="d-block w-100" height="450" alt="...">
                    </div>
                    <div class="carousel-item" data-bs-interval="10000">
                        <img src="https://i.pinimg.com/564x/21/c3/1f/21c31fe9f0cfbb6136fb66964cb942c1.jpg"
                            class="d-block w-100" height="450" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <!-- Service -->
            <div class="container px-4 py-5 mb-0" id="featured-3">
                <h1 class="pb-3 border-bottom text-center fw-bolder">SERVICES</h2>
                    <div class="row g-2 py-5">
                        <div
                            class="feature col-xl-3 col-md-6 col-sm-12 d-flex flex-column align-items-center justify-content-center">
                            <div class="feature-icon fs-2 mb-3">
                                <span class="py-2 px-3 text-center text-bg-primary bg-gradient rounded">
                                    <i class="bi bi-calendar text-light"></i>
                                </span>
                            </div>
                            <p class="text-center">
                                Paragraph of text beneath the heading to explain the heading. We'll add onto it with another
                                sentence and probably just keep going until we run out of words.
                            </p>
                        </div>
                        <div
                            class="feature col-xl-3 col-md-6 col-sm-12 d-flex flex-column align-items-center justify-content-center">
                            <div class="feature-icon fs-2 mb-3">
                                <span class="py-2 px-3 text-center text-bg-primary bg-gradient rounded">
                                    <i class='fas fa-luggage-cart'></i>
                                </span>
                            </div>
                            <p class="text-center">
                                Paragraph of text beneath the heading to explain the heading. We'll add onto it with another
                                sentence and probably just keep going until we run out of words.
                            </p>
                        </div>
                        <div
                            class="feature col-xl-3 col-md-6 col-sm-12 d-flex flex-column align-items-center justify-content-center">
                            <div class="feature-icon fs-2 mb-3">
                                <span class="py-2 px-3 text-center text-bg-primary bg-gradient rounded">
                                    <i class="bi bi-wifi text-light"></i>
                                </span>
                            </div>
                            <p class="text-center">
                                Paragraph of text beneath the heading to explain the heading. We'll add onto it with another
                                sentence and probably just keep going until we run out of words.
                            </p>
                        </div>
                        <div
                            class="feature col-xl-3 col-md-6 col-sm-12 d-flex flex-column align-items-center justify-content-center">
                            <div class="feature-icon fs-2 mb-3">
                                <span class="py-2 px-3 text-center text-bg-primary bg-gradient rounded">
                                    <i class="fa-solid fa-car"></i>
                                </span>
                            </div>
                            <p class="text-center">
                                Paragraph of text beneath the heading to explain the heading. We'll add onto it with another
                                sentence and probably just keep going until we run out of words.
                            </p>
                        </div>

                    </div>
            </div>

            <!-- Footer -->
            <footer class="py-3 my-4 bg-dark text-light">
                <ul class="nav justify-content-center pb-3 mb-2">
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
                </ul>
                <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                    <li class="nav-item px-2 fs-3"><i class="bi bi-facebook"></i></li>
                    <li class="nav-item px-2 fs-3"><i class="bi bi-instagram"></i></li>
                </ul>
                <p class="text-center text-muted">&copy; 2023 Don Elmer Resort</p>
            </footer>

        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>
        <script src="js/scripts.js"></script>

        <script>
            function submitReservation() {
            // Get values from the form
            var inDate = document.getElementById("inDate").value;
            var outDate = document.getElementById("outDate").value;
            var numGuests = document.getElementById("numGuests").value;


            if (!inDate || !outDate || !numGuests) {
                alert("Please fill in all fields.");
                return;
            }   else {
                return false;
            }

            alert("Reservation details:\nCheck-in: " + inDate + "\nCheck-out: " + outDate + "\nGuests: " + numGuests);
            }
        </script>

            <?php include('../includes/footer.php'); ?>

    </body>

</html>
