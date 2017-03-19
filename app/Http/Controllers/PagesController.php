<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function splash() {

        $title = 'Welcome to Lifecanvas';
        $description = 'Lifecanvas, take a byte our of life';
        $hidenav = false;

        return view('pages.splash', compact('title', 'description','hidenav'));

    }

}
