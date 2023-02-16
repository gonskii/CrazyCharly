<?php

namespace teamiut\action;

use classes\auth\Auth;

class Accueil implements Action
{

    public function execute(): string
    {
        $header = new Header();
        $html = $header->execute();
        $footer = new Footer();
        $html .= $footer->execute();
        return $html;
    }
}