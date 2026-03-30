<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalesContact;
use Illuminate\Http\Request;

class SalesContactController extends Controller
{
    public function index()
    {
        $contacts = SalesContact::orderBy('wilayah')->get();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('admin.contacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sales'    => 'required|string|max:255',
            'wilayah'       => 'required|in:Utara,Selatan,Barat,Timur,Pusat',
            'nomor_wa'      => 'required|string|max:20',
            'pesan_default' => 'nullable|string',
        ]);

        SalesContact::create([
            'nama_sales'    => $request->nama_sales,
            'wilayah'       => $request->wilayah,
            'nomor_wa'      => $request->nomor_wa,
            'pesan_default' => $request->pesan_default,
            'is_active'     => $request->has('is_active'),
        ]);

        return redirect()->route('admin.contacts.index')
                         ->with('success', 'Kontak sales berhasil ditambahkan!');
    }

    public function show(SalesContact $contact)
    {
        return redirect()->route('admin.contacts.edit', $contact);
    }

    public function edit(SalesContact $contact)
    {
        return view('admin.contacts.edit', compact('contact'));
    }

    public function update(Request $request, SalesContact $contact)
    {
        $request->validate([
            'nama_sales'    => 'required|string|max:255',
            'wilayah'       => 'required|in:Utara,Selatan,Barat,Timur,Pusat',
            'nomor_wa'      => 'required|string|max:20',
            'pesan_default' => 'nullable|string',
        ]);

        $contact->update([
            'nama_sales'    => $request->nama_sales,
            'wilayah'       => $request->wilayah,
            'nomor_wa'      => $request->nomor_wa,
            'pesan_default' => $request->pesan_default,
            'is_active'     => $request->has('is_active'),
        ]);

        return redirect()->route('admin.contacts.index')
                         ->with('success', 'Kontak berhasil diperbarui!');
    }

    public function destroy(SalesContact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')
                         ->with('success', 'Kontak berhasil dihapus.');
    }
}