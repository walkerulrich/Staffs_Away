<?php
session_start();
include '../PHP/Base.php';
global $base;
?>
<?php

if (isset($_POST['delete_idplane'])) {
    // Récupérer l'identifiant de l'aéroport à supprimer
    $plane_id = $_POST['delete_idplane'];

    // Requête de suppression
    $query = "DELETE FROM Commercial_plane WHERE plane_id = :plane_id";
    $statement = $base->prepare($query);
    $statement->bindParam(':plane_id', $plane_id, PDO::PARAM_INT);

    // Exécuter la requête de suppression
    if ($statement->execute()) {
      // Rediriger ou afficher un message de succès
      header("Location: home.php");
      exit();
    } else {
      echo "Error delete failled.";
    }
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






  if (isset($_POST['delete_idBooking'])) {
    // Récupérer l'identifiant de l'aéroport à supprimer
    $booking_id = $_POST['delete_idBooking'];

    // Requête de suppression
    $query = "DELETE FROM booking_flight WHERE booking_id = :booking_id";
    $statement = $base->prepare($query);
    $statement->bindParam(':booking_id', $booking_id, PDO::PARAM_INT);

    // Exécuter la requête de suppression
    if ($statement->execute()) {
      // Rediriger ou afficher un message de succès
      header("Location: home.php");
      exit();
    } else {
      echo "Error delete failled.";
    }
  }



  if (isset($_POST['delete_idBookingrent'])) {
    // Récupérer l'identifiant de l'aéroport à supprimer
    $booking_id = $_POST['delete_idBookingrent'];

    // Requête de suppression
    $query = "DELETE FROM bookings WHERE booking_id = :booking_id";
    $statement = $base->prepare($query);
    $statement->bindParam(':booking_id', $booking_id, PDO::PARAM_INT);

    // Exécuter la requête de suppression
    if ($statement->execute()) {
      // Rediriger ou afficher un message de succès
      header("Location: home.php");
      exit();
    } else {
      echo "Error delete failled.";
    }
  }




  if (isset($_POST['delete_idBookingrentplane'])) {
    // Récupérer l'identifiant de l'aéroport à supprimer
    $booking_id = $_POST['delete_idBookingrentplane'];

    // Requête de suppression
    $query = "DELETE FROM Rental_planes WHERE rental_id = :rental_id";
    $statement = $base->prepare($query);
    $statement->bindParam(':rental_id', $booking_id, PDO::PARAM_INT);

    // Exécuter la requête de suppression
    if ($statement->execute()) {
      // Rediriger ou afficher un message de succès
      header("Location: home.php");
      exit();
    } else {
      echo "Error delete failled.";
    }
  }




  if (isset($_POST['delete_idlocation'])) {
    // Récupérer l'identifiant de l'aéroport à supprimer
    $booking_id = $_POST['delete_idlocation'];

    // Requête de suppression
    $query = "DELETE FROM Locations WHERE location_id = :location_id";
    $statement = $base->prepare($query);
    $statement->bindParam(':location_id', $booking_id, PDO::PARAM_INT);

    // Exécuter la requête de suppression
    if ($statement->execute()) {
      // Rediriger ou afficher un message de succès
      header("Location: home.php");
      exit();
    } else {
      echo "Error delete failled.";
    }
  }




  if (isset($_POST['delete_idcities'])) {
    // Récupérer l'identifiant de l'aéroport à supprimer
    $booking_id = $_POST['delete_idcities'];

    // Requête de suppression
    $query = "DELETE FROM Cities WHERE city_id = :city_id";
    $statement = $base->prepare($query);
    $statement->bindParam(':city_id', $booking_id, PDO::PARAM_INT);

    // Exécuter la requête de suppression
    if ($statement->execute()) {
      // Rediriger ou afficher un message de succès
      header("Location: home.php");
      exit();
    } else {
      echo "Error delete failled.";
    }
  }




  if (isset($_POST['delete_idairport'])) {
    // Récupérer l'identifiant de l'aéroport à supprimer
    $booking_id = $_POST['delete_idairport'];

    // Requête de suppression
    $query = "DELETE FROM Airports WHERE airport_id = :airport_id";
    $statement = $base->prepare($query);
    $statement->bindParam(':airport_id', $booking_id, PDO::PARAM_INT);

    // Exécuter la requête de suppression
    if ($statement->execute()) {
      // Rediriger ou afficher un message de succès
      header("Location: home.php");
      exit();
    } else {
      echo "Error delete failled.";
    }
  }


  if (isset($_POST['delete_iduser'])) {
    // Récupérer l'identifiant de l'aéroport à supprimer
    $booking_id = $_POST['delete_iduser'];

    // Requête de suppression
    $query = "DELETE FROM Users WHERE user_id = :user_id";
    $statement = $base->prepare($query);
    $statement->bindParam(':user_id', $booking_id, PDO::PARAM_INT);

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
