<?php
session_start();
include 'Base.php';
global $base;
if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['username'];

}
else {

  $user_id = null;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Staff Airline</title>
    <style>

.bigsection2{
    margin-top: 500px;
    font-family: 'Arial', sans-serif;
    max-width: 100%;
    max-height: 100%
    margin: 20px auto;
    padding: 0px;
    border: 1px solid #ccc;
    border-radius: 10px;
}

.ticket {
    font-family: 'Arial', sans-serif;
    max-width: 75%;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
}
.head{

    display: flex;
    align-items: center;
    background-color:  #001d3d ;
    color: white;
}
.informations{
    font-family: 'Arial', sans-serif;
    max-width: 100%;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
}
.pub{
    font-family: 'Arial', sans-serif;
    max-width: 100%;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    color: white;
    background-color: #001d3d;
}
.pubtitle{
   text-align: center;
   color: while;
}
.passprt{
    text-align: justify;
}
.imPub{
    text-align: center;
    align-items: center;
    max-width: 100%;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    background-image: url(../Img/IMG_6310.JPG);
    background-repeat: no-repeat;
    color: transparent;
    height: 450px;
}
.justIt{
    text-align: center;
    color: white;
    background-color: #001d3d;
    color: white;
    border-radius: 10px;
    padding: 0.05%;
}
.foot{
    text-align: center;
    color: #001d3d;
    border-radius: 10px;
    padding: 0.05%;
}
.litllhead{
    margin-left: 10%;
    margin-right: 20%;
}
h2{
    color: #ffc300;
}
h4{
    align-items: center ;
}
.logo {
    margin-left: 20%;
    width: 120px;
    height: auto;
}

.foot{
    align-items: center;
    justify-content: center;
    text-align: center;
    display: flex;
}
.icon{
    padding: 5%;
}
button{
    border-radius: 10px;
    background-color: #001d3d ;
    text-align: center;
    align-items: center;
    color: white;
}
            body{
                font-family: 'Arial', sans-serif;
                max-width: 75%;
                margin: 20px auto;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 10px;
            }

            .ticket {
                font-family: 'Arial', sans-serif;
                max-width: 75%;
                margin: 20px auto;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 10px;
            }
            .head{

                display: flex;
                align-items: center;
                background-color:  #001d3d ;
                color: white;
            }
            .informations{
                font-family: 'Arial', sans-serif;
                max-width: 100%;
                margin: 20px auto;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 10px;
            }
            .pub{
                font-family: 'Arial', sans-serif;
                max-width: 100%;
                margin: 20px auto;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 10px;
                color: white;
                background-color: #001d3d;
            }
            .pubtitle{
               text-align: center;
               color: while;
            }
            .passprt{
                text-align: justify;
            }
            .imPub{
                text-align: center;
                align-items: center;
                max-width: 100%;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 10px;
                background-image: url(../Img/IMG_6310.JPG);
                background-repeat: no-repeat;
                color: transparent;
            }
            .justIt{
                text-align: center;
                color: white;
                background-color: #001d3d;
                color: white;
                border-radius: 10px;
                padding: 0.05%;
            }
            .foot{
                text-align: center;
                color: #001d3d;
                border-radius: 10px;
                padding: 0.05%;
            }
            .litllhead{
                margin-left: 10%;
                margin-right: 20%;
            }
            h2{
                color: #ffc300;
            }
            h4{
                align-items: ;
            }
            .logo {
                margin-left: 20%;
                width: 120px;
                height: auto;
            }
            .Codebar{
                margin-left: 20%;
                width: 10%;
                height: 10%;
            }
            .foot{
                align-items: center;
                justify-content: center;
                text-align: center;
                display: flex;
            }
            .icon{
                padding: 5%;
            }
            .qr-code {
                text-align: center;
                margin: 20px 0;
            }
            .info {
                margin-bottom: 20px;
            }
            .info div {
                margin-bottom: 10px;
            }
            .ad-section {
                background-color: #f0f0f0;
                padding: 10px;
                margin: 20px 0;
                text-align: center;
            }
        </style>

  </head>

  <body>
    <header>

            <?php

            $booking_id1 = $_GET['bookingf1_id'] ?? null;
            $booking_id2 = $_GET['bookingf2_id'] ?? null;
            $booking_id3 = $_GET['bookingr_id'] ?? null;

            if ($booking_id1 != null) {
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
            WHERE bf.booking_id = ?";
            $stmt = $base->prepare($query);
            $stmt->bindParam(1, $booking_id1);
            $stmt->execute();
            if (!$stmt) {
              echo "Error in SQL execution: " . htmlspecialchars($base->errorInfo()[2]);
              exit;
            }
            $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!$reservations) {
                echo "No bookings found for this user.";
            } else {
            }

            foreach ($reservations as $reservation):

              $aller1 = htmlspecialchars($reservation['departure_flight_number']);
              $aller2 = htmlspecialchars($reservation['departure_airport_name1']);
              $aller3 = htmlspecialchars($reservation['arrival_airport_name1']);
              $aller4 = htmlspecialchars($reservation['departure_datetime1']);
              $aller5 = htmlspecialchars($reservation['return_datetime1']);
              $aller7 = htmlspecialchars($reservation['departure_seat']);
              $aller8 = htmlspecialchars($reservation['insurance']);
              $aller9 = htmlspecialchars($reservation['class']);

            endforeach;
            ?>

            <div class="ticketFl">
            <section class="head">
                <div class="litllhead">
                    <p><h2>Staffs Airways</h2></p>
                    <p><b><?php echo $user_id; ?></b></p>
                </div>
                <div class="logo">
                    <img src="../image/aircraft-removebg-preview.png" alt="Airline Management Logo" class="logo">
                </div>
            </section>

            <section class="informations" style="font-size: 15px">
                <div style="display: flex">
                    <div style="display: flex">
                        <div style=" paadding: 100px">
                            <p><b>Flight:</b></p>  <p><?php echo $aller1; ?></p>
                            <p><b>From:</b></p>  <p><?php echo $aller2; ?></p>
                            <p><b>To:</b></p>  <p><?php echo $aller3; ?></p>
                            <p><b>Class:</b></p>  <p><?php echo $aller9; ?></p>

                        </div>
                        <div style="margin-left: 50%; margin-right: 30%; paadding: 100px">
                            <p><b>Departure:</b></p>  <p><?php echo $aller4; ?></p>
                            <p><b>Arrival:</b></p>  <p><?php echo $aller5; ?></p>
                            <p><b>Seat:</b></p>  <p><?php echo $aller7; ?></p>
                            <p><b>Insurance:</b></p>  <p><?php echo $aller8; ?></p>
                        </div>

                    </div>

                    <div style="margin-left: 30%;">
                        <h4 style="text-align: center; margin-left: 40%">SCAN THE FOLLOWING <br>BAR CODE TO PASS THE DOORS</h4>
                        <div class="Codebar" style="">
                            <img src="../Img/codebarre-removebg-preview.png" alt="CodeBar" width="400" height="110">
                        </div>

                    </div>
                </div>

                <div style="font-size: 12px">
                    <h4>Further information</h4>
                    <p>Please arrive 60-90 minutes before departure <br> The gate closes 30 minutes before departure <br></p>
                    <p>Exchangeable before departure of each journey by paying the difference with the next fare <br> available. Additional fees per person, per way apply for exchanges in <br> the 7 days of the original departure. Non refundable.</p>
                </div>

            </section>

            <section class="pub">
                <div class="pubtitle">
                    <h4>Important information</h4>
                </div>

                <div class="passprt">
                    <p><b>UK passport holders:</b> check your passport issue and expiry dates <br> <b>EU passport holders:</b> Passports are now compulsory for most passengers, including children, traveling to the UK <br><br> To find out more, visit our Travel documents page on  <a href="aboutUs.php"><strong><i>staffsAirways.com</i></strong></a></p>
                </div>
            </section>

            <section class="imPub">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum optio numquam voluptatibus asperiores. Eveniet error similique rem quo doloribus, voluptates odio reprehenderit hic dolorum dolore? Magnam tempore labore nesciunt deserunt.</p>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eveniet, corrupti eligendi, fugiat inventore temporibus laudantium ut praesentium porro voluptatum eum fugit ex adipisci velit architecto unde deserunt, quasi impedit molestiae.</p>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repudiandae deserunt incidunt voluptates voluptatibus, harum ex autem, dolor facilis illum officia, necessitatibus dolores! Est fuga quos, mollitia voluptatibus cumque quas suscipit!</p>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum optio numquam voluptatibus asperiores. Eveniet error similique rem quo doloribus, voluptates odio reprehenderit hic dolorum dolore? Magnam tempore labore nesciunt deserunt.</p>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eveniet, corrupti eligendi, fugiat inventore temporibus laudantium ut praesentium porro voluptatum eum fugit ex adipisci velit architecto unde deserunt, quasi impedit molestiae.</p>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repudiandae deserunt incidunt voluptates voluptatibus, harum ex autem, dolor facilis illum officia, necessitatibus dolores! Est fuga quos, mollitia voluptatibus cumque quas suscipit!</p>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum optio numquam voluptatibus asperiores. Eveniet error similique rem quo doloribus, voluptates odio reprehenderit hic dolorum dolore? Magnam tempore labore nesciunt deserunt.</p>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eveniet, corrupti eligendi, fugiat inventore temporibus laudantium ut praesentium porro voluptatum eum fugit ex adipisci velit architecto unde deserunt, quasi impedit molestiae.</p>
            </section>

            <section class="justIt">
                <h4>BEFORE LEAVING</h4>
            </section>

            <section class="foot">

                <div class="icon">
                    <img src="../Img/luggage-icon.jpg" alt="Capacity Icon" width="70" height="70" />
                    <p class="text-gray-600 mb-1">
                        <p><h4>Prepare your luggage</h4></p>
                        <p>You can take two bags and one handbag</p>
                    </p>
                </div>
                <div class="icon">
                    <img src="../Img/passport-icon.png" alt="Capacity Icon" width="70" height="70" />
                    <p class="text-gray-600 mb-1">
                        <p><h4>Bring Your Passport</h4></p>
                        <p>Prepare it for the checks </p>
                    </p>
                </div>
                <div class="icon">
                    <img src="../Img/ticket-icon.png" alt="Capacity Icon" width="70" height="70" />
                    <p class="text-gray-600 mb-1">
                        <p><h4>Keep your tickets</h4></p>
                        <p>Scan them individually</p>
                    </p>
                </div>

            </section>


        </div>

            <?php


            }
            elseif ($booking_id2 != null) {
              $query2 = "SELECT bf.*,
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
            WHERE bf.booking_id = ?";
            $stmt2 = $base->prepare($query2);
            $stmt2->bindParam(1, $booking_id2);
            $stmt2->execute();
            if (!$stmt2) {
              echo "Error in SQL execution: " . htmlspecialchars($base->errorInfo()[2]);
              exit;
            }
            $reservations2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            if (!$reservations2) {
                echo "No bookings found for this user.";
            } else {
            }

            foreach ($reservations2 as $reservation):
              $aller1 = htmlspecialchars($reservation['return_flight_number']);
              $aller2 = htmlspecialchars($reservation['departure_airport_name2']);
              $aller3 = htmlspecialchars($reservation['arrival_airport_name2']);
              $aller4 = htmlspecialchars($reservation['departure_datetime2']);
              $aller5 = htmlspecialchars($reservation['return_datetime2']);
              $aller7 = htmlspecialchars($reservation['return_seat']);
              $aller8 = htmlspecialchars($reservation['insurance']);
              $aller9 = htmlspecialchars($reservation['class']);
            endforeach;

            ?>


            <div class="ticketFl">
            <section class="head">
                <div class="litllhead">
                    <p><h2>Staffs Airways</h2></p>
                    <p><b><?php echo $user_id; ?></b></p>
                </div>
                <div class="logo">
                    <img src="../image/aircraft-removebg-preview.png" alt="Airline Management Logo" class="logo">
                </div>
            </section>

            <section class="informations" style="font-size: 15px">
                <div style="display: flex">
                    <div style="display: flex">
                        <div>
                            <p><b>Flight:</b></p>  <p><?php echo $aller1; ?></p>
                            <p><b>From:</b></p>  <p><?php echo $aller2; ?></p>
                            <p><b>To:</b></p>  <p><?php echo $aller3; ?></p>
                            <p><b>Class:</b></p>  <p><?php echo $aller9; ?></p>

                        </div>
                        <div style="margin-left: 50%; margin-right: 30%">
                            <p><b>Departure:</b></p>  <p><?php echo $aller4; ?></p>
                            <p><b>Arrival:</b></p>  <p><?php echo $aller5; ?></p>
                            <p><b>Seat:</b></p>  <p><?php echo $aller7; ?></p>
                            <p><b>Insurance:</b></p>  <p><?php echo $aller8; ?></p>
                        </div>

                    </div>

                    <div style="margin-left: 30%;">
                        <h4 style="text-align: center; margin-left: 40%">SCAN THE FOLLOWING <br>BAR CODE TO PASS THE DOORS</h4>
                        <div class="Codebar" style="">
                            <img src="../Img/codebarre-removebg-preview.png" alt="CodeBar" width="400" height="110">
                        </div>

                    </div>
                </div>

                <div style="font-size: 12px">
                    <h4>Further information</h4>
                    <p>Please arrive 60-90 minutes before departure <br> The gate closes 30 minutes before departure <br></p>
                    <p>Exchangeable before departure of each journey by paying the difference with the next fare <br> available. Additional fees per person, per way apply for exchanges in <br> the 7 days of the original departure. Non refundable.</p>
                </div>

            </section>

            <section class="pub">
                <div class="pubtitle">
                    <h4>Important information</h4>
                </div>

                <div class="passprt">
                    <p><b>UK passport holders:</b> check your passport issue and expiry dates <br> <b>EU passport holders:</b> Passports are now compulsory for most passengers, including children, traveling to the UK <br><br> To find out more, visit our Travel documents page on  <a href="aboutUs.php"><strong><i>staffsAirways.com</i></strong></a></p>
                </div>
            </section>

            <section class="imPub">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum optio numquam voluptatibus asperiores. Eveniet error similique rem quo doloribus, voluptates odio reprehenderit hic dolorum dolore? Magnam tempore labore nesciunt deserunt.</p>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eveniet, corrupti eligendi, fugiat inventore temporibus laudantium ut praesentium porro voluptatum eum fugit ex adipisci velit architecto unde deserunt, quasi impedit molestiae.</p>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repudiandae deserunt incidunt voluptates voluptatibus, harum ex autem, dolor facilis illum officia, necessitatibus dolores! Est fuga quos, mollitia voluptatibus cumque quas suscipit!</p>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum optio numquam voluptatibus asperiores. Eveniet error similique rem quo doloribus, voluptates odio reprehenderit hic dolorum dolore? Magnam tempore labore nesciunt deserunt.</p>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eveniet, corrupti eligendi, fugiat inventore temporibus laudantium ut praesentium porro voluptatum eum fugit ex adipisci velit architecto unde deserunt, quasi impedit molestiae.</p>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repudiandae deserunt incidunt voluptates voluptatibus, harum ex autem, dolor facilis illum officia, necessitatibus dolores! Est fuga quos, mollitia voluptatibus cumque quas suscipit!</p>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum optio numquam voluptatibus asperiores. Eveniet error similique rem quo doloribus, voluptates odio reprehenderit hic dolorum dolore? Magnam tempore labore nesciunt deserunt.</p>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eveniet, corrupti eligendi, fugiat inventore temporibus laudantium ut praesentium porro voluptatum eum fugit ex adipisci velit architecto unde deserunt, quasi impedit molestiae.</p>
            </section>

            <section class="justIt">
                <h4>BEFORE LEAVING</h4>
            </section>

            <section class="foot">

                <div class="icon">
                    <img src="../Img/luggage-icon.jpg" alt="Capacity Icon" width="70" height="70" />
                    <p class="text-gray-600 mb-1">
                        <p><h4>Prepare your luggage</h4></p>
                        <p>You can take two bags and one handbag</p>
                    </p>
                </div>
                <div class="icon">
                    <img src="../Img/passport-icon.png" alt="Capacity Icon" width="70" height="70" />
                    <p class="text-gray-600 mb-1">
                        <p><h4>Bring Your Passport</h4></p>
                        <p>Prepare it for the checks </p>
                    </p>
                </div>
                <div class="icon">
                    <img src="../Img/ticket-icon.png" alt="Capacity Icon" width="70" height="70" />
                    <p class="text-gray-600 mb-1">
                        <p><h4>Keep your tickets</h4></p>
                        <p>Scan them individually</p>
                    </p>
                </div>

            </section>


        </div>
        <?php


            }
            elseif ($booking_id3 != null) {

              $query3 = "SELECT b.booking_id, rp.manufacturer, rp.model, rp.registration_number,
                     ld.location_name AS departure_location, la.location_name AS arrival_location,
                     b.rental_date, b.rental_time, b.total_price, b.status_s
                     FROM bookings b
                     JOIN Rental_planes rp ON b.plane_id = rp.rental_id
                     JOIN Locations ld ON b.departure_location = ld.location_id
                     JOIN Locations la ON b.arrival_location = la.location_id
                     WHERE b.booking_id = ?";
                    $stmt3 = $base->prepare($query3);
                    $stmt3->bindParam(1, $booking_id3);
                    $stmt3->execute();
                    $rental_reservations = $stmt3->fetchAll(PDO::FETCH_ASSOC);



            foreach ($rental_reservations as $reservation):

              $aller2 = htmlspecialchars($reservation['model']);
              $aller3 = htmlspecialchars($reservation['departure_location']);
              $aller4 = htmlspecialchars($reservation['arrival_location']);
              $aller7 = htmlspecialchars($reservation['rental_date']);
              $aller8 = htmlspecialchars($reservation['rental_time']);

            endforeach;

            ?>

            <section class="bigsection2" style="margin-top: 75px; margin-bottom: 75px">
     <div class="ticketFl">
         <section class="head">
             <div class="litllhead">
                 <p><h2>Staffs Airways</h2></p>
                 <p><b><?php echo $user_id; ?></b></p>
             </div>
             <div class="logo">
                 <img src="../image/aircraft-removebg-preview.png" alt="Airline Management Logo" class="logo">
             </div>
         </section>

         <section class="informations" style="font-size: 15px">
             <div style="display: flex">
                 <div style="display: flex">
                     <div style="margin-left: 40%; margin-right: 50%">
                         <p><b>Model:</b></p>  <p><?php echo $aller2; ?></p>
                         <p><b>From:</b></p>  <p><?php echo $aller3; ?></p>
                         <p><b>To:</b></p>  <p><?php echo $aller4; ?></p>
                     </div>
                     <div style="margin-left: 70%;">
                         <p><b>Date: </b></b></p>  <p></p><?php echo $aller7; ?></p>
                         <p><b>Time:</b></p>  <p><?php echo $aller8; ?></p>
                     </div>
                 </div>

                 <div style="margin-left: 40%;">
                     <h4 style="text-align: center; margin-left: 40%">SCAN THE FOLLOWING <br>BAR CODE TO PASS THE DOORS</h4>
                     <div class="Codebar2" style="">
                         <img src="../Img/codebarre-removebg-preview.png" alt="CodeBar" width="400" height="110">
                     </div>

                 </div>
             </div>
         </section>

         <section class="pub">
             <div class="pubtitle">
                 <h4>Important information</h4>
             </div>

             <div class="passprt">
                 <p>
                 <ul>
                     Travel Documents: Ensure your passport and visas are valid.
                 </ul>
                 <ul>
                     Safety: Follow crew instructions for a safe flight.
                 </ul>
                 <ul>
                     For more details, visit <a href="aboutUs.php"><strong><i>staffsAirways.com</i></strong></a> .
                 </ul>
             </div>
         </section>

         <section class="imPub">

         </section>

         <section class="justIt">
             <h4>BEFORE LEAVING</h4>
         </section>

         <section class="foot">

             <div class="icon">
                 <img src="../Img/luggage-icon.jpg" alt="Capacity Icon" width="70" height="70" />
                 <p class="text-gray-600 mb-1">
                     <p><h4>Prepare your luggage</h4></p>
                     <p>You can take two bags and one handbag</p>
                 </p>
             </div>
             <div class="icon">
                 <img src="../Img/passport-icon.png" alt="Capacity Icon" width="70" height="70" />
                 <p class="text-gray-600 mb-1">
                     <p><h4>Bring Your Passport</h4></p>
                     <p>Prepare it for the checks </p>
                 </p>
             </div>
             <div class="icon">
                 <img src="../Img/ticket-icon.png" alt="Capacity Icon" width="70" height="70" />
                 <p class="text-gray-600 mb-1">
                     <p><h4>Keep your tickets</h4></p>
                     <p>Scan them individually</p>
                 </p>
             </div>

         </section>


     </div>
 </section>
 <?php


            }













            ?>
            </ul>
          </div>
        </nav>
      </header>
