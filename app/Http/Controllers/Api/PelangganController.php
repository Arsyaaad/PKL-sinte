<?php

namespace App\Http\Controllers\Api;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PelangganResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PelangganController extends Controller
{
    public function index()
    {
        // get posts
        $pelanggans = Pelanggan::latest()->paginate(5);

        //return colection of posts as a resource
        return new PelangganResource(true, 'list Data', $pelanggans);
    }
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'email'   => 'required',
            'nomor_telepon'   => 'required|string|max:15|regex:/^\+?[0-9]+$/',
            'alamat'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $pelanggan = Pelanggan::create([
            'nama'     => $request->nama,
            'email'   => $request->email,
            'nomor_telepon'   => $request->nomor_telepon,
            'alamat'   => $request->alamat,
        ]);

        //return response
        return new PelangganResource(true, 'Data Berhasil Ditambahkan!', $pelanggan);
    }
    public function show($id)
{
    $pelanggan = Pelanggan::find($id);
    
    // return single post as a resource
    return new PelangganResource(true, 'Data Ditemukan!', $pelanggan);
}

public function update(Request $request, Pelanggan $pelanggan)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'email'   => 'required',
            'nomor_telepon'   => 'required',
            'alamat'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

            //update produk with new image
            $pelanggan->update([
                'nama'     => $request->nama,
                'email'   => $request->email,
                'nomor_telepon'   => $request->nomor_telepon,
                'alamat'   => $request->alamat,    
            ]);

        //return response
        return new PelangganResource(true, 'Data Berhasil Diubah!', $pelanggan);
    }
    public function destroy(Pelanggan $pelanggan)
    {
    
        //delete post
        $pelanggan->delete();

        //return response
        return new PelangganResource(true, 'Data Berhasil Dihapus!', null);
    }
}
