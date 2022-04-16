<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    // En algunas ocasiones el controlador puede tener una única acción o método en lugar de varios, en tal caso "single action controller" el método se puede invocar automáticamente con la función __invoke()
    public function __invoke()
    {
        return 'Single';
    }
}
