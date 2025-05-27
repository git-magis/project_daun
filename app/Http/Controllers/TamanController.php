<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Pohon;
use App\Models\Bunga;
use App\Models\Taman;

class TamanController extends Controller
{

    public function index()
    {
        $data = Taman::all();

        // return view('admin.manage_taman', ['data' => $data]);
        return view('admin.manage_taman', compact('data')); 
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the file upload
        if ($request->hasFile('gambar_pohon')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images'), $imageName);
        }
    
        // Save the data to the database
        Taman::create([
            'nama' => $validated['nama'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'gambar' => $imageName ?? null,
        ]);
    
        // return redirect()->route('manage-taman')->with('success', 'Data saved successfully.');
        return redirect()->route(auth()->user()->level === 'admin' ? 'admin.manage-taman' : 'staff.manage-taman')
        ->with('success', 'Data berhasil ditambahkan.');
    }
    

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Find the Taman record by ID
        $data = Taman::findOrFail($request->id);

        // Handle the file upload
        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images'), $imageName);
            $data->gambar = $imageName; // Update the image field
        }
        else {
            $imageName = $data->getOriginal('gambar');
        }
    
        // Update the data
        $data->update([
            'nama' => $validated['nama'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'gambar' => $imageName,
        ]);
    
        // return redirect()->route('manage-taman')->with('success', 'Data updated successfully.');
        return redirect()->route(auth()->user()->level === 'admin' ? 'admin.manage-taman' : 'staff.manage-taman')
        ->with('success', 'Data berhasil diperbarui.');
    }
    

    public function destroy($id)
    {
        // Find the tree by ID and delete it
        $data = Taman::findOrFail($id);
        $data->delete();

        // Redirect back with a success message
        // return redirect()->route('manage-taman')->with('success', 'taman berhasil dihapus.');
        return redirect()->route(auth()->user()->level === 'admin' ? 'admin.manage-taman' : 'staff.manage-taman')
        ->with('success', 'Data berhasil dihapus.');
    }

    public function getTamans()
    {
        // $tamans = Taman::withCount(['pohons', 'bungas'])->get();
        $tamans = Taman::with([
            'pohons.jenisPohon',
            'bungas.jenisBunga',
        ])->withCount(['pohons', 'bungas'])->get();

        return response()->json($tamans);
    }

    public function getTamansById($id)
    {
        $tamansid = Taman::with([
            'pohons.jenisPohon',
            'bungas.jenisBunga',
        ])->withCount(['pohons', 'bungas'])->findOrFail($id);

        return response()->json($tamansid);
    }

    public function showMap()
    {
        $taman = Taman::first();
        return view('admin.add_peta', compact('taman'));
    }

    public function editMap($id)
    {
        $taman = Taman::findOrFail($id);
        return view('admin.edit_peta', compact('taman'));
    }

    public function saveLocation(Request $request)
    {
        session([
            'selected_latitude' => $request->latitude,
            'selected_longitude' => $request->longitude
        ]);

        return redirect()->route(auth()->user()->level === 'admin' ? 'admin.manage-taman' : 'staff.manage-taman')->with('open_modal', true);
    }

    public function getTamanData($id)
    {
        $taman = Taman::find($id);

        if (!$taman) {
            return response()->json(['error' => 'Data not found'], 404);
        }

        return response()->json([
            'id' => $taman->id,
            'nama' => $taman->nama,
            'latitude' => $taman->latitude,
            'longitude' => $taman->longitude,
            'kode' => $taman->kode
        ]);
    }

    public function chartTaman($id)
    {
        $taman = Taman::with(['jenisPohon', 'jenisBunga'])->findOrFail($id);

        $treeData = collect($taman->jenisPohon)->unique('id')->map(function ($jenisPohon) use ($taman) {
            $count = Pohon::where('jenis_id', $jenisPohon->id)
                ->where('lokasi_id', $taman->id)
                ->count();
    
            return [
                'name' => $jenisPohon->nama_jenis_pohon,
                'count' => $count,
            ];
        });
    
        $flowerData = collect($taman->jenisBunga)->unique('id')->map(function ($jenisBunga) use ($taman) {
            $count = Bunga::where('jenisb_id', $jenisBunga->id)
                ->where('lokasib_id', $taman->id)
                ->count();
    
            return [
                'name' => $jenisBunga->nama_jenis_bunga,
                'count' => $count,
            ];
        });
    
        $combinedData = $treeData->merge($flowerData);
    
        $groupedData = $combinedData->groupBy('name')->map(function ($items, $name) {
            return [
                'name' => $name,
                'count' => $items->sum('count'),
            ];
        });
    
        $labels = $groupedData->pluck('name')->toArray();
        $data = $groupedData->pluck('count')->toArray();
        $total = array_sum($data);
    
        return response()->json([
            'taman' => $taman->nama,
            'labels' => $labels,
            'data' => $data,
            'total' => $total,
        ]);
    }

}
