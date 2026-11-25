<?php
namespace App\Http\Controllers;

use App\Models\Catatan;
use Illuminate\Http\Request;

class CatatanController extends Controller
{
    private function rules(): array
    {
        return [
            'judul'    => 'required|string|max:255',
            'isi'      => 'required|string',
            'tanggal'  => 'required|date',
            'kategori' => 'required|in:Kuliah,Tugas,Pribadi,Lainnya',
        ];
    }

    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Catatan::orderByDesc('tanggal')->orderByDesc('id')->get(),
        ], 200);
    }

    public function show(Catatan $catatan)
    {
        return response()->json(['success' => true, 'data' => $catatan], 200);
    }

    public function store(Request $request)
    {
        $catatan = Catatan::create($request->validate($this->rules()));
        return response()->json(['success' => true, 'data' => $catatan], 201);
    }

    public function update(Request $request, Catatan $catatan)
    {
        $catatan->update($request->validate($this->rules()));
        return response()->json(['success' => true, 'data' => $catatan], 200);
    }

    public function destroy(Catatan $catatan)
    {
        $catatan->delete();
        return response()->noContent(); 
    }
}