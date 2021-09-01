<?php

namespace App\Http\Controllers\UPT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Models\Pendaftaran;
use App\Models\PendaftaranBantuan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Notifications\PendaftarNotification;
use Illuminate\Support\Carbon;
use App\Models\KodeWilayah;
use App\Models\JenisAduan;
use App\Models\JenisKelamin;
use App\Models\Permasalahan;
use App\Models\KondisiTerakhir;
use App\Models\Upt;
use App\Models\User;
use App\Helpers\Fungsi;
use App\Helpers\UploadImage;
use App\Helpers\UploadFile;
use App\Imports\PendaftaranImport;
use Maatwebsite\Excel\Facades\Excel;

class PenerimaManfaatController extends Controller
{

    public function index() {
        return view('upt.penerimaManfaat.index');
    }

    public function dataPenerima(Request $request) {
        $pendaftar = Fungsi::getPendaftarPenerimaManfaat(auth()->user()->upt_id);
        return Datatables:: of($pendaftar)
            ->addIndexColumn()
            ->editColumn('no_reg', function ($data){
                return $data->nomor_registrasi;
            })
            ->addColumn('tindakanstatus', function ($data){
                if($data->tindakan == 3) {
                    return '<p class="badge badge-primary">Selesai</p>';
                } elseif($data->tindakan == 2) {
                    return '<p class="badge badge-info">Ditangani</p>';
                } elseif($data->tindakan == 1) {
                    return '<p class="badge badge-info">Dihubungi</p>';
                } elseif($data->tindakan == 0) {
                    return '<p class="badge badge-info">Tertunda</p>';
                } else {
                    return '-';
                }
            })
            ->editColumn('tanggal_masuk', function ($data){
                return Fungsi::hari_indo($data->tanggal_masuk);
            })
            ->editColumn('ttl', function ($data){
                if(($data->tempat_lahir!=null)&&($data->tanggal_lahir!=null)) {
                    return ucwords($data->tempat_lahir) .', '.date('d/m/Y', strtotime($data->tanggal_lahir));
                } else if($data->tanggal_lahir!=null) {
                    return date('d/m/Y', strtotime($data->tanggal_lahir));
                }
            })
            ->addColumn('action', function($dataPenerima){
                // <a onclick="return confirm(`Anda Yakin Mengubah Status Data Ini?`)" href="'.route('upt-penerima-manfaat-selesai', ['uuid' => $dataPenerima->uuid]).'" class="btn btn-info text-white"><i class = "fa fa-check"></i></a>
                $actionBtn = '<div class="aksi-button">
                    <div class="relative">
                        <a href  = "#" class                = "mx-1 btn btn-success" style = "width: 46px" onclick = "more('.$dataPenerima->id.')">
                            <i class = "fa fa-ellipsis-v" style = "color: #fff;" title    = "More"></i>
                        </a>
                        <div class="dropdown tes" id="dropdowns'.$dataPenerima->id.'">
                            <button class="btn btn-success" type="button" onclick="setselesai('.$dataPenerima->id.')" data-toggle="modal" data-target="#set_selesai">
                                <i class = "fa fa-check"></i>
                            </button>
                            <a href="'.route('upt-penerima-perkembangan', ['uuid' => $dataPenerima->uuid]).'" class="btn btn-primary"><i class = "fa fa-history"></i></a>
                            <a href="'.route('upt-penerima-tambah-bantuan', ['uuid' => $dataPenerima->uuid]).'" class="btn btn-secondary"><i class = "fa fa-hand-holding-medical"></i></a>
                        </div>
                        </div>
                        <button class="btn btn-warning" onclick="exportexcelpenerimamanfaatindividu('.$dataPenerima->id.');"><i class = "fa fa-file-excel-o"></i></button>
                        <a   href = "'.route('edit-penerima-manfaat-detail', ['uuid' => $dataPenerima->uuid]).'" class = "mx-1 btn btn-primary">
                        <img src  = "'.asset('assets/images/edit.svg').'" alt                                          = "">
                        </a>
                        <a  onclick="return confirm(`Anda Yakin Menghapus Data Ini?`)" href = "'.route('upt-penerima-manfaat-delete', ['uuid' => $dataPenerima->uuid]).'" class                                           = "mx-1 btn btn-danger">
                        <img src  = "'.asset('assets/images/delete_outline.svg').'" alt = "">
                        </a>
                    </div>';
                return $actionBtn;
            })
            ->rawColumns(['tindakanstatus', 'action'])
            ->make(true);
    }

    public function setSelesai(Request $request)
    {
        $id = $request->input('iddata');
        $data    = Pendaftaran::where('id', $id)->first();
        if(!$data) {
            return 0;
        }
        return view('upt.penerimaManfaat.setSelesai', compact('data'));
    }

    public function dataSelesai() {
        $pendaftar = Fungsi::getHistoryPendaftarPenerimaManfaat(auth()->user()->upt_id);
        return Datatables:: of($pendaftar)
            ->editColumn('no_reg', function ($data){
                return $data->nomor_registrasi;
            })
            ->addColumn('tindakanstatus', function ($data){
                if($data->tindakan == 3) {
                    return '<p class="badge badge-primary">Selesai</p>';
                } elseif($data->tindakan == 2) {
                    return '<p class="badge badge-info">Ditangani</p>';
                } elseif($data->tindakan == 1) {
                    return '<p class="badge badge-info">Dihubungi</p>';
                } elseif($data->tindakan == 0) {
                    return '<p class="badge badge-info">Tertunda</p>';
                } else {
                    return '-';
                }
            })
            ->editColumn('tanggal_masuk', function ($data){
                return Fungsi::hari_indo($data->tanggal_masuk);
            })
            ->editColumn('ttl', function ($data){
                return ucwords($data->tempat_lahir) .', '.date('d/m/Y', strtotime($data->tanggal_masuk));
            })
            ->addColumn('action', function($dataPenerima){
                // <a href="'.route('upt-exportdatapenerima', ['id' => $dataPenerima->id]).'" class="btn btn-secondary"><i class = "fa fa-file-excel-o"></i></a>
                $actionBtn = '<div class="aksi-button">
                    <div class="relative">
                        <a href="'.route('upt-penerima-manfaat-selesai-undo', ['uuid' => $dataPenerima->uuid]).'" class="btn btn-secondary"><i class = "fa fa-undo"></i></a>
                        <button class="btn btn-warning" onclick="exportexcelpenerimamanfaatindividu('.$dataPenerima->id.');"><i class = "fa fa-file-excel-o"></i></button>
                        <a href="'.route('upt-penerima-manfaat-selesai-bantuan', ['uuid' => $dataPenerima->uuid]).'" class="btn btn-secondary"><i class = "fa fa-hand-holding-medical"></i></a>
                        <a   href = "'.route('upt-penerima-manfaat-detail', ['uuid' => $dataPenerima->uuid]).'" class = "mx-1 btn btn-primary"><i class = "fa fa-eye"></i>
                        </a>
                    </div>';
                return $actionBtn;
            })
            ->rawColumns(['tindakanstatus', 'action'])
            ->make(true);
    }

    public function dataPenerimaExport(Request $request, $id=null)
    {
        $pendaftar = null;
        $tindakan = null;
        $wilayah = null;
        if($id!=null) {
            $pendaftar    = Pendaftaran::with('penanggungjawab', 'upt', 'jenisaduan', 'jeniskelamin', 'permasalahanya', 'pendampinya')->where('id', $id)->where('upt_id', auth()->user()->upt_id)->where('soft_delete', 0)->get();
        //     $wilayah = KodeWilayah::where('kec_id', $pendaftar->kec_id)->first();
        //     if($pendaftar->tindakan = 0) {
        //         $tindakan = 'Tertunda';
        //     } else if($pendaftar->tindakan = 1) {
        //         $tindakan = 'Dihubungi';
        //     } else if($pendaftar->tindakan = 2) {
        //         $tindakan = 'Penerima Manfaat';
        //     } else if($pendaftar->tindakan = 3) {
        //         $tindakan = 'Selesai';
        //     } else {
        //         $tindakan = '-';
        //     }

        //     $data = array();
        //     $data['nik'] = $pendaftar->nik ?? '';
        //     $data['nama_lengkap'] = $pendaftar->nama_lengkap ?? '';
        //     $data['tempat_lahir'] = $pendaftar->tempat_lahir ?? '';
        //     $data['tanggal_lahir'] = $pendaftar->tanggal_lahir ?? '';
        //     $data['umur'] = $pendaftar->umur ?? '';
        //     $data['jenis_kelamin'] = $pendaftar->jeniskelamin->nama ?? '';
        //     $data['nomor_telepon'] = $pendaftar->no_hp ?? '';
        //     $data['provinsi'] = $wilayah->prov ?? '';
        //     $data['kabupaten'] = $wilayah->kab ?? '';
        //     $data['kecamatan'] = $wilayah->kec ?? '';
        //     $data['alamat'] = $pendaftar->alamat ?? '';
        //     $data['jenis_aduan'] = $pendaftar->jenisaduan->nama ?? '';
        //     $data['upt'] = $pendaftar->upt->nama ?? '';
        //     $data['status'] = $tindakan;
        //     $data['nama_rekomendasi'] = $pendaftar->nama_rekomendasi ?? '';
        //     $data['telp_rekomendasi'] = $pendaftar->telp_rekomendasi ?? '';
        //     $data['dibuat_tanggal'] = $pendaftar->created_at ?? '';
        //     $data['tanggal_masuk'] = $pendaftar->tanggal_masuk ?? '';
        //     $data['tanggal_keluar'] = $pendaftar->tanggal_keluar ?? '';
        //     $data['penanggung_jawab'] = $pendaftar->penanggungjawab->username ?? '';
        //     $data['permasalahan'] = $pendaftar->permasalahanya->nama ?? '';
        //     $data['pendamping'] = $pendaftar->pendampinya->username ?? '';
        } else {
            $pendaftar    = Pendaftaran::with('penanggungjawab', 'upt', 'jenisaduan', 'jeniskelamin', 'permasalahanya', 'pendampinya')->where('upt_id', auth()->user()->upt_id)->where('soft_delete', 0)->get();
        }

            $data = array();
            foreach($pendaftar as $pp => $val) {
                $wilayah = null;
                $wilayah = KodeWilayah::where('kec_id', $val['kec_id'])->first();
                $tindakan = null;
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
        // }
        return response()->json($data);
    }

    public function import(Request $request)
    {
        // $rows = Excel::toArray(new PendaftaranImport, $request->file('file'));
        // foreach($rows[0] as $id => $val) {
            // $data[$id]['no'] = $val['no'];
            // $data[$id]['tanggal'] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($val['tanggal'])->format('Y-m-d H:i:s');
            // $data[$id]['nama'] = $val['nama'];
            // $explode = explode(',', $val['tempat_tanggal_lahir']);
            // $tempat_lahir = $explode[0] ?? null;
            // return $tempat_lahir;
            // $data[$id]['tanggal_lahir'] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($val['tanggal_lahir'])->format('Y-m-d H:i:s');
        //     $data[$id]['alamat'] = $val['alamat'];
        // }
        // return response()->json(["rows"=>$data]);
        DB:: beginTransaction();
        try {
            // hapus data awal
            // Pendaftaran::where('upt_id', auth()->user()->upt_id)->where('soft_delete', 0)->update(array('soft_delete' => 1));
            if(isset($request->file)){
                $validator=Validator::make($request->all(),[
                    'file' => 'required|max:50000|mimes:xlsx,doc,docx,ppt,pptx,ods,odt,odp,application/csv,application/excel,
                    application/vnd.ms-excel, application/vnd.msexcel,
                    text/csv, text/anytext, text/plain, text/x-c,
                    text/comma-separated-values,
                    inode/x-empty,
                    application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                /*  'extension'  => strtolower($request->file->getClientOriginalExtension()),
                    'extension'=>'required|in:doc,csv,xlsx,xls,docx,ppt,odt,ods,odp'*/
                ]);

                if ($validator->fails()) {
                    return back()->with(array(
                        // 'message'    => $validator->errors(),
                        'message'    => 'Format File Salah',
                        'alert-type' => 'error'
                    ));
                }

                DB:: commit();
                Excel::import(new PendaftaranImport,request()->file('file'));
                return back()->with(array(
                    'message'    => 'Data Berhasil Diimport',
                    'alert-type' => 'success'
                ));
            } else {
                DB:: rollback();
                return back()->with(array(
                    'message'    => 'File Tidak Boleh Kosong',
                    'alert-type' => 'error'
                ));
            }
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            DB:: rollback();
            // $failures = $e->failures();
            // foreach ($failures as $failure) {
            //     $failure->row(); // row that went wrong
            //     $failure->attribute(); // either heading key (if using heading row concern) or column index
            //     $failure->errors(); // Actual error messages from Laravel validator
            //     $failure->values(); // The values of the row that has failed.
            // }

            // return $failures;

            return back()->with(array(
                'message'    => 'Terdapat Kesalahan Pada Baris '.$failure->row,
                'alert-type' => 'error'
            ));
        }
    }

    public function daftarBantuan(Request $request, $uuid) {
        $users = Fungsi::getPegawai(auth()->user()->upt_id);
        $provinsi     = KodeWilayah::select(['prov_id', 'prov'])->distinct()->get();
        $jenis_aduan  = JenisAduan::get();
        $jenis_kelamin  = JenisKelamin::get();
        $upt          = Upt::get();
        $permasalahan = Permasalahan::where('upt_id', auth()->user()->upt_id)->orderBy('nama', 'asc')->get();
        $pendaftar    = Pendaftaran::where('uuid', $uuid)->first();
        if(!$pendaftar) {
            return redirect()->route('upt-penerima-manfaat')->with(array(
                'message'    => 'Data Pendaftar Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }
        return view('upt.penerimaManfaat.selesaibantuan', compact('pendaftar', 'provinsi', 'upt', 'jenis_aduan', 'jenis_kelamin', 'permasalahan', 'users', 'uuid'));
    }

    public function dataPenerimaDetailEdit(Request $request, $uuid) {
        $users = Fungsi::getPegawai(auth()->user()->upt_id);
        $provinsi     = KodeWilayah::select(['prov_id', 'prov'])->distinct()->get();
        $jenis_aduan  = JenisAduan::get();
        $jenis_kelamin  = JenisKelamin::get();
        $upt          = Upt::get();
        $permasalahan = Permasalahan::where('upt_id', auth()->user()->upt_id)->orderBy('nama', 'asc')->get();
        $pendaftar    = Pendaftaran::with(['kondisiterakhir'])->where('uuid', $uuid)->first();
        if(!$pendaftar) {
            return redirect()->route('upt-penerima-manfaat')->with(array(
                'message'    => 'Data Pendaftar Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('upt.penerimaManfaat.edit', compact('pendaftar', 'provinsi', 'upt', 'jenis_aduan', 'jenis_kelamin', 'permasalahan', 'users'));
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            DB:: beginTransaction();
            try {
                           $pendaftar          = Pendaftaran::where('uuid', $uuid)->first();
                $pendaftar['tindakan']         = 2;
                $pendaftar['nama_lengkap']     = $request->nama_lengkap;
                $pendaftar['nik']              = $request->nik;
                $pendaftar['tempat_lahir']     = $request->tempat_lahir;
                $pendaftar['tanggal_lahir']    = $request->tanggal_lahir;
                $pendaftar['umur']             = $request->umur;
                $pendaftar['jenis_kelamin']    = $request->jenis_kelamin;
                $pendaftar['no_hp']            = $request->no_hp;
                $pendaftar['prov_id']          = 35;
                $pendaftar['kab_id']           = $request->kab_id;
                $pendaftar['kec_id']           = $request->kec_id;
                $pendaftar['alamat']           = $request->alamat;
                $pendaftar['jenis_aduan']      = $request->jenis_aduan;
                $pendaftar['upt_id']           = auth()->user()->upt_id;
                $pendaftar['nama_rekomendasi'] = $request->nama_rekomendasi;
                $pendaftar['telp_rekomendasi'] = $request->telp_rekomendasi;
                $pendaftar['pendamping']       = $request->pendamping;
                // $pendaftar['nomor_registrasi'] = $request->nomor_registrasi;
                $pendaftar['tanggal_masuk']    = date('Y-m-d', strtotime($request->tanggal_masuk));
                $pendaftar['tanggal_keluar']   = date('Y-m-d', strtotime($request->tanggal_keluar));
                $pendaftar['permasalahan']     = $request->permasalahan;
                if(file_exists($_FILES['foto_kondisi']['tmp_name']) || is_uploaded_file($_FILES['foto_kondisi']['tmp_name'])) {
                    UploadImage::setPath('pendaftaran/foto_kondisi');
                    UploadImage::setImage($request->file("foto_kondisi")->getContent());
                    UploadImage::setExt($request->file("foto_kondisi")->extension());
                    $path_foto_kondisi = UploadImage::uploadImage();
                    $pendaftar['foto_kondisi'] = $path_foto_kondisi;
                }
                if(file_exists($_FILES['surat_pengantar']['tmp_name']) || is_uploaded_file($_FILES['surat_pengantar']['tmp_name'])) {
                    UploadFile::setPath('pendaftaran/surat_pengantar');
                    UploadFile::setFile($request->file("surat_pengantar")->getContent());
                    UploadFile::setExt($request->file("surat_pengantar")->extension());
                    $path_surat_pengantar = UploadFile::uploadFile();
                    $pendaftar['surat_pengantar'] = $path_surat_pengantar;
                }
                $pendaftar->update();

                DB:: commit();
                return redirect()->route('upt-penerima-manfaat')->with(array(
                    'message'    => 'Sukses Edit Data',
                    'alert-type' => 'success',
                ));
            } catch (\Throwable $th) {
                DB:: rollback();
                return redirect()->back()->with(array(
                    'message'    => 'Terdapat Kesalahan',
                    'alert-type' => 'error'
                ))->withInput();
            }
        }
    }

    public function dataPenerimaDetail(Request $request, $uuid) {
        $users = Fungsi::getPegawai(auth()->user()->upt_id);
        $provinsi     = KodeWilayah::select(['prov_id', 'prov'])->distinct()->get();
        $jenis_aduan  = JenisAduan::get();
        $jenis_kelamin  = JenisKelamin::get();
        $upt          = Upt::get();
        $permasalahan = Permasalahan::where('upt_id', auth()->user()->upt_id)->orderBy('nama', 'asc')->get();
        $pendaftar    = Pendaftaran::with(['kondisiterakhir'])->where('uuid', $uuid)->first();
        if(!$pendaftar) {
            return redirect()->route('upt-penerima-manfaat')->with(array(
                'message'    => 'Data Pendaftar Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        return view('upt.penerimaManfaat.detail', compact('pendaftar', 'provinsi', 'upt', 'jenis_aduan', 'jenis_kelamin', 'permasalahan', 'users'));
    }

    public function aksiSelesai(Request $request) {
        $uuid = $request->uuid;
        $pendaftar   = Pendaftaran::where('uuid', $uuid)->first();
        if(!$pendaftar) {
            return redirect()->route('upt-penerima-manfaat')->with(array(
                'message'    => 'Data Pendaftar Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        DB:: beginTransaction();
        try {
            $pendaftar['tindakan'] = 3;
            $pendaftar->update();

            $inputkonsidi = new KondisiTerakhir;
            $inputkonsidi->id = Str::uuid();
            $inputkonsidi->soft_delete = 0;
            $inputkonsidi->pendaftar_id = $uuid;
            UploadImage::setPath('pendaftaran/kondisi_terakhir');
            UploadImage::setImage($request->file("kondisi_terakhir")->getContent());
            UploadImage::setExt($request->file("kondisi_terakhir")->extension());
            $path_kondisi_terakhir = UploadImage::uploadImage();
            $inputkonsidi->photo = $path_kondisi_terakhir;
            $inputkonsidi->keterangan = $request->keterangan;
            $inputkonsidi->save();

            DB:: commit();
            return redirect()->route('upt-penerima-manfaat')->with(array(
                'message'    => 'Berhasil Menyelesaikan',
                'alert-type' => 'success',
            ));
        } catch (\Throwable $th) {
            // $th->getMessage()
            DB:: rollback();
            return redirect()->back()->with(array(
                'message'    => $th->getMessage(),
                'alert-type' => 'error'
            ));
        }
    }

    public function aksiSelesaiUndo(Request $request) {
        $uuid = $request->uuid;
        $pendaftar   = Pendaftaran::where('uuid', $uuid)->first();
        if(!$pendaftar) {
            return redirect()->route('upt-penerima-manfaat')->with(array(
                'message'    => 'Data Pendaftar Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        DB:: beginTransaction();
        try {
            $pendaftar['tindakan'] = 2;
            $pendaftar->update();

            $hapuskonsidi = KondisiTerakhir::where('pendaftar_id', $uuid)->update(['soft_delete' => 1]);

            DB:: commit();
            return redirect()->route('upt-penerima-manfaat')->with(array(
                'message'    => 'Berhasil Rollback Data Penerima Manfaat',
                'alert-type' => 'success',
            ));
        } catch (\Throwable $th) {
            // $th->getMessage()
            DB:: rollback();
            return redirect()->back()->with(array(
                'message'    => $th->getMessage(),
                'alert-type' => 'error'
            ));
        }
    }

    public function hapus(Request $request, $uuid) {
        $pendaftar   = Pendaftaran::where('uuid', $uuid)->first();
        if(!$pendaftar) {
            return redirect()->route('upt-penerima-manfaat')->with(array(
                'message'    => 'Data Pendaftar Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        DB:: beginTransaction();
        try {
            $pendaftar['soft_delete'] = 1;
            $pendaftar->update();

            DB:: commit();
            return redirect()->route('upt-penerima-manfaat')->with(array(
                'message'    => 'Sukses Menghapus Data',
                'alert-type' => 'success',
            ));
        } catch (\Throwable $th) {
            DB:: rollback();
            return redirect()->back()->with(array(
                'message'    => 'Terdapat Kesalahan',
                'alert-type' => 'error'
            ));
        }
    }

    public function tambahBantuan(Request $request, $uuid) {
        $pendaftar   = Pendaftaran::where('uuid', $uuid)->first();
        if(!$pendaftar) {
            return redirect()->route('upt-penerima-manfaat')->with(array(
                'message'    => 'Data Pendaftar Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('upt.penerimaManfaat.tambah_bantuan', compact('uuid'));
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            DB:: beginTransaction();
            try {
                $bantuan                = new PendaftaranBantuan;
                $bantuan->id            = Str::uuid();
                $bantuan->tanggal_beri  = $request->input('tanggal');
                $bantuan->bantuan       = $request->input('manfaat');
                $bantuan->upt_id        = auth()->user()->upt->uuid ?? '';
                $bantuan->soft_delete   = 0;
                $bantuan->pendaftar_id  = $uuid;

                // Upload photo
                if(file_exists($_FILES['foto_bukti']['tmp_name']) || is_uploaded_file($_FILES['foto_bukti']['tmp_name'])) {
                    // $data_in['foto_bukti'] = Str:: uuid().".".$request->file("foto_bukti")->extension();
                    // Storage::put('public/bukti/'.$data_in['foto_bukti'],$request->file("foto_bukti")->getContent());
                    // $bantuan->bukti = $data_in['foto_bukti'];

                    UploadImage::setPath('foto_bukti');
                    UploadImage::setImage($request->file("foto_bukti")->getContent());
                    UploadImage::setExt($request->file("foto_bukti")->extension());
                    $path_foto_bukti = UploadImage::uploadImage();
                    $bantuan->bukti = $path_foto_bukti;
                }

                $bantuan->save();

                DB:: commit();
                return redirect()->route('upt-penerima-tambah-bantuan', ['uuid' => $uuid])->with(array(
                    'message'    => 'Sukses Menambah Bantuan',
                    'alert-type' => 'success',
                ));
            } catch (\Throwable $th) {
                DB:: rollback();
                return redirect()->back()->with(array(
                    'message'    => 'Terdapat Kesalahan',
                    'alert-type' => 'error'
                ))->withInput();
            }
        }
    }

    public function dataBantuan($uuid) {
        $bantuan = Fungsi::getPendaftarBantuan($uuid, auth()->user()->upt_id);
        return Datatables:: of($bantuan)
            ->addColumn('fotobukti', function ($data){
                $foto = '<a data-fancybox="images" href="'.Storage::disk('s3')->temporaryUrl($data->bukti, Carbon::now()->addMinutes(3600)).'"><img class="img-fluid" src="'.Storage::disk('s3')->temporaryUrl($data->bukti, Carbon::now()->addMinutes(3600)).'"></a>';
                return $foto;
            })
            ->editColumn('tanggal_beri', function ($data){
                return Fungsi::hari_indo($data->tanggal_beri);
            })
            ->addColumn('action', function($dataPenerima){
                $actionBtn = '<div class="aksi-button">
                    <div class="relative">
                        <a   href = "'.route('upt-penerima-edit-bantuan', ['uuid' => $dataPenerima->id]).'" class = "btn btn-primary">
                        <img src  = "'.asset('assets/images/edit.svg').'" alt                                          = "">
                        </a>
                        <a  onclick="return confirm(`Anda Yakin Menghapus Data Ini?`)" href = "'.route('upt-penerima-hapus-bantuan', ['uuid' => $dataPenerima->id]).'" class                                           = "btn btn-danger">
                        <img src  = "'.asset('assets/images/delete_outline.svg').'" alt = "">
                        </a>
                    </div>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'fotobukti'])
            ->make(true);
    }

    public function editBantuan(Request $request, $id) {
        $bantuan   = PendaftaranBantuan::where('id', $id)->first();
        if(!$bantuan) {
            return redirect()->back()->with(array(
                'message'    => 'Data Bantuan Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('upt.penerimaManfaat.edit_bantuan', compact('bantuan'));
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            DB:: beginTransaction();
            try {
                $bantuan                = PendaftaranBantuan::where('id', $id)->first();
                $bantuan->tanggal_beri  = $request->input('tanggal');
                $bantuan->bantuan       = $request->input('manfaat');
                $bantuan->upt_id        = auth()->user()->upt->uuid ?? '';
                $bantuan->soft_delete   = 0;
                $bantuan->pendaftar_id  = $bantuan->pendaftar_id;

                // Upload photo
                if(file_exists($_FILES['foto_bukti']['tmp_name']) || is_uploaded_file($_FILES['foto_bukti']['tmp_name'])) {
                    UploadImage::setPath('foto_bukti');
                    UploadImage::setImage($request->file("foto_bukti")->getContent());
                    UploadImage::setExt($request->file("foto_bukti")->extension());
                    $path_foto_bukti = UploadImage::uploadImage();
                    $bantuan->bukti = $path_foto_bukti;
                }

                $bantuan->save();

                DB:: commit();
                return redirect()->route('upt-penerima-tambah-bantuan', ['uuid' => $bantuan->pendaftar_id])->with(array(
                    'message'    => 'Sukses Edit Bantuan',
                    'alert-type' => 'success',
                ));
            } catch (\Throwable $th) {
                DB:: rollback();
                return redirect()->back()->with(array(
                    'message'    => 'Terdapat Kesalahan',
                    'alert-type' => 'error'
                ));
            }
        }
    }

    public function hapusBantuan(Request $request, $id) {
        $bantuan   = PendaftaranBantuan::where('id', $id)->first();
        if(!$bantuan) {
            return redirect()->back()->with(array(
                'message'    => 'Data Bantuan Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        DB:: beginTransaction();
        try {
            $bantuan['soft_delete'] = 1;
            $bantuan->update();

            DB:: commit();
            return redirect()->route('upt-penerima-tambah-bantuan', ['uuid' => $bantuan->pendaftar_id])->with(array(
                'message'    => 'Sukses Menghapus Bantuan',
                'alert-type' => 'success',
            ));
        } catch (\Throwable $th) {
            DB:: rollback();
            return redirect()->back()->with(array(
                'message'    => 'Terdapat Kesalahan',
                'alert-type' => 'error'
            ));
        }
    }

    public function tambah(Request $request)
    {
        $users = Fungsi::getPegawai(auth()->user()->upt_id);
        $provinsi    = KodeWilayah::select(['prov_id', 'prov'])->distinct()->get();
        $jenis_aduan = JenisAduan::orderBy('nama', 'asc')->get();
        $jenis_kelamin = JenisKelamin::orderBy('nama', 'asc')->get();
        $permasalahan = Permasalahan::orderBy('nama', 'asc')->get();
        $upt         = Upt::get();

        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('upt.penerimaManfaat.tambah', compact('provinsi', 'jenis_aduan', 'jenis_kelamin', 'upt', 'permasalahan','users'));
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            DB:: beginTransaction();
            try {
                $noregis = Fungsi::generateNoRegis();
                $pendaftaran = new Pendaftaran;
                $pendaftaran->nama_lengkap     = $request->nama_lengkap ?? null;
                $pendaftaran->nik              = $request->nik ?? null;
                $pendaftaran->tempat_lahir     = $request->tempat_lahir ?? null;
                $pendaftaran->tanggal_lahir    = $request->tanggal_lahir ?? null;
                $pendaftaran->umur             = $request->umur ?? null;
                $pendaftaran->jenis_kelamin    = $request->jenis_kelamin;
                $pendaftaran->no_hp            = $request->no_hp ?? null;
                $pendaftaran->prov_id          = 35;
                $pendaftaran->kab_id           = $request->kab_id;
                $pendaftaran->kec_id           = $request->kec_id;
                $pendaftaran->alamat           = $request->alamat ?? null;
                $pendaftaran->jenis_aduan      = $request->jenis_aduan;
                $pendaftaran->upt_id           = auth()->user()->upt_id;
                $pendaftaran->nama_rekomendasi = $request->nama_rekomendasi ?? null;
                $pendaftaran->telp_rekomendasi = $request->telp_rekomendasi ?? null;
                $pendaftaran->permasalahan     = $request->permasalahan;
                $pendaftaran->pendamping       = $request->pendamping;
                $pendaftaran->is_penjangkauan  = 1;
                if($request->tanggal_masuk!=null) {
                    $pendaftaran->tanggal_masuk    = date('Y-m-d', strtotime($request->tanggal_masuk));
                }
                if($request->tanggal_keluar!=null) {
                    $pendaftaran->tanggal_keluar   = date('Y-m-d', strtotime($request->tanggal_keluar));
                }
                $pendaftaran->uuid             = Str::uuid();
                $pendaftaran->tindakan         = 2;
                $pendaftaran->nomor_registrasi = $noregis;
                $pendaftaran->pj_id            = $request->idpenanggungjawab ?? null;

                if(file_exists($_FILES['foto_kondisi']['tmp_name']) || is_uploaded_file($_FILES['foto_kondisi']['tmp_name'])) {
                    UploadImage::setPath('pendaftaran/foto_kondisi');
                    UploadImage::setImage($request->file("foto_kondisi")->getContent());
                    UploadImage::setExt($request->file("foto_kondisi")->extension());
                    $path_foto_kondisi = UploadImage::uploadImage();
                    $pendaftaran->foto_kondisi = $path_foto_kondisi;
                }
                if(file_exists($_FILES['surat_pengantar']['tmp_name']) || is_uploaded_file($_FILES['surat_pengantar']['tmp_name'])) {
                    UploadFile::setPath('pendaftaran/surat_pengantar');
                    UploadFile::setFile($request->file("surat_pengantar")->getContent());
                    UploadFile::setExt($request->file("surat_pengantar")->extension());
                    $path_surat_pengantar = UploadFile::uploadFile();
                    $pendaftaran->surat_pengantar = $path_surat_pengantar;
                }

                $pendaftaran->save();

                // buat notifikasi upt
                $to    = User::where('upt_id', auth()->user()->upt_id)->get();
                $judul = 'Pendaftar Baru!';
                $pesan = 'Ada pendaftar yang baru dengan nama ' . ucwords($request->nama_lengkap ?? null) . '. Silahkan di Cek!';
                $url   = '/upt/pendaftar/tertunda';
                foreach($to as $t) {
                    $t->notify(new PendaftarNotification($judul, $pesan, $url));
                }

                // buat notifikasi dinsos
                $toDinsos    = User::whereHas('role', function ($q) {
                            $q->where('role', 'dinsos');
                        })->get();
                $urlDinsos   = '/dinsos/pendaftar';
                foreach($toDinsos as $t) {
                    $t->notify(new PendaftarNotification($judul, $pesan, $urlDinsos));
                }

                DB:: commit();
                return redirect()->route('upt-penerima-manfaat')->with(array(
                    'message'    => 'Data Sudah Terdaftar',
                    'alert-type' => 'success'
                ));
            } catch (\Throwable $th) {
                // $th->getMessage()
                DB:: rollback();
                return redirect()->back()->with(array(
                    'message'    => 'Terdapat Kesalahan',
                    'alert-type' => 'error'
                ))->withInput();
            }
        }
    }

}
