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

    <section class="bg-secondary-500 poster relative text-gray-300" style="margin-bottom: -50px; padding-bottom: -30px">
        <div class="container mx-auto pb-24 pt-72 px-4" style="display: flex; margin-top: -70px">
            <div class="-mx-4 flex flex-wrap items-center space-y-6 lg:space-y-0" style="margin-left:100px;">
                <div class="content" style="padding: 0 50px; margin-top: 50px; width: 100%">
                    <div class="px-4 w-full md:w-9/12 xl:w-7/12 2xl:w-6/12" style="">
                        <p class="font-bold font-sans mb-1 text-2xl text-white">The</p>
                        <h1 class="font-bold mb-6 text-5xl text-white md:leading-tight lg:leading-tight lg:text-6xl">
                            <span class="text-primary-500">Perfect Plane</span> for <span class="text-primary-500">Your Journey</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="form-container">
                <div class="booking-form show" id="rental-plane-form" style="width: 80%; margin-right:-100px; margin-left: 70px">
                    <h2>Rent a Plane</h2>
                    <form action="searchresult.php" method="post">
                        <!-- Champs de sélection pour le départ -->
                        <div class="row">
                            <div class="col">
                                <label for="departure_location">Departure</label>
                                <select id="departure_location" name="departure_location">
                                    <option value="Paris - Charles de Gaulle">Paris - Charles de Gaulle</option>
                                    <option value="Londres - Heathrow">Londres - Heathrow</option>
                                    <option value="New York - JFK">New York - JFK</option>
                                    <option value="Los Angeles - LAX">Los Angeles - LAX</option>
                                    <option value="Tokyo - Haneda">Tokyo - Haneda</option>
                                </select>
                            </div>

                            <!-- Champ de saisie avec autocomplétion pour l'arrivée -->
                            <div class="col">
                                <label for="arrival_location">Arrival</label>
                                <!-- <input list="arrival_suggestions" id="arrival_location" name="arrival_location" placeholder="Enter arrival location" required /> -->
                                <select id="arrival_location" name="arrival_location">
                                    <option value="Paris - Charles de Gaulle">Paris - Charles de Gaulle</option>
                                    <option value="Londres - Heathrow">Londres - Heathrow</option>
                                    <option value="New York - JFK">New York - JFK</option>
                                    <option value="Los Angeles - LAX">Los Angeles - LAX</option>
                                    <option value="Tokyo - Haneda">Tokyo - Haneda</option>
                                    <option value="Madrid - MAD">Madrid - Barajas</option>
                                    <option value="Sydney - Kingsford Smith">Sydney - Kingsford Smith</option>
                                    <option value="Toronto - YYZ">Toronto - Pearson</option>
                                    <option value="Hong Kong - HKG">Hong Kong - Chek Lap Kok</option>
                                    <option value="San Francisco - SFO">San Francisco - SFO</option>
                                    <option value="Dubai - DXB">Dubai - DXB</option>
                                    <option value="Singapore - SIN">Singapore - Changi</option>
                                    <option value="Amsterdam - Schiphol">Amsterdam - Schiphol</option>
                                    <option value="Frankfurt - FRA">Frankfurt - FRA</option>
                                    <option value="Barcelona - BCN">Barcelona - BCN</option>
                                </select>
                            </div>
                        </div>

                        <!-- Autres champs du formulaire -->
                        <div class="row">
                            <div class="col">
                                <label for="rental_date_time">Date & Time</label>
                                <input type="datetime-local" id="rental_date_time" name="rental_date_time" required />
                            </div>
                            <div class="col">
                                <label for="passengers">Passengers</label>
                                <input type="number" id="passengers" name="passengers" min="1" value="1" />
                            </div>
                        </div>

                        <!-- Bouton de réservation -->
                        <button type="submit">Book Now</button>
                    </form>

                </div>
            </div>
        </div>
    </section>
        <!-- Introductory Section -->


        <!---Plane presentations-->
        <?php
            // Fetch the initial set of planes (first 6)
            $initialCount = 6; // Initial count of planes
            $query = "SELECT * FROM Rental_planes LIMIT $initialCount"; // Fetch the first 6 planes
            $stmt = $base->prepare($query);
            $stmt->execute();
            $initialPlanes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Fetch all planes for "See More"
            $query = "SELECT * FROM Rental_planes"; // Fetch all planes
            $stmt = $base->prepare($query);
            $stmt->execute();
            $allPlanes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <section class="bg-gray-50 py-24">
            <div class="container mx-auto px-4">
                <div class="-mx-4 flex flex-wrap items-center mb-6">
                    <div class="px-4 w-full md:flex-1">
                        <h2 class="font-medium mb-1 text-primary-500 text-xl">Our Aircraft</h2>
                        <h3 class="capitalize font-bold mb-4 text-4xl text-gray-900">Planes for All Your Needs</h3>
                        <div class="bg-primary-500 mb-6 pb-1 w-2/12"></div>
                        <p class="text-gray-600">
                           <i><b>Explore our fleet of modern planes available for rental. Whether you're planning a business trip or a leisurely getaway, we have the perfect aircraft for you.</b></i>
                        </p>
                    </div>
                </div>

                <div class="-mx-3 flex flex-wrap justify-center mb-12" id="plane-container">
                    <?php
                        // Display initial planes (first 6)
                        for ($i = 0; $i < 6; $i++) {
                            if ($i >= count($allPlanes)) {
                                break;
                            }

                            $plane = $allPlanes[$i];

                            echo "


                            <div class='p-3 w-full' style='display:flex'> <!-- Parent container for the plane item -->
                                <div class='half-size border  mx-auto max-w-xl'> <!-- Set a smaller maximum width -->
                                    <a class='imgclass' href='plane_detail.php?plane_id={$plane['rental_id']}' >
                                        <!-- Reduce the image size by setting the class to adjust width -->
                                        <img class='imgclass' src='{$plane['image_path']}' alt='Plane'  />
                                    </a>

                                    <div class='p-6'>
                                        <h4 class='font-bold mb-2 text-gray-900 text-xl'>
                                            <a href='plane_detail.php?plane_id={$plane['rental_id']}' class='hover:text-gray-500'>
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

                <div class="flex justify-center mt-8">
                    <button id="plane-see-more" class="bg-primary-500 hover:bg-primary-600 px-6 py-2 text-white">
                        See More
                    </button>
                    <button id="plane-see-less" class="bg-primary-500 hover:bg-primary-600 px-6 py-2 text-white" style="display: none; margin-left: 20px">
                        See Less
                    </button>
                </div>
                <div>
                    <p>
                        <br></br>
                    </p>
                </div>
            </div>
            <section class="about-us">
                <div class="about">
                    <div class="image-container">
                        <img src="../Img/about.jpeg" alt="About Us Image">
                    </div>
                    <div class="content" style="margin-left: 50px">
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

            <script>
                const allPlanes = <?php echo json_encode($allPlanes); ?>;
                let currentStartIndex = 6;
                const planesPerPage = 3;

                // Function to load additional planes
                function loadPlanes(startIndex, count) {
                    const container = document.getElementById("plane-container");

                    for (let i = startIndex; i < startIndex + count; i++) {
                        if (i >= allPlanes.length) {
                            break;
                        }

                        const plane = allPlanes[i];

                        const planeDiv = document.createElement("div");
                        planeDiv.className = "p-3 w-full";

                        planeDiv.innerHTML = `
                            <div class='half-size border  mx-auto max-w-xl'> <!-- Set a smaller maximum width -->
                                <a class='imgclass' href='plane_detail.php?plane_id=${plane['rental_id']}' >
                                    <!-- Reduce the image size by setting the class to adjust width -->
                                    <img class='imgclass' src='${plane['image_path']}' alt='Plane'  />
                                </a>

                                    <div class='p-6'>
                                    <h4 class='font-bold mb-2 text-gray-900 text-xl'>
                                        <a href='plane_detail.php?plane_id=${plane['rental_id']}' class='hover:text-gray-500'>
                                            ${plane['model']}
                                        </a>
                                    </h4>
                                    <p class='mb-2 text-sm' style='font-size: 20px; margin-top:20px'>${plane['description']}</p>
                                    <hr class='border-gray-200 my-4' />
                                    <div class='detailclass' style='margin-top: 60px'>
                                        <div class='flex items-center space-x-2' style='margin-top:30px'>
                                            <img src='../Img_logo/icon_rating.svg' alt='Rating Icon' width='24' height='24' />
                                            <p class='text-gray-600 mb-1'>
                                                <b>Rating</b>: <p style='color: black'>${plane['rating']}</p>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor' width='1.125em' height='1.125em' class='text-primary-500'>
                                                    <g>
                                                        <path d='M12 18.26l-7.053 3.948 1.575-7.928L.587 8.792l8.027-.952L12 .5l3.386 7.34 8.027.952-5.935 5.488 1.575 7.928z'></path>
                                                    </g>
                                                </svg>
                                            </p>
                                        </div>
                                        <div class='flex items-center space-x-2' style='margin-top:30px'>
                                            <img src='../Img_logo/icon_reviews.png' alt='Reviews Icon' width='24' height='24' />
                                            <p class='text-gray-600 mb-1'>
                                                <b>Reviews</b>: <p style='color: black'>${plane['number_of_reviews']}</p>
                                            </p>
                                        </div>
                                        <div class='flex items-center space-x-2' style='margin-top:30px'>
                                            <img src='../Img_logo/icon_price.png' alt='Price Icon' width='24' height='24' />
                                            <p class='text-gray-600 mb-1'>
                                                <b>Price</b>: <p style='color: black;'> £${plane['rental_price_per_hour']}</p>
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>`;

                        container.appendChild(planeDiv);
                    }
                }

                // Function to remove planes (for "See Less")
                function removePlanes(count) {
                    const container = document.getElementById("plane-container");

                    for (let i = 0; i < count; i++) {
                        if (container.childNodes.length <= 6) {
                            break; // Don't remove if fewer than initial planes
                        }

                        container.removeChild(container.lastChild);
                    }

                    currentStartIndex -= count;
                }

                document.getElementById("plane-see-more").addEventListener("click", function() {
                    loadPlanes(currentStartIndex, planesPerPage);
                    currentStartIndex += planesPerPage;

                    if (currentStartIndex >= allPlanes.length) {
                        this.style.display = "none"; // Hide "See More" if all planes are displayed
                    }

                    document.getElementById("plane-see-less").style.display = "block"; // Show "See Less"
                });

                document.getElementById("plane-see-less").addEventListener("click", function() {
                    removePlanes(planesPerPage);

                    if (currentStartIndex < allPlanes.length) {
                        document.getElementById("plane-see-more").style.display = "block"; // Show "See More" if not all planes are displayed
                    }

                    if (currentStartIndex <= 6) {
                        this.style.display = "none"; // Hide "See Less" if only initial planes are displayed
                    }
                });
            </script>
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

        </style>
        <!-- END of ADDITION !!!!?????-->

    </main>

    </body>

</html>
