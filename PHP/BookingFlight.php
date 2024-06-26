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
    <link rel="stylesheet" href="../css/BookingFlight.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-xxxxx" crossorigin="anonymous" />
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
    <section class="flight-details">
    <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $selectedOutboundFlightId = isset($_POST['selected_outbound']) ? $_POST['selected_outbound'] : null;
                $selectedReturnFlightId = isset($_POST['selected_return']) ? $_POST['selected_return'] : null;

                if ($selectedOutboundFlightId) {
                    displayFlightDetails($selectedOutboundFlightId, "Departure");
                }

                if ($selectedReturnFlightId) {
                    displayFlightDetails($selectedReturnFlightId, "Return");
                }
            }

            function displayFlightDetails($flightId, $flightType) {
                global $base;


                $query = "SELECT F.flight_number, F.airline, F.departure_datetime, F.arrival_datetime, F.flight_duration, F.ticket_price, F.available_seats, F.stopover_info, A1.airport_name AS departure_airport_name, A2.airport_name AS arrival_airport_name
                          FROM Flights F
                          JOIN Airports A1 ON F.departure_airport = A1.airport_id
                          JOIN Airports A2 ON F.arrival_airport = A2.airport_id
                          WHERE F.flight_id = ?";
                $stmt = $base->prepare($query);
                $stmt->execute([$flightId]);
                $flight = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($flight) {
                    $class = $_POST['class'] ?? 'economy';
                    $passengers = $_POST['passengers'];
                    $originalPrice = (float)$flight['ticket_price'];
                    $adjustedPrice = $class === 'business' ? $originalPrice * 2 : $originalPrice;
                    $adjustedPrice2 = $adjustedPrice * $passengers;
                    echo "<h2>" . htmlspecialchars($flightType) . " Flight Details</h2>";
                    echo "<p >Flight Number: " . htmlspecialchars($flight['flight_number']) . "</p>";
                    echo "<p>Airline: " . htmlspecialchars($flight['airline']) . "</p>";
                    echo "<p>Departure Airport: " . htmlspecialchars($flight['departure_airport_name']) . " at " . htmlspecialchars($flight['departure_datetime']) . "</p>";
                    echo "<p>Arrival Airport: " . htmlspecialchars($flight['arrival_airport_name']) . " at " . htmlspecialchars($flight['arrival_datetime']) . "</p>";
                    echo "<p>Duration: " . htmlspecialchars($flight['flight_duration']) . "</p>";
                    echo "<p>Price: £" . $adjustedPrice2 . "</p>";
                    echo "<p>Available Seats: " . htmlspecialchars($flight['available_seats']) . "</p>";
                    echo "<p>Stopover Info: " . (!empty($flight['stopover_info']) ? htmlspecialchars($flight['stopover_info']) : 'No Stopovers') . "</p>";
                    return $flight['ticket_price'];
                } else {
                    echo "<p>No details available for this flight.</p>";
                }

            }

            function displayFlightDetails2($flightId, $flightType) {
                global $base;


                $query = "SELECT F.flight_number, F.airline, F.departure_datetime, F.arrival_datetime, F.flight_duration, F.ticket_price, F.available_seats, F.stopover_info, A1.airport_name AS departure_airport_name, A2.airport_name AS arrival_airport_name
                          FROM Flights F
                          JOIN Airports A1 ON F.departure_airport = A1.airport_id
                          JOIN Airports A2 ON F.arrival_airport = A2.airport_id
                          WHERE F.flight_id = ?";
                $stmt = $base->prepare($query);
                $stmt->execute([$flightId]);
                $flight = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($flight) {
                    return $flight['ticket_price'];
                }
                else {

                }

            }

            $passengers = $_POST['passengers'];
            $class = $_POST['class'] ?? 'economy';
            $priceOutbound = displayFlightDetails2($selectedOutboundFlightId, "Departure");
            $priceReturn = displayFlightDetails2($selectedReturnFlightId, "Return") ?? 0;
            $totalPrice = $priceOutbound + $priceReturn;
            $totalPrice = $totalPrice * $passengers;
            echo"</section>";

            if ($class === 'business') {
                $totalPrice = $totalPrice * 2;
                  echo "<h1>Business Class</h1>";
                  echo"<section class='container1'>";
                  echo "<form action='Payement.php' method='post'>";
                  echo "<div class='container1'>
                        <div class='price-row'>
                            <div class='price-col'>
                                <p>Business</p>
                                <hr>
                                <ul>
                                  <li class='checked-bag'>Carry-on Bag (12 kg)</li>
                                    <li class='checked-bag'>Checked Bag (23 kg)</li>
                                    <li class='checked-bag'>Front Cabin Seats</li>
                                    <li class='carry-on'>Refundable</li>
                                    <li class='checked-bag'>Lounge Access</li>
                                    <li class='checked-bag'>Sky Priority</li>
                                </ul>
                                <h3> £ ".$totalPrice."</h3>
                                <div class='sel'>
                                <label>Select<input type='radio' name='selected_option' value='Business' checked></label>
                            </div>
                            </div>
                            <div class='price-col'>
                                <p>Business Flex</p>
                                <hr>
                                <ul>
                                <li class='checked-bag'>Carry-on Bag (12 kg)</li>
                                    <li class='checked-bag'>Checked Bag (23 kg)</li>
                                    <li class='checked-bag'>Front Cabin Seats</li>
                                    <li class='checked-bag'>Refundable</li>
                                    <li class='checked-bag'>Lounge Access</li>
                                    <li class='checked-bag'>Sky Priority</li>
                                </ul>
                                <h3>£ ".($totalPrice + 100*$passengers)."</h3>
                                <div class='sel'>
                                <label>Select<input type='radio' name='selected_option' value='Business Flex'></label>
                                </div>
                            </div>

                        </div>
                    </div>";

                    echo"</section>";
                echo"</section>";

                echo "<section class='insurance-section'>";
                echo "<img src='../image/2.png' alt='Description de l'image'>";
                echo "<h1>Insurance Options</h1>";

                echo "<table border='1'>";
                echo "<tr><th>Select</th><th>Insurance Type</th><th>Description</th><th>Price</th></tr>";
                echo "<tr><td><input type='radio' name='selected_insurance' value='None' checked></td><td>None</td><td>No insurance coverage selected</td><td>£0</td></tr>";
                echo "<tr><td><input type='radio' name='selected_insurance' value='Basic'></td><td>Basic</td><td>Covers lost luggage</td><td>£". 20*$passengers."</td></tr>";
                echo "<tr><td><input type='radio' name='selected_insurance' value='Premium'></td><td>Premium</td><td>Includes medical expenses and trip interruption</td><td>£". 40*$passengers."</td></tr>";
                echo "</table>";
                echo "</section>";


                echo "<br>";

                echo"<section class='Passenger Details'>";
                echo "<h1>Passenger Details</h1>";
                for ($i = 1; $i <= $passengers; $i++) {
                  echo "<div class='passenger-info'>";
                    echo "<h4>Passenger $i</h4>";
                    echo "<label for='email$i'>Email:</label>";
                    echo "<input type='email' name='email$i' required><br>";

                    echo "<label for='first_name$i'>First Name:</label>";
                    echo "<input type='text' name='first_name$i' required><br>";

                    echo "<label for='last_name$i'>Last Name:</label>";
                    echo "<input type='text' name='last_name$i' required><br>";

                    echo "<label for='age$i'>Age:</label>";
                    echo "<input type='number' name='age$i' min='0' required><br>";

                    echo "<label for='phone$i'>Phone Number:</label>";
                    echo "<input type='tel' name='phone$i' required>";


                }
                foreach ($_POST as $key => $value) {
                    echo "<input type='hidden' name='".htmlspecialchars($key)."' value='".htmlspecialchars($value)."'>";
                }
                echo "<input type='hidden' name='price' value='" . $totalPrice . "'>";

                echo "<button id='validate' type='submit'>Submit</button>";
                echo "</form>";
                echo "</div>";
                echo"</section>";
            }
            else {



              echo "<h1>Economy Class</h1>";
              echo"<section class='container1'>";
              echo "<form action='Payement.php' method='post'>";
              echo "<div class='container1'>
                    <div class='price-row'>
                        <div class='price-col'>
                            <p>Standard</p>
                            <hr>
                            <ul>
                                <li class='checked-bag'>Carry-on Bag (12 kg)</li>
                                <li class='carry-on'>Checked Bag (23 kg)</li>
                                <li class='carry-on'>Front Cabin Seats</li>
                                <li class='carry-on'>Refundable</li>
                                <li class='carry-on'>Lounge Access</li>
                                <li class='carry-on'>Sky Priority</li>
                            </ul>
                            <h3> £ ".$totalPrice."</h3>
                            <div class='sel'>
                            <label>Select<input type='radio' name='selected_option' value='Standard' checked></label>
                        </div>
                        </div>
                        <div class='price-col'>
                            <p>Standard +</p>
                            <hr>
                            <ul>
                                <li class='checked-bag'>Carry-on Bag (12 kg)</li>
                                <li class='checked-bag'>Checked Bag (23 kg)</li>
                                <li class='carry-on'>Front Cabin Seats</li>
                                <li class='carry-on'>Refundable</li>
                                <li class='carry-on'>Lounge Access</li>
                                <li class='carry-on'>Sky Priority</li>
                            </ul>
                            <h3>£ ".($totalPrice + 50*$passengers)."</h3>
                            <div class='sel'>
                            <label>Select<input type='radio' name='selected_option' value='Standard +'></label>
                            </div>
                        </div>
                        <div class='price-col'>
                            <p>Standard Flex</p>
                            <hr>
                            <ul>
                                <li class='checked-bag'>Carry-on Bag (12 kg)</li>
                                <li class='checked-bag'>Checked Bag (23 kg)</li>
                                <li class='checked-bag'>Front Cabin Seats</li>
                                <li class='checked-bag'>Refundable</li>
                                <li class='carry-on'>Lounge Access</li>
                                <li class='carry-on'>Sky Priority</li>
                            </ul>
                            <h3>£ ".($totalPrice + 150*$passengers)."</h3>
                            <div class='sel'>
                            <label>Select<input type='radio' name='selected_option' value='Standard Flex'></label>
                            </div>
                        </div>
                    </div>
                </div>";

                echo"</section>";

                echo "<section class='insurance-section'>";
                echo "<img src='../image/2.png' alt='Description de l'image'>";
                echo "<h1>Insurance Options</h1>";

                echo "<table border='1'>";
                echo "<tr><th>Select</th><th>Insurance Type</th><th>Description</th><th>Price</th></tr>";
                echo "<tr><td><input type='radio' name='selected_insurance' value='None' checked></td><td>None</td><td>No insurance coverage selected</td><td>£0</td></tr>";
                echo "<tr><td><input type='radio' name='selected_insurance' value='Basic'></td><td>Basic</td><td>Covers lost luggage</td><td>£". 20*$passengers."</td></tr>";
                echo "<tr><td><input type='radio' name='selected_insurance' value='Premium'></td><td>Premium</td><td>Includes medical expenses and trip interruption</td><td>£". 40 *$passengers ."</td></tr>";
                echo "</table>";
                echo "</section>";
                echo "<br>";

                echo"<section class='Passenger Details'>";
                echo "<h1>Passenger Details</h1>";
                for ($i = 1; $i <= $passengers; $i++) {
                  echo "<div class='passenger-info'>";
                    echo "<h4>Passenger $i</h4>";
                    echo "<label for='email$i'>Email:</label>";
                    echo "<input type='email' name='email$i' required><br>";

                    echo "<label for='first_name$i'>First Name:</label>";
                    echo "<input type='text' name='first_name$i' required><br>";

                    echo "<label for='last_name$i'>Last Name:</label>";
                    echo "<input type='text' name='last_name$i' required><br>";

                    echo "<label for='age$i'>Age:</label>";
                    echo "<input type='number' name='age$i' min='0' required><br>";

                    echo "<label for='phone$i'>Phone Number:</label>";
                    echo "<input type='tel' name='phone$i' required>";



                }
                foreach ($_POST as $key => $value) {
                    echo "<input type='hidden' name='".htmlspecialchars($key)."' value='".htmlspecialchars($value)."'>";
                }
                echo "<input type='hidden' name='price' value='" . $totalPrice . "'>";

                echo "<button id='validate' type='submit'>Submit </button>";
                echo "</form>";
                echo "</div>";
                echo"</section>";

            }

            ?>
          </section>
          <footer>
  <div class="footer-content">
    <div class="contact">
      <h2>Need Help With Your Booking?</h2>
      <p>Staffs Airways Service Line: +33 234 567 890</p>
      <p>Higher booking and service fees by phone, learn more</p>
      <p>Spoken languages: fr - en</p>
      <p>Opening hours: Today (08:00 AM - 10:00 PM)</p>
    </div>
    <div class="security">
      <h2>Security and Privacy</h2>
      <p>We make every effort to keep your personal details secure and confidential.</p>
      <a href="#">Staffs Airways Privacy Policy</a>
    </div>
  </div>
</footer>
  </body>
</html>
