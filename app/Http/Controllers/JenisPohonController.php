<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\JenisPohon;

class JenisPohonController extends Controller
{

    public function index()
    {
        // Fetch all data from the pohon table
        // $data = JenisPohon::all();

        $data = JenisPohon::query()
            ->leftJoin('pohons', 'jenispohons.id', '=', 'pohons.jenis_id')
            ->select('jenispohons.*', DB::raw('COUNT(pohons.id) as total'))
            ->groupBy('jenispohons.id')
            ->get();

            foreach ($data as $jenisPohon) {
                DB::table('jenispohons')->where('id', $jenisPohon->id)->update(['jumlah' => $jenisPohon->total]);
            }
        
        return view('admin.manage_jenis_pohon', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jenis_pohon' => 'required|string|max:255',
            // 'jumlah' => 'required|string',
            'nama_ilmiah' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'gambar_pohon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the file upload
        if ($request->hasFile('gambar_pohon')) {
            $imageName = time() . '.' . $request->gambar_pohon->extension();
            $request->gambar_pohon->move(public_path('images'), $imageName);
        }

        // Save the data to the database
        JenisPohon::create([
            'nama_jenis_pohon' => $validated['nama_jenis_pohon'],
            // 'jumlah' => $validated['jumlah'],
            'nama_ilmiah' => $validated['nama_ilmiah'],
            'deskripsi' => $validated['deskripsi'],
            'gambar_pohon' => $imageName ?? null,
        ]);

        // return redirect()->route('manage-jenis-pohon')->with('success', 'Data saved successfully.');
        return redirect()->route(auth()->user()->level === 'admin' ? 'admin.manage-jenis-pohon' : 'staff.manage-jenis-pohon')
        ->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_jenis_pohon' => 'required|string|max:255',
            // 'jumlah' => 'required|string',
            'nama_ilmiah' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'gambar_pohon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $data = JenisPohon::findOrFail($id); // Find the Pohon record by ID
    
        // Handle the file upload
        if ($request->hasFile('gambar_pohon')) {
            $imageName = time() . '.' . $request->gambar_pohon->extension();
            $request->gambar_pohon->move(public_path('images'), $imageName);
            $data->gambar_pohon = $imageName; // Update the image field
        }
        else {
            $imageName = $data->getOriginal('gambar_pohon');
        }
    
        // Update other fields
        $data->update([
            'nama_jenis_pohon' => $validated['nama_jenis_pohon'],
            // 'jumlah' => $validated['jumlah'],
            'nama_ilmiah' => $validated['nama_ilmiah'],
            'deskripsi' => $validated['deskripsi'],
            'gambar_pohon' => $imageName,
        ]);
    
        // return redirect()->route('manage-jenis-pohon')->with('success', 'Data updated successfully.');
        return redirect()->route(auth()->user()->level === 'admin' ? 'admin.manage-jenis-pohon' : 'staff.manage-jenis-pohon')
        ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Find the tree by ID and delete it
        $data = JenisPohon::findOrFail($id);
        $data->delete();

        // Redirect back with a success message
        // return redirect()->route('manage-jenis-pohon')->with('success', 'Jenis Pohon berhasil dihapus.');
        return redirect()->route(auth()->user()->level === 'admin' ? 'admin.manage-jenis-pohon' : 'staff.manage-jenis-pohon')
        ->with('success', 'Data berhasil dihapus.');
    }


}
