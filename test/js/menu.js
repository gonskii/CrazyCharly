console.log("menu.js loaded");

// Create a "close" button and append it to each list item
var productElements = document.getElementsByClassName("product");
var i;
for (i = 0; i < productElements.length; i++) {
    var span = document.createElement("SPAN");
    var txt = document.createTextNode("\u00D7");
    span.className = "close";
    span.appendChild(txt);
    productElements[i].appendChild(span);
}

// Click on a close button to hide the current product item
var close = document.getElementsByClassName("close");
var i;
for (i = 0; i < close.length; i++) {
    close[i].onclick = function () {
        var div = this.parentElement;
        div.style.display = "none";
    }
}

// Create a new product item when clicking on the "Add" button
function newProduct() {
    console.log("newProduct");
    var productCatInput = document.getElementById('category-select');
    var idContainer = productCatInput.value;
    console.log(idContainer)
    var productContainer = document.getElementById(idContainer);
    var productTitleInput = document.getElementById("product-title");
    var productCatInput = document.getElementById('category-select');

    var title = productTitleInput.value;

    if (title === '') {
        alert("vous devez choisir un nom de produit");
    } else {
        var product = document.createElement("div");
        product.className = "product";
        var titleElement = document.createElement("h3");
        var titleText = document.createTextNode(title);
        titleElement.appendChild(titleText);
        product.appendChild(titleElement);

        productContainer.appendChild(product);
    }

    productTitleInput.value = "";

    var span = document.createElement("SPAN");
    var txt = document.createTextNode("\u00D7");
    span.className = "close";
    span.appendChild(txt);
    product.appendChild(span);

    for (i = 0; i < close.length; i++) {
        close[i].onclick = function () {
            var div = this.parentElement;
            div.style.display = "none";
        }
    }
}

function sauvegarderCarte() {
    // Récupérer tous les éléments "produit" de la carte
    var produits = document.querySelectorAll(".product");

    // Créer un tableau vide pour stocker les produits
    var carte = [];

    // Itérer à travers chaque élément "produit"
    produits.forEach(function (produit) {
        // Récupérer les informations du produit
        var categorie = produit.parentNode.id;
        var titre = produit.querySelector("h3").innerText;

        // Ajouter les informations du produit au tableau
        carte.push({
            categorie: categorie,
            titre: titre,
        });
    });

    // Envoyer le tableau d'objets JSON à votre base de données
    // créer une requête POST à l'URL de votre base de données
    // avec le tableau d'objets JSON en tant que corps de la requête
    // Code pour enregistrer le tableau de produits dans la base de données ici
}


