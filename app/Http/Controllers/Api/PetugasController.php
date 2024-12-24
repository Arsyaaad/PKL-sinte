<?php

namespace App\Http\Controllers\Api;

//import Model "Petugas"
use App\Models\Petugas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//import Resource "PetugasResource"
use App\Http\Resources\PetugasResource;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

//import Facade "Validator"
use Illuminate\Support\Facades\Validator;

class PetugasController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all Petugass
        $petugass = Petugas::latest()->paginate(5);

        //return collection of Petugass as a resource
        return new PetugasResource(true, 'List Data Petugass', $petugass);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'email'   => 'required',
            'nomor_telepon'   => 'required',
   
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create Petugas
        $petugas = Petugas::create([
            'nama'     => $request->nama,
            'email'   => $request->email,
            'nomor_telepon'=>$request->nomor_telepon,
        ]);

        //return response
        return new PetugasResource(true, 'Data Petugas Berhasil Ditambahkan!', $petugas);
    }

    /**
     * show
     *
     * @param  mixed $Petugas
     * @return void
     */
    public function show($id)
    {
        //find Petugas by ID
        $petugas = Petugas::find($id);

        //return single Petugas as a resource
        return new PetugasResource(true, 'Detail Data Petugas!', $petugas);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $Petugas
     * @return void
     */
    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'email'   => 'required',
            'nomor_telepon'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find Petugas by ID
        $petugas = Petugas::find($id);
            $petugas->update([
                'nama'     => $request->nama,
                'email'   => $request->email,
                'nomor_telepon'=>$request->nomor_telepon,
                ]);

        //return response
        return new PetugasResource(true, 'Data Petugas Berhasil Diubah!', $petugas);
    }

    /**
     * destroy
     *
     * @param  mixed $Petugas
     * @return void
     */
    public function destroy($id)
    {

        //find Petugas by ID
        $petugas = Petugas::find($id);

        //delete Petugas
        $petugas->delete();

        //return response
        return new PetugasResource(true, 'Data Petugas Berhasil Dihapus!', null);
    }
}