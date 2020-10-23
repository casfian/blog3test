<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $tajuk = 'Welcome to Laravel';
        return view('pages.index', compact('tajuk'));
    }

    public function about() {
        $tajuk = 'About Page';
        return view('pages.about', compact('tajuk'));
    }

    public function services() {
        $data = array(
            'tajuk' => 'Our Services',
            'services' => ['Web Design', 'UI/UX', 'SEO', 'Programming']
        );
        return view('pages.services')->with($data); //laravel way
        //return view('pages.services', compact('data')); //php
    }
}
