<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


use App\Models\Pohon;
use App\Models\JenisPohon;
use App\Models\Taman;
use Barryvdh\DomPDF\Facade\Pdf;

class PohonController extends Controller
{

    public function index()
    {
        // Fetch all data from the pohon table
        $data = Pohon::with(['jenisPohon','taman'])->get();
        $jenis_pohon = JenisPohon::all();
        $taman_lokasi = Taman::all();
        

        // Pass data to the view
        // return view('admin.manage_pohon', ['data' => $data]);  // Ensure 'data' is passed correctly
        return view('admin.manage_pohon', compact('data', 'jenis_pohon', 'taman_lokasi'));
    }

    public function create()
    {
        // Fetch related data for dropdowns
        $jenis_pohon = JenisPohon::all();
        $taman_lokasi = Taman::all();
    
        // Return the create view with the required data
        return view('pohon.create', compact('jenis_pohon', 'taman_lokasi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pohon' => 'required|string|max:255',
            'jenis_id' => 'required|exists:jenispohons,id',
            'lokasi_id' => 'required|exists:tamans,id',
            'gambar_pohon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jumlahInput' => 'required|integer|min:1|max:100',
            'tanggal_tanam' => 'nullable|date',
        ]);

        $imageName = null;

        // Handle the file upload
        if ($request->hasFile('gambar_pohon')) {
            $imageName = time() . '.' . $request->gambar_pohon->extension();
            $request->gambar_pohon->move(public_path('images'), $imageName);
        }

        $jumlah = $validated['jumlahInput'];
        $baseName = $validated['nama_pohon'];
        $data = [];

        for ($i = 1; $i <= $jumlah; $i++) {
            $data[] = [
                'nama_pohon' => $jumlah > 1 ? $baseName . '-' . $i : $baseName,
                'jenis_id' => $validated['jenis_id'],
                'lokasi_id' => $validated['lokasi_id'],
                'gambar_pohon' => $imageName,
                'tanggal_tanam' => $validated['tanggal_tanam'],
                'user_id' => auth()->id(),
                'created_at' => now(),
                'updated_at' => now(), 
            ];
        }

        // Pohon::insert($data);
        foreach ($data as $tangkal) {
            Pohon::create($tangkal);
        }
        
        // Pohon::create([
        //     'nama_pohon' => $validated['nama_pohon'],
        //     'jenis_id' => $validated['jenis_id'],
        //     'lokasi_id' => $validated['lokasi_id'],
        //     'gambar_pohon' => $imageName ?? null,
        //     'user_id' => auth()->id(),
        // ]);

        return redirect()->route(auth()->user()->level === 'admin' ? 'admin.manage-pohon' : 'staff.manage-pohon')
        ->with('success', "$jumlah pohon berhasil ditambahkan.");
    }

    public function edit($id)
    {
        // Fetch the existing tree record
        $pohon = Pohon::findOrFail($id);
    
        // Fetch related data for dropdowns
        $jenis_pohon = JenisPohon::all();
        $taman_lokasi = Taman::all();
    
        // Return the edit view with the required data
        return view('pohon.edit', compact('pohon', 'jenis_pohon', 'taman_lokasi'));
    }

    public function update(Request $request, $id)
    {

        try {
            // Log incoming request data
            Log::info('Update request received:', $request->all());

            $validated = $request->validate([
                'nama_pohon' => 'required|string|max:255',
                'jenis_id' => 'required|exists:jenispohons,id',
                'lokasi_id' => 'required|exists:tamans,id',
                'gambar_pohon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'tanggal_tanam' => 'nullable|date',
            ]);

            // Fetch the Bunga instance
            $data = Pohon::findOrFail($id);
            Log::info('Model state before update:', $data->toArray());

            // Update the model with new data
            $data->update($request->all());
            Log::info('Model state after update:', $data->toArray());

            $data = Pohon::findOrFail($id); // Find the bunga record by ID
    
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
                'nama_pohon' => $validated['nama_pohon'],
                'jenis_id' => $validated['jenis_id'],
                'lokasi_id' => $validated['lokasi_id'],
                'gambar_pohon' => $imageName,
                'tanggal_tanam' => $validated['tanggal_tanam'],
            ]);
        
            // return redirect()->route('manage-pohon')->with('success', 'Data updated successfully.');
            return redirect()->route(auth()->user()->level === 'admin' ? 'admin.manage-pohon' : 'staff.manage-pohon')
            ->with('success', 'Data berhasil diperbarui.');

        } catch (\Exception $e) {
            // Log any exceptions
            Log::error('Error during update:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Failed to update Pohon'], 500);
        }
    }

    public function destroy($id)
    {
        // Find the tree by ID and delete it
        $data = Pohon::findOrFail($id);
        $data->delete();

        // Redirect back with a success message
        // return redirect()->route('manage-pohon')->with('success', 'Pohon berhasil dihapus.');
        return redirect()->route(auth()->user()->level === 'admin' ? 'admin.manage-pohon' : 'staff.manage-pohon')
        ->with('success', 'Data berhasil dihapus.');
    }

    public function downloadQRPohon($id) {
        $data = Pohon::with(['jenisPohon', 'taman'])->findOrFail($id);

        // $safeKodeUnik = preg_replace('/[\/\\\\]/', '_', $data->kode_unik);

        $pdf = Pdf::loadView('admin.pdf_pohon', compact('data'))->setPaper('a5', 'landscape');

        return $pdf->stream('pohon_' . $data->id . '.pdf');
    }


}
