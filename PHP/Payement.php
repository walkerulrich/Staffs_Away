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
    <link rel="stylesheet" href="../css/payment.css">

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
                  $user_id = null;
                }

                ?>
              </ul>
            </div>
          </nav>
    </header>


<section class='pay'>
<form action="#" method="post">
                <h3>Payment Details</h3>
                <?php

                if ($_SERVER["REQUEST_METHOD"] == "POST"){
                  $insurance = isset($_POST['selected_insurance']) ? $_POST['selected_insurance'] : null;
                  $option = isset($_POST['selected_option']) ? $_POST['selected_option'] : null;
                  $price = isset($_POST['price']) ? $_POST['price'] : null;
                  $email = isset($_POST['email1']) ? $_POST['email1'] : null;
                  $first_name = isset($_POST['first_name1']) ? $_POST['first_name1'] : null;
                  $last_name = isset($_POST['last_name1']) ? $_POST['last_name1'] : null;
                  $phone = isset($_POST['phone1']) ? $_POST['phone1'] : null;
                  $selected_outbound = isset($_POST['selected_outbound']) ? $_POST['selected_outbound'] : null;
                  $selected_return = isset($_POST['selected_return']) ? $_POST['selected_return'] : null;
                  $class = isset($_POST['class']) ? $_POST['class'] : null;
                  $passengers = isset($_POST['passengers']) ? $_POST['passengers'] : null;
                  $seat_number1 = chr(rand(65, 90)) . rand(1, 30);
                  if ($selected_return == null){
                    $seat_number2 = null;
                  }
                  else{
                    $seat_number2 = chr(rand(65, 90)) . rand(1, 30);
                  }
                  if ($option == 'Standard +'){
                    $price = $price + 50*$passengers;
                    $skypriority = 0;
                    $checked_baggage = 1;
                    $cabin_baggage = 1;
                    $refundable = 0;
                    $front_seats = 0;
                    $lounge_access = 0;
                    $classnumber = 1;
                  }
                  elseif($option == 'Standard Flex'){
                    $price = $price + 150*$passengers;
                    $skypriority = 0;
                    $checked_baggage = 1;
                    $cabin_baggage = 1;
                    $refundable = 1;
                    $front_seats = 0;
                    $lounge_access = 0;
                    $classnumber = 2;
                  }
                  elseif($option == 'Business Flex'){
                    $price = $price + 100*$passengers;
                    $skypriority = 1;
                    $checked_baggage = 2;
                    $cabin_baggage = 2;
                    $refundable = 1;
                    $front_seats = 1;
                    $lounge_access = 1;
                    $classnumber = 4;
                  }
                  elseif($option == 'Business'){
                    $skypriority = 1;
                    $checked_baggage = 2;
                    $cabin_baggage = 2;
                    $refundable = 0;
                    $front_seats = 1;
                    $lounge_access = 1;
                    $classnumber = 3;

                  }
                  elseif($option == 'Standard'){
                    $skypriority = 0;
                    $checked_baggage = 0;
                    $cabin_baggage = 1;
                    $refundable = 0;
                    $front_seats = 0;
                    $lounge_access = 0;
                    $classnumber = 0;

                  }
                  if ($insurance == 'Basic'){
                    $price = $price + 20*$passengers;
                    $insurancenumber = 1;
                  }
                  elseif($insurance == 'Premium'){
                    $price = $price + 40*$passengers;
                    $insurancenumber = 2;
                  }
                  elseif($insurance == 'None'){
                    $insurancenumber = 0;

                  }
                  echo "<h2>Price : £ ". $price . "</h2>";
                }


                 ?>



                <label for="cardNumber">Card Number:</label>
                <input type="text" id="cardNumber" name="cardNumber" required><br>

                <label for="cardHolder">Card Holder:</label>
                <input type="text" id="cardHolder" name="cardHolder" required><br>

                <label for="expiry">Expiry Date:</label>
                <input type="month" id="expiry" name="expiry" required><br>

                <label for="cvc">CVC:</label>
                <input type="number" id="cvc" name="cvc" required><br>


                <?php
                foreach ($_POST as $key => $value) {
                    echo "<input type='hidden' name='".htmlspecialchars($key)."' value='".htmlspecialchars($value)."'>";

                }
                ?>

                <button type="submit" name='confirmPayment'>Confirm Payment</button>
            </form>

            <?php

            if (isset($_POST['confirmPayment'])) {
                $sql = "INSERT INTO booking_flight (user_id, departure_flight_id, return_flight_id, number_of_passengers, price, departure_seat, return_seat, email, phone, skypriority, lounge_access, checked_baggage, cabin_baggage, refundable, front_seats, insurance, class) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $base->prepare($sql);
                $params = [$user_id, $selected_outbound, $selected_return, $passengers, $price, $seat_number1, $seat_number2, $email, $phone, $skypriority, $lounge_access, $checked_baggage, $cabin_baggage, $refundable, $front_seats, $insurancenumber, $classnumber];
                if ($stmt->execute($params)) {
                    echo "Reservation successful!";
                } else {
                    echo "Error: " . $base->errorInfo()[2];
                }
                header("Location: Successful1.php");
            }

             ?>


          </ul>
        </div>
              </section>

  </body>
</html>
