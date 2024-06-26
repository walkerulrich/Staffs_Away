<?php
session_start();
include '../PHP/Base.php';
global $base;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../image/aircraft__1_-removebg-preview.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/home.css">
  <link rel="stylesheet" href="../css/admin.css">
  <title>Admin</title>
</head>

<body>

  <header>
    <nav class="navbar">
      <div class="container">
        <img src="../image/aircraft-removebg-preview.png" alt="Airline Management Logo" class="logo">
        <ul class="nav-links">
          <li><a href="../PHP/home.php">Search Flights</a></li>
          <li><a href="../PHP/aircraft.php">Plan Rental</a></li>
          <li><a href="../PHP/aboutUs.php">About Us</a></li>
          <?php
          if (isset($_SESSION['user_id'])) {
            echo "<li><a href=\"../PHP/Profile.php\">Profile</a></li>";
            if ($_SESSION['admin_id'] == 1) {
              echo "<li><a href=\"home.php\">Admin</a></li>";
            }
            echo "<li><a href=\"../PHP/Logout.php\">Logout</a></li>";
          } else {
            echo "<li><a href=\"../PHP/Login.php\">Log In</a></li>
                          <li id=\"sign-in\"><a href=\"../PHP/Registration.php\">Sign In</a></li>";
          }

          ?>
        </ul>
      </div>
    </nav>
  </header>






  <section class="corps">
    <section class="head">
      <button class="button clicked" id="bouton_flights">FLIGHTS</button>
      <button class="button" id="bouton_bookings">BOOKINGS</button>
      <button class="button" id="bouton_rent_bookings">PLANNED RENTALS</button>
      <button class="button" id="bouton_commercial_planes">COMMERCIAL PLANES</button>
      <button class="button" id="bouton_planes_rent">RENTAL PLANES</button>
      <button class="button" id="bouton_locations">LOCATIONS</button>
      <button class="button" id="bouton_cities">CITIES</button>
      <button class="button" id="bouton_airports">AIRPORTS</button>
      <button class="button" id="bouton_users">USERS</button>
    </section>







    <div class="management" id="page_flights" style="display: block;">
      <div class="header-container">
        <h2>FLIGHTS TABLE</h2>
        <div class="search-container">
          <select id="searchColumn"></select>
          <input type="text" id="searchInput" name="search"
            onkeyup="searchTable('flightTable', 'searchInput', 'searchColumn')" placeholder="       Search...">
          <span class="search-icon" id="search-icon_flights">&#128269;</span>
        </div>
      </div>
      <button id="add_butt_flight" class="add_butt">CLICK TO ADD A FLIGHT</button>

      <div class="adding" id="add_flights" style="display: none;">
        <form method="post" action="add.php">
          <input type="hidden" name="form_type" value="add_idflight">
          <h1>ADD A FLIGHT</h1>
          <div class="col">
            <table class="addtab">

              <tbody>
                <tr>
                  <td><label for="plane_id">ID de l'avion:</label></td>
                  <td><input type="number" id="plane_id" name="plane_id" required></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>
                <tr>
                  <td><label for="airline">Compagnie aérienne:</label></td>
                  <td><input type="text" id="airline" name="airline" required></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>
                <tr>
                  <td><label for="flight_number">Numéro de vol:</label></td>
                  <td><input type="text" id="flight_number" name="flight_number" required></td>

                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>
                <tr>
                  <td><label for="departure_airport">Aéroport de départ:</label></td>
                  <td><input type="number" id="departure_airport" name="departure_airport" required></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->

                </tr>
                <tr>
                  <td><label for="arrival_airport">Aéroport d'arrivée:</label></td>
                  <td><input type="number" id="arrival_airport" name="arrival_airport" required></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->

                </tr>
                <tr>
                  <td><label for="departure_datetime">Date et heure de départ:</label></td>
                  <td><input type="datetime-local" id="departure_datetime" name="departure_datetime" required></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->

                </tr>
                <tr>
                  <td><label for="arrival_datetime">Date et heure d'arrivée :</label></td>
                  <td><input type="datetime-local" id="arrival_datetime" name="arrival_datetime" required></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>
                <!-- Ajoutez autant de lignes que nécessaire -->
              </tbody>
            </table>


          </div>

          <div class="col">
            <table class="addtab">

              <tbody>
                <tr>
                  <td><label for="flight_duration">Durée du vol :</label></td>
                  <td><input type="time" id="flight_duration" name="flight_duration"></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->

                </tr>
                <tr>
                  <td><label for="flight_status">Statut du vol :</label></td>
                  <td><label for="flight_status">Statut du vol :</label>
                    <select id="flight_status" name="flight_status">
                      <option value="scheduled">Scheduled</option>
                      <option value="ongoing">Ongoing</option>
                      <option value="delayed">Delayed</option>
                      <option value="cancelled">Cancelled</option>
                      <option value="completed">Completed</option>
                    </select>
                  </td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>

                <tr>
                  <td><label for="ticket_price">Prix du billet :</label></td>
                  <td><input type="number" id="ticket_price" name="ticket_price" step="0.01"></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>

                <tr>
                  <td><label for="available_seats">Places disponibles :</label></td>
                  <td><input type="number" id="available_seats" name="available_seats"></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>

                <tr>
                  <td><label for="stopover_info">Informations sur les escales :</label></td>
                  <td><textarea id="stopover_info" name="stopover_info"></textarea></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>

                <!-- Ajoutez autant de lignes que nécessaire -->
              </tbody>
            </table>


          </div>
          </br>

          <button type='reset' onclick="ferme('add_flights')" class='can b_ref_flight'>CANCEL</button>
          <button type='submit' value="ajouter" onclick="ferme('add_flights');" class="conf b_add_flight">ADD</button>

        </form>

      </div>
      <table id='flightTable'>
        <tr>
          <th style="width: 90px; min-height: 50px;">Flight ID</th>
          <th style="width: 150px; min-height: 50px;">Plane</th>
          <th style="width: 115px; min-height: 50px;">Airline</th>
          <th style="width: 102px; min-height: 50px;">Flight Number</th>
          <th style="width: 150px; min-height: 50px;">Departure Airport</th>
          <th style="width: 150px; min-height: 50px;">Arrival Airport</th>
          <th style="width: 108px; min-height: 50px;">Departure Datetime</th>
          <th style="width: 104px; min-height: 50px;">Arrival Datetime</th>
          <th style="width: 104px; min-height: 50px;">Flight Duration</th>
          <th style="width: 107px; min-height: 50px;">Flight Status</th>
          <th style="width: 97px; min-height: 50px;">Ticket Price</th>
          <th style="width: 104px; min-height: 50px;">Available Seats</th>
          <th style="width: 112px; min-height: 50px;">Stopover Info</th>
          <th style="width: 102px; min-height: 50px;">Created At</th>
          <th>Action</th>
        </tr>

        <?php
        try {


          // Requête SQL pour récupérer les enregistrements de la table Flights avec les informations supplémentaires
          $sql = "SELECT f.flight_id, p.model, f.airline, f.flight_number,
          dep.airport_name AS departure_airport, arr.airport_name AS arrival_airport,
          f.departure_datetime, f.arrival_datetime, f.flight_duration,
          f.flight_status, f.ticket_price, f.available_seats, f.stopover_info, f.created_at
          FROM Flights f
          INNER JOIN Commercial_plane p ON f.plane_id = p.plane_id
          INNER JOIN Airports dep ON f.departure_airport = dep.airport_id
          INNER JOIN Airports arr ON f.arrival_airport = arr.airport_id
          ORDER BY f.flight_id";
          $stmt = $base->query($sql);

          // Si la requête renvoie des résultats
          if ($stmt->rowCount() > 0) {
            // Parcourir chaque ligne de résultats
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              // Afficher chaque enregistrement dans une ligne de tableau
              echo "<tr>";
              foreach ($row as $value) {
                echo "<td>" . $value . "</td>";
              }
              echo "<td>
              <form method='post' action='delete.php'>
                  <input type='hidden' name='delete_id' value='" . $row['flight_id'] . "'>
                  <button type='button' onclick='showConfirmation(this)' class='deleteBtn'>Delete</button>
                  <div id='confirmation' class='confirmation'>
            <img class='not' src='../image/war.png' />
            <h2>WARNING</h2>
            <p>Do you really want to delete this record ? This process cannot be undone.</p>
            <button type='submit' name='confirm_delete' class='conf'>YES</button>
            <button type='button' onclick='hideConfirmation(this)' class='can'>CANCEL</button>
          </div>
              </form>
          </td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='15'>No data found</td></tr>";
          }
        } catch (PDOException $e) {
          echo "Erreur : " . $e->getMessage();
        }


        if (isset($_POST['delete_id'])) {
          // Récupérer l'identifiant de l'aéroport à supprimer
          $flight_id = $_POST['delete_id'];

          // Requête de suppression
          $query = "DELETE FROM Flights WHERE flight_id = :flight_id";
          $statement = $base->prepare($query);
          $statement->bindParam(':flight_id', $flight_id, PDO::PARAM_INT);

          // Exécuter la requête de suppression
          if ($statement->execute()) {
            // Rediriger ou afficher un message de succès
            header("Location: home.php");
            exit();
          } else {
            echo "Error delete failled.";
          }
        }

        ?>
      </table>


    </div>








    <div class="management" id="page_bookings" style="display: none;">
      <div class="header-container">
        <h2>BOOKINGS</h2>
        <div class="search-container">
          <select id="searchBookings"></select>
          <input type="text" id="searchInputBookings" name="search"
            onkeyup="searchTable('bookingsTable', 'searchInputBookings', 'searchBookings')"
            placeholder="       Search...">
          <span class="search-icon" id="search-icon_bookings">&#128269;</span>
        </div>
      </div>


      <button id="add_butt_booking" class="add_butt">CLICK TO ADD A RENTAL BOOKING</button>
      <div class="adding" id="add_BOOKING" style="display: none;">



        <form method="post" action="add.php">
          <input type="hidden" name="form_type" value="add_idbooking">
          <h1>ADD A RENTAL BOOKING</h1>
          <div class="col">
            <table class="addtab">


              <tbody>
                <tr>
                  <td><label for="user_id">User ID:</label></td>
                  <td><input type="number" id="user_id" name="user_id"></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>
                <tr>


                  <td><label for="departure_flight_id">Departure Flight ID:</label></td>
                  <td><input type="number" id="departure_flight_id" name="departure_flight_id"></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>
                <tr>
                  <td><label for="return_flight_id">Return Flight ID:</label></td>
                  <td><input type="number" id="return_flight_id" name="return_flight_id"></td>

                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>
                <tr>

                  <td><label for="number_of_passengers">Number of Passengers:</label></td>
                  <td><input type="number" id="number_of_passengers" name="number_of_passengers" required></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->

                </tr>
                <tr>
                  <td><label for="status">Status:</label></td>
                  <td><select id="status" name="status">
                      <option value="Confirmed">Confirmed</option>
                      <option value="Cancelled">Cancelled</option>
                    </select></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->

                </tr>
                <tr>
                  <td><label for="price">Price:</label></td>
                  <td><input type="text" id="price" name="price"></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->

                </tr>
                <tr>
                  <td><label for="departure_seat">Departure Seat:</label></td>
                  <td><input type="text" id="departure_seat" name="departure_seat"></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>

                <tr>
                  <td><label for="return_seat">Return Seat:</label></td>
                  <td><input type="text" id="return_seat" name="return_seat"></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->

                </tr>
                <tr>
                  <td><label for="email">Email:</label></td>
                  <td><input type="email" id="email" name="email" required></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>


                <!-- Ajoutez autant de lignes que nécessaire -->
              </tbody>
            </table>


          </div>

          <div class="col">
            <table class="addtab">




              <tbody>
                <tr>
                  <td><label for="phone">Phone:</label></td>
                  <td><input type="text" id="phone" name="phone" required></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>

                <tr>
                  <td> <label for="skypriority">SkyPriority:</label></td>
                  <td> <input type="checkbox" id="skypriority" name="skypriority" value="1"></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>

                <tr>
                  <td> <label for="lounge_access">Lounge Access:</label></td>
                  <td> <input type="checkbox" id="lounge_access" name="lounge_access" value="1"></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>


                <tr>
                  <td><label for="checked_baggage">Checked Baggage:</label></td>
                  <td><input type="number" id="checked_baggage" name="checked_baggage"></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>

                <tr>
                  <td><label for="cabin_baggage">Cabin Baggage:</label></td>
                  <td><input type="number" id="cabin_baggage" name="cabin_baggage"></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>

                <tr>
                  <td><label for="refundable">Refundable:</label></td>
                  <td><input type="checkbox" id="refundable" name="refundable" value="1"></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>

                <tr>
                  <td><label for="front_seats">Front Seats:</label></td>
                  <td><input type="checkbox" id="front_seats" name="front_seats" value="1"></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>

                <tr>
                  <td><label for="insurance">Insurance:</label></td>
                  <td><input type="checkbox" id="lounge_access" name="lounge_access" value="1"></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>

                <tr>
                  <td><label for="class">Class:</label></td>
                  <td><select id="class" name="class" required>
                      <option value="1">Business</option>
                      <option value="0">Economy</option>
                    </select></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>

                <!-- Ajoutez autant de lignes que nécessaire -->
              </tbody>
            </table>

          </div>
          </br>

          <button type='reset' onclick="ferme('add_BOOKING')" class='can b_ref_flight'>CANCEL</button>
          <button type='submit' value="ajouter" onclick="ferme('add_BOOKING');" class="conf b_add_flight">ADD</button>

        </form>




      </div>


      <table id="bookingsTable">
        <tr>
          <th>Booking ID</th>
          <th>User</th>
          <th>Departure Flight</th>
          <th>Return Flight</th>
          <th>Booking Date</th>
          <th>Number of Passengers</th>
          <th>Status</th>
          <th>Price</th>
          <th>Departure seats</th>
          <th>Return seats</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Sky Priority</th>
          <th>Checked Baggage</th>
          <th>Cabin Baggage</th>
          <th>Cabin Baggage Return</th>
          <th>Refundable</th>
          <th>Front Seats</th>
          <th>Insurance</th>
          <th>Class</th>
          <th>Action</th>
        </tr>

        <?php
        try {





          // Requête SQL pour récupérer les enregistrements de la table booking_flight avec les informations utilisateur et vols correspondantes
          $requete = "SELECT bf.booking_id, u.username, u.email, bf.departure_flight_id, bf.return_flight_id, bf.booking_date, bf.number_of_passengers, bf.status, bf.price, bf.departure_seat, bf.return_seat, bf.email, bf.phone, bf.skypriority, bf.lounge_access, bf.checked_baggage, bf.cabin_baggage, bf.refundable, bf.front_seats, bf.insurance, bf.class
              FROM booking_flight bf
              INNER JOIN Users u ON bf.user_id = u.user_id";
          $resultat = $base->query($requete);

          // Si la requête renvoie des résultats
          if ($resultat->rowCount() > 0) {
            // Parcourir chaque ligne de résultats
            while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
              echo "<tr>";
              // Affichage des données dans les colonnes du tableau
              echo "<td>" . $row['booking_id'] . "</td>";
              echo "<td>" . $row['username'] . " (" . $row['email'] . ")</td>";
              echo "<td>" . $row['departure_flight_id'] . "</td>";
              echo "<td>" . $row['return_flight_id'] . "</td>";
              echo "<td>" . $row['booking_date'] . "</td>";
              echo "<td>" . $row['number_of_passengers'] . "</td>";
              echo "<td>" . $row['status'] . "</td>";
              echo "<td>" . $row['price'] . "</td>";
              echo "<td>" . $row['departure_seat'] . "</td>";
              echo "<td>" . $row['return_seat'] . "</td>";
              echo "<td>" . $row['email'] . "</td>";
              echo "<td>" . $row['phone'] . "</td>";
              echo "<td>" . $row['skypriority'] . "</td>";
              echo "<td>" . $row['lounge_access'] . "</td>";
              echo "<td>" . $row['checked_baggage'] . "</td>";
              echo "<td>" . $row['cabin_baggage'] . "</td>";
              echo "<td>" . $row['refundable'] . "</td>";
              echo "<td>" . $row['front_seats'] . "</td>";
              echo "<td>" . $row['insurance'] . "</td>";
              echo "<td>" . $row['class'] . "</td>";
              echo "<td>
              <form method='post' action='delete.php'>
                  <input type='hidden' name='delete_idBooking' value='" . $row['booking_id'] . "'>
                  <button type='button' onclick='showConfirmation(this)' class='deleteBtn'>Delete</button>
                  <div id='confirmation' class='confirmation'>
            <img class='not' src='../image/war.png' />
            <h2>WARNING</h2>
            <p>Do you really want to delete this record ? This process cannot be undone.</p>
            <button type='submit' name='confirm_delete' class='conf'>YES</button>
            <button type='button' onclick='hideConfirmation(this)' class='can'>CANCEL</button>
          </div>
              </form>
          </td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='22'>Aucune donnée trouvée</td></tr>";
          }
        } catch (PDOException $e) {
          echo "Erreur : " . $e->getMessage();
        }
        ?>
      </table>


    </div>

    <div class="management" id="page_rent_bookings" style="display: none;">
      <div class="header-container">
        <h2>RENTALS TABLE</h2>
        <div class="search-container">
          <select id="searchRentBook"></select>
          <input type="text" id="searchInputRentBook" name="search"
            onkeyup="searchTable('rentBookingsTable', 'searchInputRentBook', 'searchRentBook')"
            placeholder="       Search...">
          <span class="search-icon" id="search-iconRentBook">&#128269;</span>
        </div>
      </div>





      <button id="add_butt_rentbooking" class="add_butt">CLICK TO ADD A BOOKING</button>
      <div class="adding" id="add_rentbook" style="display: none;">
        <form method="post" action="add.php">
          <input type="hidden" name="form_type" value="add_idrentbooking">
          <h1>ADD A RENTAL BOOKING</h1>
          <div class="col">
            <table class="addtab">


              <tbody>
                <tr>
                  <td><label for="plane_id">Plane ID:</label></td>
                  <td><input type="number" id="plane_id" name="plane_id" required></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>
                <tr>
                  <td><label for="customer_id">Customer ID:</label></td>
                  <td><input type="number" id="customer_id" name="customer_id" required></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>
                <tr>
                  <td><label for="rental_date">Rental Date:</label></td>
                  <td><input type="date" id="rental_date" name="rental_date" required></td>

                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>
                <tr>
                  <td><label for="rental_time">Rental Time:</label></td>
                  <td><input type="time" id="rental_time" name="rental_time" required></td>
                </tr>

                <tr>
                  <td><label for="departure_location">Departure Location:</label></td>
                  <td><input type="number" id="departure_location" name="departure_location" required></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->

                </tr>
                <!-- Ajoutez autant de lignes que nécessaire -->
              </tbody>
            </table>


          </div>

          <div class="col">
            <table class="addtab">

              <tbody>

                <tr>
                  <td><label for="arrival_location">Arrival Location:</label></td>
                  <td><input type="number" id="arrival_location" name="arrival_location" required></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>

                <tr>
                  <td><label for="total_price">Total Price:</label></td>
                  <td><input type="number" id="total_price" name="total_price" required></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>

                <tr>
                  <td><label for="status">Status:</label></td>
                  <td><select id="status" name="status" required>
                      <option value="confirmed">Confirmed</option>
                      <option value="pending">Pending</option>
                      <option value="canceled">Canceled</option>
                    </select></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>

                <tr>
                  <td><label for="notes">Notes:</label></td>
                  <td><textarea id="notes" name="notes"></textarea></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>

                <!-- Ajoutez autant de lignes que nécessaire -->
              </tbody>
            </table>


          </div>
          </br>

          <button type='reset' onclick="ferme('add_rentbook')" class='can b_ref_flight'>CANCEL</button>
          <button type='submit' value="ajouter" onclick="ferme('add_rentbook');" class="conf b_add_flight">ADD</button>

        </form>

      </div>



      <table id="rentBookingsTable">
        <tr>
          <th>Booking ID</th>
          <th>Plane</th>
          <th>Manufacturer</th>
          <th>Customer Name</th>
          <th>Rental Date</th>
          <th>Rental Time</th>
          <th>Departure Location</th>
          <th>Arrival Location</th>
          <th>Total Price</th>
          <th>Status</th>
          <th>Notes</th>
          <th>Action</th>
        </tr>

        <?php
        try {


          // Requête pour sélectionner toutes les lignes de la table Bookings avec les informations de client, d'avion et de lieu
          $query = "SELECT
              b.booking_id,
              rp.manufacturer,
              rp.model,
              u.username as customer_name,
              b.rental_date as booking_date,
              b.rental_time as rental_time,
              dep.location_name as departure_location,
              arr.location_name as arrival_location,
              b.total_price,
              b.status_s as status,
              b.notes
          FROM
              bookings b
          LEFT JOIN
              Rental_planes rp ON b.plane_id = rp.rental_id
          LEFT JOIN
              Users u ON b.customer_id = u.user_id
          LEFT JOIN
              Locations dep ON b.departure_location = dep.location_id
          LEFT JOIN
              Locations arr ON b.arrival_location = arr.location_id";
          $statement = $base->query($query);


          // Si des lignes sont retournées
          if ($statement->rowCount() > 0) {
            // Parcourir chaque ligne de résultats
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
              echo "<tr>";
              // Afficher chaque valeur de colonne dans une cellule de tableau
              foreach ($row as $key => $value) {
                echo "<td>";
                // Si la colonne est "manufacturer" ou "model", afficher le nom de l'avion
                if ($key == "manufacturer") {
                  echo htmlspecialchars($row["manufacturer"]);
                } elseif ($key == "model") {
                  echo htmlspecialchars($row["model"]);
                } else {
                  echo htmlspecialchars($value);
                }
                echo "</td>";
              }
              echo "<td>
      <form method='post' action='delete.php'>
          <input type='hidden' name='delete_idBookingrent' value='" . $row['booking_id'] . "'>
          <button type='button' onclick='showConfirmation(this)' class='deleteBtn'>Delete</button>
          <div id='confirmation' class='confirmation'>
              <img class='not' src='../image/war.png' />
              <h2>WARNING</h2>
              <p>Do you really want to delete this record? This process cannot be undone.</p>
              <button type='submit' name='confirm_delete' class='conf'>YES</button>
              <button type='button' onclick='hideConfirmation(this)' class='can'>CANCEL</button>
          </div>
      </form>
      </td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='12'>Aucune donnée trouvée</td></tr>";
          }
        } catch (PDOException $e) {
          echo "Erreur: " . $e->getMessage();
        }
        ?>


      </table>


    </div>

    <div class="management" id="page_commercial_planes" style="display: none;">
      <div class="header-container">
        <h2>COMMERCIAL PLANES TABLE</h2>
        <div class="search-container">
          <select id="searchCommercial"></select>
          <input type="text" id="searchInputCommercial" name="search"
            onkeyup="searchTable('commercialTable', 'searchInputCommercial', 'searchCommercial')"
            placeholder="       Search...">
          <span class="search-icon" id="search-iconCommercial">&#128269;</span>
        </div>
      </div>



      <button id="add_butt_plane" class="add_butt">CLICK TO ADD A COMMERCIAL PLANE</button>
      <div class="adding" id="add_plane" style="display: none;">
        <form method="post" action="add.php">
          <input type="hidden" name="form_type" value="add_idplane">
          <h1>ADD A COMMERCIAL PLANE</h1>
          <div class="col">
            <table class="addtab">



              <tbody>
                <tr>
                  <td><label for="manufacturer">Manufacturer:</label></td>
                  <td> <input type="text" id="manufacturer" name="manufacturer" required></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>
                <tr>
                  <td><label for="year_of_manufacture">Year of Manufacture:</label></td>
                  <td><input type="number" id="year_of_manufacture" name="year_of_manufacture"></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>
                <tr>
                  <td><label for="model">Model:</label></td>
                  <td><input type="text" id="model" name="model" required></td>

                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>
                <tr>
                  <td><label for="registration_number">Registration Number:</label></td>
                  <td><input type="text" id="registration_number" name="registration_number"></td>
                </tr>

                <!-- Ajoutez autant de lignes que nécessaire -->
              </tbody>
            </table>


          </div>

          <div class="col">
            <table class="addtab">

              <tbody>


                <tr>
                  <td><label for="maximum_capacity">Maximum Capacity:</label></td>
                  <td><input type="number" id="maximum_capacity" name="maximum_capacity" required></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>

                <tr>
                  <td><label for="availability_status">Availability Status:</label></td>
                  <td><select id="availability_status" name="availability_status">
                      <option value="available">Available</option>
                      <option value="booked">Booked</option>
                      <option value="maintenance">Maintenance</option>
                    </select></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>

                <tr>
                  <td><label for="maintenance_history">Maintenance History:</label></td>
                  <td><textarea id="maintenance_history" name="maintenance_history"></textarea></td>
                  <!-- Ajoutez autant de cellules de données que nécessaire pour chaque ligne -->
                </tr>

                <!-- Ajoutez autant de lignes que nécessaire -->
              </tbody>
            </table>


          </div>

          <button type='reset' onclick="ferme('add_plane')" class='can b_ref_flight'>CANCEL</button>
          <button type='submit' value="ajouter" onclick="ferme('add_plane');" class="conf b_add_flight">ADD</button>

        </form>

      </div>


      <table id="commercialTable">
        <tr>
          <th>Plane ID</th>
          <th>Manufacturer</th>
          <th>Year of Manufacture</th>
          <th>Model</th>
          <th>Registration Number</th>
          <th>Maximum Capacity</th>
          <th>Availability Status</th>
          <th>Maintenance History</th>
          <th>Created At</th>
          <th>Action</th>
        </tr>

        <?php
        try {



          // Query to retrieve records from the Commercial_plane table
          $query = "SELECT * FROM Commercial_plane";
          $statement = $base->query($query);

          // If there are rows returned
          if ($statement->rowCount() > 0) {
            // Loop through each row of results
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
              echo "<tr>";
              // Output each column value in a table cell
              foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";


              }

              echo "<td>
              <form method='post' action='delete.php'>
        <input type='hidden' name='delete_idplane' value='" . $row['plane_id'] . "'>
        <button type='button' onclick='showConfirmation(this)' class='deleteBtn'>Delete</button>

            <div id='confirmation' class='confirmation'>
            <img class='not' src='../image/war.png' />
            <h2>WARNING</h2>
            <p>Do you really want to delete this record ? This process cannot be undone.</p>
            <button type='submit' name='confirm_delete' class='conf'>YES</button>
            <button type='button' onclick='hideConfirmation(this)' class='can'>CANCEL</button>
          </div>


    </form>
</td>";




              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='10'>No data found</td></tr>";
          }
        } catch (PDOException $e) {
          echo "Erreur : " . $e->getMessage();
        }
        ?>

      </table>

    </div>


    <div class="management" id="page_planes_rent" style="display: none;">
      <div class="header-container">
        <h2>RENTAL PLANES TABLE</h2>
        <div class="search-container">
          <select id="searchPlaneRent"></select>
          <input type="text" id="searchInputPlanerent" name="search"
            onkeyup="searchTable('rentalPlanesTable', 'searchInputPlanerent', 'searchPlaneRent')"
            placeholder="       Search...">
          <span class="search-icon" id="search-iconPlaneRent">&#128269;</span>
        </div>
      </div>




      <button id="add_butt_rentplane" class="add_butt">CLICK TO ADD A RENTAL PLANE</button>
      <div class="adding" id="add_rentplane" style="display: none;">
        <form method="post" action="add.php">
          <input type="hidden" name="form_type" value="add_idrentplane">
          <h1>ADD A COMMERCIAL PLANE</h1>
          <div class="col">
            <table class="addtab">

              <tbody>
                <tr>
                  <td><label for="manufacturer">Manufacturer:</label></td>
                  <td><input type="text" id="manufacturer" name="manufacturer" required></td>
                </tr>
                <tr>
                  <td><label for="model">Model:</label></td>
                  <td><input type="text" id="model" name="model" required></td>
                </tr>
                <tr>
                  <td><label for="year_of_manufacture">Year of Manufacture:</label></td>
                  <td><input type="number" id="year_of_manufacture" name="year_of_manufacture"></td>
                </tr>
                <tr>
                  <td><label for="registration_number">Registration Number:</label></td>
                  <td><input type="text" id="registration_number" name="registration_number" required></td>
                </tr>
                <tr>
                  <td><label for="maximum_capacity">Maximum Capacity:</label></td>
                  <td><input type="number" id="maximum_capacity" name="maximum_capacity" required></td>
                </tr>
                <tr>
                  <td><label for="maximum_range">Maximum Range:</label></td>
                  <td><input type="number" id="maximum_range" name="maximum_range"></td>
                </tr>
                <tr>
                  <td><label for="rental_price_per_hour">Rental Price Per Hour:</label></td>
                  <td><input type="number" id="rental_price_per_hour" name="rental_price_per_hour" step="0.01" required>
                  </td>
                </tr>
                <tr>
                  <td><label for="availability_status">Availability Status:</label></td>
                  <td>
                    <select id="availability_status" name="availability_status">
                      <option value="available">Available</option>
                      <option value="booked">Booked</option>
                      <option value="maintenance">Maintenance</option>
                    </select>
                  </td>
                </tr>
                <!-- Ajoutez autant de lignes que nécessaire -->
              </tbody>
            </table>


          </div>

          <div class="col">
            <table class="addtab">

              <tbody>


                <tr>
                  <td><label for="maintenance_history">Maintenance History:</label></td>
                  <td><textarea id="maintenance_history" name="maintenance_history"></textarea></td>
                </tr>
                <tr>
                  <td><label for="features">Features:</label></td>
                  <td><textarea id="features" name="features"></textarea></td>
                </tr>
                <tr>
                  <td><label for="description">Description:</label></td>
                  <td><textarea id="description" name="description"></textarea></td>
                </tr>
                <tr>
                  <td><label for="detailed_description">Detailed Description:</label></td>
                  <td><textarea id="detailed_description" name="detailed_description"></textarea></td>
                </tr>
                <tr>
                  <td><label for="rating">Rating:</label></td>
                  <td><input type="number" id="rating" name="rating" step="0.1"></td>
                </tr>
                <tr>
                  <td><label for="number_of_reviews">Number of Reviews:</label></td>
                  <td><input type="number" id="number_of_reviews" name="number_of_reviews"></td>
                </tr>
                <tr>
                  <td><label for="image_path">Image Path:</label></td>
                  <td><input type="text" id="image_path" name="image_path"></td>
                </tr>

                <!-- Ajoutez autant de lignes que nécessaire -->
              </tbody>
            </table>


          </div>
          <button type='reset' onclick="ferme('add_rentplane')" class='can b_ref_flight'>CANCEL</button>
          <button type='submit' value="ajouter" onclick="ferme('add_rentplane');" class="conf b_add_flight">ADD</button>

        </form>

      </div>





      <table id="rentalPlanesTable">
        <tr>
          <th>Rental ID</th>
          <th>Manufacturer</th>
          <th>Model</th>
          <th>Year of Manufacture</th>
          <th>Registration Number</th>
          <th>Maximum Capacity</th>
          <th>Maximum Range</th>
          <th>Rental Price per Hour</th>
          <th>Availability Status</th>
          <th>Maintenance History</th>
          <th>Features</th>
          <th>Description</th>
          <th>Detailed Description</th>
          <th>Rating</th>
          <th>Number of Reviews</th>
          <th>Image Path</th>
          <th>Created At</th>
          <th>Updated At</th>
          <th>Base Location</th>
          <th>Action</th>
        </tr>

        <?php
        try {


          // Query to retrieve records from the Rental_planes table with associated base location name
          $query = "SELECT rp.*, l.location_name AS base_location
              FROM Rental_planes rp
              LEFT JOIN Locations l ON rp.base_location = l.location_id";

          // Executing the query
          $statement = $base->query($query);

          // Fetching the result set as an associative array
          $result = $statement->fetchAll(PDO::FETCH_ASSOC);

          // If there are rows returned
          if (count($result) > 0) {
            // Loop through each row of results
            foreach ($result as $row) {
              // Display each record in a table row
              echo "<tr>";
              foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
              }
              echo "<td>
      <form method='post' action='delete.php'>
          <input type='hidden' name='delete_idBookingrentplane' value='" . $row['rental_id'] . "'>
          <button type='button' onclick='showConfirmation(this)' class='deleteBtn'>Delete</button>
          <div id='confirmation' class='confirmation'>
              <img class='not' src='../image/war.png' />
              <h2>WARNING</h2>
              <p>Do you really want to delete this record? This process cannot be undone.</p>
              <button type='submit' name='confirm_delete' class='conf'>YES</button>
              <button type='button' onclick='hideConfirmation(this)' class='can'>CANCEL</button>
          </div>
      </form>
      </td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='19'>No data found</td></tr>";
          }
        } catch (PDOException $e) {
          // Displaying error message if connection or query fails
          echo "<tr><td colspan='20'>Error: " . $e->getMessage() . "</td></tr>";
        }
        ?>

      </table>


    </div>


    <div class="management" id="page_locations" style="display: none;">
      <div class="header-container">
        <h2>LOCATIONS TABLE</h2>
        <div class="search-container">
          <select id="searchLocation"></select>
          <input type="text" id="searchInputLocation" name="search"
            onkeyup="searchTable('locationsTable', 'searchInputLocation', 'searchLocation')"
            placeholder="       Search...">
          <span class="search-icon" id="search-iconLocation">&#128269;</span>
        </div>
      </div>




      <button id="add_butt_location" class="add_butt">CLICK TO ADD A LOCATION</button>
      <div class="adding" id="add_location" style="display: none;">
        <form method="post" action="add.php">
          <input type="hidden" name="form_type" value="add_idlocation">
          <h1>ADD A LOCATION</h1>
          <div class="col">
            <table class="addtab">



              <tbody>
                <tr>
                  <td><label for="location_name">Location Name:</label></td>
                  <td><input type="text" id="location_name" name="location_name" required></td>
                </tr>
                <tr>
                  <td><label for="latitude">Latitude:</label></td>
                  <td><input type="number" id="latitude" name="latitude" step="any"></td>
                </tr>
                <tr>
                  <td><label for="longitude">Longitude:</label></td>
                  <td><input type="number" id="longitude" name="longitude" step="any"></td>
                </tr>
                <tr>
                  <td><label for="country">Country:</label></td>
                  <td><input type="text" id="country" name="country"></td>
                </tr>

                <!-- Ajoutez autant de lignes que nécessaire -->
              </tbody>
            </table>


          </div>

          <div class="col">
            <table class="addtab">

              <tbody>


                <tr>
                  <td><label for="city">City:</label></td>
                  <td><input type="text" id="city" name="city"></td>
                </tr>
                <tr>
                  <td><label for="airport_code">Airport Code:</label></td>
                  <td><input type="text" id="airport_code" name="airport_code"></td>
                </tr>
                <tr>
                  <td><label for="description">Description:</label></td>
                  <td><textarea id="description" name="description"></textarea></td>
                </tr>

                <!-- Ajoutez autant de lignes que nécessaire -->
              </tbody>
            </table>


          </div>
          <button type='reset' onclick="ferme('add_location')" class='can b_ref_flight'>CANCEL</button>
          <button type='submit' value="ajouter" onclick="ferme('add_location');" class="conf b_add_flight">ADD</button>

        </form>

      </div>




      <table id="locationsTable">
        <tr>
          <th>Location ID</th>
          <th>Location Name</th>
          <th>Latitude</th>
          <th>Longitude</th>
          <th>Country</th>
          <th>City</th>
          <th>Airport Code</th>
          <th>Description</th>
          <th>Action</th>
        </tr>

        <?php
        try {

          // Query to retrieve records from the Locations table
          $query = "SELECT * FROM Locations";

          // Executing the query
          $statement = $base->query($query);

          // Fetching the result set as an associative array
          $result = $statement->fetchAll(PDO::FETCH_ASSOC);

          // If there are rows returned
          if (count($result) > 0) {
            // Loop through each row of results
            foreach ($result as $row) {
              // Display each record in a table row
              echo "<tr>";
              foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
              }
              echo "<td>
      <form method='post' action='delete.php'>
          <input type='hidden' name='delete_idlocation' value='" . $row['location_id'] . "'>
          <button type='button' onclick='showConfirmation(this)' class='deleteBtn'>Delete</button>
          <div id='confirmation' class='confirmation'>
              <img class='not' src='../image/war.png' />
              <h2>WARNING</h2>
              <p>Do you really want to delete this record? This process cannot be undone.</p>
              <button type='submit' name='confirm_delete' class='conf'>YES</button>
              <button type='button' onclick='hideConfirmation(this)' class='can'>CANCEL</button>
          </div>
      </form>
      </td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='8'>No data found</td></tr>";
          }
        } catch (PDOException $e) {
          // Displaying error message if connection or query fails
          echo "<tr><td colspan='9'>Error: " . $e->getMessage() . "</td></tr>";
        }
        ?>

      </table>


    </div>


    <div class="management" id="page_cities" style="display: none;">
      <div class="header-container">
        <h2>CITIES TABLE</h2>
        <div class="search-container">
          <select id="searchcities"></select>
          <input type="text" id="searchInputCities" name="search"
            onkeyup="searchTable('citiesTable', 'searchInputCities', 'searchcities')" placeholder="       Search...">
          <span class="search-icon" id="search-iconCities">&#128269;</span>
        </div>
      </div>


      <button id="add_butt_city" class="add_butt">CLICK TO ADD A CITY</button>
      <div class="adding" id="add_city" style="display: none;">
        <form method="post" action="add.php">
          <input type="hidden" name="form_type" value="add_idcity">
          <h1>ADD A CITY</h1>
          <div class="col">
            <table class="addtab">

              <tbody>
                <tr>
                  <td><label for="city_name">City Name:</label></td>
                  <td><input type="text" id="city_name" name="city_name" required></td>
                </tr>

                <!-- Ajoutez autant de lignes que nécessaire -->
              </tbody>
            </table>


          </div>

          <div class="col">
            <table class="addtab">

              <tbody>


                <tr>
                  <td><label for="country">Country:</label></td>
                  <td><input type="text" id="country" name="country" required></td>
                </tr>

                <!-- Ajoutez autant de lignes que nécessaire -->
              </tbody>
            </table>


          </div>

          <button type='reset' onclick="ferme('add_city')" class='can b_ref_flight'>CANCEL</button>
          <button type='submit' value="ajouter" onclick="ferme('add_city');" class="conf b_add_flight">ADD</button>

        </form>

      </div>

      <table id="citiesTable">
        <tr>
          <th>City ID</th>
          <th>City Name</th>
          <th>Country</th>
          <th>Action</th>
        </tr>

        <?php
        try {

          // Query to retrieve records from the Cities table
          $query = "SELECT * FROM Cities";

          // Executing the query
          $statement = $base->query($query);

          // Fetching the result set as an associative array
          $result = $statement->fetchAll(PDO::FETCH_ASSOC);

          // If there are rows returned
          if (count($result) > 0) {
            // Loop through each row of results
            foreach ($result as $row) {
              // Display each record in a table row
              echo "<tr>";
              foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
              }
              echo "<td>
      <form method='post' action='delete.php'>
          <input type='hidden' name='delete_idcities' value='" . $row['city_id'] . "'>
          <button type='button' onclick='showConfirmation(this)' class='deleteBtn'>Delete</button>
          <div id='confirmation' class='confirmation'>
              <img class='not' src='../image/war.png' />
              <h2>WARNING</h2>
              <p>Do you really want to delete this record? This process cannot be undone.</p>
              <button type='submit' name='confirm_delete' class='conf'>YES</button>
              <button type='button' onclick='hideConfirmation(this)' class='can'>CANCEL</button>
          </div>
      </form>
      </td>";
            }
          } else {
            echo "<tr><td colspan='3'>No data found</td></tr>";
          }
        } catch (PDOException $e) {
          // Displaying error message if connection or query fails
          echo "<tr><td colspan='4'>Error: " . $e->getMessage() . "</td></tr>";
        }
        ?>

      </table>

    </div>


    <div class="management" id="page_airports" style="display: none;">
      <div class="header-container">
        <h2>AIRPORTS TABLE</h2>
        <div class="search-container">
          <select id="searchairports"></select>
          <input type="text" id="searchInputairport" name="search"
            onkeyup="searchTable('airportsTable', 'searchInputairport', 'searchairports')"
            placeholder="       Search...">
          <span class="search-icon" id="search-iconAirports">&#128269;</span>
        </div>
      </div>



      <button id="add_butt_airport" class="add_butt">CLICK TO ADD AN AIRPORT</button>
      <div class="adding" id="add_airport" style="display: none;">
        <form method="post" action="add.php">
          <input type="hidden" name="form_type" value="add_idairport">
          <h1>ADD AN AIRPORT</h1>
          <div class="col">
            <table class="addtab">

              <tbody>
                <tr>
                  <td><label for="airport_name">Airport Name:</label></td>
                  <td><input type="text" id="airport_name" name="airport_name" required></td>
                </tr>

                <!-- Ajoutez autant de lignes que nécessaire -->
              </tbody>
            </table>


          </div>


          <div class="col">
            <table class="addtab">

              <tbody>


                <tr>
                  <td><label for="city_id">City ID:</label></td>
                  <td><input type="number" id="city_id" name="city_id" required></td>
                </tr>

                <!-- Ajoutez autant de lignes que nécessaire -->
              </tbody>
            </table>


          </div>
          <button type='reset' onclick="ferme('add_airport')" class='can b_ref_flight'>CANCEL</button>
          <button type='submit' value="ajouter" onclick="ferme('add_airport');" class="conf b_add_flight">ADD</button>

        </form>

      </div>



      <table id="airportsTable">
        <tr>
          <th>Airport ID</th>
          <th>Airport Name</th>
          <th>City Name</th>
          <th>Action</th>
        </tr>

        <?php
        try {



          // Query to retrieve records from the Airports table with associated city name
          $query = "SELECT a.airport_id, a.airport_name, c.city_name
              FROM Airports a
              INNER JOIN Cities c ON a.city_id = c.city_id";
          $statement = $base->query($query);

          // If there are rows returned
          if ($statement->rowCount() > 0) {
            // Loop through each row of results
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
              // Display each record in a table row
              echo "<tr>";
              foreach ($row as $value) {
                echo "<td>" . $value . "</td>";
              }
              echo "<td>
      <form method='post' action='delete.php'>
          <input type='hidden' name='delete_idairport' value='" . $row['airport_id'] . "'>
          <button type='button' onclick='showConfirmation(this)' class='deleteBtn'>Delete</button>
          <div id='confirmation' class='confirmation'>
              <img class='not' src='../image/war.png' />
              <h2>WARNING</h2>
              <p>Do you really want to delete this record? This process cannot be undone.</p>
              <button type='submit' name='confirm_delete' class='conf'>YES</button>
              <button type='button' onclick='hideConfirmation(this)' class='can'>CANCEL</button>
          </div>
      </form>
      </td>";

              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='4'>No data found</td></tr>";
          }
        } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
        ?>

      </table>


    </div>


    <div class="management" id="page_users" style="display: none;">
      <div class="header-container">
        <h2>USERS TABLE</h2>
        <div class="search-container">
          <select id="searchusers"></select>
          <input type="text" id="searchInputUsers" name="search"
            onkeyup="searchTable('usersTable', 'searchInputUsers', 'searchusers')" placeholder="       Search...">
          <span class="search-icon" id="search-iconUsers">&#128269;</span>
        </div>
      </div>


      <button id="add_butt_user" class="add_butt">CLICK TO ADD AN USER</button>
      <div class="adding" id="add_user" style="display: none;">
        <form method="post" action="add.php">
          <input type="hidden" name="form_type" value="add_iduser">
          <h1>ADD AN USER</h1>
          <div class="col">
            <table class="addtab">

              <tbody>
                <tr>
                  <td><label for="nom">Nom d'utilisateur:</label></td>
                  <td><input type="text" id="nom" name="nom" required></td>
                </tr>

                <tr>
                  <td><label for="admin">Admin</label></td>
                  <td><input type="checkbox" id="admin" name="admin" value="1"></td>
                </tr>
                <!-- Ajoutez autant de lignes que nécessaire -->
              </tbody>
            </table>


          </div>


          <div class="col">
            <table class="addtab">

              <tbody>

                <tr>
                  <td><label for="password">Mot de passe:</label></td>
                  <td><input type="password" id="password" name="password" required></td>
                </tr>

                <!-- Ajoutez autant de lignes que nécessaire -->
              </tbody>
            </table>


          </div>
          <button type='reset' onclick="ferme('add_user')" class='can b_ref_flight'>CANCEL</button>
          <button type='submit' value="ajouter" onclick="ferme('add_user');" class="conf b_add_flight">ADD</button>

        </form>

      </div>



      <table id="usersTable">
        <tr>
          <th>User ID</th>
          <th>Username</th>
          <th>Email</th>
          <th>Password</th>
          <th>Admin ID</th>
          <th>Created At</th>
          <th>Action</th>
        </tr>

        <?php
        try {

          // Query to retrieve records from the Users table
          $query = "SELECT * FROM Users";
          $statement = $base->query($query);

          // If there are rows returned
          if ($statement->rowCount() > 0) {
            // Loop through each row of results
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
              // Display each record in a table row
              echo "<tr>";
              foreach ($row as $value) {
                echo "<td>" . $value . "</td>";
              }
              echo "<td>
      <form method='post' action='delete.php'>
          <input type='hidden' name='delete_iduser' value='" . $row['user_id'] . "'>
          <button type='button' onclick='showConfirmation(this)' class='deleteBtn'>Delete</button>
          <div id='confirmation' class='confirmation'>
              <img class='not' src='../image/war.png' />
              <h2>WARNING</h2>
              <p>Do you really want to delete this record? This process cannot be undone.</p>
              <button type='submit' name='confirm_delete' class='conf'>YES</button>
              <button type='button' onclick='hideConfirmation(this)' class='can'>CANCEL</button>
          </div>
      </form>
      </td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
          }
        } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
        ?>

      </table>


    </div>



  </section>

<!--
  INSERT INTO booking_flight (user_id, departure_flight_id, return_flight_id, booking_date, number_of_passengers, status, price, departure_seat, return_seat, email, phone, skypriority, lounge_access, checked_baggage, cabin_baggage, refundable, front_seats, insurance, class) VALUES
(2, 2, 3, '2024-05-11', 1, 'Confirmed', 910.00, 'B14', 'Z22', 'maadi_walid@yahoo.fr', '+33658168287', 0, 0, 1, 1, 0, 0, 2, 1);



INSERT INTO bookings (plane_id, customer_id, rental_date, rental_time, departure_location, arrival_location, total_price, status_s, notes) VALUES
(10, 2, '2024-05-02', '05:46:00', 1, 2, 3469.65, NULL, NULL),
(11, 2, '2024-05-02', '05:46:00', 1, 2, 3469.65, NULL, NULL);
-->



</body>
<script src="../js/admin.js"></script>

</html>
