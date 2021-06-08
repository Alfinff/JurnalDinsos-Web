<?php

namespace App\Imports;

use Illuminate\Support\Str;
use App\Models\Pendaftaran;
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
            'nama'          => ['nullable', 'string', 'max:255'],
            // 'tanggal'       => ['nullable', 'dateformat:d/m/Y'],
            'tempat_lahir'  => ['nullable', 'string', 'max:255'],
            // 'tanggal_lahir' => ['nullable', 'dateformat:d/m/Y'],
            'alamat'        => ['nullable', 'string', 'max:2000'],
        ];

    }

    public function customValidationMessages()
    {
        return [
            'nama'          => 'Format Nama Salah',
            'tanggal'       => 'Format Tanggal Salah',
            'tempat_lahir'  => 'Format Tempat Lahir Salah',
            'tanggal_lahir' => 'Format Tanggal Lahir Salah',
            'alamat'        => 'Format Alamat Salah',
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
            if(isset($row['tanggal']) && ($row['tanggal'] != null)) {
                $tanggal = $this->transformDate($row['tanggal']) ?? null;
                $input['tanggal_masuk']    = $tanggal;
            }

            $tanggal_lahir = null;
            if(isset($row['tanggal_lahir']) && ($row['tanggal_lahir']  != null)) {
                $tanggal_lahir = $this->transformDate($row['tanggal_lahir']) ?? null;
                $input['tanggal_lahir']    = $tanggal_lahir;
            }

                   $pendaftaran        = new Pendaftaran();
            $input['nik']              = $row['nik'] ?? null;
            $input['nama_lengkap']     = $row['nama'] ?? null;
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
