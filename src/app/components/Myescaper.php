<?php

namespace App\Components;

use Phalcon\Escaper;

class Myescaper
{
    public function sanitize($input)
    {
        $escaper = new Escaper();
        $arr =  $input;

        $input = $escaper->escapeHtml($arr);

        return $input;
    }
}
