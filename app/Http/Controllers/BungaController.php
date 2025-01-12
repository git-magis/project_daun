<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bunga;
use App\Models\JenisBunga;
use App\Models\Taman;

class BungaController extends Controller
{

    public function index()
    {
        // Fetch all data from the bunga table
        $data = Bunga::with(['jenisBunga','taman'])->get();
        $jenis_bunga = JenisBunga::all();
        $taman_lokasi = Taman::all();

        // Pass data to the view
        return view('admin.manage_bunga', compact('data', 'jenis_bunga', 'taman_lokasi'));  // Ensure 'data' is passed correctly
    }

    public function create()
    {
        // Fetch related data for dropdowns
        $jenis_bunga = JenisBunga::all();
        $taman_lokasi = Taman::all();
    
        // Return the create view with the required data
        return view('pohon.create', compact('jenis_bunga', 'taman_lokasi'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_bunga' => 'required|string|max:255',
            'jenisb_id' => 'required|exists:jenisbungas,id',
            'lokasib_id' => 'required|exists:tamans,id',
            'gambar_bunga' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the file upload
        if ($request->hasFile('gambar_bunga')) {
            $imageName = time() . '.' . $request->gambar_bunga->extension();
            $request->gambar_bunga->move(public_path('images'), $imageName);
        }

        // Save the data to the database
        Bunga::create([
            'nama_bunga' => $validated['nama_bunga'],
            'jenisb_id' => $validated['jenisb_id'],
            'lokasib_id' => $validated['lokasib_id'],
            'gambar_bunga' => $imageName ?? null,
        ]);

        return redirect()->route('manage-bunga')->with('success', 'Data saved successfully.');
    }

    public function edit($id)
    {
        // Fetch the existing tree record
        $bunga = Bunga::findOrFail($id);
    
        // Fetch related data for dropdowns
        $jenis_bunga = JenisBunga::all();
        $taman_lokasi = Taman::all();
    
        // Return the edit view with the required data
        return view('pohon.edit', compact('bunga', 'jenis_bunga', 'taman_lokasi'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_bunga' => 'required|string|max:255',
            'jenisb_id' => 'required|exists:jenisbungas,id',
            'lokasib_id' => 'required|exists:tamans,id',
            'gambar_bunga' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $data = Bunga::findOrFail($id); // Find the bunga record by ID
    
        // Handle the file upload
        if ($request->hasFile('gambar_bunga')) {
            $imageName = time() . '.' . $request->gambar_bunga->extension();
            $request->gambar_bunga->move(public_path('images'), $imageName);
            $data->gambar_bunga = $imageName; // Update the image field
        }
    
        // Update other fields
        $data->update([
            'nama_bunga' => $validated['nama_bunga'],
            'jenisb_id' => $validated['jenisb_id'],
            'lokasib_id' => $validated['lokasib_id'],
            'gambar_bunga' => $data->gambar_bunga ?? null, // Keep the existing image if not updated
        ]);
    
        return redirect()->route('manage-bunga')->with('success', 'Data updated successfully.');
    }

    public function destroy($id)
    {
        // Find the tree by ID and delete it
        $data = Bunga::findOrFail($id);
        $data->delete();

        // Redirect back with a success message
        return redirect()->route('manage-bunga')->with('success', 'bunga berhasil dihapus.');
    }


}
