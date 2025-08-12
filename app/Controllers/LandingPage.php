<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class LandingPage extends Controller
{
  public function index(): string
  {
    return view('landing');
  }
}
