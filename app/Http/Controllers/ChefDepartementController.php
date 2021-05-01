<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChefDepartementController extends Controller
{
    public function getEmploi()
    {
        return view('Chef.emploi');
    }
}
