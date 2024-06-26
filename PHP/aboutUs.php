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
    <title>Document</title>
    <link rel="stylesheet" href="../css/aboutUs.css">
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

    <section class="ma-section">
        <div class="background-image">
            <img src="../image/fondabout.jpg" alt="Description de l'image">
        </div>
        <div class="contenu">
            <p id="p1">STAFFS_AIRWAYS</p>
            <p id="p2">Our DNA, our history, our vision</p>
        </div>
    </section>

    <section class="about-section">
        <div class="about-container">
            <h2>About Staffs Airways</h2>
            <p>Staffs Airways, a rapidly growing airline, offers you a unique and memorable travel experience on every flight. With a commitment to service excellence, passenger comfort, and environmental sustainability, Staffs Airways is your trusted partner for all your air travel needs.</p>
        </div>
    </section>
    <section class="features-section">
        <div class="features-container">
            <div class="feature">
                <img src="../image/save-the-world.png" alt="Environment Icon" class="icon">
                <h2>Committed to Environment and Sustainability</h2>
                <p>At Staffs Airways, we take our responsibility to the environment very seriously. We invest in a modern, fuel-efficient fleet, reducing our carbon footprint while offering passengers increased comfort and peace of mind during their travels.</p>
            </div>
            <div class="feature">
                <img src="../image/quality-service (1).png" alt="Service Icon" class="icon">
                <h2>Quality Service, On the Ground and in the Air</h2>
                <p>Our dedicated team of professionals ensures that every aspect of your journey is impeccable, from the moment you book your ticket to your arrival at your destination. We take pride in our attentive and personalized service, guaranteeing a hassle-free flying experience for all our passengers.</p>
            </div>
            <div class="feature">
                <img src="../image/talent-management.png" alt="Experience Icon" class="icon">
                <h2>Experience the Staffs Airways Difference</h2>
                <p>Whether you're traveling for business or pleasure, Staffs Airways is committed to providing you with an unforgettable flying experience at every moment. Join us on board and experience the Staffs Airways difference today!</p>
            </div>
        </div>
    </section>
    <section class="destination-section">
  <div class="destination-content">
    <div class="destination-image-container">
      <img src="../image/2811148.jpg" alt="About Us Image">
    </div>
    <div class="destination-text">

      <h1>Discover Our Destinations</h1>
      <p>Staffs Airways serves a wide range of destinations, covering continents and meeting the diverse needs of our passengers. From North America to Africa, Europe, and Asia, our routes include iconic cities and hidden gems, ensuring an enriching travel experience at every step of your journey.</p>

    </div>
  </div>
</section>

<section class="why-choose-section">
    <div class="why-choose-content">
        <h2>Why Choose Staffs Airways for Your Travels?</h2>
        <p>Each year, countless travelers opt for Staffs Airways as their preferred choice for travel, establishing us as a trusted name in both national and international aviation. Renowned for our expertise in long-distance flights, we seamlessly connect passengers to coveted destinations across the globe. Complementing our commercial offerings, Staffs Airways extends its exceptional service through private jet charters, catering to the bespoke requirements of our esteemed clientele. Whether embarking on a discreet corporate journey or indulging in a lavish excursion, our elite fleet of private jets stands ready to elevate your travel experience to new heights.</p>
    </div>
</section>

<section class="about-us-section">
  <div class="about-us-content">
    <div class="about-us-image-container">
      <img src="../image/private-jet-chauffeur-services.webp" alt="About Us Image">
    </div>
    <div class="about-us-text">
      <h2>Private Jet</h2>
      <h1>Why Charter a Private Jet with Staffs Airways?</h1>
      <ul>
        <li>Absolute privacy and discretion</li>
        <li>Total flexibility in planning your trip</li>
        <li>Unmatched comfort and luxury aboard our private jets</li>
        <li>Personalized and attentive service from our dedicated team</li>
        <li>Discover the Luxury of Private Jet Travel</li>
        <li>Indulge in the ultimate luxury of private jet travel with Staffs Airways.</li>
        <li>Whether for last-minute business trips or luxury getaways with family, our private jet charter service offers you the freedom to travel on your own terms.</li>
      </ul>
      <a href="aircraft.php"><button>Discover More</button></a>
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



</body>
</html>
