function afficherAccueil(id) {
    
   
}


function test(id) {
    allwhite();
    var element = document.getElementById("finit");
    element.style.backgroundColor = "gray";
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('contenu').innerHTML = xhr.responseText;

            // Sélectionner toutes les zones utilisateur
            var userZones = document.querySelectorAll(".serie-zone");

            // Ajouter un gestionnaire d'événements clic à chaque zone utilisateur
            userZones.forEach(function(zone) {
                zone.addEventListener("click", function() {
                    // Récupérer l'ID de l'utilisateur associé à cette zone
                    var userId = zone.getAttribute("data-serie-id");
                    
                    // Exécuter votre code JavaScript en fonction de l'ID de l'utilisateur
                    // Par exemple, remplacer le contenu de l'élément 'contenu' par le texte "2"
                    voirtest(userId);
                });
            });
        }
    };
    xhr.open("GET", "../view/php/testfini.php?IDuser="+id, true);
    xhr.send();
}
function test2() {
    allwhite();
    var element = document.getElementById("finit");
    element.style.backgroundColor = "gray";
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('contenu').innerHTML = xhr.responseText;

            // Sélectionner toutes les zones utilisateur
            var userZones = document.querySelectorAll(".serie-zone");

            // Ajouter un gestionnaire d'événements clic à chaque zone utilisateur
            userZones.forEach(function(zone) {
                zone.addEventListener("click", function() {
                    // Récupérer l'ID de l'utilisateur associé à cette zone
                    var userId = zone.getAttribute("data-serie-id");
                    
                    // Exécuter votre code JavaScript en fonction de l'ID de l'utilisateur
                    // Par exemple, remplacer le contenu de l'élément 'contenu' par le texte "2"
                    voirtest(userId);
                });
            });
        }
    };
    xhr.open("GET", "../view/php/testfinirespo.php", true);
    xhr.send();
}


// Fonction pour afficher le contenu du compte rendu
function afficherCompteRendu() {
    allwhite();
    var element = document.getElementById("compte");
    element.style.backgroundColor = "gray";
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('contenu').innerHTML = xhr.responseText;

            // Sélectionner toutes les zones utilisateur
            var userZones = document.querySelectorAll(".serie-zone");

            // Ajouter un gestionnaire d'événements clic à chaque zone utilisateur
            userZones.forEach(function(zone) {
                zone.addEventListener("click", function() {
                    // Récupérer l'ID de l'utilisateur associé à cette zone
                    var userId = zone.getAttribute("data-serie-id");
                    
                    var blob = document.getElementById("blob_"+ userId).value;
                    console.log(blob);
                    
                    // Exécuter votre code JavaScript en fonction de l'ID de l'utilisateur
                    // Par exemple, remplacer le contenu de l'élément 'contenu' par le texte "2"
                    téléchargerBlob(blob);
                });
            });
        }
    };
    xhr.open("GET", "../view/php/acceuilinge.php", true);
    xhr.send();

}
function afficherCompteRendu2() {
    allwhite();
    var element = document.getElementById("compte");
    element.style.backgroundColor = "gray";
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('contenu').innerHTML = xhr.responseText;

            // Sélectionner toutes les zones utilisateur
            var userZones = document.querySelectorAll(".serie-zone");

            // Ajouter un gestionnaire d'événements clic à chaque zone utilisateur
            userZones.forEach(function(zone) {
                zone.addEventListener("click", function() {
                    // Récupérer l'ID de l'utilisateur associé à cette zone
                    var userId = zone.getAttribute("data-serie-id");
                    var blob = document.getElementById("blob_"+ userId).value;
                    console.log(blob);

                    
                    // Exécuter votre code JavaScript en fonction de l'ID de l'utilisateur
                    // Par exemple, remplacer le contenu de l'élément 'contenu' par le texte "2"
                    téléchargerBlob(blob);
                });
            });
        }
    };
    xhr.open("GET", "../view/php/cringe.php", true);
    xhr.send();

}
function téléchargerBlob(pdfData) {
    // Création d'un lien temporaire
    var pdfBytes = atob(pdfData);

    // Convertissez les octets en tableau d'octets
    var byteNumbers = new Array(pdfBytes.length);
    for (var i = 0; i < pdfBytes.length; i++) {
        byteNumbers[i] = pdfBytes.charCodeAt(i);
    }
    var byteArray = new Uint8Array(byteNumbers);

    // Créez un objet Blob à partir du tableau d'octets
    var blob = new Blob([byteArray], { type: 'application/pdf' });

    // Créez une URL objet à partir du Blob
    var blobUrl = URL.createObjectURL(blob);

    // Créez un élément de lien
    var link = document.createElement('a');

    // Définissez l'URL du lien sur l'URL blob
    link.href = blobUrl;

    // Définissez le nom de fichier du lien
    link.download = 'document.pdf';

    // Ajoutez le lien à la page
    document.body.appendChild(link);

    // Cliquez sur le lien pour déclencher le téléchargement
    link.click();

    // Supprimez le lien de la page
    document.body.removeChild(link);

    // Révoquer l'URL blob
    URL.revokeObjectURL(blobUrl);
}

function endit(currentUserId) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('contenu').innerHTML = xhr.responseText;
        }
    };
    xhr.open("GET", "../view/php/edition.php?userID=" + currentUserId, true);
    xhr.send();

}
function voirtest(currentUserId) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('contenu').innerHTML = xhr.responseText;
        }
    };
    xhr.open("GET", "../view/php/voirtest.php?userID=" + currentUserId, true);
    xhr.send();

}
function endit2(currentUserId,id) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('contenu').innerHTML = xhr.responseText;
        }
    };
    xhr.open("GET", "../view/php/edition.php?userID=" + currentUserId +"&variable="+id, true);
    xhr.send();

}
function loadserie(id) {
    allwhite();
    var element = document.getElementById("Test");
    element.style.backgroundColor = "gray";
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('contenu').innerHTML = xhr.responseText;

            // Sélectionner toutes les zones utilisateur
            var userZones = document.querySelectorAll(".serie-zone");

            // Ajouter un gestionnaire d'événements clic à chaque zone utilisateur
            userZones.forEach(function(zone) {
                zone.addEventListener("click", function() {
                    // Récupérer l'ID de l'utilisateur associé à cette zone
                    var userId = zone.getAttribute("data-serie-id");
                    
                    // Exécuter votre code JavaScript en fonction de l'ID de l'utilisateur
                    // Par exemple, remplacer le contenu de l'élément 'contenu' par le texte "2"
                    endit(userId);
                });
            });
        }
    };
    
    xhr.open("GET", "../view/php/acceuille.php?userID=" + id, true);
    xhr.send();
}

function pieceplus(currentUserId,id,max) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('contenu').innerHTML = xhr.responseText;
        }
    };
    id = (id + 1 <= max) ? id + 1 : max; 
    xhr.open("GET", "../view/php/edition.php?userID=" + currentUserId+"&variable="+id, true);
    xhr.send();
    
}
function piecemoins(currentUserId,id) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('contenu').innerHTML = xhr.responseText;
        }
    };
    id = (id - 1 >= 1) ? id - 1 : 1;
    xhr.open("GET", "../view/php/edition.php?userID=" + currentUserId+"&variable="+id, true);
    xhr.send();
    
}
function pieceplus2(currentUserId,id,max) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('contenu').innerHTML = xhr.responseText;
        }
    };
    id = (id + 1 <= max) ? id + 1 : max; 
    xhr.open("GET", "../view/php/voirtest.php?userID=" + currentUserId+"&variable="+id, true);
    xhr.send();
    
}
function piecemoins2(currentUserId,id) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('contenu').innerHTML = xhr.responseText;
        }
    };
    id = (id - 1 >= 1) ? id - 1 : 1;
    xhr.open("GET", "../view/php/voirtest.php?userID=" + currentUserId+"&variable="+id, true);
    xhr.send();
    
}

function nouveau() {
    
    allwhite();
    
    var element = document.getElementById("nouveau");
    element.style.backgroundColor = "gray";
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('contenu').innerHTML = xhr.responseText;
            const imageInput = document.getElementById('inputFilenouv');
    const previewImage = document.getElementById('previewImage');
    
    imageInput.addEventListener('change', function(event) {
        
        if (event.target.files && event.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                
                previewImage.src = e.target.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    });
        }
    };
    xhr.open("GET", "../view/php/creationtest.php", true);
    xhr.send();
    
    //ajusterPositionFooter();

}

function allwhite() {
    var element = document.getElementById("Test");
    element.style.backgroundColor = "lightgrey";
    element.addEventListener("mouseover", function() {
        element.style.backgroundColor = "grey";
    });
    element.addEventListener("mouseout", function() {
        element.style.backgroundColor = "";
    });
    if (document.getElementById("nouveau")) {
        var element1 = document.getElementById("nouveau");
    element1.style.backgroundColor = "lightgrey";
    element1.addEventListener("mouseover", function() {
        element1.style.backgroundColor = "grey";
    });
    element1.addEventListener("mouseout", function() {
        element1.style.backgroundColor = "";
    });
    }
    
    var element2 = document.getElementById("compte");
    element2.style.backgroundColor = "lightgrey";
    element2.addEventListener("mouseover", function() {
        element2.style.backgroundColor = "grey";
    });
    element2.addEventListener("mouseout", function() {
        element2.style.backgroundColor = "";
    });
    var element3 = document.getElementById("finit");
    element3.style.backgroundColor = "lightgrey";
    element3.addEventListener("mouseover", function() {
        element3.style.backgroundColor = "grey";
    });
    element3.addEventListener("mouseout", function() {
        element3.style.backgroundColor = "";
    });

}
function afficherSerie() {
    var xhr = new XMLHttpRequest();
    allwhite();
    var element = document.getElementById("Test");
    element.style.backgroundColor = "gray";
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('contenu').innerHTML = xhr.responseText;
        }
    };
    xhr.open("GET", "../view/php/serierespo.php", true);
    xhr.send();

}


function afficherMessageBox(message) {
    //console.log("coucou");
    var messageBox = document.createElement('div');
    messageBox.textContent = message;
    messageBox.className = 'error-box'; // Ajouter la classe CSS error-box

    // Style pour le message box
    messageBox.style.position = 'fixed';
    messageBox.style.top = '50%';
    messageBox.style.left = '50%';
    messageBox.style.transform = 'translate(-50%, -50%)';
    messageBox.style.backgroundColor = 'red';
    messageBox.style.color = 'white';
    messageBox.style.padding = '20px';
    messageBox.style.borderRadius = '5px';
    messageBox.style.boxShadow = '0 0 10px rgba(0, 0, 0, 0.5)';
    messageBox.style.zIndex = '9999';
    messageBox.style.textAlign = 'center';

    // Ajouter le message box à la page
    document.body.appendChild(messageBox);

    // Supprimer le message box après 5 secondes
    setTimeout(function() {
        document.body.removeChild(messageBox);
    }, 4000);
}


function afficherMessageBox2(message) {
    //console.log("coucou");
    var messageBox = document.createElement('div');
    messageBox.textContent = message;
    messageBox.className = 'error-box'; // Ajouter la classe CSS error-box

    // Style pour le message box
    messageBox.style.position = 'fixed';
    messageBox.style.top = '50%';
    messageBox.style.left = '50%';
    messageBox.style.transform = 'translate(-50%, -50%)';
    messageBox.style.backgroundColor = 'green';
    messageBox.style.color = 'white';
    messageBox.style.padding = '20px';
    messageBox.style.borderRadius = '5px';
    messageBox.style.boxShadow = '0 0 10px rgba(0, 0, 0, 0.5)';
    messageBox.style.zIndex = '9999';
    messageBox.style.textAlign = 'center';

    // Ajouter le message box à la page
    document.body.appendChild(messageBox);

    // Supprimer le message box après 5 secondes
    setTimeout(function() {
        document.body.removeChild(messageBox);
    }, 4000);
}