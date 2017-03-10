<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contato;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    //Função index da área administrativa    
    public function index()
    {
        $contatos = Contato::all();
        return view('admin/home')->with('contatos', $contatos);
    }
    
}
