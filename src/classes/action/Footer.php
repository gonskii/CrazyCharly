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
        <!-- integration bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
        END;


        return $html;
    }
}