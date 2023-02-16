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
                <img id="imageMenu" src="src/images/menu.jpg" alt="Menu">
             </body>
END;
        return $html;
    }
}