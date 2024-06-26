<?php
session_start();
include 'Base.php';
global $base;

// Fetch all unique models from the planes table
$query = "SELECT DISTINCT model FROM Rental_planes";
$stmt = $base->prepare($query);
$stmt->execute();
$models = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch the list of planes
$query = "SELECT * FROM Rental_planes";
$allPlanes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Define initial display settings
$initialPlaneCount = 6; // Display the first 6 planes initially
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Staffs_Airways - Aircraft</title>
        <!-- <link rel="stylesheet" href="tailwind.css"> -->
        <link rel="stylesheet"href="../css/tailwind.css">
    </head>
    <body>

        <header>
            <nav class="navbar">
                <div class="container1">
                <img src="../Img_logo/aircraft-removebg-preview.png" alt="Airline Management Logo" class="logo">
                <ul class="nav-links">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="aircraft.php">Rent a Plane</a></li>
                    <li><a href="aboutUs.php">About Us</a></li>
                    <?php
                    if(isset($_SESSION['user_id'])){
                    echo "<li><a href=\"Profile.php\">Profile</a></li>";
                    if($_SESSION['admin_id'] == 1){
                        echo "<li><a href=\"../admin/home.php\">Admin</a></li>";
                    }
                    echo "<li><a href=\"Logout.php\">Logout</a></li>";
                    }
                    else {
                    echo "<li><a href=\"Login.php\">Log In</a></li>
                            <li id=\"sign-in\"><a href=\"Registration.php\">Sign In</a></li>";
                    }

                    ?>
                </ul>
                </div>
            </nav>
        </header>

        <main style="background: linear-gradient(to bottom,#d0d1d1, #001d3d ) ;">

            <?php

                $plane_id = $_GET['plane_id'];

                // Fetch the plane details from the database
                $query = "SELECT * FROM Rental_planes WHERE rental_id = :plane_id";
                $stmt = $base->prepare($query);
                $stmt->bindParam(':plane_id', $plane_id, PDO::PARAM_STR);
                $stmt->execute();
                $plane = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$plane) {
                    echo "<p>Plane not found.</p>";
                    exit;
                }

                // Plane details display
            ?>
            <section class="py-24" style="margin-bottom: 75px" >
                <div class="container mx-auto px-4" style="font-family:Verdana, Geneva, Tahoma, sans-serif">
                    <div class="-mx-4 flex flex-wrap items-center">
                        <!-- Image Section -->
                        <div class="px-4 w-full lg:w-6/12" style="margin-top: 75px; padding-bottom: 30px">
                            <img src="<?= $plane['image_path']?>" class="w-full rounded-lg" alt="<?= $plane['model'] ?>" />
                        </div>
                        <!-- Details Section -->
                        <div class="px-4 w-full lg:w-6/12"style="font-size:20px display flex">
                            <h2 class="font-bold text-3xl "><?= $plane['model'] ?></h2>
                            <p class="text-gray-600 my-4"><?= $plane['description'] ?></p>

                            <!-- Features with Icons -->
                            <div style="display: flex; height: 200px; margin-top: -40px">
                                <div class="lotdinf">
                                    <div class="flex items-center space-x-2" style="margin-top:30px">
                                        <img src="../Img_logo/icon_capacity.png" alt="Capacity Icon" width="24" height="24" />
                                        <p class="text-gray-600 mb-1">
                                            <b>Capacity</b>: <p style="color: black"><?= $plane['maximum_capacity'] ?> people</p>
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-2" style="margin-top:30px">
                                        <img src="../Img_logo/icon_range.png" alt="Range Icon" width="24" height="24" />
                                        <p class="text-gray-600 mb-1">
                                            <b>Maximum Range</b>: <p style="color: black"><?= $plane['maximum_range'] ?> km</p>
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-2" style="margin-top:30px">
                                        <img src="../Img_logo/icon_manufacturer.png" alt="Manufacturer Icon" width="24" height="24" />
                                        <p class="text-gray-600 mb-1">
                                            <b>Manufacturer</b>: <p style="color: black"><?= $plane['manufacturer'] ?></p>
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-2" style="margin-top:30px">
                                        <img src="../Img_logo/icon_year.png" alt="Year Icon" width="24" height="24" />
                                        <p class="text-gray-600 mb-1">
                                            <b>Year of Manufacture</b>: <p style="color: black"><?= $plane['year_of_manufacture'] ?></p>
                                        </p>
                                    </div>
                                </div>
                                <div class="vertical-line"></div>
                                <div class="lotdinf">
                                    <div class="flex items-center space-x-2" style="margin-top:30px">
                                        <img src="../Img_logo/icon_rating.svg" alt="Rating Icon" width="24" height="24" />
                                        <p class="text-gray-600 mb-1">
                                            <b>Rating</b>: <p style="color: black"><?= $plane['rating'] ?></p>
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-2" style="margin-top:30px">
                                        <img src="../Img_logo/icon_reviews.png" alt="Reviews Icon" width="24" height="24" />
                                        <p class="text-gray-600 mb-1">
                                            <b>Reviews</b>: <p style="color: black"><?= $plane['number_of_reviews'] ?> reviews</p>
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-2" style="margin-top:30px">
                                        <img src="../Img_logo/icon_availability.png" alt="Availability Icon" width="24" height="24" />
                                        <p class="text-gray-600 mb-1">
                                            <b>Availability</b>: <p style="color: black"><?= $plane['availability_status'] ?></p>
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-2" style="margin-top:30px">
                                        <img src="../Img_logo/icon_price.png" alt="Price Icon" width="24" height="24" />
                                        <p class="text-gray-600 mb-1">
                                            <b>Rental Price</b>: <p style="color: black">$<?= $plane['rental_price_per_hour'] ?>/hour</p>
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div class="booking-form show">
                                <!-- Formulaire de réservation -->
                                <!-- <section class="bg-white py-12">
                                    <div class="container mx-auto px-6" style="max-width: 600px; margin-top: 75px;">
                                        <?php
                                            // Supposons que `$plane['location_id']` donne l'ID de la localisation de départ
                                            // Requête pour récupérer toutes les localisations à l'exception de celle de départ
                                            $query = "SELECT location_name FROM Locations WHERE location_id != :departure_id";
                                            $stmt = $base->prepare($query);
                                            $stmt->bindParam(':departure_id', $plane['location_id']);
                                            $stmt->execute();
                                            $arrival_locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        ?>
                                        <?php
                                            // Connexion à la base de données et récupération des détails de l'avion
                                            include 'Base.php';
                                            global $base;
                                            $plane_id = $_GET['plane_id'];
                                            $query = "SELECT * FROM Rental_planes WHERE rental_id = :plane_id";
                                            $stmt = $base->prepare($query);
                                            $stmt->bindParam(':plane_id', $plane_id, PDO::PARAM_INT);
                                            $stmt->execute();
                                            $plane = $stmt->fetch(PDO::FETCH_ASSOC);

                                            if (!$plane) {
                                                echo "Plane not found.";
                                                exit;
                                            }

                                            // Récupérer l'emplacement de départ lié à l'avion
                                            $departure_id = $plane['base_location'];
                                            $query = "SELECT * FROM Locations WHERE location_id = :departure_id";
                                            $stmt = $base->prepare($query);
                                            $stmt->bindParam(':departure_id', $departure_id, PDO::PARAM_INT);
                                            $stmt->execute();
                                            $departure_location = $stmt->fetch(PDO::FETCH_ASSOC);

                                            if (!$departure_location) {
                                                echo "Departure location not found.";
                                                exit;
                                            }

                                            // Récupérer toutes les autres locations pour le formulaire déroulant
                                            $query = "SELECT location_id, location_name FROM Locations WHERE location_id != :departure_id";
                                            $stmt = $base->prepare($query);
                                            $stmt->bindParam(':departure_id', $departure_id, PDO::PARAM_INT);
                                            $stmt->execute();
                                            $arrival_locations = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        ?>

                                        <-!-- <form class="rental-form" action="planeBooking.php" method="POST">
                                            <input type="hidden" name="plane_id" value="<?= $plane_id ?>">
                                            <div class="flex justify-between">
                                                <div class="mb-4 w-full">
                                                    <input type="hidden" name="plane_id" value="<?= $plane['rental_id'] ?>">
                                                    <label for="departure_location" class="text-gray-700">Departure Location:</label>
                                                    <input type="hidden" name="departure_location" value="<?= $departure_location['location_id'] ?>" class="form-input w-full border-gray-300 rounded-lg" readonly>
                                                </div>
                                                <div class="mb-4 w-full">
                                                    <label for="arrival_location" class="text-gray-700">Arrival Location:</label>
                                                    <select name="arrival_location" class="form-input w-full border-gray-300 rounded-lg" required>
                                                    //<?php foreach ($arrival_locations as $location): ?>
                                                        <option value="<?= $location['location_id'] ?>"><?= $location['location_name'] ?></option>
                                                    <?php endforeach; ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="flex justify-between">
                                                <div class="mb-4 w-1/2 pr-2">
                                                    <label for="rental_date" class="text-gray-700">Date:</label>
                                                    <input type="date" name="rental_date" class="form-input w-full border-gray-300 rounded-lg" required>
                                                </div>
                                                <div class="mb-4 w-1/2 pl-2">
                                                    <label for="rental_time" class="text-gray-700">Time:</label>
                                                    <input type="time" name="rental_time" class="form-input w-full border-gray-300 rounded-lg" required>
                                                    </div>
                                            </div>
                                            <div>
                                                <button type="submit" class="bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-600">Book This Plane Now</button>
                                            </div>
                                        </form> -!->
                                        <form class="rental-form" action="planeBooking.php" method="POST">
                                            <-!-- ID de l'avion -!->
                                            <input type="hidden" name="plane_id" value="<?= $plane['rental_id'] ?>">

                                            <div class="flex justify-between">
                                                <-!-- Lieu de départ -!->
                                                <div class="mb-4 w-full">
                                                    <label for="departure_location" class="text-gray-700">Departure Location:</label>
                                                    <input type="text" name="departure_location"
                                                        value="<?= $plane['location_name'] ?>"
                                                        class="form-input w-full border-gray-300 rounded-lg"
                                                        readonly>
                                                </div>

                                                <-!-- Lieu d'arrivée -!->
                                                <div class="mb-4 w-full">
                                                    <label for="arrival_location" class="text-gray-700">Arrival Location:</label>
                                                    <select name="arrival_location" class="form-input w-full border-gray-300 rounded-lg" required>
                                                        <-!-- Liste des lieux d'arrivée, à l'exception du lieu de départ -!->
                                                        <?php foreach ($arrival_locations as $location): ?>
                                                            <option value="<?= $location['location_id'] ?>"><?= $location['location_name'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            - Date et Heure de la location !
                                            <div class="flex justify-between">
                                                <div class="mb-4 w-1/2 pr-2">
                                                    <label for="rental_date" class="text-gray-700">Date:</label>
                                                    <input type="date" name="rental_date"
                                                        class="form-input w-full border-gray-300 rounded-lg"
                                                        required>
                                                </div>
                                                <div class="mb-4 w-1/2 pl-2">
                                                    <label for="rental_time" class="text-gray-700">Time:</label>
                                                    <input type="time" name="rental_time"
                                                        class="form-input w-full border-gray-300 rounded-lg"
                                                        required>
                                                </div>
                                            </div>

                                            <-!-- Bouton de soumission -!->
                                            <div>
                                                <button type="submit" class="bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-600">
                                                    Book This Plane Now
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </section> -->
                                <section class="bg-white py-12">
                                    <div class="container mx-auto px-6" style="max-width: 600px; margin-top: 75px;">
                                        <?php
                                            // Récupérer l'avion et ses détails
                                            include 'Base.php';
                                            global $base;

                                            $plane_id = $_GET['plane_id'];
                                            $stmt = $base->prepare("SELECT * FROM Rental_planes WHERE rental_id = :plane_id");
                                            $stmt->bindParam(':plane_id', $plane_id, PDO::PARAM_INT);
                                            $stmt->execute();
                                            $plane = $stmt->fetch(PDO::FETCH_ASSOC);

                                            if (!$plane) {
                                                echo "Plane not found.";
                                                exit;
                                            }

                                            // Récupérer l'emplacement de départ associé à l'avion
                                            $departure_id = $plane['base_location'];
                                            $stmt = $base->prepare("SELECT * FROM Locations WHERE location_id = :departure_id");
                                            $stmt->bindParam(':departure_id', $departure_id, PDO::PARAM_INT);
                                            $stmt->execute();
                                            $departure_location = $stmt->fetch(PDO::FETCH_ASSOC);

                                            if (!$departure_location) {
                                                echo "Departure location not found.";
                                                exit;
                                            }

                                            // Récupérer toutes les autres locations pour le formulaire déroulant
                                            $stmt = $base->prepare("SELECT location_id, location_name FROM Locations WHERE location_id != :departure_id");
                                            $stmt->bindParam(':departure_id', $departure_id, PDO::PARAM_INT);
                                            $stmt->execute();
                                            $arrival_locations = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        ?>

                                        <form class="rental-form" action="planeBooking.php" method="POST" style="color: black">
                                            <input type="hidden" name="plane_id" value="<?= $plane['rental_id'] ?>">

                                            <div class="flex justify-between">
                                                <!-- Lieu de départ -->
                                                <div class="mb-4 w-full">
                                                    <label for="departure_location" class="text-gray-700">Departure Location:</label>
                                                    <input type="text" name="departure_location"
                                                        value="<?= $departure_location['location_name'] ?>"
                                                        class="form-input w-full border-gray-300 rounded-lg"
                                                        readonly>
                                                </div>

                                                <!-- Lieu d'arrivée -->
                                                <div class="mb-4 w-full">
                                                    <label for="arrival_location" class="text-gray-700">Arrival Location:</label>
                                                    <select name="arrival_location" class="form-input w-full border-gray-300 rounded-lg" required>
                                                        <!-- Liste des lieux d'arrivée, à l'exception du lieu de départ -->
                                                        <?php foreach ($arrival_locations as $location): ?>
                                                            <option value="<?= $location['location_id'] ?>"><?= $location['location_name'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Date et Heure de la location -->
                                            <div class="flex justify-between">
                                                <div class="mb-4 w-1/2 pr-2">
                                                    <label for="rental_date" class="text-gray-700">Date:</label>
                                                    <input type="date" name="rental_date"
                                                        class="form-input w-full border-gray-300 rounded-lg"
                                                        required>
                                                </div>
                                                <div class="mb-4 w-1/2 pl-2">
                                                    <label for="rental_time" class="text-gray-700">Time:</label>
                                                    <input type="time" name="rental_time"
                                                        class="form-input w-full border-gray-300 rounded-lg"
                                                        required>
                                                </div>
                                            </div>

                                            <!-- Bouton de soumission -->
                                            <?php
                                                if(isset($_SESSION['user_id'])){
                                                    echo "                                            <div>
                                                    <button type=\"submit\" class=\"bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-600\">
                                                        Book This Plane Now
                                                    </button>
                                                </div>";

                                                }else {
                                                    echo "<h3>Sorry, you need to log in to proceed with the airplane reservation</h3>";

                                                }
                                            ?>
                                        </form>

                                    </div>
                                </section>

                            </div>

                        </div>
                    </div>
                </div>

            </section>



            <footer class="footer">
                <div class="footer-content">
                    <div class="footer-section about">
                    <img src="../image/aircraft-removebg-preview.png" alt="Aircraft Image">
                    <p>With STAFFS_AIRWAYS, you can easily book any ticket you need to travel safely thanks to our detailed system of searching and booking airline tickets.</p>
                    <div class="contact">
                        <span><i class="fas fa-phone"></i> +33 234 567 890</span>
                        <span><i class="fas fa-envelope"></i> sttaffsairways@gmail.com</span>
                    </div>
                    </div>
                    <div class="footer-section links">
                    <h2>Quick Links</h2>
                    <ul>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="aboutUs.php">About</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                    </div>
                    <div class="footer-section contact-form">
                    <h2>Contact Us</h2>
                    <form action="#">
                        <input type="email" name="email" class="text-input contact-input" placeholder="Your email address">
                        <textarea name="message" class="text-input contact-input" placeholder="Your message"></textarea>
                        <button type="submit" class="btn contact-btn">
                        <i class="fas fa-envelope"></i>
                        Send Message
                        </button>
                    </form>
                    </div>
                </div>
                <div class="footer-bottom">
                    &copy; 2024 Airline Management System | Designed by Nesrine - Caleb - Walid - Ulrich - Walker
                </div>
            </footer>

            <style>
                .bg-gray-100 {
                    background: linear-gradient(to bottom,#d0d1d1, #001d3d ) ;
                }

                .text-gray-800 {
                color: #2d3748;
                }

                .text-gray-700 {
                color: #4a5568;
                }

                .text-gray-600 {
                color: #718096;
                }

                .text-primary-500 {
                color: #ffc300;
                }

                .bg-primary-500 {
                background-color: #ffc300;
                align-items: center;
                justify-content: center;
                }

                .hover\:bg-primary-600:hover {
                background-color: #ffa700;
                }

                .form-input {
                padding: 0.5rem 1rem;
                border: 1px solid #cbd5e0;
                border-radius: 0.5rem;
                }

                .form-input:focus {
                border-color: #3182ce;
                }

                .rounded-lg {
                border-radius: 1rem;
                }

                .shadow-lg {
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
                }
                /* .container {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    max-width: 1200px;
                    margin: 0 auto;
                    padding: 0 20px;
                } */
                .rental-form {
                    width: 100%;
                    padding: 35px;
                    background-color: #001d3d;
                    border-radius: 10px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    color: #ccc;
                    font-size: 16px;
                }
                .rental-form .mb-4 {
                    flex: 1;
                    margin-right: 15px;
                }
                .rental-form .mb-4:last-child {
                    margin-right: 0;
                }
                body{
                    position: absolute ;
                }
                .statistics {
                    display: flex;
                    justify-content: space-around;
                    padding: 50px 0; /* Ajuster le padding selon vos préférences */
                    background-image: url('../Img/jet.jpg'); /* Ajouter votre image de fond */
                    background-size: cover; /* Redimensionne l'image pour couvrir toute la section */
                    background-position: center; /* Centre l'image de fond */
                }

                .statistic {
                    text-align: center;
                }
                .vertical-line {
                    border-left: 2px solid black;  /* Créer une bordure verticale */
                    height: 100%;  /* La bordure occupe toute la hauteur */
                    width: 1px;
                    background-color: #4a5568;
                    margin-top: 30px;
                    margin-right: 10px;
                }
                .lotdinf {
                    flex: 1;
                    padding: 10px;
                }
                .flex{
                    font-size: 15px;
                }
                input{
                    background-color: transparent;
                }
                .footer {
                background-color: transparent;
                color: #ccc; /* Changer la couleur du texte en #ccc */
                padding: 50px 0;
                text-align: left; /* Aligner le texte à gauche */
                }

                .footer-content {
                display: flex;
                justify-content: space-between;
                max-width: 1000px;
                margin: 0 auto;
                padding: 0 20px; /* Ajout de marges à droite et à gauche */
                }


                .footer-section {
                flex: 1;
                }

                .footer-section.about {
                max-width: 300px;
                }

                .footer-section.about img {
                width: 100px;
                margin-bottom: 20px;
                }

                .footer-section h2 {
                font-size: 20px;
                margin-bottom: 15px;
                }

                .footer-section p {
                font-size: 14px;
                line-height: 1.6;
                }

            </style>


        </main>



    </body>

</html>
