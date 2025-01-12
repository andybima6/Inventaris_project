<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        // Static data for the profile page
        // Static data for the profile page
        $company = [
            'name' => 'BPBD Gresik',
            'address' => 'Jl. Dr. Wahidin Sudirohusodo No.133, Kebomas, Randuagung, Kec. Kebomas, Kabupaten Gresik, Jawa Timur 61121',
            'phone' => '(031) 3985151',
            'province' => 'Jawa Timur',
            'photos' => [
                'images/1.jpg',
                'images/2.jpg',
                'images/3.jpg',
                'images/4.jpg',
                'images/5.jpg',
                'images/6.jpg',
                'images/7.jpg',
                'images/8.jpg',
                'images/9.jpg',
                'images/10.jpg',
            ]
        ];

        // Return the profile view with company data
        return view('profile', compact('company'));
    }
}
