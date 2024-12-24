<?php

namespace App\Http\Controllers\Api;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProdukResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all Produks
        $produks = Produk::latest()->paginate(5);

        //return collection of Produks as a resource
        return new ProdukResource(true, 'List Data Produks', $produks);
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
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama'     => 'required',
            'deskripsi'   => 'required',
            'problem'   => 'required',
            'solution'   => 'required',
            'pelanggan_id'   => 'required',

        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/Produks', $image->hashName());

        //create Produk
        $produk = Produk::create([
            'image'     => $image->hashName(),
            'nama'     => $request->nama,
            'deskripsi'   => $request->deskripsi,
            'problem'   => $request->problem,
            'solution'   => $request->solution,
            'pelanggan_id'   => $request->pelanggan_id,


        ]);

        //return response
        return new ProdukResource(true, 'Data Produk Berhasil Ditambahkan!', $produk);
    }

    /**
     * show
     *
     * @param  mixed $Produk
     * @return void
     */
    public function show($id)
    {
        //find Produk by ID
        $produk = Produk::find($id);

        //return single Produk as a resource
        return new ProdukResource(true, 'Detail Data Produk!', $produk);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $Produk
     * @return void
     */
    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama'     => 'required',
            'deskripsi'   => 'required',
            'problem'   => 'required',
            'solution'   => 'required',
            'pelanggan_id'   => 'required',

        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find Produk by ID
        $produk = Produk::find($id);

        //check if image is not empty
        if ($request->hasFile('image')) {

            //upload image
            $image = $request->file('image');
            $image->storeAs('public/Produks', $image->hashName());

            //delete old image
            Storage::delete('public/Produks/'.basename($Produk->image));

            //update Produk with new image
            $produk->update([
                'image'     => $image->hashName(),
                'nama'     => $request->nama,
                'deskripsi'   => $request->deskripsi,
                'problem'   => $request->problem,
                'solution'   => $request->solution,
                'pelanggan_id'   => $request->pelanggan_id,
                ]);

        } else {

            //update Produk without image
            $produk->update([
                'nama'     => $request->nama,
                'deskripsi'   => $request->deskripsi,
                'problem'   => $request->problem,
                'solution'   => $request->solution,
                'pelanggan_id'   => $request->pelanggan_id,
                ]);
        }

        //return response
        return new ProdukResource(true, 'Data Produk Berhasil Diubah!', $produk);
    }

    /**
     * destroy
     *
     * @param  mixed $Produk
     * @return void
     */
    public function destroy($id)
    {

        //find Produk by ID
        $produk = Produk::find($id);

        //delete Produk
        $produk->delete();

        //return response
        return new ProdukResource(true, 'Data Produk Berhasil Dihapus!', null);
    }
}