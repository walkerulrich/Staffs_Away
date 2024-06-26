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
        $departure_location_name = $_POST['arrival_location'];
        $rental_date = $_POST['rental_date'];
        $rental_time = $_POST['rental_time'];
        $total_price = $_POST['total_price'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];

        // echo" $rental_time";




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



        // ID de l'emplacement d'arrivée (déjà connu)
        $arrival_location_name = $_POST['arrival_location'];

         // Obtenir l'ID de l'emplacement de départ à partir de son nom
         $stmt = $base->prepare("SELECT location_id FROM Locations WHERE location_name = :departure_location_name");
         $stmt->bindParam(':departure_location_name', $arrival_location_name);
         $stmt->execute();
         $arrival_location_row = $stmt->fetch(PDO::FETCH_ASSOC);

         // Vérifier si l'emplacement de départ a été trouvé
         if (!$arrival_location_row) {
             echo "Erreur : Emplacement de départ non trouvé.";
             exit;
         }

        $arrival_location_id = $arrival_location_row['location_id'];

        // Obtenez les détails de l'emplacement d'arrivée
        $stmt = $base->prepare("SELECT * FROM Locations WHERE location_id = :arrival_location_id");
        $stmt->bindParam(':arrival_location_id', $arrival_location_id);
        $stmt->execute();
        $arrival_location = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si les détails de l'emplacement d'arrivée ont été trouvés
        if (!$arrival_location) {
            echo "Erreur : Emplacement d'arrivée non trouvé.
            $arrival_location_id";
            exit;
        }


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

        // // Function to add a new user
        // function create_user($username, $email, $base) {
        //     $stmt = $base->prepare("INSERT INTO Users (username, email) VALUES (:username, :email)");
        //     $stmt->bindParam(':username', $username);
        //     $stmt->bindParam(':email', $email);
        //     $stmt->execute();

        //     return $base->lastInsertId(); // Get the new user ID
        // }

        // // Function to get the user by username and email
        // function get_user($username, $email, $base) {
        //     $stmt = $base->prepare("SELECT * FROM Users WHERE username = :username AND email = :email");
        //     $stmt->bindParam(':username', $username);
        //     $stmt->bindParam(':email', $email);
        //     $stmt->execute();

        //     return $stmt->fetch(PDO::FETCH_ASSOC);
        // }

        // Function to create a booking
        // function create_booking($plane_id, $user_id, $rental_date, $rental_time,$departure_location_id, $arrival_location_id,$total_price) {
        //     $stmt = $base->prepare("INSERT INTO Bookings (plane_id, customer_id, rental_date, rental_time, departure_location,arrival_location,total_price) VALUES (:plane_id, :user_id, :rental_date, :rental_time, :departure_location_id, :arrival_location_id, :total_price)");
        //     $stmt->bindParam(':plane_id', $plane_id);
        //     $stmt->bindParam(':user_id', $user_id);
        //     $stmt->bindParam(':rental_date', $rental_date);
        //     $stmt->bindParam(':rental_time', $rental_time);
        //     $stmt->bindParam('departure_location_id', $departure_location_id);
        //     $stmt->bindParam('arrival_location_id', $arrival_location_id);
        //     $stmt->bindParam('total_price', $total_price);
        //     $stmt->execute();

        //     return $base->lastInsertId(); // Get the new booking ID
        // }

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

        // if(isset($_POST['completepayment'])){
        //     $sql = "INSERT INTO Bookings (plane_id, customer_id, rental_date, rental_time, departure_location,arrival_location,total_price) VALUES (:plane_id, :user_id, :rental_date, :rental_time, :departure_location_id, :arrival_location_id, :total_price)";

        //     $stmt = $base->prepare($sql);
        //     $params = [$plane_id, $user_id, $rental_date, $rental_time,$departure_location_id, $arrival_location_id,$total_price];
        //     if($stmt-> execute($params)){
        //         echo"Reservation Successfull! ";
        //     }else{
        //         echo "Error: " . $base->errorInfo()[2];
        //     }
        //     header("Location: Successful.php");
        //     // return create_booking($plane_id, $user_id, $rental_date, $rental_time,$departure_location_id, $arrival_location_id,$total_price);
        // }

        // $plane_id = $_POST['plane_id'];
        // $departure_location_name = $_POST['departure_location'];
        // $departure_location_name = $_POST['arrival_location'];
        // $rental_date = $_POST['rental_date'];
        // $rental_time = $_POST['rental_time'];
        // $total_price = $_POST['total_price'];
        // $firstname = $_POST['firstname'];
        // $lastname = $_POST['lastname'];
        // $email = $_POST['email'];
        // $phonenumber = $_POST['phonenumber'];



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
    <!-- <header>
        <nav class="navbar">
            <div class="container">
              <img src="../image/aircraft-removebg-preview.png" alt="Airline Management Logo" class="logo">
              <ul class="nav-links">
                <li><a href="home.php">Search Flights</a></li>
                <li><a href="aircraft.php">Plan Rental</a></li>
                <li><a href="aboutUs.php">About Us</a></li>
                <?php
                if(isset($_SESSION['user_id'])){
                    $user_id = $_SESSION['user_id'];
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
    </header> -->

    <section class="booking" style="display: flex; width: 100%; justify-content: center; align-items: center;">
        <div class="booking20" style="margin-bottom:0">
            <div  style="display: flex;">
                <div class="px-4" style="margin-right: 30px; display: flex; margin-top: 20px; width: 50%" >
                    <img src="<?= $plane['image_path']?>" class=" " alt="<?= $plane['model'] ?>"  style=" width: 100%; border-radius: 20px" />
                </div>
                <div class="w-full " style="; width: 70%;">

                    <div tyle="flex">
                        <h2 class="font-bold">Payment Information</h2>
                    </div>


                    <div class="" style="font-size: 12px; margin-bottom: 50px; display: flex">

                        <div class="" style="margin: 1px; display: flex">  <!-- Afficher les détails de la réservation -->
                            <div class="text-lg" style="margin: 20px">
                                <b> <?= $plane['model'] ?></b>
                            </div>
                            <div class="text-lg" style="margin: 20px">
                                <b> <?= $departure_location['location_name'] ?></b>
                            </div>
                            <div class="text-lg" style="margin: 20px">
                                <b><?= $arrival_location['location_name'] ?></b>
                            </div>
                            <div class="text-lg" style="margin: 20px">
                                <b><?= $rental_time ?></b>
                            </div>

                        </div>

                        <div class="" style=" margin: 1px; display: flex">
                            <div class="text-lg" style="margin: 20px">
                                <b><?= $rental_date ?></b>
                            </div>

                            <div class="spe" style="">
                                <div class="text-lmoney" style="margin: 20px">
                                    <b> $<?= $total_price ?></b>
                                </div>

                            </div>
                        </div>

                    </div>


                    <div class="lotdinf" style="font-size: 15px; backgroud-image: black; margin-bottom: 25px">

                        <div class="payment-form" style="width: 100%; padding: 20px; border: 1px solid #ccc; border-radius: 10px;">

                            <form action="successful.php" method="POST" style="display: flex">

                                <!-- <input type="hidden" name="booking_id" value="<?= $booking_id ?>"> -->
                                <input type="hidden" name="plane_id" value="<?= $plane_id ?>">
                                <input type="hidden" name="departure_location_id" value="<?= $departure_location_id ?>">
                                <input type="hidden" name="arrival_location_id" value="<?= $arrival_location_id ?>">
                                <input type="hidden" name="rental_date" value="<?= $rental_date ?>">
                                <input type="hidden" name="customer_id" value="<?= $user_id ?>">
                                <input type="hidden" name="rental_time" value="<?= $rental_time ?>">
                                <input type="hidden" name="total_price" value="<?= $total_price ?>">
                                <input type="hidden" name="firstname" value="<?= $firstname ?>">
                                <input type="hidden" name="lastname" value="<?= $lastname ?>">
                                <input type="hidden" name="email" value="<?= $email ?>">
                                <input type="hidden" name="phonenumber" value="<?= $phonenumber ?>">
                                <input type="hidden" name="iamgepath" value="<?= $plane['image_path']?>">
                                <input type="hidden" name="iamgepath" value="<?= $plane['image_path']?>">




                                <div class="mb-4 w-full">
                                    <label for="card_number" class="text-gray-700"><b>Credit Card Number:</b></label>
                                    <input type="text" name="card_number" placeholder="1234 5678 9012 3456" class="text-lg" required>
                                </div>

                                <div class="mb-4 w-full">
                                    <label for="expiration_date" class="text-gray-700"><b>Expiration Date:</b></label>
                                    <input type="month" name="expiration_date" placeholder="MM/YY" class="text-lg" required>
                                </div>

                                <div class="mb-4 w-full">
                                    <label for="cvv" class="text-gray-700"><b>CVC:</b></label>
                                    <input type="text"  maxlength="4" size="3" name="cvv" placeholder="123" class="text-lg" required>
                                </div>

                                <button class="button00" type="submit" name="completepayment">
                                    Complete Payment
                                </button>

                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>


    </section>

    <section>

    </section>
    <footer class="footer20">
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
        .booking{
            justify-content: center;
            align-items: center;
        }
        .footer20 {
            background-color: transparent;
            color: #ccc; /* Changer la couleur du texte en #ccc */
            padding: 50px 0;
            text-align: left; /* Aligner le texte à gauche */
            margin-top: 100px;
        }
        body {
            margin: 0; /* 1 */
            line-height: inherit; /* 2 */
            background: linear-gradient(to bottom,#d0d1d1, #001d3d );
        }

    </style>

</body>
</html>
