const mariadb = require('mariadb');

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


async function sauvegarderCarte() {
    console.log("sauvegarderCarte")
    try {
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
    // recupereles données a partir du ../../env.json
    const dbLog = JSON.parse('../../env.json');
    console.log(dbLog)
    const connection = await mariadb.createConnection(dbLog);
    // drop table si elle existe deja
    await connection.query("DROP TABLE IF EXISTS carte");
    // creation de la table
    await connection.query("CREATE TABLE carte (id INT NOT NULL AUTO_INCREMENT, categorie VARCHAR(255), titre VARCHAR(255), PRIMARY KEY (id))");
    // insertion des données
    await connection.query("INSERT INTO carte (categorie, titre) VALUES ?", [carte]);
    // fermeture de la connexion
    connection.end();
    } catch (err) {
        console.log(err);
    }
}