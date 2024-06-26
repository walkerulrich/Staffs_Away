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
    <link rel="stylesheet" href="../css/flight.css">

  </head>

  <body>

    <nav class="navbar">
        <div class="container">
          <img src="../image/aircraft-removebg-preview.png" alt="Airline Management Logo" class="logo">
          <ul class="nav-links">
            <li><a href="home.php">Search Flights</a></li>
            <li><a href="aircraft.php">Plan Rental</a></li>
            <li><a href="aboutUs.php">About Us</a></li>
            <?php
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

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
            echo"  </ul>";
          echo"  </nav>";
          echo"</div>";

          echo"<section>";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo "<h1>Flight Search Details</h1>";
                echo"";
                echo "<p>Trip Type: " . htmlspecialchars(isset($_POST['trip-type']) ? $_POST['trip-type'] : "Two Ways") .
                     " <br> From: " . htmlspecialchars(isset($_POST['departure-city']) ? $_POST['departure-city'] : "Unknown") .
                     " <br> To: " . htmlspecialchars(isset($_POST['destination-city']) ? $_POST['destination-city'] : "Unknown") .
                     " <br> Departure Date: " . htmlspecialchars(isset($_POST['depart']) ? $_POST['depart'] : "Not set") .
                     " <br> Return Date: " . (isset($_POST['return']) && !empty($_POST['return']) ? htmlspecialchars($_POST['return']) : "N/A") .
                     " <br> Class: " . htmlspecialchars(isset($_POST['class']) ? $_POST['class'] : "Not set") .
                     "<br> Number of Passengers: " . htmlspecialchars(isset($_POST['passengers']) ? $_POST['passengers'] : "Not specified") . "</p>";
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                try {
                    $base = new PDO("mysql:host=localhost;dbname=Staff_Airline", "root", "");
                    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                    $departureCity = $_POST['departure-city'];
                    $destinationCity = $_POST['destination-city'];
                    $departDate = $_POST['depart'];
                    $returnDate = $_POST['return'];
                    $passengers = $_POST['passengers'];
                    $class = $_POST['class'];

                    echo "<form action='BookingFlight.php' method='post'>";

                    displayFlights($base, $departureCity, $destinationCity, $departDate, $passengers, "Departure Flights <img src='../image/airplane.png' alt='icone_departure_flights' style='width: 40px; height: 30px;'> ", "outbound", $class);
                      if (!empty($returnDate)) {
                          displayFlights($base, $destinationCity, $departureCity, $returnDate, $passengers, "Return Flights <img src='../image/airplane (1).png' alt='icone_return_flights' style='width: 40px; height: 30px;'> ", "return", $class);
                      }

                    echo "<br><br><br>";
                    echo "<input type='hidden' name='class' value='" . htmlspecialchars($class) . "'>";
                    echo "<input type='hidden' name='passengers' value='" . htmlspecialchars($passengers) . "'>";

                    echo "<button id='validate'  type='submit'>Validate Selection</button>";
                    echo "</form>";

                } catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            }


            function displayFlights($db, $fromCity, $toCity, $date, $passengers, $flightType, $flightDirection, $class) {
                $sql = "SELECT F.flight_number, F.airline, F.departure_datetime, F.arrival_datetime, F.flight_duration, F.ticket_price, F.available_seats, F.stopover_info, F.flight_id, A1.airport_name AS departure_airport_name, A2.airport_name AS arrival_airport_name
                        FROM Flights F
                        JOIN Airports A1 ON F.departure_airport = A1.airport_id
                        JOIN Cities C1 ON A1.city_id = C1.city_id
                        JOIN Airports A2 ON F.arrival_airport = A2.airport_id
                        JOIN Cities C2 ON A2.city_id = C2.city_id
                        WHERE C1.city_name = ? AND C2.city_name = ? AND DATE(F.departure_datetime) = ? AND F.available_seats >= ?";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(1, $fromCity, PDO::PARAM_STR);
                $stmt->bindValue(2, $toCity, PDO::PARAM_STR);
                $stmt->bindValue(3, $date, PDO::PARAM_STR);
                $stmt->bindValue(4, $passengers, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo "<h1>$flightType</h1>";



              if (count($result) > 0) {
                echo "<div class='flight-container'>";
                foreach ($result as $key => $row) {
                  $originalPrice = (float)$row['ticket_price'];
                  $adjustedPrice = $class === 'business' ? $originalPrice * 2 : $originalPrice;
                  $adjustedPrice2 = $adjustedPrice * $passengers;

                    echo "<div class='flight'>";

                    // Airline and Flight Number
                    echo "<div class='airline-info'>";

                    echo htmlspecialchars($row['airline']) . "<br><br>" . htmlspecialchars($row['flight_number']);
                    echo "</div>";

                   // Departure Date and Airport
                    echo "<div class='departure-info'>";
                    echo "<div class='date' id='departure-date'>" . date('d-m-Y', strtotime($row['departure_datetime'])) . "</div>";
                    echo "<div class='time'id='departure-time'>" . date('H:i', strtotime($row['departure_datetime'])) ."</div>";
                    echo "<div class='airport' id='departure-airport'>" . htmlspecialchars($row['departure_airport_name']) . "</div>";
                    echo "</div>";


                      echo "<div class='duration-info'>";
                      $departureTime = strtotime($row['departure_datetime']);
                      $arrivalTime = strtotime($row['arrival_datetime']);
                      $duration = $arrivalTime - $departureTime;
                      $hours = floor($duration / 3600);
                      $minutes = floor(($duration % 3600) / 60);

                      // Bouton "i" dans la ligne
                      echo "<div class='infos'>";
                      echo "<div class='flex'>";
                      echo "<div class='line'></div>";
                      echo "<span class='info-btn' data-flight='$key'></span>";
                      echo "<div class='line'></div>";
                      echo "</div>";
                      echo "</div>";

                      // Durée
                      //echo "<div style='text-align: center;' class='duration'>"  . htmlspecialchars(sprintf("%2d", $hours) . "h" . sprintf("%02d", $minutes) . "") . "</div>";
                      echo "<div style='text-align: center;' class='duration'>";
                      echo "<img src='../image/deadline.png' alt='Icone montre' class='tiny-icon'>";
                        echo htmlspecialchars(sprintf("%2d", $hours) . "h" . sprintf("%02d", $minutes) . "");
                        echo "</div>";

                      // Boîte d'information sur les escales (si nécessaire)
                      echo "<div class='stopover-info-box' id='stopover-info-box-$key' style='display: none;'>" . (!empty($row['stopover_info']) ? htmlspecialchars($row['stopover_info']) : 'No Stopovers') . "</div>";
                      echo "</div>";




                      // Arrival Date
                      echo "<div class='arrival-info'>";
                      echo "<div class='date' id='arrival-date' >" . date('d-m-Y', strtotime($row['arrival_datetime'])) . "</div>";
                      echo "<div class='time' id='arrival-time'>" . date('H:i', strtotime($row['arrival_datetime'])) . "</div>";
                      echo "<div class='airport' id='arrival-airport'>" . htmlspecialchars($row['arrival_airport_name']) . "</div>";
                      echo "</div>";


                  //price
                  echo "<div class='price-and-select'>";
                  echo "<div class='price-info'>£ " . $adjustedPrice2 . "</div>";
                  echo "<div id='sel'>";

                  //echo "<input id='sel' type='radio' name='selected_$flightDirection' value='" . $row['flight_id'] . "'>";
                  echo "<label>Select <input type='radio' name='selected_$flightDirection' value='" . $row['flight_id'] . "'></label>";
                  echo "</div>";
                  echo "</div>";



                  //echo "<input type='radio' name='selected_$flightDirection' value='" . $row['flight_id'] . "'>";


                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "No flights found for $flightType.";
            }
          }

            echo"</section>";

            ?>
              <script>
            document.addEventListener('DOMContentLoaded', function() {
                var infoButtons = document.querySelectorAll('.info-btn');
                infoButtons.forEach(function(button) {
                    button.addEventListener('click', function() {
                        var flightKey = this.getAttribute('data-flight');
                        var stopoverInfoBox = document.getElementById('stopover-info-box-' + flightKey);
                        stopoverInfoBox.style.display = (stopoverInfoBox.style.display === 'none') ? 'block' : 'none';
                    });
                });
            });
            </script>
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
