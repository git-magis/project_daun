<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\JenisBunga;

class JenisBungaController extends Controller
{

    public function index()
    {
        // Fetch all data from the bunga table
        $data = JenisBunga::query()
            ->leftJoin('bungas', 'jenisbungas.id', '=', 'bungas.jenisb_id')
            ->select('jenisbungas.*', DB::raw('COUNT(bungas.id) as total'))
            ->groupBy('jenisbungas.id')
            ->get();

        
        foreach ($data as $jenisBunga) {
                DB::table('jenisbungas')->where('id', $jenisBunga->id)->update(['jumlah' => $jenisBunga->total]);
        }

        return view('admin.manage_jenis_bunga', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jenis_bunga' => 'required|string|max:255',
            // 'jumlah' => 'required|string',
            'nama_ilmiah' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'gambar_bunga' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the file upload
        if ($request->hasFile('gambar_bunga')) {
            $imageName = time() . '.' . $request->gambar_bunga->extension();
            $request->gambar_bunga->move(public_path('images'), $imageName);
        }

        // Save the data to the database
        JenisBunga::create([
            'nama_jenis_bunga' => $validated['nama_jenis_bunga'],
            // 'jumlah' => $validated['jumlah'],
            'nama_ilmiah' => $validated['nama_ilmiah'],
            'deskripsi' => $validated['deskripsi'],
            'gambar_bunga' => $imageName ?? null,
        ]);

        // return redirect()->route('manage-jenis-bunga')->with('success', 'Data saved successfully.');
        return redirect()->route(auth()->user()->level === 'admin' ? 'admin.manage-jenis-bunga' : 'staff.manage-jenis-bunga')
        ->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_jenis_bunga' => 'required|string|max:255',
            // 'jumlah' => 'required|string',
            'nama_ilmiah' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'gambar_bunga' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $data = JenisBunga::findOrFail($id); // Find the bunga record by ID
    
        // Handle the file upload
        if ($request->hasFile('gambar_bunga')) {
            $imageName = time() . '.' . $request->gambar_bunga->extension();
            $request->gambar_bunga->move(public_path('images'), $imageName);
            $data->gambar_bunga = $imageName; // Update the image field
        }
        else {
            $imageName = $data->getOriginal('gambar_bunga');
        }

        // dd($validated);
    
        // Update other fields
        $data->update([
            'nama_jenis_bunga' => $validated['nama_jenis_bunga'],
            // 'jumlah' => $validated['jumlah'],
            'nama_ilmiah' => $validated['nama_ilmiah'],
            'deskripsi' => $validated['deskripsi'],
            'gambar_bunga' => $imageName,
        ]);
    
        // return redirect()->route('manage-jenis-bunga')->with('success', 'Data updated successfully.');
        return redirect()->route(auth()->user()->level === 'admin' ? 'admin.manage-jenis-bunga' : 'staff.manage-jenis-bunga')
        ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Find the tree by ID and delete it
        $data = JenisBunga::findOrFail($id);
        $data->delete();

        // Redirect back with a success message
        // return redirect()->route('manage-jenis-bunga')->with('success', 'Jenis bunga berhasil dihapus.');
        return redirect()->route(auth()->user()->level === 'admin' ? 'admin.manage-jenis-bunga' : 'staff.manage-jenis-bunga')
        ->with('success', 'Data berhasil dihapus.');
    }


}
