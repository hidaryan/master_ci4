<?php

namespace App\Controllers;

class PagesController extends BaseController
{
    public function index()
    {

        $data = [
            'nav'    => 'dashboard',
            'title'    => 'Dashboard'
        ];
        return view('pages/home', $data);
    }
}
