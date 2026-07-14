<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gemini\Laravel\Facades\Gemini;

class AssistantController extends Controller 
{
    public function index() 
    {
        return view('landing');
    }

}