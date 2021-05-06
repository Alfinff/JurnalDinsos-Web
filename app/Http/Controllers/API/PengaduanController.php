<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    public function dihubungi(Request $request, $id) {
        $pengaduan = Pengaduan::find($id);
        $pengaduan->tindakan = "dihubungi";
        $pengaduan->save();
        $response = array(
            'msg' => "Sukses dihubungi pengaduan",
            'success' => true
        );
        return response()->json($response);
    }

    public function ditangani(Request $request, $id) {
        $pengaduan = Pengaduan::find($id);
        $pengaduan->tindakan = "ditangani";
        $pengaduan->save();
        $response = array(
            'msg' => "Sukses ditangani pengaduan",
            'success' => true
        );
        return response()->json($response);
    }

    public function hapus(Request $request, $id) {
        $pengaduan = Pengaduan::find($id);
        $pengaduan->tindakan = null;
        $pengaduan->save();
        $response = array(
            'msg' => "Sukses hapus pengaduan",
            'success' => true
        );
        return response()->json($response);
    }
}
