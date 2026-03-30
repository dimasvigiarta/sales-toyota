<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::withCount('images')->latest()->paginate(15);
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_mobil'  => 'required|string|max:255',
            'kategori'    => 'required|in:SUV,MPV,Hatchback,Sedan,Pickup,Sport',
            'harga_mulai' => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
            'spesifikasi' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'is_active'   => 'nullable|boolean',
            'gallery.*'   => 'nullable|image|max:2048',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active']   = $request->has('is_active');

      // Bangun spesifikasi dari input form biasa
        if ($request->filled('spek')) {
            $spek = $request->input('spek');
            // Bersihkan nilai kosong
            $validated['spesifikasi'] = array_filter([
                'mesin'       => array_filter($spek['mesin'] ?? []),
                'transmisi'   => $spek['transmisi'] ?? null,
                'bahan_bakar' => $spek['bahan_bakar'] ?? null,
                'dimensi'     => array_filter($spek['dimensi'] ?? []),
                'interior'    => array_filter($spek['interior'] ?? []),
                'fitur'       => $spek['fitur'] ?? [],
            ]);
        }

        // Proses warna
        if ($request->filled('warna')) {
            $warnas = collect($request->input('warna'))
                ->filter(fn($w) => !empty($w['nama']))
                ->values()
                ->toArray();
            $validated['warna_tersedia'] = $warnas;
        }


        $car = Car::create($validated);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $i => $file) {
                $path = $file->store("cars/{$car->id}/gallery", 'public');
                $car->images()->create([
                    'path_gambar' => $path,
                    'tipe_gambar' => 'galeri',
                    'urutan'      => $i,
                ]);
            }
        }

        return redirect()->route('admin.cars.index')
                         ->with('success', 'Mobil berhasil ditambahkan!');
    }

    public function show(Car $car)
    {
        return redirect()->route('admin.cars.edit', $car);
    }

    public function edit(Car $car)
    {
        $car->load(['galleryImages', 'threeSixtyImages']);
        return view('admin.cars.edit', compact('car'));
    }

   public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'nama_mobil'  => 'required|string|max:255',
            'kategori'    => 'required|in:SUV,MPV,Hatchback,Sedan,Pickup,Sport',
            'harga_mulai' => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
            'spesifikasi' => 'nullable|string',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active']   = $request->has('is_active');

        if ($request->filled('spek')) {
            $spek = $request->input('spek');
            $validated['spesifikasi'] = array_filter([
                'mesin'       => array_filter($spek['mesin'] ?? []),
                'transmisi'   => $spek['transmisi'] ?? null,
                'bahan_bakar' => $spek['bahan_bakar'] ?? null,
                'dimensi'     => array_filter($spek['dimensi'] ?? []),
                'interior'    => array_filter($spek['interior'] ?? []),
                'fitur'       => $spek['fitur'] ?? [],
            ]);
        }

        // Proses warna
        if ($request->filled('warna')) {
            $warnas = collect($request->input('warna'))
                ->filter(fn($w) => !empty($w['nama']))
                ->values()
                ->toArray();
            $validated['warna_tersedia'] = $warnas;
        } else {
            $validated['warna_tersedia'] = [];
        }

       // Proses highlights
        if ($request->has('highlights')) {
            $highlightItems = [];

            foreach ($request->input('highlights', []) as $i => $item) {
                if (empty($item['judul'])) continue;

                $gambarHero = $item['gambar_hero_existing'] ?? null;

                $subItems = [];
                foreach ($item['sub_items'] ?? [] as $j => $sub) {
                    if (empty($sub['caption'])) continue;
                    $subItems[] = [
                        'gambar'    => $sub['gambar_existing'] ?? null,
                        'caption'   => $sub['caption'],
                        'deskripsi' => $sub['deskripsi'] ?? '',
                    ];
                }

                $highlightItems[] = [
                    'judul'       => $item['judul'],
                    'deskripsi'   => $item['deskripsi'] ?? '',
                    'gambar_hero' => $gambarHero,
                    'sub_items'   => $subItems,
                ];
            }

            $validated['highlights'] = $highlightItems;
        } else {
            $validated['highlights'] = [];
        }

        if ($car->nama_mobil !== $validated['nama_mobil']) {
            $validated['slug'] = Str::slug($validated['nama_mobil']);
        }

        $car->update($validated);

        return redirect()->route('admin.cars.edit', $car)
                        ->with('success', 'Data mobil berhasil diperbarui!');
    }

    public function destroy(Car $car)
    {
        foreach ($car->images as $image) {
            Storage::disk('public')->delete($image->path_gambar);
        }
        $car->delete();

        return redirect()->route('admin.cars.index')
                         ->with('success', 'Mobil berhasil dihapus.');
    }

    public function uploadImages(Request $request, Car $car)
    {
        Log::info('warna_nama received: ' . $request->input('warna_nama', 'NULL'));

        $request->validate([
            'images.*'    => 'required|image|max:2048',
            'tipe_gambar' => 'required|in:galeri,360_degree',
        ]);

        $uploaded   = [];
        $warnaNama  = $request->input('warna_nama') ?: null;
        $lastUrutan = $car->images()
                        ->where('tipe_gambar', $request->tipe_gambar)
                        ->when($warnaNama, fn($q) => $q->where('warna_nama', $warnaNama))
                        ->max('urutan') ?? -1;

        foreach ($request->file('images') as $file) {
            $lastUrutan++;
            $path = $file->store("cars/{$car->id}/{$request->tipe_gambar}", 'public');
            $img  = $car->images()->create([
                'path_gambar' => $path,
                'tipe_gambar' => $request->tipe_gambar,
                'urutan'      => $lastUrutan,
                'warna_nama'  => $warnaNama,
            ]);
            $uploaded[] = ['id' => $img->id, 'url' => asset('storage/' . $path)];
        }

        return response()->json(['success' => true, 'images' => $uploaded]);
    }

    public function deleteImage(CarImage $image)
    {
        Storage::disk('public')->delete($image->path_gambar);
        $image->delete();
        return response()->json(['success' => true]);
    }

    public function uploadHighlightImage(Request $request, Car $car)
    {
        $request->validate([
            'gambar'    => 'required|image|max:3072',
            'index'     => 'required|integer',
            'tipe'      => 'required|in:hero,sub',
            'sub_index' => 'nullable|integer',
        ]);

        $path       = $request->file('gambar')->store("cars/{$car->id}/highlights", 'public');
        $index      = (int) $request->input('index');
        $tipe       = $request->input('tipe');
        $subIndex   = (int) $request->input('sub_index', 0);

        $raw        = DB::table('cars')->where('id', $car->id)->value('highlights');
        $highlights = json_decode($raw, true) ?? [];

        while (count($highlights) <= $index) {
            $highlights[] = [
                'judul'       => '',
                'deskripsi'   => '',
                'gambar_hero' => null,
                'sub_items'   => [],
            ];
        }

        if ($tipe === 'hero') {
            $highlights[$index]['gambar_hero'] = $path;
        } else {
            while (count($highlights[$index]['sub_items'] ?? []) <= $subIndex) {
                $highlights[$index]['sub_items'][] = [
                    'gambar'    => null,
                    'caption'   => '',
                    'deskripsi' => '',
                ];
            }
            $highlights[$index]['sub_items'][$subIndex]['gambar'] = $path;
        }

        DB::table('cars')
        ->where('id', $car->id)
        ->update(['highlights' => json_encode($highlights)]);

        return response()->json([
            'success' => true,
            'path'    => $path,
            'url'     => asset('storage/' . $path),
        ]);
    }
}
