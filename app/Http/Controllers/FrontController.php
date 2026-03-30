<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Promo;
use App\Models\SalesContact;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function home()
    {
        $featuredCars = Car::active()->featured()
                           ->with(['images' => fn($q) => $q->where('tipe_gambar', 'galeri')
                                                            ->orderBy('urutan')])
                           ->latest()
                           ->take(6)
                           ->get();

        $categories = Car::active()
                         ->select('kategori')
                         ->distinct()
                         ->pluck('kategori');

        $activePromos = Promo::active()->latest()->take(3)->get();

        return view('front.home', compact('featuredCars', 'categories', 'activePromos'));
    }

    public function carIndex(Request $request)
    {
        $query = Car::active()->with('images');

        if ($request->filled('kategori')) {
            $query->kategori($request->kategori);
        }

        if ($request->filled('search')) {
            $query->where('nama_mobil', 'like', '%' . $request->search . '%');
        }

        $sortBy = $request->get('sort', 'latest');
        match($sortBy) {
            'harga_asc'  => $query->orderBy('harga_mulai'),
            'harga_desc' => $query->orderByDesc('harga_mulai'),
            default      => $query->latest(),
        };

        $cars       = $query->paginate(12)->withQueryString();
        $categories = Car::active()->select('kategori')->distinct()->pluck('kategori');

        return view('front.cars.index', compact('cars', 'categories'));
    }

    public function carShow(string $slug)
    {
        $car = Car::active()
                  ->where('slug', $slug)
                  ->with(['galleryImages', 'threeSixtyImages'])
                  ->firstOrFail();

        $relatedCars = Car::active()
                          ->where('kategori', $car->kategori)
                          ->where('id', '!=', $car->id)
                          ->with('images')
                          ->take(3)
                          ->get();

        return view('front.cars.show', compact('car', 'relatedCars'));
    }

    public function promoIndex()
    {
        $promos = Promo::active()->latest()->paginate(9);
        return view('front.promos.index', compact('promos'));
    }

    public function promoShow(string $slug)
    {
        $promo = Promo::active()->where('slug', $slug)->firstOrFail();
        return view('front.promos.show', compact('promo'));
    }

    public function tentang()
    {
        $contacts = SalesContact::active()->orderBy('wilayah')->get();
        return view('front.tentang', compact('contacts'));
    }

    public function salesContacts()
    {
        $contacts = SalesContact::active()
                                ->select('id', 'nama_sales', 'wilayah', 'nomor_wa', 'pesan_default')
                                ->orderBy('wilayah')
                                ->get()
                                ->map(fn($c) => [
                                    'id'         => $c->id,
                                    'nama_sales' => $c->nama_sales,
                                    'wilayah'    => $c->wilayah,
                                    'wa_link'    => $c->wa_link,
                                ]);

        return response()->json($contacts);
    }
}