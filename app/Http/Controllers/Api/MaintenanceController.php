<?php

namespace App\Http\Controllers\Api;

use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MaintenanceResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MaintenanceController extends Controller
{
    public function index()
    {
        // get posts
        $maintenances = Maintenance::latest()->paginate(5);

        //return colection of posts as a resource
        return new MaintenanceResource(true, 'list Data Maintenance', $maintenances);
    }
    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'tanggal_awal'    =>'required',
            'tanggal_akhir' => 'required',
            'jumlah_maintenance' => 'required',
            'produk_id' => 'required',
            'petugas_id' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create new detail maintenance entry
        $maintenances = Maintenance::create([
            'tanggal_awal'    => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'jumlah_maintenance' => $request->jumlah_maintenance,
            'produk_id' => $request->produk_id,
            'petugas_id' => $request->petugas_id,
        ]);

        // Return response with success message
        return new MaintenanceResource(true, 'Data Berhasil Ditambahkan!', $maintenances);
    }
    public function show($id)
{
    $maintenance = Maintenance::find($id);
    
    // return single post as a resource
    return new MaintenanceResource(true, 'Data Ditemukan!', $maintenance);
}

public function update(Request $request, $id)
{
    //define validation rules
    $validator = Validator::make($request->all(), [
        'tanggal_awal'    =>'required',
        'tanggal_akhir' => 'required',
        'jumlah_maintenance' => 'required',
        'produk_id' => 'required',
        'petugas_id' => 'required',
]);

    //check if validation fails
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    //find post by ID
    $maintenance = Maintenance::find($id);

        //update post with new image
        $maintenance->update([
            'tanggal_awal'    => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'jumlah_maintenance' => $request->jumlah_maintenance,
            'produk_id' => $request->produk_id,
            'petugas_id' => $request->petugas_id,
        ]);

    //return response
    return new MaintenanceResource(true, 'Data Post Berhasil Diubah!', $maintenance);
}
    public function destroy(Maintenance $maintenance)
    {
        //delete post
        $maintenance->delete();

        //return response
        return new MaintenanceResource(true, 'Data Berhasil Dihapus!', null);
    }
}
