<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::latest()->paginate(15);
        return view('admin.promos.index', compact('promos'));
    }

    public function create()
    {
        return view('admin.promos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_promo'      => 'required|string|max:255',
            'konten'           => 'required|string',
            'tanggal_berakhir' => 'nullable|date',
            'gambar_banner'    => 'nullable|image|max:3072',
            'file_brosur'      => 'nullable|max:5120',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('gambar_banner')) {
            $path = $request->file('gambar_banner')->store('promos', 'public');
            $validated['gambar_banner'] = $path;
            $validated['file_brosur']   = $path;
        }

        Promo::create($validated);

        return redirect()->route('admin.promos.index')
                         ->with('success', 'Promo berhasil ditambahkan!');
    }

    public function show(Promo $promo)
    {
        return redirect()->route('admin.promos.edit', $promo);
    }

    public function edit(Promo $promo)
    {
        return view('admin.promos.edit', compact('promo'));
    }

    public function update(Request $request, Promo $promo)
    {
        $validated = $request->validate([
            'judul_promo'      => 'required|string|max:255',
            'konten'           => 'required|string',
            'tanggal_berakhir' => 'nullable|date',
            'gambar_banner'    => 'nullable|image|max:3072',
            'file_brosur'      => 'nullable|max:5120',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('gambar_banner')) {
            if ($promo->gambar_banner) {
                Storage::disk('public')->delete($promo->gambar_banner);
            }
            $path = $request->file('gambar_banner')->store('promos', 'public');
            $validated['gambar_banner'] = $path;
            $validated['file_brosur']   = $path;
        }

        $promo->update($validated);

        return redirect()->route('admin.promos.index')
                         ->with('success', 'Promo berhasil diperbarui!');
    }

    public function destroy(Promo $promo)
    {
        if ($promo->gambar_banner) {
            Storage::disk('public')->delete($promo->gambar_banner);
        }
        if ($promo->file_brosur) {
            Storage::disk('public')->delete($promo->file_brosur);
        }
        $promo->delete();

        return redirect()->route('admin.promos.index')
                         ->with('success', 'Promo berhasil dihapus.');
    }
}