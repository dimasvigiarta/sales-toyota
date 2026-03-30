<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Promo;
use App\Models\SalesContact;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_cars'     => Car::count(),
            'active_cars'    => Car::active()->count(),
            'active_promos'  => Promo::active()->count(),
            'total_contacts' => SalesContact::active()->count(),
        ];

        $recentCars   = Car::latest()->take(5)->get();
        $activePromos = Promo::active()->latest()->take(3)->get();

        return view('admin.dashboard', compact('stats', 'recentCars', 'activePromos'));
    }
}