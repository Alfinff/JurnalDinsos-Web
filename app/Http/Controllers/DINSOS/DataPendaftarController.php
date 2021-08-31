<?php

namespace App\Http\Controllers\DINSOS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use App\Helpers\Fungsi;
use App\Models\Pendaftaran;
use App\Models\JenisAduan;
use App\Models\JenisKelamin;
use App\Models\KodeWilayah;
use App\Models\Permasalahan;
use App\Models\Upt;
use Carbon\Carbon;

class DataPendaftarController extends Controller
{
    public function index() {
        $upt = Upt::orderBy('nama', 'asc')->get();
        return view('dinsos.dataPendaftar.index', compact('upt'));
    }

    public function filter(Request $request) {
        $idupt = $request->upt;
        $upt = Upt::where('uuid', $idupt)->first();

        if(!$upt) {
            return redirect()->route('dinsos-pegawai-pendaftar')->with(array(
                'message'    => 'Data Upt Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        return view('dinsos.dataPendaftar.filterpendaftar', compact('upt'));
    }

    public function dataPendaftar($uptid=null) {
        if($uptid!=null) {
            $pendaftaran = Fungsi::getPendaftar($uptid);
        } else {
            $pendaftaran = Fungsi::getPendaftarAll();
        }

        return    Datatables:: of($pendaftaran)
            ->editColumn('jenisaduan', function ($data){
                return $data->jenisaduan->nama ?? '-';
            })
            ->editColumn('upt', function ($data){
                return $data->upt->nama ?? '-';
            })
            ->editColumn('status', function ($data){
                if($data->tindakan == 0) {
                    return '<p class="badge badge-danger">Tertunda</p>';
                } elseif($data->tindakan == 1) {
                    return '<p class="badge badge-warning">Dihubungi</p>';
                } elseif($data->tindakan == 2) {
                    return '<p class="badge badge-primary">Ditangani</p>';
                } elseif($data->tindakan == 3) {
                    return '<p class="badge badge-info">Selesai</p>';
                } else {
                    return '-';
                }
            })
            ->editColumn('tindakan', function ($dataPenerima){
                $actionBtn = '<div class="aksi-button">
                    <div class="relative  d-flex justify-content-end">
                        <button class="btn btn-warning" onclick="exportexcelpenerimamanfaatindividu('.$dataPenerima->id.');"><i class = "fa fa-file-excel-o"></i></button>
                    ';
                if($dataPenerima->tindakan == 3) {
                    $actionBtn .='
                        <a href="'.route('dinsos-pendaftar-selesai-bantuan', array('uuid' => $dataPenerima->uuid,'uptid' => $dataPenerima->upt_id)).'" class="btn btn-secondary"><i class = "fa fa-hand-holding-medical"></i></a>';
                }
                    $actionBtn .='
                        <a   href = "'.route('dinsos-pegawai-pendaftar-detail', ['uuid' => $dataPenerima->uuid]).'" class = "mx-1 btn btn-primary"><i class = "fa fa-eye"></i>
                        </a>
                    </div>
                </div>';
                return $actionBtn;
            })
            ->rawColumns(['tindakan','status'])
            ->make(true);
    }

    public function daftarBantuan(Request $request, $uuid, $uptid) {
        $users = Fungsi::getPegawai($uptid);
        $provinsi     = KodeWilayah::select(['prov_id', 'prov'])->distinct()->get();
        $jenis_aduan  = JenisAduan::get();
        $upt          = Upt::get();
        $permasalahan = Permasalahan::get();
        $pendaftar    = Pendaftaran::where('uuid', $uuid)->first();
        if(!$pendaftar) {
            return redirect()->route('dinsos-pegawai-pendaftar')->with(array(
                'message'    => 'Data Pendaftar Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }
        return view('dinsos.dataPendaftar.selesaibantuan', compact('pendaftar', 'provinsi', 'upt', 'jenis_aduan', 'permasalahan', 'users', 'uuid', 'uptid'));
    }

    public function dataBantuan($uuid, $uptid) {
        $bantuan = Fungsi::getPendaftarBantuan($uuid, $uptid);
        return Datatables:: of($bantuan)
            ->addColumn('fotobukti', function ($data){
                if($data->bukti!=null) {
                    $foto = '<a data-fancybox="images" href="'.Storage::disk('s3')->temporaryUrl($data->bukti, Carbon::now()->addMinutes(3600)).'"><img class="img-fluid" src="'.Storage::disk('s3')->temporaryUrl($data->bukti, Carbon::now()->addMinutes(3600)).'"></a>';
                    return $foto;
                }
            })
            ->editColumn('tanggal_beri', function ($data){
                if($data->tanggal_beri!=null) {
                    return Fungsi::hari_indo($data->tanggal_beri);
                }
            })
            ->rawColumns(['action', 'fotobukti'])
            ->make(true);
    }

    public function detail(Request $request, $uuid) {
        $users = Fungsi::getPegawai(auth()->user()->upt_id);
        $provinsi     = KodeWilayah::select(['prov_id', 'prov'])->distinct()->get();
        $jenis_aduan  = JenisAduan::get();
        $jenis_kelamin  = JenisKelamin::get();
        $upt          = Upt::get();
        $permasalahan = Permasalahan::get();
        $pendaftar    = Pendaftaran::where('uuid', $uuid)->first();
        if(!$pendaftar) {
            return redirect()->route('dinsos-pegawai-pendaftar')->with(array(
                'message'    => 'Data Pendaftar Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        return view('dinsos.dataPendaftar.detail', compact('pendaftar', 'provinsi', 'upt', 'jenis_aduan', 'jenis_kelamin', 'permasalahan', 'users'));
    }

    public function dataPenerimaExport(Request $request, $id=null)
    {
        $pendaftar = null;
        $wilayah = null;
        if($id!=null) {
            $pendaftar    = Pendaftaran::with('penanggungjawab', 'upt', 'jenisaduan', 'jeniskelamin', 'permasalahanya', 'pendampinya')->where('soft_delete', 0)->where('id', $id)->get();
        } else {
            $pendaftar    = Pendaftaran::with('penanggungjawab', 'upt', 'jenisaduan', 'jeniskelamin', 'permasalahanya', 'pendampinya')->where('soft_delete', 0)->get();
        }

        $data = array();
        foreach($pendaftar as $pp => $val) {
            $wilayah = null;
            $tindakan = null;
            $wilayah = KodeWilayah::where('kec_id', $val['kec_id'])->first();
            if($val['tindakan'] = 0) {
                $tindakan = 'Tertunda';
            } else if($val['tindakan'] = 1) {
                $tindakan = 'Dihubungi';
            } else if($val['tindakan'] = 2) {
                $tindakan = 'Penerima Manfaat';
            } else if($val['tindakan'] = 3) {
                $tindakan = 'Selesai';
            } else {
                $tindakan = '-';
            }

            $data[$pp]['nik'] = $val['nik'] ?? '';
            $data[$pp]['nama_lengkap'] = $val['nama_lengkap'] ?? '';
            $data[$pp]['tempat_lahir'] = $val['tempat_lahir'] ?? '';
            $data[$pp]['tanggal_lahir'] = $val['tanggal_lahir'] ?? '';
            $data[$pp]['umur'] = $val['umur'] ?? '';
            $data[$pp]['jenis_kelamin'] = $val['jeniskelamin']->nama ?? '';
            $data[$pp]['nomor_telepon'] = $val['no_hp'] ?? '';
            $data[$pp]['provinsi'] = $wilayah->prov ?? '';
            $data[$pp]['kabupaten'] = $wilayah->kab ?? '';
            $data[$pp]['kecamatan'] = $wilayah->kec ?? '';
            $data[$pp]['alamat'] = $val['alamat'] ?? '';
            $data[$pp]['jenis_aduan'] = $val['jenisaduan']->nama ?? '';
            $data[$pp]['upt'] = $val['upt']->nama ?? '';
            $data[$pp]['status'] = $tindakan;
            $data[$pp]['nama_rekomendasi'] = $val['nama_rekomendasi'] ?? '';
            $data[$pp]['telp_rekomendasi'] = $val['telp_rekomendasi'] ?? '';
            $data[$pp]['dibuat_tanggal'] = $val['created_at'] ?? '';
            $data[$pp]['tanggal_masuk'] = $val['tanggal_masuk'] ?? '';
            $data[$pp]['tanggal_keluar'] = $val['tanggal_keluar'] ?? '';
            $data[$pp]['penanggung_jawab'] = $val['penanggungjawab']->username ?? '';
            $data[$pp]['permasalahan'] = $val['permasalahanya']->nama ?? '';
            $data[$pp]['pendamping'] = $val['pendampinya']->username ?? '';
        }

        return response()->json($data);
    }

}
