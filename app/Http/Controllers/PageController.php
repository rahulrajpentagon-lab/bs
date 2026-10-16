<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        return view('frontend.about', [
            'seo' => [
                'title' => 'About Kayacode | Affordable Web Development Company in India',
                'description' => 'Kayacode is a professional web development company in India delivering affordable premium website development, custom web applications and cost-effective digital solutions for Indian businesses.',
                'canonical' => route('about'),
                'keywords' => implode(', ', [
                    'affordable web development company India',
                    'web development company India',
                    'professional web development company',
                    'website development for Indian businesses',
                    'affordable website development for small businesses',
                ]),
            ],
        ]);
    }

    public function services(): View
    {
        return view('frontend.services', [
            'seo' => [
                'title' => 'Affordable Website Development Services in India | Kayacode',
                'description' => 'Affordable website development, custom web application development, eCommerce website development, SEO and business software solutions from a trusted web development company in India.',
                'canonical' => route('services'),
                'keywords' => implode(', ', [
                    'affordable website development India',
                    'professional website development',
                    'custom web application development',
                    'affordable web application development',
                    'eCommerce website development',
                    'business website development',
                    'Laravel web application development',
                    'website development for startups',
                ]),
            ],
        ]);
    }

    public function contact(): View
    {
        return view('frontend.contact', [
            'seo' => [
                'title' => 'Contact Kayacode | Affordable Website Development India',
                'description' => 'Contact Kayacode for affordable website development and custom web application quotes in India. We reply within one day with clear price details.',
                'canonical' => route('contact'),
                'keywords' => implode(', ', [
                    'affordable website development India',
                    'website development company India',
                    'contact web development company India',
                    'get website development quote India',
                ]),
            ],
        ]);
    }

    public function works(): View
    {
        return view('frontend.works', [
            'seo' => [
                'title' => 'Our Works | Websites, Web Apps & Mobile Applications | Kayacode',
                'description' => 'Explore Kayacode portfolio projects including business websites, e-commerce stores, dashboards and mobile applications built for Indian businesses.',
                'canonical' => route('works'),
                'keywords' => implode(', ', [
                    'website portfolio India',
                    'mobile app development portfolio',
                    'web application designs',
                    'ecommerce website examples',
                    'business website designs',
                ]),
            ],
        ]);
    }
}
