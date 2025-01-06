<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bunga;

class BungaController extends Controller
{

    public function index()
    {
        // Fetch all data from the bunga table
        $data = Bunga::all();

        // Pass data to the view
        return view('admin.manage_bunga', ['data' => $data]);  // Ensure 'data' is passed correctly
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_bunga' => 'required|string|max:255',
            'jenis_bunga' => 'required|string',
            'lokasi_bunga' => 'required|string',
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
            'jenis_bunga' => $validated['jenis_bunga'],
            'lokasi_bunga' => $validated['lokasi_bunga'],
            'gambar_bunga' => $imageName ?? null,
        ]);

        return redirect()->route('manage-bunga')->with('success', 'Data saved successfully.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_bunga' => 'required|string|max:255',
            'jenis_bunga' => 'required|string',
            'lokasi_bunga' => 'required|string',
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
            'jenis_bunga' => $validated['jenis_bunga'],
            'lokasi_bunga' => $validated['lokasi_bunga'],
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
