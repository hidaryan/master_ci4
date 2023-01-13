<?php

namespace App\Controllers;

class PagesController extends BaseController
{
    public function index()
    {

        $data = [
            'nav'    => 'dashboard'
        ];
        return view('pages/home', $data);
    }
}
