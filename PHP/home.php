<?php
session_start();
include 'Base.php';
global $base;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../image/aircraft__1_-removebg-preview.png" type="image/x-icon">
    <title>Home</title>
    <link rel="stylesheet" href="../css/home.css">
    <script src="../js/javascript.js"></script>
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
    <section class="section">
        <div class="content">
        <p id="titre">The Sky is Waiting for You</p>
        <p id="paragraphe">With "Staffs Airways", you can easily book any ticket you need to travel safely thanks to our detailed system of searching and booking airline tickets.</p>
        </div>

        <div class="category-buttons">
            <button class="category-button active" data-target="book-flight-form">Book Flight</button>
            <button class="category-button" data-target="rental-plane-form">Rental Plane</button>
        </div>
        <div class="form-container">
            <div class="booking-form show" id="book-flight-form">
              <h2>Book a Flight</h2>
              <form action="Flight.php" method="post" id="flight-form">
                  <input type="checkbox" id="one-way" name="trip-type" value="one-way" >
                  <label for="one-way">One Way</label><br><br>
                  <div class="row">
                      <div class="col">
                          <label for="departure-city">From</label>
                          <input type="text" id="departure-city" name="departure-city" required>
                      </div>
                      <div class="col">
                          <label for="destination-city">To</label>
                          <input type="text" id="destination-city" name="destination-city" required>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col">
                          <label for="depart">Departure Date:</label>
                          <input type="date" id="depart" name="depart" required>
                      </div>
                      <div class="col" id="return-date-field">
                          <label for="return">Return Date:</label>
                          <input type="date" id="return" name="return">
                      </div>
                  </div>
                  <div class="row">
                      <div class="col">
                          <label for="class">Class:</label>
                          <select id="class" name="class">
                              <option value="economy">Economy</option>
                              <option value="business">Business</option>
                          </select>
                      </div>
                      <div class="col">
                          <label for="passengers">Number of Passengers:</label>
                          <div class="passenger-select">
                              <input type="text" id="passengers" name="passengers" value="1" >
                              <div class="arrow-up"></div>
                              <div class="arrow-down"></div>
                          </div>
                      </div>
                  </div>
                  <button id="validate section " type="submit">Search Flight</button>
              </form>
            </div>
            <div class="rental-form" id="rental-plane-form">
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
    </section>




    <section class="features">
        <h2>FEATURES</h2>
        <h3>Top Features</h3>
        <p>Explore the unparalleled advantages that set our airline apart, ensuring an exceptional journey for every passenger.</p>

        <div class="features-grid">
            <div class="feature">
                <img src="../image/diamond-removebg-preview.png" alt="Luxury and Comfort">
                <h3>Luxury And Comfort</h3>
                <p>Experience the pinnacle of luxury and comfort with our airline, where every journey is an exquisite and pleasurable experience, meticulously crafted to exceed your expectations.</p>
            </div>

            <div class="feature">
                <img src="../image/avion-removebg-preview.png" alt="Save and Secure">
                <h3>Save And Secure</h3>
                <p>Travel with peace of mind knowing that our airline provides a safe and secure service, prioritizing your well-being every step of the way.</p>
            </div>

            <div class="feature">
                <img src="../image/1-removebg-preview.png " alt="All Over The World">
                <h3>All Over The World</h3>
                <p>Discover the world at your fingertips with our airline, providing our customers the unparalleled opportunity to travel all over the globe.</p>
            </div>
        </div>
    </section>
    <section class="about-us">
  <div class="about">
    <div class="image-container">
      <img src="../image/about.jpeg" alt="About Us Image">
    </div>
    <div class="content">
      <h2>About Us</h2>
      <h1>Making Your Dreams Come True</h1>
      <p>Staffs Airways offers a unique and memorable travel experience, committed to service excellence, passenger comfort, and environmental sustainability. Our private jet charter services cater to discerning clients, providing luxurious and convenient travel options for business or special occasions.</p>
      <a href="aboutUs.php"><button>Discover More</button></a>
    </div>
  </div>
</section>
<section class="services">
    <h2>SERVICES</h2>
    <h3>What We Offer</h3>
    <p>We offer a wide range of services tailored to your specific needs, ensuring exceptional customer experience and complete satisfaction.</p>

    <div class="services-grid">
        <div class="service">
            <img src="../image/luxury.png" alt="Luxury and Comfort">
            <h3>Luxury Travel</h3>
            <p>Experience the pinnacle of luxury and comfort with our airline, where every journey is an exquisite and pleasurable experience, meticulously crafted to exceed your expectations.</p>
        </div>

        <div class="service">
            <img src="../image/work-schedule.png" alt="Save and Secure">
            <h3>Flexible Schedule</h3>
            <p>Travel at your own pace with our airline, offering our customers the freedom to choose a flexible schedule that fits their needs.</p>
        </div>

        <div class="service">
            <img src="../image/low-price.png" alt="All Over The World">
            <h3>Affordable Cost</h3>
            <p>Traveling affordably is our promise. Enjoy the opportunity to explore the world with our airline without breaking the bank</p>
        </div>
        <div class="service">
            <img src="../image/seater-sofa.png" alt="Luxury and Comfort">
            <h3>Comfort Travel</h3>
            <p>Our airline offers our customers the opportunity to travel with comfort and ease, ensuring a seamless journey from takeoff to touchdown.</p>
        </div>

        <div class="service">
            <img src="../image/delivery.png" alt="Save and Secure">
            <h3>Easy Transport</h3>
            <p>Experience hassle-free travel with Easy Transport, where our airline provides customers with the opportunity to journey effortlessly and comfortably.</p>
        </div>

        <div class="service">
            <img src="../image/fast-service.png" alt="All Over The World">
            <h3>Fast Service</h3>
            <p>Experience swift and efficient service with our airline, where your time is valued and every aspect of your journey is handled promptly and seamlessly.</p>
        </div>
    </div>
</section>
<section class="statistics">
    <div class="statistic">
      <div class="number">80</div>
      <div class="text">+ Happy Clients</div>
    </div>
    <div class="statistic">
      <div class="number">50</div>
      <div class="text">+ Expert Pilots</div>
    </div>
    <div class="statistic">
      <div class="number">10</div>
      <div class="text">+ Win Awards</div>
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



</body>
</html>
