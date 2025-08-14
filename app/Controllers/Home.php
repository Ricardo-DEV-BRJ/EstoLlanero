<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('dashboard');
    }

      public function quienessomos(): string
    {
        return view('quienessomos');
    }
}
