<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\User;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function approveRegistration(Request $request)
    {
        $user = User::find($request->idUser);

        $user->ekskuls()->updateExistingPivot(
            $request->idEkskul,
            ['status' => 'diterima']
        );

        return response()->json(['status' => 'success']);
    }

    public function approveAll(Request $request)
    {
        foreach($request->pendingRegistrations as $penRegis){
            $user = User::find($penRegis['siswa_id']);

            $user->ekskuls()->updateExistingPivot(
                $penRegis['ekskul_id'],
                ['status' => $penRegis['pivot']['status']]
            );
        }

        return response()->json($request->all());
    }
}