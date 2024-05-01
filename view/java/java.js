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
                    var userId = document.getElementById("blob").value;

                    
                    // Exécuter votre code JavaScript en fonction de l'ID de l'utilisateur
                    // Par exemple, remplacer le contenu de l'élément 'contenu' par le texte "2"
                    téléchargerBlob(userId);
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
                    var userId = document.getElementById("blob").value;

                    
                    // Exécuter votre code JavaScript en fonction de l'ID de l'utilisateur
                    // Par exemple, remplacer le contenu de l'élément 'contenu' par le texte "2"
                    téléchargerBlob(userId);
                });
            });
        }
    };
    xhr.open("GET", "../view/php/cringe.php", true);
    xhr.send();

}
function téléchargerBlob(blob) {
    // Création d'un lien temporaire
    var nomFichier = "testreturnphoto.jpeg";
   
    // Convertir la chaîne base64 en tableau de bytes
    var byteCharacters = atob(blob);
    var byteArrays = new Array(byteCharacters.length);
    for (var i = 0; i < byteCharacters.length; i++) {
        byteArrays[i] = byteCharacters.charCodeAt(i);
    }
    var byteArray = new Uint8Array(byteArrays);
    
    // Créer un Blob à partir du tableau d'octets
    var blobe = new Blob([byteArray], { type: 'image/jpeg' }); // Assurez-vous que le type MIME est correct
    
    
    // Créer un lien temporaire pour le téléchargement du Blob
    var lien = document.createElement('a');
    lien.href = window.URL.createObjectURL(blobe);
    lien.download = nomFichier;
    
    // Ajouter le lien au DOM et déclencher le téléchargement
    document.body.appendChild(lien);
    lien.click();
    
    // Supprimer le lien du DOM
    document.body.removeChild(lien);
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
    if (document.getElementById("nouveau")) {
        var element = document.getElementById("nouveau");
    element.style.backgroundColor = "lightgrey";
    }
    
    var element = document.getElementById("compte");
    element.style.backgroundColor = "lightgrey";
    var element = document.getElementById("finit");
    element.style.backgroundColor = "lightgrey";

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
function generatePDF(info, piece) {
    // Importer la bibliothèque jsPDF
    // const { jsPDF } = window.jspdf;

    // Créer un nouveau document PDF
    const doc = new jsPDF();

    // Définir la taille de la police et les marges
    const fontSize = 12;
    const margin = 10;

    // Définir la position initiale du texte
    let y = margin;

    // Ajouter les données de l'info
    doc.setFontSize(fontSize);
    doc.text("Informations de la série :", margin, y);
    y += fontSize + margin;
    Object.keys(info).forEach(key => {
        doc.text(`${key}: ${info[key]}`, margin, y);
        y += fontSize;
    });

    // Ajouter les données des pièces
    y += margin;
    doc.text("Liste des pièces :", margin, y);
    y += fontSize + margin;
    piece.forEach((p, index) => {
        doc.text(`${index + 1}. ${p}`, margin, y);
        y += fontSize;
    });

    // Enregistrer le document sous forme de blob
    const blob = doc.output('blob');
return blob;
    // // Créer une URL à partir du blob
    // const url = URL.createObjectURL(blob);

    // // Mettre à jour la valeur de l'élément HTML avec l'ID "pdf"
    // var pdfInput = document.getElementById('pdf');
    // pdfInput.value = url; /* Mettre à jour la valeur avec l'URL */

    // Ne pas soumettre le formulaire automatiquement ici
}
