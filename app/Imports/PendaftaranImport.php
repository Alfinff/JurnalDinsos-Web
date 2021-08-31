<?php

namespace App\Imports;

use Illuminate\Support\Str;
use App\Models\Pendaftaran;
use App\Models\JenisKelamin;
use App\Models\JenisAduan;
use App\Helpers\Fungsi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PendaftaranImport implements ToCollection, WithHeadingRow, WithValidation
{
    public function rules(): array
    {
        return [
            // 'tanggal_masuk'       => ['nullable', 'dateformat:d/m/Y'],
            'nama'            => ['nullable', 'string', 'max:255'],
            'tempat_lahir'    => ['nullable', 'string', 'max:255'],
            // 'tanggal_lahir'=> ['nullable', 'dateformat:d/m/Y'],
            'alamat'          => ['nullable', 'string', 'max:2000'],
            'umur'            => ['nullable', 'numeric'],
            'no_hp'           => ['nullable', 'numeric'],
            'nik'             => ['nullable', 'numeric', 'digits:16'],
            'jenis_kelamin'   => ['nullable', 'string', 'max:255'],
            'jenis_aduan'     => ['nullable', 'string', 'max:255'],
        ];

    }

    public function customValidationMessages()
    {
        return [
            'tanggal_masuk' => 'Format Tanggal Masuk Salah',
            'nama'          => 'Format Nama Salah',
            'tempat_lahir'  => 'Format Tempat Lahir Salah',
            'tanggal_lahir' => 'Format Tanggal Lahir Salah',
            'alamat'        => 'Format Alamat Salah',
            'umur'          => 'Format Umur Salah',
            'no_hp'         => 'Format Nomor HP Salah',
            'nik'           => 'Format NIK Salah',
            'jenis_kelamin' => 'Format Jenis Kelamin Salah',
            'jenis_aduan'   => 'Format Jenis Aduan Salah',
        ];
    }

    public function transformDate($value = '0000-00-00 00:00:00', $format = 'Y-m-d H:i:s')
    {
        try {
            return \PhpOffice\PhpSpreadsheet\Shared\Date:: excelToDateTimeObject($value)->format($format);
        } catch(Exception $tg) {
            return 0;
        }
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $tanggal = null;
            if(isset($row['tanggal_masuk']) && ($row['tanggal_masuk'] != null)) {
                $tanggal = $this->transformDate($row['tanggal_masuk']) ?? null;
                $input['tanggal_masuk']    = $tanggal;
            }

            $tanggal_lahir = null;
            if(isset($row['tanggal_lahir']) && ($row['tanggal_lahir']  != null)) {
                $tanggal_lahir = $this->transformDate($row['tanggal_lahir']) ?? null;
                $input['tanggal_lahir']    = $tanggal_lahir;
            }

            $jenis_kelamin = null;
            if(isset($row['jenis_kelamin']) && ($row['jenis_kelamin']  != null)) {
                $laki = "laki-laki";
                $pria = "pria";
                $perempuan = "perempuan";
                $wanita = "wanita";
                if((strpos($row['jenis_kelamin'], $pria) !== false) || (strpos($row['jenis_kelamin'], $laki) !== false)) {
                    $jenis_kelamin = $laki;
                } else if ((strpos($row['jenis_kelamin'], $wanita) !== false) || (strpos($row['jenis_kelamin'], $perempuan) !== false)) {
                    $jenis_kelamin = $perempuan;
                }
                $cek = JenisKelamin::where('nama', 'like', '%'.$jenis_kelamin.'%')->where('soft_delete', 0)->first();
                
                if(!$cek) {
                    $jenis_kelamin = null;
                } else {
                    $jenis_kelamin = $cek->uuid;
                }
                $input['jenis_kelamin']    = $jenis_kelamin;
            }

            $jenis_aduan = null;
            if(isset($row['jenis_aduan']) && ($row['jenis_aduan']  != null)) {
                $cek = JenisAduan::where('nama', 'like', '%'.$row['jenis_aduan'].'%')->first();
                if(!$cek) {
                    $jenis_aduan = null;
                } else {
                    $jenis_aduan = $cek->uuid;
                }
                $input['jenis_aduan']    = $jenis_aduan;
            }

                   $pendaftaran        = new Pendaftaran();
            $input['nik']              = $row['nik'] ?? null;
            $input['nama_lengkap']     = $row['nama'] ?? null;
            $input['umur']             = $row['umur'] ?? null;
            $input['no_hp']            = $row['no_hp'] ?? null;
            $input['tempat_lahir']     = $row['tempat_lahir'];
            $input['alamat']           = $row['alamat'] ?? null;
            $input['nomor_registrasi'] = Fungsi::generateNoRegis();
            $input['uuid']             = Str::uuid();
            $input['tindakan']         = 2;
            $input['upt_id']           = auth()->user()->upt_id ?? null;
            $input['is_penjangkauan']  = 1;
            $pendaftaran->create($input);
        }

        return true;
    }
}
