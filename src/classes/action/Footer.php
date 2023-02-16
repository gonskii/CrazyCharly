<?php

namespace teamiut\action;

use teamiut\action\Action;

class Footer implements Action
{
    function execute(): string
    {
        $header = new Header();
        $html = $header->execute();

$html .= <<<END
    
END;


        return $html;
    }
}