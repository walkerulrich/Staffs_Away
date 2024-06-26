document.getElementById("bouton_flights").addEventListener("click", function() {
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

document.getElementById("bouton_bookings").addEventListener("click", function() {
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

document.getElementById("bouton_rent_bookings").addEventListener("click", function() {
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

document.getElementById("bouton_commercial_planes").addEventListener("click", function() {
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

document.getElementById("bouton_planes_rent").addEventListener("click", function() {
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

document.getElementById("bouton_locations").addEventListener("click", function() {
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

document.getElementById("bouton_cities").addEventListener("click", function() {
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

document.getElementById("bouton_airports").addEventListener("click", function() {
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

document.getElementById("bouton_users").addEventListener("click", function() {
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


// Récupère tous les éléments avec la classe "custom-button"
var buttons = document.getElementsByClassName("button");

// Parcourt tous les boutons et ajoute un gestionnaire d'événements de clic à chacun
for (var i = 0; i < buttons.length; i++) {
  buttons[i].addEventListener("click", function() {
    // Retire la classe "clicked" de tous les boutons
    for (var j = 0; j < buttons.length; j++) {
      buttons[j].classList.remove("clicked");
    }
    // Ajoute la classe "clicked" au bouton cliqué
    this.classList.add("clicked");
  });
}


/*function filterTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.getElementById("flightTable");
    tr = table.getElementsByTagName("tr");

    // Parcours toutes les lignes du tableau
    for (i = 0; i < tr.length; i++) {
        // Compare chaque cellule de la ligne avec la valeur de recherche
        td = tr[i].getElementsByTagName("td");
        for (var j = 0; j < td.length; j++) {
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    break;
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
}*/


/*function searchTable() {
    var input, filter, table, tr, td, i, columnIndex, txtValue;
    input = document.getElementById("searchInput").value.toUpperCase();
    table = document.getElementById("flightTable");
    tr = table.getElementsByTagName("tr");
    columnIndex = document.getElementById("searchColumn").value;
    
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
}*/




 // JavaScript pour générer dynamiquement les options du menu déroulant
 document.addEventListener('DOMContentLoaded', function() {
    var select = document.getElementById('searchColumn');
    var headers = document.querySelectorAll('#flightTable th');
    headers.forEach(function(header, index) {
        var option = document.createElement('option');
        option.value = index;
        option.textContent = header.textContent;
        select.appendChild(option);
    });
});





 // JavaScript pour générer dynamiquement les options du menu déroulant
 document.addEventListener('DOMContentLoaded', function() {
    var select = document.getElementById('searchBookings');
    var headers = document.querySelectorAll('#bookingsTable th');
    headers.forEach(function(header, index) {
        var option = document.createElement('option');
        option.value = index;
        option.textContent = header.textContent;
        select.appendChild(option);
    });
});



// JavaScript pour générer dynamiquement les options du menu déroulant
document.addEventListener('DOMContentLoaded', function() {
    var select = document.getElementById('searchRentBook');
    var headers = document.querySelectorAll('#rentBookTable th');
    headers.forEach(function(header, index) {
        var option = document.createElement('option');
        option.value = index;
        option.textContent = header.textContent;
        select.appendChild(option);
    });
});


/*function searchTable() {
    var input, filter, table, tr, td, i, columnIndex, txtValue;
    input = document.getElementById("searchInput").value.toUpperCase();
    table = document.getElementById("flightTable");
    tr = table.getElementsByTagName("tr");
    columnIndex = document.getElementById("searchColumn").value;
    
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
}*/

  // Fonction pour réinitialiser le tableau lorsque le champ de recherche est effacé
  document.getElementById('searchInput').addEventListener('input', function() {
    if (this.value === '') {
        resetTable();
    }
});

// Fonction pour réinitialiser le tableau
function resetTable() {
    var table = document.getElementById('flightTable');
    var tr = table.getElementsByTagName('tr');
    for (var i = 0; i < tr.length; i++) {
        tr[i].style.display = '';
    }
}



  // Fonction pour réinitialiser le tableau lorsque le champ de recherche est effacé
  document.getElementById('searchInput').addEventListener('input', function() {
    if (this.value === '') {
        resetTable();
    }
});

// Fonction pour réinitialiser le tableau
function resetTable() {
    var table = document.getElementById('flightTable');
    var tr = table.getElementsByTagName('tr');
    for (var i = 0; i < tr.length; i++) {
        tr[i].style.display = '';
    }
}

// Fonction pour rechercher dans le tableau
function searchTable() {
    var input, filter, table, tr, td, i, columnIndex, txtValue;
    input = document.getElementById("searchInput").value.toUpperCase();
    table = document.getElementById("flightTable");
    tr = table.getElementsByTagName("tr");
    columnIndex = document.getElementById("searchColumn").value;
    
    // Vérifier si le champ de recherche est vide
    if (input === "") {
        resetTable();
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
