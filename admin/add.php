<?php
session_start();
include '../PHP/Base.php';
global $base;



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_type']) && $_POST['form_type'] == 'add_idflight') {
    // Récupérer les données du formulaire
    $plane_id = $_POST['plane_id'];
    $airline = $_POST['airline'];
    $flight_number = $_POST['flight_number'];
    $departure_airport = $_POST['departure_airport'];
    $arrival_airport = $_POST['arrival_airport'];
    $departure_datetime = $_POST['departure_datetime'];
    $arrival_datetime = $_POST['arrival_datetime'];
    $ticket_price = $_POST['ticket_price'];
    $available_seats = $_POST['available_seats'];
    $stopover_info = $_POST['stopover_info'];

    // Requête d'insertion avec des paramètres nommés
    $sql = "INSERT INTO Flights (plane_id, airline, flight_number, departure_airport, arrival_airport, departure_datetime, arrival_datetime, ticket_price, available_seats, stopover_info) 
        VALUES (:plane_id, :airline, :flight_number, :departure_airport, :arrival_airport, :departure_datetime, :arrival_datetime, :ticket_price, :available_seats, :stopover_info)";

    $stmt = $base->prepare($sql);

    $stmt->bindParam(':plane_id', $plane_id);
    $stmt->bindParam(':airline', $airline);
    $stmt->bindParam(':flight_number', $flight_number);
    $stmt->bindParam(':departure_airport', $departure_airport);
    $stmt->bindParam(':arrival_airport', $arrival_airport);
    $stmt->bindParam(':departure_datetime', $departure_datetime);
    $stmt->bindParam(':arrival_datetime', $arrival_datetime);
    $stmt->bindParam(':ticket_price', $ticket_price);
    $stmt->bindParam(':available_seats', $available_seats);
    $stmt->bindParam(':stopover_info', $stopover_info);

    if ($stmt->execute()) {
        header("Location: home.php");
    } else {
        echo "Erreur lors de l'ajout du vol.";
        header("Location: home.php");
    }
}




if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_type']) && $_POST['form_type'] == 'add_idbooking') {
    // Retrieve form data
    $user_id = $_POST['user_id'];
    $departure_flight_id = $_POST['departure_flight_id'];
    $return_flight_id = $_POST['return_flight_id'];
    $number_of_passengers = $_POST['number_of_passengers'];
    $price = $_POST['price'];
    $departure_seat = $_POST['departure_seat'];
    $return_seat = $_POST['return_seat'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $skypriority = isset($_POST['skypriority']) ? 1 : 0;
    $lounge_access = isset($_POST['lounge_access']) ? 1 : 0;
    $checked_baggage = $_POST['checked_baggage'];
    $cabin_baggage = $_POST['cabin_baggage'];
    $refundable = isset($_POST['refundable']) ? 1 : 0;
    $front_seats = isset($_POST['front_seats']) ? 1 : 0;
    $insurance = $_POST['insurance'];
    $class = $_POST['class'];

    // Default values
    $status = 'Confirmed'; // Default status
    $booking_date = date('Y-m-d'); // Default booking date is the current date

    // Include database connection file
    include 'db_connection.php'; // Assuming you have a separate file for the DB connection

    // Validate and sanitize input data
    $user_id = filter_var($user_id, FILTER_VALIDATE_INT);
    $departure_flight_id = filter_var($departure_flight_id, FILTER_VALIDATE_INT);
    $return_flight_id = filter_var($return_flight_id, FILTER_VALIDATE_INT);
    $number_of_passengers = filter_var($number_of_passengers, FILTER_VALIDATE_INT);
    $price = filter_var($price, FILTER_VALIDATE_FLOAT);
    $departure_seat = filter_var($departure_seat, FILTER_SANITIZE_STRING);
    $return_seat = filter_var($return_seat, FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $phone = filter_var($phone, FILTER_SANITIZE_STRING);
    $skypriority = filter_var($skypriority, FILTER_VALIDATE_BOOLEAN);
    $lounge_access = filter_var($lounge_access, FILTER_VALIDATE_BOOLEAN);
    $checked_baggage = filter_var($checked_baggage, FILTER_VALIDATE_INT);
    $cabin_baggage = filter_var($cabin_baggage, FILTER_VALIDATE_INT);
    $refundable = filter_var($refundable, FILTER_VALIDATE_BOOLEAN);
    $front_seats = filter_var($front_seats, FILTER_VALIDATE_BOOLEAN);
    $insurance = filter_var($insurance, FILTER_VALIDATE_INT);
    $class = filter_var($class, FILTER_VALIDATE_INT);



    // SQL insert query with named parameters
    $sql = "INSERT INTO booking_flight (
                user_id, departure_flight_id, return_flight_id, booking_date, 
                number_of_passengers, status, price, departure_seat, 
                return_seat, email, phone, skypriority, lounge_access, 
                checked_baggage, cabin_baggage, refundable, front_seats, 
                insurance, class
            ) VALUES (
                :user_id, :departure_flight_id, :return_flight_id, :booking_date, 
                :number_of_passengers, :status, :price, :departure_seat, 
                :return_seat, :email, :phone, :skypriority, :lounge_access, 
                :checked_baggage, :cabin_baggage, :refundable, :front_seats, 
                :insurance, :class
            )";

    $stmt = $base->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':departure_flight_id', $departure_flight_id);
    $stmt->bindParam(':return_flight_id', $return_flight_id);
    $stmt->bindParam(':booking_date', $booking_date);
    $stmt->bindParam(':number_of_passengers', $number_of_passengers);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':departure_seat', $departure_seat);
    $stmt->bindParam(':return_seat', $return_seat);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':skypriority', $skypriority);
    $stmt->bindParam(':lounge_access', $lounge_access);
    $stmt->bindParam(':checked_baggage', $checked_baggage);
    $stmt->bindParam(':cabin_baggage', $cabin_baggage);
    $stmt->bindParam(':refundable', $refundable);
    $stmt->bindParam(':front_seats', $front_seats);
    $stmt->bindParam(':insurance', $insurance);
    $stmt->bindParam(':class', $class);

    // Execute the statement and handle potential errors
    if ($stmt->execute()) {
        header("Location: home.php");
        exit(); // Make sure to call exit after header to stop script execution
    } else {
        echo "Erreur lors de l'ajout de la réservation: " . $stmt->errorInfo()[2];
        header("Location: home.php");
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_type']) && $_POST['form_type'] == 'add_idrentbooking') {

    $plane_id = $_POST['plane_id'];
    $customer_id = $_POST['customer_id'];
    $rental_date = $_POST['rental_date'];
    $rental_time = $_POST['rental_time'];
    $departure_location = $_POST['departure_location'];
    $arrival_location = $_POST['arrival_location'];
    $total_price = $_POST['total_price'];
    $status = $_POST['status'];
    $notes = $_POST['notes'];

    $sql = "INSERT INTO bookings (plane_id, customer_id, rental_date, rental_time, departure_location, arrival_location, total_price, status_s, notes) 
            VALUES (:plane_id, :customer_id, :rental_date, :rental_time, :departure_location, :arrival_location, :total_price, :status, :notes)";

    try {
        $stmt = $base->prepare($sql);
        $stmt->bindParam(':plane_id', $plane_id, PDO::PARAM_INT);
        $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
        $stmt->bindParam(':rental_date', $rental_date);
        $stmt->bindParam(':rental_time', $rental_time);
        $stmt->bindParam(':departure_location', $departure_location, PDO::PARAM_INT);
        $stmt->bindParam(':arrival_location', $arrival_location, PDO::PARAM_INT);
        $stmt->bindParam(':total_price', $total_price);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':notes', $notes);

        $stmt->execute();
        if ($stmt->execute()) {
            header("Location: home.php");
            exit(); // Make sure to call exit after header to stop script execution
        } else {
            echo "Erreur lors de l'ajout de la réservation: " . $stmt->errorInfo()[2];
            header("Location: home.php");
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        header("Location: home.php");
    }

}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_type']) && $_POST['form_type'] == 'add_idplane') {
    $manufacturer = $_POST['manufacturer'];
    $year_of_manufacture = $_POST['year_of_manufacture'];
    $model = $_POST['model'];
    $registration_number = $_POST['registration_number'];
    $maximum_capacity = $_POST['maximum_capacity'];
    $availability_status = $_POST['availability_status'];
    $maintenance_history = $_POST['maintenance_history'];

    $sql = "INSERT INTO Commercial_plane (manufacturer, year_of_manufacture, model, registration_number, maximum_capacity, availability_status, maintenance_history) 
            VALUES (:manufacturer, :year_of_manufacture, :model, :registration_number, :maximum_capacity, :availability_status, :maintenance_history)";

    try {
        $stmt = $base->prepare($sql);
        $stmt->bindParam(':manufacturer', $manufacturer);
        $stmt->bindParam(':year_of_manufacture', $year_of_manufacture, PDO::PARAM_INT);
        $stmt->bindParam(':model', $model);
        $stmt->bindParam(':registration_number', $registration_number);
        $stmt->bindParam(':maximum_capacity', $maximum_capacity, PDO::PARAM_INT);
        $stmt->bindParam(':availability_status', $availability_status);
        $stmt->bindParam(':maintenance_history', $maintenance_history);

        $stmt->execute();
        if ($stmt->execute()) {
            header("Location: home.php");
            exit(); // Make sure to call exit after header to stop script execution
        } else {
            echo "Erreur lors de l'ajout de la réservation: " . $stmt->errorInfo()[2];
            header("Location: home.php");
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_type']) && $_POST['form_type'] == 'add_idrentplane') {

    $manufacturer = $_POST['manufacturer'];
    $model = $_POST['model'];
    $year_of_manufacture = $_POST['year_of_manufacture'];
    $registration_number = $_POST['registration_number'];
    $maximum_capacity = $_POST['maximum_capacity'];
    $maximum_range = $_POST['maximum_range'];
    $rental_price_per_hour = $_POST['rental_price_per_hour'];
    $availability_status = $_POST['availability_status'];
    $maintenance_history = $_POST['maintenance_history'];
    $features = $_POST['features'];
    $description = $_POST['description'];
    $detailed_description = $_POST['detailed_description'];
    $rating = $_POST['rating'];
    $number_of_reviews = $_POST['number_of_reviews'];
    $image_path = $_POST['image_path'];



    // Create a PDO instance
    try {


        // Prepare SQL query
        $sql = "INSERT INTO Rental_planes (manufacturer, model, year_of_manufacture, registration_number, maximum_capacity, maximum_range, rental_price_per_hour, availability_status, maintenance_history, features, description, detailed_description, rating, number_of_reviews, image_path) 
            VALUES (:manufacturer, :model, :year_of_manufacture, :registration_number, :maximum_capacity, :maximum_range, :rental_price_per_hour, :availability_status, :maintenance_history, :features, :description, :detailed_description, :rating, :number_of_reviews, :image_path)";

        // Bind parameters
        $stmt = $base->prepare($sql);
        $stmt->bindParam(':manufacturer', $manufacturer);
        $stmt->bindParam(':model', $model);
        $stmt->bindParam(':year_of_manufacture', $year_of_manufacture);
        $stmt->bindParam(':registration_number', $registration_number);
        $stmt->bindParam(':maximum_capacity', $maximum_capacity);
        $stmt->bindParam(':maximum_range', $maximum_range);
        $stmt->bindParam(':rental_price_per_hour', $rental_price_per_hour);
        $stmt->bindParam(':availability_status', $availability_status);
        $stmt->bindParam(':maintenance_history', $maintenance_history);
        $stmt->bindParam(':features', $features);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':detailed_description', $detailed_description);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':number_of_reviews', $number_of_reviews);
        $stmt->bindParam(':image_path', $image_path);

        // Execute the query
        $stmt->execute();

        if ($stmt->execute()) {
            header("Location: home.php");
            exit(); // Make sure to call exit after header to stop script execution
        } else {
            echo "Erreur lors de l'ajout de la réservation: " . $stmt->errorInfo()[2];
            header("Location: home.php");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $base = null;
}



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_type']) && $_POST['form_type'] == 'add_idlocation') {

    $location_name = $_POST['location_name'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $airport_code = $_POST['airport_code'];
    $description = $_POST['description'];

    // Create a PDO instance
    try {


        // Prepare SQL query
        $sql = "INSERT INTO Locations (location_name, latitude, longitude, country, city, airport_code, description) 
                VALUES (:location_name, :latitude, :longitude, :country, :city, :airport_code, :description)";

        // Bind parameters
        $stmt = $base->prepare($sql);
        $stmt->bindParam(':location_name', $location_name);
        $stmt->bindParam(':latitude', $latitude);
        $stmt->bindParam(':longitude', $longitude);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':airport_code', $airport_code);
        $stmt->bindParam(':description', $description);

        // Execute the query
        $stmt->execute();

        header("Location: home.php");

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $base = null;
}



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_type']) && $_POST['form_type'] == 'add_idcity') {
    $city_name = $_POST['city_name'];
$country = $_POST['country'];

// Create a PDO instance
try {


    // Prepare SQL query
    $sql = "INSERT INTO Cities (city_name, country) 
            VALUES (:city_name, :country)";
    
    // Bind parameters
    $stmt = $base->prepare($sql);
    $stmt->bindParam(':city_name', $city_name);
    $stmt->bindParam(':country', $country);
    
    // Execute the query
    $stmt->execute();

    header("Location: home.php");
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$base = null;
}




if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_type']) && $_POST['form_type'] == 'add_idairport') {

    $stmt = $base->prepare("INSERT INTO Airports (airport_name, city_id) VALUES (:airport_name, :city_id)");

    // Liaison des paramètres
    $stmt->bindParam(':airport_name', $airport_name);
    $stmt->bindParam(':city_id', $city_id);

    // Assignation des valeurs des champs du formulaire
    $airport_name = $_POST['airport_name'];
    $city_id = $_POST['city_id'];

    // Exécution de la requête
    try {
        $stmt->execute();
        header("Location: home.php");
    } catch(PDOException $e) {
        echo "Erreur lors de l'insertion des données : " . $e->getMessage();
    }

}



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_type']) && $_POST['form_type'] == 'add_iduser') {

    try {

        $admin = isset($_POST['admin']) ? 1 : 0;
    
        // Préparer la requête d'insertion
        $stmt = $base->prepare("INSERT INTO Users (username, email, password, admin_id, created_at) 
                                VALUES (:username, :email, :password, :admin_id, NOW())");
    
        // Liaison des paramètres
        $stmt->bindParam(':username', $_POST['nom']);
        $stmt->bindParam(':email', $_POST['nom']);
        $stmt->bindParam(':admin_id', $_POST['admin']);
        $stmt->bindParam(':password', $admin);
    
        // Exécution de la requête
        $stmt->execute();
    
        header("Location: home.php");
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

}



?>