<?php
session_start();
include 'Base.php';
global $base;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Staff Airline</title>
    <link rel="stylesheet" href="../css/successful.css">

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
                    echo "<li><a href=\"\">Admin</a></li>";
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


<section >

            <h2>Reservation Confirmation</h2>
            <?php
            if(isset($_SESSION['user_id'])){
              echo "<p>You will find the details of your reservation in your profile and email address.</p>";

            }
            else{
              echo "<p>You will find the details of your reservation in your email address.</p>";

            }

             ?>
            <p>If this reservation concerned several passengers each of them will receive the details of the reservation in their email address.</p>
            <p>Thank you for booking with Staff Airways.</p>


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
