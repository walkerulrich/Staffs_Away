<?php
    session_start();
    include 'Base.php';
    global $base;

    // Retrieve form data from previous page
    $departure = $_POST['departure_location'];
    $arrival = $_POST['arrival_location'];
    $datetime = $_POST['rental_date_time'];
    $passengers = $_POST['passengers'];



    // Obtenir l'ID de l'emplacement de départ à partir de son nom
    $stmt = $base->prepare("SELECT location_id FROM Locations WHERE location_name = :departure");
    $stmt->bindParam(':departure', $departure);
    $stmt->execute();
    $departure_location_id = $stmt->fetch(PDO::FETCH_ASSOC);



    // echo "---------$departure---------";
    //          echo "---------$arrival---------";

    //          echo "---------$passengers---------";


    if (!$departure_location_id) {
        echo "Erreur : Emplacement de départ non trouvé.";
        exit;
    }else{
        foreach ( $departure_location_id as $loc ) {

                //  $plane = $allPlanes[$i];

            //echo "$loc";
            // Fetch all planes based on the departure location
            $query = "SELECT * FROM Rental_planes WHERE base_location = :loc";
            $stmt = $base->prepare($query);
            $stmt->bindParam(':loc', $loc);
            $stmt->execute();
            $allPlanes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!$allPlanes) {
                echo "Erreur : Plane not Found";
                exit;
            }
        }
    }



    $date = new DateTime($datetime);
    $date_format = $date->format('d/m/Y');
    $time_format = $date->format('H:i');
    // echo $date_format
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Staffs_Airways - Aircraft</title>
        <link rel="stylesheet" href="../css/tailwind.css">
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

    <main>
        <section class="Infos" style="width: 100%; justify-content: center; align-items: center;t">
            <div class="booking120" style="margin-bottom:0">


                <div  style="display: flex; width: 100%; justify-content: center">

                    <div class="w-full " style="; width: 70%;">

                        <div tyle="flex">
                            <h2 class="font-bold">Booking Confirmation</h2>
                        </div>

                        <div class="lotdinf" style="font-size: 12px; margin-bottom: 50px; margin-top: 100px">

                            <div class="text-lg" style="margin: 20px">
                                <b>From: </b> <?= $departure ?>
                            </div>
                            <div class="text-lg" style="margin: 20px">
                                <b>To: </b> <?= $arrival ?>
                            </div>
                            <div class="text-lg" style="margin: 20px">
                                <b>On: </b><?= $date_format ?>
                            </div>
                            <div class="text-lg" style="margin: 20px">
                                <b>At: </b><?= $time_format ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section class="bg-gray-50 py-24">
            <section class="bg-gray-50 py-24">
                <div class="container mx-auto px-4">
                    <div class="-mx-3 flex flex-wrap justify-center mb-12" id="plane-container">
                        <?php
                            // Display planes
                            foreach ($allPlanes as $plane) {
                                echo "
                                <div class='p-3 w-full' style='display:flex'> <!-- Parent container for the plane item -->
                                <div class='half-size border  mx-auto max-w-xl'> <!-- Set a smaller maximum width -->
                                    <a class='imgclass' href='plane_detail2_0.php?plane_id={$plane['rental_id']}&arrival={$arrival}&date={$datetime}&passengers={$passengers}' action='searchresult.php' method='post'>
                                        <!-- Reduce the image size by setting the class to adjust width -->
                                        <input type='hidden' name='arrival_location' value='<?= {$arrival} ?>'>
                                        <img class='imgclass' src='{$plane['image_path']}' alt='Plane'  />
                                    </a>

                                    <div class='p-6'>
                                        <h4 class='font-bold mb-2 text-gray-900 text-xl'>
                                            <a href='plane_detail2_0.php?plane_id={$plane['rental_id']}&arrival={$arrival}&date={$datetime}&passengers={$passengers}' class='hover:text-gray-500'>
                                                {$plane['model']}
                                            </a>
                                        </h4>
                                        <p class='mb-2 text-sm' style='font-size: 20px; margin-top:20px'>{$plane['description']}</p>
                                        <hr class='border-gray-200 my-4' />
                                        <div class='detailclass' style='margin-top: 60px'>
                                            <div class='flex items-center space-x-2' style='margin-top:30px'>
                                                <img src='../Img_logo/icon_rating.svg' alt='Rating Icon' width='24' height='24' />
                                                <p class='text-gray-600 mb-1'>
                                                    <b>Rating</b>: <p style='color: black'>{$plane['rating']}</p>
                                                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor' width='1.125em' height='1.125em' class='text-primary-500'>
                                                        <g>
                                                            <path d='M12 18.26l-7.053 3.948 1.575-7.928L.587 8.792l8.027-.952L12 .5l3.386 7.34 8.027.952-5.935 5.488 1.575 7.928z'></path>
                                                        </g>
                                                    </svg>
                                                </p>
                                            </div>

                                            <div class='flex items-center space-x-2' style='margin-top:30px'>
                                                <img src='../Img_logo/icon_price.png' alt='Price Icon' width='24' height='24' />
                                                <p class='text-gray-600 mb-1'>
                                                    <b>Price</b>: <p style='color: black;'> £{$plane['rental_price_per_hour']}</p>
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                                ";
                            }
                        ?>
                    </div>
                </div>
            </section>

            <section class="about-us">
                <div class="about">
                    <div class="image-container">
                        <img src="../Img/about.jpeg" alt="About Us Image">
                    </div>
                    <div class="content" style="margin-left: 50px">
                    <input type="hidden">
                        <h2>About Us</h2>
                        <h1>Making Your Dreams Come True</h1>
                        <p>Staffs Airways offers a unique and memorable travel experience, committed to service excellence, passenger comfort, and environmental sustainability. Our private jet charter services cater to discerning clients, providing luxurious and convenient travel options for business or special occasions.</p>
                        <a href="../php/aboutUs.php"><button>Discover More</button></a>
                    </div>
                </div>
            </section>
            <section class="services">
                <h2>SERVICES</h2>
                <h3>What We Offer</h3>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>

                <div class="services-grid">
                    <div class="service">
                        <img src="../Img_logo/luxury.png" alt="Luxury and Comfort">
                        <h3>Luxury Travel</h3>
                        <p>Experience the pinnacle of luxury and comfort with our airline, where every journey is an exquisite and pleasurable experience, meticulously crafted to exceed your expectations.</p>
                    </div>

                    <div class="service">
                        <img src="../Img_logo/work-schedule.png" alt="Save and Secure">
                        <h3>Flexible Schedule</h3>
                        <p>Travel at your own pace with our airline, offering our customers the freedom to choose a flexible schedule that fits their needs.</p>
                    </div>

                    <div class="service">
                        <img src="../Img_logo/low-price.png" alt="All Over The World">
                        <h3>Affordable Cost</h3>
                        <p>Traveling affordably is our promise. Enjoy the opportunity to explore the world with our airline without breaking the bank</p>
                    </div>
                    <div class="service">
                        <img src="../Img_logo/seater-sofa.png" alt="Luxury and Comfort">
                        <h3>Comfort Travel</h3>
                        <p>"Our airline offers our customers the opportunity to travel with comfort and ease, ensuring a seamless journey from takeoff to touchdown."</p>
                    </div>

                    <div class="service">
                        <img src="../Img_logo/delivery.png" alt="Save and Secure">
                        <h3>Easy Transport</h3>
                        <p>"Experience hassle-free travel with Easy Transport, where our airline provides customers with the opportunity to journey effortlessly and comfortably."</p>
                    </div>

                    <div class="service">
                        <img src="../Img_logo/fast-service.png" alt="All Over The World">
                        <h3>Fast Service</h3>
                        <p>"Experience swift and efficient service with our airline, where your time is valued and every aspect of your journey is handled promptly and seamlessly."</p>
                    </div>
                </div>
            </section>


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
            .half-size {
                width: 100%; /* Reduce image size by half */
                height: auto; /* Maintain aspect ratio */
                display: block;
                /*margin: auto; /* Center the image */
                border-radius: 45px; /* Add border radius for a smooth look */
                display: flex;
                background: linear-gradient(to right, transparent, #DEE2E6);
                border: none;
            }
            .p-3{
                /*display: flex;
                /*width: 105%; /* Reduce image size by half *-/
                height: 55%; /* Maintain aspect ratio */
                margin-left: 170px;
                margin-right: 170px;
                /* padding-top: 75px;
                padding-bottom: 75px; */
                background-color: transparent;
                /* border-color: #ccc; */
                /* border-width: 5px;*/
                border-radius: 60px;
                margin-top: 70px;
                background: linear-gradient(to right, rgb(59, 59, 59), #DEE2E6)
            }
            .detailclass{
                height: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 20px;
                margin-right: 20px;
            }
            .flex{
                margin-left: 10px;
                margin-right: 10px;
            }
            .imgclass{
                width: 200%; /* Reduce image size by half */
                height: auto; /* Maintain aspect ratio */
                display: block;
                /*margin: auto; /* Center the image */
                border-radius: 45px; /* Add border radius for a smooth look */
                display: flex;
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
            .font-bold{
                font-size: 30px;
            }
            #plane-see-less,
            #plane-see-more{
                border-radius: 10px;
                padding: 10px;
            }

            .booking120{
                flex: 1;
                padding: 10px;
            }
            .booking1{
                justify-content: center;
                align-items: center;
            }

            .booking-form, .rental-form {
                display: none;
            }

            .booking-form.show, .rental-form.show {
                display: block;
            }

            .booking-form, .rental-form {
                width: 100%;
                padding: 20px;
                background-color: #001d3d;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                color: #ccc;
            }

            .booking-form h2, .rental-form h2 {
                color: #ccc;
                margin-bottom: 20px;
            }

            .booking-form label, .rental-form label {
                font-weight: bold;
                margin-bottom: 5px;
                color: #CCC;
            }

            .booking-form input[type="text"], .booking-form input[type="datetime-local"], .booking-form input[type="number"], .booking-form select, .rental-form input[type="text"], .rental-form input[type="datetime-local"], .rental-form input[type="number"], .rental-form select {
                width: 100%;
                padding: 10px;
                margin-bottom: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
                box-sizing: border-box;
                background-color: #ccc;
                color: #000000;
            }

            .booking-form input[type="checkbox"], .rental-form input[type="checkbox"] {
                margin-right: 5px;
                appearance: none;
            }

            .booking-form input[type="checkbox"]::before, .rental-form input[type="checkbox"]::before {
                content: "";
                display: inline-block;
                width: 18px;
                height: 18px;
                border: 2px solid #ccc;
                border-radius: 3px;
                background-color: #001d3d;
            }

            .booking-form input[type="checkbox"]:checked::before, .rental-form input[type="checkbox"]:checked::before {
                content: "\2713";
                font-size: 14px;
                color: #fff;
                text-align: center;
                line-height: 18px;
            }

            .booking-form button, .rental-form button {
                width: 100%;
                padding: 10px;
                background-color: #ffc300;
                color: #001d3d;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .booking-form button:hover, .rental-form button:hover {
                background-color: #987608;
            }

            .booking-form .row, .rental-form .row {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 15px;
            }

            .booking-form .col, .rental-form .col {
                flex: 1;
                margin-right: 15px;
            }

            .booking-form .col:last-child, .rental-form .col:last-child {
                margin-right: 0;
            }

            .booking-form select#class, .rental-form select#class {
                background-color: #ccc;
                color: #000000;
                border: 1px solid #ccc;
            }
            .content {

                /* width: calc(100% - 400px); Pour laisser de l'espace au formulaire */
            }
            .body{
                background-color: #caced5;
            }
            .about-us {
                background-color: #f5f5f5;
                padding: 50px 0;
                text-align: center;
                background-color: #d0d1d1;
                background: linear-gradient(to bottom, transparent, #ccc,#d0d1d1);
            }

            .about-us .about {
                display: flex;
                align-items: center;
                justify-content: space-between;
                max-width: 1200px;
                margin: 0 auto;
            }

            .about-us .left-content {
                width: 50%;
            }

            .about-us .right-content {
                width: 50%;
                text-align: left; /* Aligner le contenu du côté droit à gauche */
            }

            .about-us h2 {
                font-size: 1.8rem;
                color: #FFC300;
                text-align: left;
                margin-bottom: 10px;
            }

            .about-us h1 {
                font-size: 3rem;
                color: #001d3d;
                text-align: left;
                font-weight: bold;
                margin-bottom: 20px;
            }

            .about-us p {
                font-size: 1.2rem;
                text-align: left;
                margin-bottom: 20px;
            }

            .about-us button {
                padding: 14px 28px;
                font-size: 1.1rem;
                background-color: #ffc300;
                color: #001d3d;
                border: none;
                border-radius: 25px;
                cursor: pointer;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                transition: background-color 0.3s, transform 0.2s;
            }

            .about-us button:hover {
                background-color: #FFC300;
                transform: translateY(-2px);
            }
            .footer {
            background-color: #001d3d;
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

            .contact span {
            display: block;
            margin-bottom: 10px;
            }

            .links {
            text-align: center; /* Centrer les liens */
            }

            .links ul {
            list-style: none;
            padding: 0;
            margin: 0;
            }

            .links li {
            margin-bottom: 10px;
            }

            .links a {
            color: #ccc; /* Changer la couleur des liens en #ccc */
            }

            .contact-form input,
            .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #fff;
            border-radius: 5px;
            background-color: transparent;
            color: #ccc; /* Changer la couleur du texte en #ccc */
            }

            .contact-form button {
            width: 100%;
            padding: 12px 0;
            border: none;
            border-radius: 5px;
            background-color: #FFC300;
            color: #001d3d;
            font-size: 16px;
            cursor: pointer;
            }

            .footer-bottom {
            text-align: center;
            padding: 20px 0;
            font-size: 14px;
            }

            .footer-bottom::before {
            content: '';
            display: block;
            margin: 10px auto;
            width: 50%;
            height: 1px;
            background-color: #fff;
            margin-bottom: 20px; /* Ajout de marge en bas */
            }
            /* Ajouter ces règles de style à la fin de votre fichier CSS */

            @media screen and (max-width: 768px) {
            .footer-content {
                flex-direction: column;
                align-items: center;
            }

            .footer-section {
                margin-bottom: 30px;
                text-align: center;
            }

            .footer-section.about {
                max-width: none;
            }

            .footer-section h2 {
                font-size: 18px;
            }

            .footer-section.about img {
                width: 80px;
            }
            }

            @media screen and (max-width: 576px) {
            .footer-section h2 {
                font-size: 16px;
            }

            .footer-section p {
                font-size: 12px;
            }

            .footer-section.about img {
                width: 60px;
            }

            .footer-bottom::before {
                width: 30%;
            }
            }

        .lotdinf {
            flex: 1;
            padding: 10px;
            display: flex;
        }
        .text-lg{

            font-size: 20px;
            /* background-color: #ccc; */
            padding: 10px;
            border-radius: 7px;
            /* margin: -10px; */
            background: linear-gradient(to bottom, #CCC, transparent);
        }
        .Infos{
            background: linear-gradient(to top, rgb(244, 245, 246 ), #001d3d);
            padding-bottom: 50px;
        }
        </style>
        <!-- END of ADDITION !!!!?????-->

    </main>

    </body>

</html>
