<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MultiClasses extends Controller
{
    //
    /* protected $a;
    public function __construct(abc $a)
    {
        $this->a = $a;
    } */
    function abc(abc $a){
        print_R($a->abc());die;
    }
}

class abc{
    function abc(){
        return 'sencond class';
    }
}
