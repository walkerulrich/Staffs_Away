document.getElementById("bouton_flights").addEventListener("click", function () {
    document.getElementById("page_flights").style.display = "block";
    document.getElementById("page_bookings").style.display = "none";
    document.getElementById("page_rent_bookings").style.display = "none";
    document.getElementById("page_commercial_planes").style.display = "none";
    document.getElementById("page_planes_rent").style.display = "none";
    document.getElementById("page_locations").style.display = "none";
    document.getElementById("page_cities").style.display = "none";
    document.getElementById("page_airports").style.display = "none";
    document.getElementById("page_users").style.display = "none";
});


document.getElementById("add_butt_flight").addEventListener("click", function () {
    document.getElementById("add_flights").style.display = "block";
});


document.getElementById("add_butt_booking").addEventListener("click", function () {
    document.getElementById("add_BOOKING").style.display = "block";
});


document.getElementById("add_butt_rentbooking").addEventListener("click", function () {
    document.getElementById("add_rentbook").style.display = "block";
});

document.getElementById("add_butt_plane").addEventListener("click", function () {
    document.getElementById("add_plane").style.display = "block";
});

document.getElementById("add_butt_rentplane").addEventListener("click", function () {
    document.getElementById("add_rentplane").style.display = "block";
});

document.getElementById("add_butt_location").addEventListener("click", function () {
    document.getElementById("add_location").style.display = "block";
});

document.getElementById("add_butt_city").addEventListener("click", function () {
    document.getElementById("add_city").style.display = "block";
});

document.getElementById("add_butt_airport").addEventListener("click", function () {
    document.getElementById("add_airport").style.display = "block";
});

document.getElementById("add_butt_user").addEventListener("click", function () {
    document.getElementById("add_user").style.display = "block";
});



document.getElementById("bouton_bookings").addEventListener("click", function () {
    document.getElementById("page_flights").style.display = "none";
    document.getElementById("page_bookings").style.display = "block";
    document.getElementById("page_rent_bookings").style.display = "none";
    document.getElementById("page_commercial_planes").style.display = "none";
    document.getElementById("page_planes_rent").style.display = "none";
    document.getElementById("page_locations").style.display = "none";
    document.getElementById("page_cities").style.display = "none";
    document.getElementById("page_airports").style.display = "none";
    document.getElementById("page_users").style.display = "none";
});

document.getElementById("bouton_rent_bookings").addEventListener("click", function () {
    document.getElementById("page_flights").style.display = "none";
    document.getElementById("page_bookings").style.display = "none";
    document.getElementById("page_rent_bookings").style.display = "block";
    document.getElementById("page_commercial_planes").style.display = "none";
    document.getElementById("page_planes_rent").style.display = "none";
    document.getElementById("page_locations").style.display = "none";
    document.getElementById("page_cities").style.display = "none";
    document.getElementById("page_airports").style.display = "none";
    document.getElementById("page_users").style.display = "none";
});

document.getElementById("bouton_commercial_planes").addEventListener("click", function () {
    document.getElementById("page_flights").style.display = "none";
    document.getElementById("page_bookings").style.display = "none";
    document.getElementById("page_rent_bookings").style.display = "none";
    document.getElementById("page_commercial_planes").style.display = "block";
    document.getElementById("page_planes_rent").style.display = "none";
    document.getElementById("page_locations").style.display = "none";
    document.getElementById("page_cities").style.display = "none";
    document.getElementById("page_airports").style.display = "none";
    document.getElementById("page_users").style.display = "none";
});

document.getElementById("bouton_planes_rent").addEventListener("click", function () {
    document.getElementById("page_flights").style.display = "none";
    document.getElementById("page_bookings").style.display = "none";
    document.getElementById("page_rent_bookings").style.display = "none";
    document.getElementById("page_commercial_planes").style.display = "none";
    document.getElementById("page_planes_rent").style.display = "block";
    document.getElementById("page_locations").style.display = "none";
    document.getElementById("page_cities").style.display = "none";
    document.getElementById("page_airports").style.display = "none";
    document.getElementById("page_users").style.display = "none";
});

document.getElementById("bouton_locations").addEventListener("click", function () {
    document.getElementById("page_flights").style.display = "none";
    document.getElementById("page_bookings").style.display = "none";
    document.getElementById("page_rent_bookings").style.display = "none";
    document.getElementById("page_commercial_planes").style.display = "none";
    document.getElementById("page_planes_rent").style.display = "none";
    document.getElementById("page_locations").style.display = "block";
    document.getElementById("page_cities").style.display = "none";
    document.getElementById("page_airports").style.display = "none";
    document.getElementById("page_users").style.display = "none";
});

document.getElementById("bouton_cities").addEventListener("click", function () {
    document.getElementById("page_flights").style.display = "none";
    document.getElementById("page_bookings").style.display = "none";
    document.getElementById("page_rent_bookings").style.display = "none";
    document.getElementById("page_commercial_planes").style.display = "none";
    document.getElementById("page_planes_rent").style.display = "none";
    document.getElementById("page_locations").style.display = "none";
    document.getElementById("page_cities").style.display = "block";
    document.getElementById("page_airports").style.display = "none";
    document.getElementById("page_users").style.display = "none";
});

document.getElementById("bouton_airports").addEventListener("click", function () {
    document.getElementById("page_flights").style.display = "none";
    document.getElementById("page_bookings").style.display = "none";
    document.getElementById("page_rent_bookings").style.display = "none";
    document.getElementById("page_commercial_planes").style.display = "none";
    document.getElementById("page_planes_rent").style.display = "none";
    document.getElementById("page_locations").style.display = "none";
    document.getElementById("page_cities").style.display = "none";
    document.getElementById("page_airports").style.display = "block";
    document.getElementById("page_users").style.display = "none";
});

document.getElementById("bouton_users").addEventListener("click", function () {
    document.getElementById("page_flights").style.display = "none";
    document.getElementById("page_bookings").style.display = "none";
    document.getElementById("page_rent_bookings").style.display = "none";
    document.getElementById("page_commercial_planes").style.display = "none";
    document.getElementById("page_planes_rent").style.display = "none";
    document.getElementById("page_locations").style.display = "none";
    document.getElementById("page_cities").style.display = "none";
    document.getElementById("page_airports").style.display = "none";
    document.getElementById("page_users").style.display = "block";
});



document.addEventListener('DOMContentLoaded', function () {
    generateDropdownOptions('searchColumn', '#flightTable th');
    generateDropdownOptions('searchBookings', '#bookingsTable th');
    generateDropdownOptions('searchCommercial', '#commercialTable th');
    generateDropdownOptions('searchRentBook', '#rentBookingsTable th');
    generateDropdownOptions('searchPlaneRent', '#rentalPlanesTable th');
    generateDropdownOptions('searchLocation', '#locationsTable th');
    generateDropdownOptions('searchcities', '#citiesTable th');
    generateDropdownOptions('searchairports', '#airportsTable th');
    generateDropdownOptions('searchusers', '#usersTable th');

});

function generateDropdownOptions(selectId, headersSelector) {
    var select = document.getElementById(selectId);
    var headers = document.querySelectorAll(headersSelector);
    headers.forEach(function (header, index) {
        var option = document.createElement('option');
        option.value = index;
        option.textContent = header.textContent;
        select.appendChild(option);
    });
}

function ferme(val) {
    document.getElementById(val).style.display = "none";
}






// Récupère tous les éléments avec la classe "custom-button"
var buttons = document.getElementsByClassName("button");

// Parcourt tous les boutons et ajoute un gestionnaire d'événements de clic à chacun
for (var i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener("click", function () {
        // Retire la classe "clicked" de tous les boutons
        for (var j = 0; j < buttons.length; j++) {
            buttons[j].classList.remove("clicked");
        }
        // Ajoute la classe "clicked" au bouton cliqué
        this.classList.add("clicked");
    });
}




// Fonction pour réinitialiser le tableau
function resetTable(Idtab) {
    var table = document.getElementById(Idtab);
    var tr = table.getElementsByTagName('tr');
    for (var i = 0; i < tr.length; i++) {
        tr[i].style.display = '';
    }
}


// Fonction pour rechercher dans le tableau
function searchTable(Idtab, Idinp, rech) {
    var input, filter, table, tr, td, i, columnIndex, txtValue;
    input = document.getElementById(Idinp).value.toUpperCase();
    table = document.getElementById(Idtab);
    tr = table.getElementsByTagName("tr");
    columnIndex = document.getElementById(rech).value;

    // Vérifier si le champ de recherche est vide
    if (input === "") {
        resetTable(Idtab);
        return; // Sortir de la fonction si le champ de recherche est vide
    }

    // Parcourir toutes les lignes du tableau
    for (i = 0; i < tr.length; i++) {
        // Récupérer la cellule correspondant à la colonne sélectionnée
        td = tr[i].getElementsByTagName("td")[columnIndex];
        if (td) {
            txtValue = td.textContent || td.innerText;
            // Afficher ou masquer la ligne en fonction de la correspondance
            if (txtValue.toUpperCase() === input) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}







function confirmSubmit(event) {
    var element = event.target;
    var confirmation = document.getElementById("confirmation");
    confirmation.style.display = "block";
    var classe = element.id;

    console.log(classe);

    if (confirmation.classList) {
        // Utilisation de la méthode classList.add() si elle est disponible
        element.classList.add(classe);
    } else {
        // Si la méthode classList.add() n'est pas disponible (anciens navigateurs)
        // Nous ajoutons la classe manuellement
        confirmation.className += classe;
    }

    return false; // Empêche l'envoi du formulaire

}


/*function send() {
    // Envoyer le formulaire
    var element = document.getElementById("confirmation");
    element.classList.remove('confirmation');
    var classe = element.className;
    console.log(classe);
    var element = document.getElementByClassName(classe).submit();
    element.classList.remove(classe);
    if (confirmation.classList) {
        // Utilisation de la méthode classList.add() si elle est disponible
        element.classList.add("confirmation");
    } else {
        // Si la méthode classList.add() n'est pas disponible (anciens navigateurs)
        // Nous ajoutons la classe manuellement
        confirmation.className += "confirmation";
    }
  }




  function send() {
    // Submit the form
    var confirmation = document.getElementById("confirmation");
    var form = document.querySelector("." + confirmation.classList[1]); // Assuming the second class is the form's class
    form.submit();
    confirmation.classList.remove(confirmation.classList[1]);
    confirmation.style.display = "none";
}

  


  /*function hide() {
    var confirmation = document.getElementById("confirmation");
    confirmation.classList.remove();

    if (confirmation.classList) {
        // Utilisation de la méthode classList.add() si elle est disponible
        confirmation.classList.add("confirmation");
    } else {
        // Si la méthode classList.add() n'est pas disponible (anciens navigateurs)
        // Nous ajoutons la classe manuellement
        confirmation.className += "confirmation";
    }
    confirmation.style.display = "none";
  }

  function hide() {
    var confirmation = document.getElementById("confirmation");
    confirmation.classList.remove(confirmation.classList[1]);
    confirmation.style.display = "none";
}*/




    function showConfirmation(button) {
        var confirmationDiv = button.nextElementSibling;
        confirmationDiv.style.display = "block";
    }

    function hideConfirmation(button) {
        var confirmationDiv = button.parentNode;
        confirmationDiv.style.display = "none";
    }
