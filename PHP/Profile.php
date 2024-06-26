<?php
session_start();
include 'Base.php';
global $base;
//Vérifier que l'utilisateur est connecté
if (isset($_SESSION['user_id'])){
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Staff Airline</title>
    <link rel="stylesheet" href="../css/profile.css">
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
            }
            ?>
            </ul>
          </div>
        </nav>
      </header>
  <section id="sec">
<?php
            $query = "SELECT bf.*,
               df.flight_number AS departure_flight_number,
               rf.flight_number AS return_flight_number,
               dap.airport_name AS departure_airport_name1,
               aap.airport_name AS arrival_airport_name1,
               ppp.airport_name AS departure_airport_name2,
               aaa.airport_name AS arrival_airport_name2,
               df.departure_datetime AS departure_datetime1,
               rf.departure_datetime AS departure_datetime2,
               df.arrival_datetime AS return_datetime1,
               rf.arrival_datetime AS return_datetime2,
               df.flight_duration AS departure_duration,
               rf.flight_duration AS return_duration,
               bf.departure_seat AS departure_seat,
               bf.return_seat AS return_seat,
               CASE bf.insurance
                   WHEN 1 THEN 'Basic'
                   WHEN 2 THEN 'Premium'
                   ELSE 'None'
               END AS insurance,
               CASE bf.class
                   WHEN 1 THEN 'Standard +'
                   WHEN 2 THEN 'Standard Flex'
                   WHEN 3 THEN 'Business'
                   WHEN 4 THEN 'Business Flex'
                   ELSE 'Standard'
               END AS class
          FROM booking_flight bf
          LEFT JOIN Flights df ON bf.departure_flight_id = df.flight_id
          LEFT JOIN Flights rf ON bf.return_flight_id = rf.flight_id
          LEFT JOIN Airports dap ON df.departure_airport = dap.airport_id
          LEFT JOIN Airports aap ON df.arrival_airport = aap.airport_id
          LEFT JOIN Airports ppp ON rf.departure_airport = ppp.airport_id
          LEFT JOIN Airports aaa ON rf.arrival_airport = aaa.airport_id
          WHERE bf.user_id = ?";
          $stmt = $base->prepare($query);
          $stmt->bindParam(1, $user_id);
          $stmt->execute();
          if (!$stmt) {
            echo "Error in SQL execution: " . htmlspecialchars($base->errorInfo()[2]);
            exit;
          }
          $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);



            ?>

            <section id="user-info">
                <h3>Name: <span><?php echo htmlspecialchars($_SESSION['username']); ?></span></h3>
                <h3>Email: <span><?php echo htmlspecialchars($_SESSION['email']); ?></span></h3>
            </section>

  <section class="booking-history">
    <h1>Booking Flight History</h1>
    <table>
        <thead>
            <tr>
              <th>Booking ID</th>
              <th>Flight Direction</th>
              <th>Flight Number</th>
              <th>Airport From</th>
              <th>Airport To</th>
              <th>Departure Time</th>
              <th>Arrival Time</th>
              <th>Flight Duration</th>
              <th>Seat</th>
              <th>Insurance</th>
              <th>Class</th>
              <th>Price</th>
              <th>Ticket</th>


            </tr>
        </thead>
        <tbody>
          <?php foreach ($reservations as $reservation): ?>

          <tr>
              <td><?php echo htmlspecialchars($reservation['booking_id']); ?></td>
              <td>Departure</td>
              <td><?php echo htmlspecialchars($reservation['departure_flight_number']); ?></td>
              <td><?php echo htmlspecialchars($reservation['departure_airport_name1']); ?></td>
              <td><?php echo htmlspecialchars($reservation['arrival_airport_name1']); ?></td>
              <td><?php echo htmlspecialchars($reservation['departure_datetime1']); ?></td>
              <td><?php echo htmlspecialchars($reservation['return_datetime1']); ?></td>
              <td><?php echo htmlspecialchars($reservation['departure_duration']); ?></td>
              <td><?php echo htmlspecialchars($reservation['departure_seat']); ?></td>
              <td><?php echo htmlspecialchars($reservation['insurance']); ?></td>
              <td><?php echo htmlspecialchars($reservation['class']); ?></td>
              <td>£<?php echo number_format($reservation['price'], 2); ?></td>
              <td><a href="ticket_details.php?bookingf1_id=<?php echo htmlspecialchars($reservation['booking_id']); ?>"target="_blank">View Ticket</a></td>

          </tr>

          <?php if ($reservation['return_flight_number']): ?>
          <tr>
              <td><?php echo htmlspecialchars($reservation['booking_id']); ?></td>
              <td>Return</td>
              <td><?php echo htmlspecialchars($reservation['return_flight_number']); ?></td>
              <td><?php echo htmlspecialchars($reservation['departure_airport_name2']); ?></td>
              <td><?php echo htmlspecialchars($reservation['arrival_airport_name2']); ?></td>
              <td><?php echo htmlspecialchars($reservation['departure_datetime2']); ?></td>
              <td><?php echo htmlspecialchars($reservation['return_datetime2']); ?></td>
              <td><?php echo htmlspecialchars($reservation['return_duration']); ?></td>
              <td><?php echo htmlspecialchars($reservation['return_seat']); ?></td>
              <td><?php echo htmlspecialchars($reservation['insurance']); ?></td>
              <td><?php echo htmlspecialchars($reservation['class']); ?></td>
              <td>-------------</td>
              <td><a href="ticket_details.php?bookingf2_id=<?php echo htmlspecialchars($reservation['booking_id']); ?>"target="_blank">View Ticket</a></td>

          </tr>
          <?php endif; ?>
          <?php endforeach; ?>
        </tbody>
    </table>


    <?php

    $query2 = "SELECT b.booking_id, rp.manufacturer, rp.model, rp.registration_number,
           ld.location_name AS departure_location, la.location_name AS arrival_location,
           b.rental_date, b.rental_time, b.total_price, b.status_s
           FROM bookings b
           JOIN Rental_planes rp ON b.plane_id = rp.rental_id
           JOIN Locations ld ON b.departure_location = ld.location_id
           JOIN Locations la ON b.arrival_location = la.location_id
           WHERE b.customer_id = ?";
          $stmt2 = $base->prepare($query2);
          $stmt2->bindParam(1, $user_id);
          $stmt2->execute();
          $rental_reservations = $stmt2->fetchAll(PDO::FETCH_ASSOC);




    ?>

    <h1>Aircraft Rental History</h1>
<table>
    <thead>
        <tr>
            <th>Rental ID</th>
            <th>Manufacturer</th>
            <th>Model</th>
            <th>Departure Location</th>
            <th>Arrival Location</th>
            <th>Rental Date</th>
            <th>Rental Time</th>
            <th>Total Price</th>
            <th>Ticket</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rental_reservations as $rental): ?>
        <tr>
            <td><?php echo htmlspecialchars($rental['booking_id']); ?></td>
            <td><?php echo htmlspecialchars($rental['manufacturer']); ?></td>
            <td><?php echo htmlspecialchars($rental['model']); ?></td>
            <td><?php echo htmlspecialchars($rental['departure_location']); ?></td>
            <td><?php echo htmlspecialchars($rental['arrival_location']); ?></td>
            <td><?php echo htmlspecialchars($rental['rental_date']); ?></td>
            <td><?php echo htmlspecialchars($rental['rental_time']); ?></td>
            <td>£<?php echo number_format($rental['total_price'], 2); ?></td>
            <td><a href="ticket_details.php?bookingr_id=<?php echo htmlspecialchars($rental['booking_id']); ?>"target="_blank">View Ticket</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</section>










<?php

}
else {
    echo "Please log in to view this page.";
} ?>
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
