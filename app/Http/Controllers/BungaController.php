<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Bunga;
use App\Models\JenisBunga;
use App\Models\Taman;
use Barryvdh\DomPDF\Facade\Pdf;

class BungaController extends Controller
{

    public function index()
    {
        // Fetch all data from the bunga table
        $data = Bunga::with(['jenisBunga','taman'])->get();
        $jenis_bunga = JenisBunga::all();
        $taman_lokasi = Taman::all();

        // Pass data to the view
        return view('admin.manage_bunga', compact('data', 'jenis_bunga', 'taman_lokasi')); 
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
            'jumlahInput' => 'required|integer|min:1|max:100',
            'tanggal_tanam' => 'nullable|date',
        ]);

        $imageName = null;

        // Handle the file upload
        if ($request->hasFile('gambar_bunga')) {
            $imageName = time() . '.' . $request->gambar_bunga->extension();
            $request->gambar_bunga->move(public_path('images'), $imageName);
        }

        $jumlah = $validated['jumlahInput'];
        $baseName = $validated['nama_bunga'];
        $data = [];

        for ($i = 1; $i <= $jumlah; $i++) {
            $data[] = [
                'nama_bunga' => $jumlah > 1 ? $baseName . '-' . $i : $baseName,
                'jenisb_id' => $validated['jenisb_id'],
                'lokasib_id' => $validated['lokasib_id'],
                'gambar_bunga' => $imageName,
                'tanggal_tanam' => $validated['tanggal_tanam'] ?? now(),
                'user_id' => auth()->id(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        collect($data)->chunk(20)->each(function ($chunk) {
            foreach ($chunk as $bunga) {
                Bunga::create($bunga);
            }
        });

        return redirect()->route(auth()->user()->level === 'admin' ? 'admin.manage-bunga' : 'staff.manage-bunga')
        ->with('success', "$jumlah bunga berhasil ditambahkan.");
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
        try {
            // Log incoming request data
            Log::info('Update request received:', $request->all());

            $validated = $request->validate([
                'nama_bunga' => 'required|string|max:255',
                'jenisb_id' => 'required|exists:jenisbungas,id',
                'lokasib_id' => 'required|exists:tamans,id',
                'gambar_bunga' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'tanggal_tanam' => 'nullable|date',
            ]);

            // Fetch the Bunga instance
            $data = Bunga::findOrFail($id);
            Log::info('Model state before update:', $data->toArray());

            // Update the model with new data
            $data->update($request->all());
            Log::info('Model state after update:', $data->toArray());

            $data = Bunga::findOrFail($id); // Find the bunga record by ID
    
            // Handle the file upload
            if ($request->hasFile('gambar_bunga')) {
                $imageName = time() . '.' . $request->gambar_bunga->extension();
                $request->gambar_bunga->move(public_path('images'), $imageName);
                $data->gambar_bunga = $imageName; // Update the image field
            }
            else {
                $imageName = $data->getOriginal('gambar_bunga');
            }
        
            // Update other fields
            $data->update([
                'nama_bunga' => $validated['nama_bunga'],
                'jenisb_id' => $validated['jenisb_id'],
                'lokasib_id' => $validated['lokasib_id'],
                'gambar_bunga' => $imageName, // Keep the existing image if not updated
                'tanggal_tanam' => $validated['tanggal_tanam'],
            ]);
        
            // return redirect()->route('manage-bunga')->with('success', 'Data updated successfully.');
            return redirect()->route(auth()->user()->level === 'admin' ? 'admin.manage-bunga' : 'staff.manage-bunga')
            ->with('success', 'Data berhasil diperbarui.');

        } catch (\Exception $e) {
            // Log any exceptions
            Log::error('Error during update:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Failed to update Bunga'], 500);
        }
        
    }

    public function destroy($id)
    {
        // Find the tree by ID and delete it
        $data = Bunga::findOrFail($id);
        $data->delete();

        // Redirect back with a success message
        // return redirect()->route('manage-bunga')->with('success', 'bunga berhasil dihapus.');
        return redirect()->route(auth()->user()->level === 'admin' ? 'admin.manage-bunga' : 'staff.manage-bunga')
        ->with('success', 'Data berhasil dihapus.');
    }

    public function downloadQRBunga($id) {
        $data = Bunga::with(['jenisBunga', 'taman'])->findOrFail($id);

        // $safeKodeUnik = preg_replace('/[\/\\\\]/', '_', $data->kode_unik);

        $pdf = Pdf::loadView('admin.pdf_bunga', compact('data'))->setPaper('a5', 'landscape');

        return $pdf->stream('bunga_' . $data->id . '.pdf');
    }


}
