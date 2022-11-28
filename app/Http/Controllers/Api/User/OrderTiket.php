<?php

namespace App\Http\Controllers\Api\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konser;
use App\Models\Transaksi;

class OrderTiket extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();
        $konser = Konser::find($request->konser_id);

        return response()->json([
            'message' => 'Data Berhasil Ditampilkan',
            'data' => $konser
        ],200 );

        if ($user->role == 'user') {
             
            
            $order = Transaksi::create([
                'konser_id' => $request->konser_id,
                'user_id' => $request->id,
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'jumlah_tiket' => $request->jumlah_tiket,
                'total_harga' => $request->jumlah_tiket = $konser->harga,
                'status' => 'pending',
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil ditambahkan',
                'data' => $order,
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'anda bukan user',
            ],401 );
        }
    }
}
