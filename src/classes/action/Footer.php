<?php

namespace teamiut\action;

use teamiut\action\Action;

class Footer implements Action
{
    function execute(): string
    {
        $html = <<<END
    <!DOCTYPE html>
            <html lang="fr"> <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="src/css/footer.css">
            <link href="https://fonts.cdnfonts.com/css/marine-sikona" rel="stylesheet">
END;

        $html .= <<<END
        <!-- generate a footer including the src/images/logo-courcircuitbon.png and a dark grey background using bootstrpa--> 
        <footer class="bg-dark text-center text-white">
        <!-- Grid container -->
        <div class="container p-4">
            <!-- Section: Social media -->
            <section class="mb-4">
            <!-- Facebook -->
            <a class="btn btn-outline-light btn-floating m-1" href="https://www.facebook.com/courtcircuitVoltaire/" role="button"
                ><i class="fab fa-facebook-f"></i
            ></a>

            <!-- Instagram -->
            <a class="btn btn-outline-light btn-floating m-1" href="https://www.instagram.com/courtcircuitvoltaire/?hl=fr" role="button"
                ><i class="fab fa-instagram"></i
            ></a>
            </section>
            <!-- Section: Social media -->

            <!-- Section: Text -->
            <section class="mb-4">
            <p>
            Court-circuit est un lieu de vie associant épicerie vrac/bio/produits locaux et café-bar 100% local et équitable. 
            </p>
            </section>
            <!-- Section: Text -->

            <!-- Section: Links -->
            <section class="">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Menu</h5>

                <ul class="list-unstyled mb-0">
                    <li>
                    <a href="#!" class="text-white">Accueil</a>
                    </li>
                    <li>
                    <a href="#!" class="text-white">Le restaurant</a>
                    </li>
                    <li>
                    <a href="#!" class="text-white">Evenement</a>
                    </li>
                    <li>
                    <a href="#!" class="text-white">Notre engagement</a>
                    </li>
                    <li>
                    <a href="#!" class="text-white">Contact</a>
                    </li>
                </ul>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Informations</h5>

                <ul class="list-unstyled mb-0>
                    <li>
                    <a href="#!" class="text-white">Mentions légales</a>
                    </li>
                    <li>
                    <a href="#!" class="text-white">Politique de confidentialité</a>
                    </li>
                    <li>
                    <a href="#!" class="text-white">Plan du site</a>
                    </li>
                    
                </ul>
                </div>
                <!--Grid column-->
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Contact</h5>
                    <ul class="list-unstyled mb-0>
                        <li>
                        <a href="#!" class="text-white">local@circuitcourtnancy.fr</a>
                        </li>
                        <li>
                        <a href="#!" class="text-white">47 rue Voltaire</a>
                        </li>
                        <li>
                        <a href="#!" class="text-white">Laxou</a>
                        </li>
                        <li>
                        <a href="#!" class="text-white">03 83 19 71 03</a>
                        </li>
                        <li>
                        <a href="#!" class="text-white">
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->
            </section>
            <!-- Section: Links -->
        </div>
        <!-- Grid container -->
        
               
        
        <!-- integration bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
        END;


        return $html;
    }
}