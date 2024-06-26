<?php
    // Démarrer la session et inclure la connexion à la base de données
    session_start();
    include 'Base.php';
    global $base;

    // Vérifier si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Récupérer les valeurs du formulaire
        $plane_id = $_POST['plane_id'];
        $departure_location_name = $_POST['departure_location'];
        //$arrival_location_id = $_POST['arrival_location'];
        $rental_date = $_POST['rental_date'];
        $rental_time = $_POST['rental_time'];



        // Requête pour obtenir les détails de l'avion
        $stmt = $base->prepare("SELECT * FROM Rental_planes WHERE rental_id = :plane_id");
        $stmt->bindParam(':plane_id', $plane_id);
        $stmt->execute();
        $plane = $stmt->fetch(PDO::FETCH_ASSOC);

        // Assurez-vous que l'avion a été trouvé
        if (!$plane) {
            echo "Plane not found.";
            exit;
        }



        // Nom de l'emplacement de départ (déjà connu)
        $departure_location_name = $_POST['departure_location'];

        // Obtenir l'ID de l'emplacement de départ à partir de son nom
        $stmt = $base->prepare("SELECT location_id FROM Locations WHERE location_name = :departure_location_name");
        $stmt->bindParam(':departure_location_name', $departure_location_name);
        $stmt->execute();
        $departure_location_row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si l'emplacement de départ a été trouvé
        if (!$departure_location_row) {
            echo "Erreur : Emplacement de départ non trouvé.";
            exit;
        }

        // ID de l'emplacement de départ
        $departure_location_id = $departure_location_row['location_id'];

        // Obtenez les détails de l'emplacement de départ
        $stmt = $base->prepare("SELECT * FROM Locations WHERE location_id = :departure_location_id");
        $stmt->bindParam(':departure_location_id', $departure_location_id);
        $stmt->execute();
        $departure_location = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si les détails de l'emplacement de départ ont été trouvés
        if (!$departure_location) {
            echo "Erreur : Emplacement de départ non trouvé.";
            exit;
        }


        // Nom de l'emplacement de départ (déjà connu)
        $arrival_location_name = $_POST['arrival_location'];

        // Obtenir l'ID de l'emplacement de départ à partir de son nom
        $stmt = $base->prepare("SELECT location_id FROM Locations WHERE location_name = :arrival_location_name");
        $stmt->bindParam(':arrival_location_name', $arrival_location_name);
        $stmt->execute();
        $arrival_location_row = $stmt->fetch(PDO::FETCH_ASSOC);



        // Vérifier si l'emplacement de départ a été trouvé
        if (!$arrival_location_row) {
            echo "Erreur : Emplacement d'arrivé non trouvé---.------<-- $arrival_location_row--> -----  ";
            exit;
        }

        foreach($arrival_location_row as $arrival_location_id){
            // Obtenez les détails de l'emplacement d'arrivée
            $stmt = $base->prepare("SELECT * FROM Locations WHERE location_id = :arrival_location_id");
            $stmt->bindParam(':arrival_location_id', $arrival_location_id);
            $stmt->execute();
            $arrival_location = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifier si les détails de l'emplacement d'arrivée ont été trouvés
            if (!$arrival_location) {
                echo "Erreur : Emplacement d'arrivée non trouvé.";
                exit;
            }
        }
        //ID de l'emplacement d'arrivée (déjà connu)
        //$arrival_location_id = $_POST['arrival_location'];

        //$arrival_location_id = $arrival_location_row;




        // Vérifiez que les valeurs POST sont correctes
        if (empty($departure_location) || empty($arrival_location)) {
            echo "Error: Missing departure or arrival location.";
            exit;
        }

        $departure_latitude = $departure_location['latitude'];
        $departure_longitude = $departure_location['longitude'];
        $arrival_latitude = $arrival_location['latitude'];
        $arrival_longitude = $arrival_location['longitude'];

        // Fonction pour calculer la distance
        function haversine_distance($lat1, $lon1, $lat2, $lon2) {
            $earth_radius = 6371; // Rayon de la Terre en km
            $lat_diff = deg2rad($lat2 - $lat1);
            $lon_diff = deg2rad($lon2 - $lon1);

            $a = sin($lat_diff / 2) * sin($lat_diff / 2) +
                cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
                sin($lon_diff / 2) * sin($lon_diff / 2);

            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

            return $earth_radius * $c;
        }

        // Calculer la distance et le coût
        $distance = haversine_distance(
            $departure_latitude,
            $departure_longitude,
            $arrival_latitude,
            $arrival_longitude
        );

        $cost_per_1000km = $plane['rental_price_per_hour']; // Prix par 1000 km
        $total_price = ($distance / 500) * $cost_per_1000km;

        // Arrondir le coût total
        $total_price = round($total_price, 2);
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../image/aircraft_1-removebg-preview.png" type="image/x-icon">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="../css/home1.css">
    <script src="../js/javascript.js"></script>
</head>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="container">
              <img src="../image/aircraft-removebg-preview.png" alt="Airline Management Logo" class="logo">
              <ul class="nav-links">
                <li><a href="home.php">Search Flights</a></li>
                <li><a href="aircraft.php">Plan Rental</a></li>
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

    <section class="booking2" style="width: 100%; justify-content: center; align-items: center;">
        <div class="booking20" style="margin-bottom:0">


            <div  style="display: flex; width: 100%; justify-content: center">

                <div class="px-4" style="margin-right: 100px; margin-left: 100px; display: flex; margin-top: 20px; width: 50%" >
                    <img src="<?= $plane['image_path']?>" class=" " alt="<?= $plane['model'] ?>"  style=" width: 100%;" />
                </div>
                <div class="w-full " style="; width: 70%;">

                    <div tyle="flex">
                        <h2 class="font-bold">Booking Confirmation</h2>
                    </div>

                    <div class="lotdinf" style="font-size: 12px; backgroud-image: black; margin-bottom: 50px">

                        <div class="" style="margin: 1px">  <!-- Afficher les détails de la réservation -->
                            <div class="text-lg" style="margin: 20px">
                                <b>Model:</b> <?= $plane['model'] ?>
                            </div>
                            <div class="text-lg" style="margin: 20px">
                                <b> Date:</b> <?= $rental_date ?>
                            </div>
                            <!-- <div class="text-lg" style="margin: 20px">
                                <b>To: </b> <?= $arrival_location['location_name'] ?>
                            </div> -->
                        </div>

                        <div class="" style=" margin: 1px">
                            <div class="text-lg" style="margin: 20px">
                                <b>From: </b> <?= $departure_location['location_name'] ?>
                            </div>
                            <div class="text-lg" style="margin: 20px">
                                <b>Time:</b> <?= $rental_time ?>
                            </div>
                            <!-- <div class="text-lg" style="margin: 20px">
                                <b>Price: </b> $<?= $total_price ?>
                            </div> -->
                        </div>

                        <div class="" style=" margin: 1px">
                            <div class="text-lg" style="margin: 20px">
                                <b>To: </b> <?= $arrival_location['location_name'] ?>
                            </div>
                            <div class="text-lg" style="margin: 20px">
                                <b>Price: </b> $<?= $total_price ?>
                            </div>
                            <!-- <div class="text-lg" style="margin: 20px">
                                <b>Price: </b> $<?= $total_price ?>
                            </div> -->
                        <div>

                    </div>
            </div>


        </div>
    </section>



    <section class="booking1"  style="display: flex">

      <div>
          <b>
              <h3>
                  Complete :
              </h3>
          </b>
      </div>

  </div>


        <div>
            <form class="" action="paiement.php" method="POST" >
                <!-- ID de l'avion -->
                <input type="hidden" name="plane_id" value="<?= $plane['rental_id'] ?>">
                <input type="hidden" name="departure_location" value="<?= $departure_location['location_name'] ?>">
                <input type="hidden" name="arrival_location" value="<?= $arrival_location['location_name'] ?>">
                <input type="hidden" name="rental_date" value="<?= $rental_date ?>">
                <input type="hidden" name="total_price" value="<?= $total_price ?>">
                <input type="hidden" name="rental_time" value="<?= $rental_time ?>">


                <div style="gap:10px">
                    <!-- Nom d'utilisateur -->
                    <div style="display: flex;">
                        <div class="">
                            <input type="text" name="firstname" placeholder="First Name" class="text-lg" required>
                        </div>

                        <div class="">
                            <input type="text" name="lastname" placeholder="Last Name" class="text-lg" required>
                        </div>
                        <!-- E-mail -->
                        <div class="">
                            <input type="email" name="email" placeholder="Your Email" class="text-lg" required>
                        </div>
                        <div class="">
                            <input type="tel" name="phonenumber" placeholder="Your Phone Number" class="text-lg" required>
                        </div>

                        <div style="margin-left: 50px">
                            <button class="button00" type="submit" class="">
                                Confirm Booking
                            </button>
                        </div>

                    </div>



                </div>
            </form>
        </div>

    </section>

    <!-- <section class="special">
        <p>
            <br></br>
            <br></br>

        </p>
    </section> -->

    <footer class="footer20" style>
        <div class="footer-bottom">
            <!-- &copy; 2024 Airline Management System | Designed by Nesrine - Caleb - Walid - Ulrich - Walker -->
        </div>
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
        .text-lg{
            background-color: #ccc;
            padding: 20px;
            border-radius: 7px;
            margin: 10px;
        }
        .vertical-line {
            border-left: 2px solid black;  /* Créer une bordure verticale */
            height: 100%;  /* La bordure occupe toute la hauteur */
            width: 10px;
            background-color: #4a5568;
            margin-top: 30px;
            margin-right: 10px;
        }
        .lotdinf {
            flex: 1;
            padding: 10px;
            display: flex;
        }
        .booking20{
            flex: 1;
            padding: 10px;
        }
        .booking1{
            justify-content: center;
            align-items: center;
        }
        body {
            margin: 0; /* 1 */
            line-height: inherit; /* 2 */
            background: linear-gradient(to bottom,#d0d1d1, #001d3d ) ;
        }
        .special{
            background: linear-gradient(to bottom,#d0d1d1, #001d3d ) ;
        }
        .footer20 {
            background-color: transparent;
            color: #ccc; /* Changer la couleur du texte en #ccc */
            padding: 50px 0;
            text-align: left; /* Aligner le texte à gauche */
            margin-top: 100px;
        }
    </style>

</body>
</html>
