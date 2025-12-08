<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        About::truncate();

        About::create([
            'title' => 'About the Library System',
            
            'description' => 'Our Library Management System is a comprehensive digital solution designed to streamline library operations and enhance user experience. Built with modern technology, it provides efficient tools for managing books, members, and transactions.',
            
            'mission' => 'To provide an accessible, efficient, and user-friendly library management system that promotes knowledge sharing and learning within our community.',
            
            'vision' => 'To become the leading library management platform that revolutionizes how libraries serve their communities through innovative technology and exceptional service.',
            
            'features' => 'Book Catalog Management, Member Registration, Borrowing & Return System, Inventory Tracking, Fine Management, Search & Filter, Reports & Analytics, User Dashboard, Reservation System, Notifications',
            
            // Store team members as array 
            'developer_name' => [
                ['name' => 'Edmar Suayan', 'role' => 'Backend Developer', 'email' => 'edmarsuayan@gmail.com'],
                ['name' => 'Aguiluz Peregrin', 'role' => 'Backend Developer', 'email' => 'aguiluzperegrin@gmail.com'],
                ['name' => 'Gerrylorence Escamillas', 'role' => 'Wireframing/Documentation', 'email' => 'gerrylorenceescamillas@gmail.com'],
                ['name' => 'Kevin Setera', 'role' => 'Frontend Developer', 'email' => 'kevinsetera@gmail.com'],
                ['name' => 'Rymuel Bugarin', 'role' => 'Frontend Developer', 'email' => 'rymuelbugarin@gmail.com'],
                ['name' => 'Sam Andrei Jimenez', 'role' => 'Frontend Developer', 'email' => 'samandreijimenez@gmail.com'],
                ['name' => 'Jemuel Jan Ballebar', 'role' => 'Backend Developer', 'email' => 'jemuelballebar@gmail.com'],
                ['name' => 'Denhmar Dimaculangan', 'role' => 'Documentation', 'email' => 'denhmardimaculangan@gmail.com'],
            ],
            
            'developer_role' => null, 
            'developer_email' => null, 
            
            'image' => null,
            
            'contact_email' => 'contact@librarysystem.com',
            'contact_phone' => '+63 000000000',
        ]);
    }
}