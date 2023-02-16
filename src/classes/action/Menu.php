<?php

namespace teamiut\action;

class Menu implements Action
{
    function execute(): string
    {
        $header = new Header();
        $html = $header->execute();
        $html .= <<<END
            <body>
             <!-- ajoute le menu en utilisant l image src/images/menu.jpg grace a bootstrap sans rendre l'image trop haute-->
            <div class="container">
                <div class="row text-center " style=".img-max {
  max-width: 500px;
  width:100%;
}">
                        <img src="src/images/menu.jpg" class="img-fluid w-40" alt="Responsive image">
                </div>  
             </body>
END;
        return $html;
    }
}