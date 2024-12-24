<?php

namespace App\Http\Controllers\Api;

use App\Models\Detail_Maintenance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Detail_MaintenanceResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class Detail_MaintenanceController extends Controller
{
    public function index($id)
    {
        // Get detail maintenance data with kategori
        $detail_maintenances = Detail_Maintenance::with(['maintenance'])->where('maintenance_id', $id)->get();

        // Return collection of data as a resource
        return new Detail_MaintenanceResource(true, 'List Data', $detail_maintenances);
    }

    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'laporan_bug'   => 'required',
            'maintenance_id' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create new detail maintenance entry
        $detail_maintenance = Detail_Maintenance::create([
            'laporan_bug'    => $request->laporan_bug,
            'maintenance_id' => $request->maintenance_id,
        ]);

        // Return response with success message
        return new Detail_MaintenanceResource(true, 'Data Berhasil Ditambahkan!', $detail_maintenance);
    }

    public function show($id)
    {
        // Find detail maintenance by ID with kategori
        $detail_maintenance = Detail_Maintenance::with('maintenance')->find($id);

        // Check if the data exists
        if (!$detail_maintenance) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Return single detail maintenance as a resource
        return new Detail_MaintenanceResource(true, 'Data Ditemukan!', $detail_maintenance);
    }

    public function update(Request $request, Detail_Maintenance $detail_maintenance)
    {
        // Define validation rules (if any for updates)
        $validator = Validator::make($request->all(), [
            'laporan_bug'   => 'required',
            'maintenance_id' => 'required',        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
      
            // Update the record without changing the image
            $detail_maintenance->update([
                'laporan_bug'    => $request->laporan_bug,
                'maintenance_id' => $request->maintenance_id,            ]);

        // Return response with success message
        return new Detail_MaintenanceResource(true, 'Data Berhasil Diubah!', $detail_maintenance);
    }

    public function destroy(Detail_Maintenance $detail_maintenance)
    {

        // Delete the detail maintenance record
        $detail_maintenance->delete();

        // Return response with success message
        return new Detail_MaintenanceResource(true, 'Data Berhasil Dihapus!', null);
    }
}
