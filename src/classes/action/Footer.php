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
        
        <div class="div1">
                <img src="src/images/logo-courcircuitbon.png" alt="Logo CourtCircuit">
        </div>
        <div class="div2">
            
        </div>
        <div class="div3">
        
        </div>
        <div class="div4">
        
        </div>
        <div>
        
        </div>
        <div class="div5">
        
        </div>
        <div class="div6">
        
        </div>
        <div class="div7">
        
        </div>
        END;


        return $html;
    }
}