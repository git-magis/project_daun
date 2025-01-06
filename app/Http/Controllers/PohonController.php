<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pohon;

class PohonController extends Controller
{

    public function index()
    {
        // Fetch all data from the pohon table
        $data = Pohon::all();

        // Pass data to the view
        return view('admin.manage_pohon', ['data' => $data]);  // Ensure 'data' is passed correctly
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pohon' => 'required|string|max:255',
            'jenis_pohon' => 'required|string',
            'lokasi_pohon' => 'required|string',
            'gambar_pohon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the file upload
        if ($request->hasFile('gambar_pohon')) {
            $imageName = time() . '.' . $request->gambar_pohon->extension();
            $request->gambar_pohon->move(public_path('images'), $imageName);
        }

        // Save the data to the database
        Pohon::create([
            'nama_pohon' => $validated['nama_pohon'],
            'jenis_pohon' => $validated['jenis_pohon'],
            'lokasi_pohon' => $validated['lokasi_pohon'],
            'gambar_pohon' => $imageName ?? null,
        ]);

        return redirect()->route('manage-pohon')->with('success', 'Data saved successfully.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_pohon' => 'required|string|max:255',
            'jenis_pohon' => 'required|string',
            'lokasi_pohon' => 'required|string',
            'gambar_pohon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $data = Pohon::findOrFail($id); // Find the Pohon record by ID
    
        // Handle the file upload
        if ($request->hasFile('gambar_pohon')) {
            $imageName = time() . '.' . $request->gambar_pohon->extension();
            $request->gambar_pohon->move(public_path('images'), $imageName);
            $data->gambar_pohon = $imageName; // Update the image field
        }
    
        // Update other fields
        $data->update([
            'nama_pohon' => $validated['nama_pohon'],
            'jenis_pohon' => $validated['jenis_pohon'],
            'lokasi_pohon' => $validated['lokasi_pohon'],
            'gambar_pohon' => $data->gambar_pohon ?? null, // Keep the existing image if not updated
        ]);
    
        return redirect()->route('manage-pohon')->with('success', 'Data updated successfully.');
    }

    public function destroy($id)
    {
        // Find the tree by ID and delete it
        $data = Pohon::findOrFail($id);
        $data->delete();

        // Redirect back with a success message
        return redirect()->route('manage-pohon')->with('success', 'Pohon berhasil dihapus.');
    }


}
