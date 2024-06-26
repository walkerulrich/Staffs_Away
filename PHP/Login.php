<?php
session_start();
include 'Base.php';
global $base;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log in</title>
  <link rel="stylesheet" href="../css/pro.css">
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
    <section>
  <div class="form-container">
    <form class="login-form" action="#" method="POST">
      <h2>Log in</h2>
      <div class="input-group">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" placeholder="Your email">
      </div>

      <div class="input-group">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Your password"><br>
      </div>
      <div class="button-container">
        <button type="submit" name="login" id="login" value="Log in" class="login-button">Log in</button>
      </div>
      <?php
        if(isset($_POST['login'])){
          $password = htmlspecialchars($_POST['password']);
          $hash = password_hash($password, PASSWORD_BCRYPT);
          $email = htmlspecialchars($_POST['email']);

          if(!empty($email) AND !empty($password)){
            $request = $base->prepare("SELECT * FROM Users WHERE email = :email");
            $request->execute(['email' => $email]);
            $exist = $request->rowCount();

            if($exist == 1){
              $exist = $request->fetch();

              if (password_verify($password, $exist['password'])){
                $_SESSION['user_id'] = $exist['user_id'];
                $_SESSION['username'] = $exist['username'];
                $_SESSION['email'] = $exist['email'];
                $_SESSION['admin_id'] = $exist['admin_id'];
                header("Location: Profile.php");
              }
              else{
                $erreur = "<h3>This account does not exist</h3>";
              }
            }
            else{
              $erreur = "<h3>This account does not exist</h3>";
            }
          }
          else{
            $erreur = "<h3>All fields must be completed</h3>";
          }
        }
        if(isset($erreur)){
          echo $erreur;
          echo "<br>";
        }
      ?>
      <h3 class="register-link">No account yet? Register here: <a href="Registration.php">Registration</a></h3>
    </form>
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
