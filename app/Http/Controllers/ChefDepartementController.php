<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ChefDepartementController extends Controller
{
    public function getEmploi()
    {
        $idChef = Auth::user()->professeur->chefdep->idDepartement;
        //
        return view('Chef.emploi');
    }
}
