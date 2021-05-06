<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Illuminate\Support\Str;

class KegiatanController extends Controller
{
    public function get_kegiatan(Request $request, $id = NULL) {
        if ($id == NULL) {
            $kegiatan = Kegiatan::get();
        } else {
            $kegiatan = Kegiatan::find($id);
        }
        return response()->json($kegiatan);
    }

    public function tambah_kegiatan(Request $request, $id = NULL) {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('upt.kegiatan.tambah');
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($id == NULL) {
                $kegiatan = new Kegiatan;
            } else {
                $kegiatan = Kegiatan::find($id);
            }
            $kegiatan->id = Str::uuid();
            $kegiatan->start_date = $request->input('start_date');
            $kegiatan->end_date = $request->input('end_date');
            $kegiatan->type = $request->input('type');
            $kegiatan->number_of_p = $request->input('number_of_p');
            $kegiatan->upt_name = $request->input('upt_name');
            $kegiatan->idupt = auth()->user()->id;
            $kegiatan->budget = $request->input('budget');
            $kegiatan->description = $request->input('description');
            $kegiatan->save();
            return redirect()->back();
        }
    }

    public function delete_kegiatan(Request $request, $id) {
        $kegiatan = Kegiatan::find($id);
        if($kegiatan->count()>0) {
            $kegiatan->delete();
        }
        return redirect()->back();
    }
}
