<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('frontend.home', [
            'seo' => [
                'title' => 'Affordable Website Development Company in India | Kayacode',
                'description' => 'Kayacode is an affordable website development company in India offering professional website development, premium websites at affordable prices, and custom web applications for small businesses and startups across India.',
                'canonical' => route('home'),
                'keywords' => implode(', ', [
                    'affordable website development company India',
                    'website development company India',
                    'affordable website development India',
                    'professional website development',
                    'affordable web development company',
                    'custom web application development',
                    'affordable websites for small businesses',
                    'cost effective website development',
                ]),
            ],
        ]);
    }
}
