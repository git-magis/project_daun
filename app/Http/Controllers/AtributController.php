<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atribut;
use App\Models\JenisPohon;
use App\Models\JenisBunga;

class AtributController extends Controller
{
    // Display all attributes for a specific tree
    // public function index($id)
    // {
    //     $jenisPohon = JenisPohon::with('atributs')->findOrFail($id);
    //     return view('atribut.index', compact('jenisPohon'));
    // }
    public function index()
    {
        $atributs = Atribut::with([
            'jenisPohon' => function ($query) {
                $query->select('id', 'nama_jenis_pohon');
            },
            'jenisBunga' => function ($query) {
                $query->select('id', 'nama_jenis_bunga');
            }
        ])->get();

        return view('admin.manage_atribut', compact('atributs'));
    }


    // Show form to create a new attribute
    public function create($id)
    {
        return view('atribut.create', compact('id'));
    }

    // Store new attribute in database
    public function store(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $request->validate([
            'entity_type' => 'required|string',
            'entity_id' => 'required|integer',
            'attribute_name' => 'required|array',
            'attribute_name.*' => 'required|string|max:255',
            'attribute_value' => 'required|array',
            'attribute_value.*' => 'required|string|max:255',
        ]);

        foreach ($data['attribute_name'] as $index => $name) {
            Atribut::create([
                'entity_type' => $request->entity_type,
                'entity_id' => $request->entity_id,
                'attribute_name' => $name,
                'attribute_value' => $data['attribute_value'][$index],
            ]);
        }        

        // return redirect()->route(auth()->user()->level === 'admin' ? 'admin.manage-atribut' : 'staff.manage-atribut', $request->entity_id)
        // ->back()->with('success', 'Attribute added successfully.');
        return response()->json(['message' => 'Attributes added successfully']);
    }

    // Show edit form for attribute
    public function edit($id)
    {
        $attribute = Atribut::findOrFail($id);
        return view('atribut.edit', compact('attribute'));
    }

    // Update attribute in database
    public function update(Request $request, $id)
    {
        $request->validate([
            'attribute_name' => 'required',
            'attribute_value' => 'required',
        ]);

        $attribute = Atribut::findOrFail($id);
        $attribute->update([
            'attribute_name' => $request->attribute_name,
            'attribute_value' => $request->attribute_value,
        ]);

        return redirect()->route(auth()->user()->level === 'admin' ? 'admin.manage-atribut' : 'staff.manage-atribut', $attribute->entity_id)
        ->with('success', 'Attribute updated successfully.');
    }

    // Delete attribute
    public function destroy($id)
    {
        $attribute = Atribut::findOrFail($id);
        $entity_id = $attribute->entity_id;
        $attribute->delete();

        return redirect()->route(auth()->user()->level === 'admin' ? 'admin.manage-atribut' : 'staff.manage-atribut', $entity_id)
        ->with('success', 'Attribute deleted successfully.');
    }

    public function getEntities(Request $request)
    {
        if ($request->type == 'pohon') {
            $entities = JenisPohon::select('id', 'nama_jenis_pohon as name')->get();
        } elseif ($request->type == 'bunga') {
            $entities = JenisBunga::select('id', 'nama_jenis_bunga as name')->get();
        } else {
            $entities = [];
        }

        return response()->json($entities);
    }

}
