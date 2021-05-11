<?php

namespace App\Helpers;

use DB;
use Auth;
use Session;
use DateTime;
use Carbon\Carbon;

error_reporting(0);

use App\Models\Berita;
use App\Models\Pendaftaran;
use App\Models\PendaftaranBantuan;
use App\Models\PendaftaranPerkembangan;
use App\Models\User;
use App\Models\KodeWilayah;
use App\Models\Upt;
use App\Models\JenisAduan;
use App\Models\Permasalahan;
use App\Models\Kegiatan;
use App\Models\UnitKerja;

class Fungsi
{
    public static function getPendaftarTertunda($upt_id)
    {
        $pendaftar = Pendaftaran::
                    where('soft_delete', 0)
                    ->where('upt_id', $upt_id)
                    ->where('tindakan', 0)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return $pendaftar;
    }

    public static function getPendaftarDihubungi($upt_id)
    {
        $pendaftar = Pendaftaran::
                    with(['penanggungjawab'])
                    ->where('soft_delete', 0)
                    ->where('upt_id', $upt_id)
                    ->where('tindakan', 1)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return $pendaftar;
    }

    public static function getPendaftarPenerimaManfaat($upt_id)
    {
        $pendaftar = Pendaftaran::
                    with(['penanggungjawab','upt', 'jenisaduan'])
                    ->where('soft_delete', 0)
                    ->where('upt_id', $upt_id)
                    ->where('tindakan', 2)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return $pendaftar;
    }

    public static function getHistoryPendaftarPenerimaManfaat($upt_id)
    {
        $pendaftar = Pendaftaran::
                    with(['penanggungjawab','upt', 'jenisaduan'])
                    ->where('soft_delete', 0)
                    ->where('upt_id', $upt_id)
                    ->where('tindakan', 3)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return $pendaftar;
    }

    public static function getPendaftarBantuan($uuidpenerima, $upt_id)
    {
        $bantuan = PendaftaranBantuan::
                    where('soft_delete', 0)
                    ->where('pendaftar_id', $uuidpenerima)
                    ->where('upt_id', $upt_id)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return $bantuan;
    }

    public static function getPendaftarAll()
    {
        $pendaftar = Pendaftaran::
                    with(['upt', 'jenisaduan'])
                    ->where('soft_delete', 0)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return $pendaftar;
    }

    public static function getBerita()
    {
        $berita = Berita::
                    with(['editorberita'])
                    ->where('soft_delete', 0)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return $berita;
    }

    public static function getPendaftar($uptid)
    {
        $pendaftar = Pendaftaran::
                    with(['upt', 'jenisaduan'])
                    ->where('upt_id', $uptid)
                    ->where('soft_delete', 0)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return $pendaftar;
    }

    // public static function getPerkembangan($uuidpenerima)
    // {
    //     $perkembangan = PendaftaranPerkembangan::
    //                 where('soft_delete', 0)
    //                 ->where('pendaftar_id', $uuidpenerima)
    //                 ->orderBy('created_at', 'desc')
    //                 ->get()
    //                 ->groupBy(function($val) {
    //                     return Carbon::parse($val->created_at)->format('m');
    //                 }, function($val) {
    //                     return Carbon::parse($val->created_at)->format('Y');
    //                 });

    //     return $perkembangan;
    // }

    public static function getKegiatan($upt_id)
    {
        $kegiatan = Kegiatan::
                    where('upt_id', $upt_id)
                    ->where('soft_delete', 0)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return $kegiatan;
    }

    public static function getPegawai($upt_id)
    {
        $pegawai = User::
                    with(['profile'])
                    ->join('ms_role', 'ms_role.id', '=', 'ms_users.role')
                    ->where('ms_role.role', 'pegawai')
                    ->where('upt_id', '!=', null)
                    ->where('upt_id', $upt_id)
                    ->where('aktif', 1)
                    ->where('soft_delete', 0)
                    ->orderBy('username', 'asc')
                    ->get();

        return $pegawai;
    }

    public static function getSemuaPegawai($upt_id=null)
    {
        $pegawai = User::
                    with(['profile'])
                    ->join('ms_role', 'ms_role.id', '=', 'ms_users.role')
                    ->where('ms_role.role', 'pegawai')
                    ->where('upt_id', '!=', null)
                    ->where('upt_id', $upt_id)
                    ->where('soft_delete', 0)
                    ->orderBy('username', 'asc')
                    ->get();

        return $pegawai;
    }

    public static function getUnitKerja($upt_id)
    {
        $unit_kerja = UnitKerja::
                    where('upt_id', $upt_id)
                    ->where('soft_delete', 0)
                    ->orderBy('id_level_unit', 'asc')
                    ->get();

        return $unit_kerja;
    }

    public static function time_elapsed_string($datetime, $full = false) {
        $now  = new DateTime;
        $ago  = new DateTime ($datetime);
        $diff = $now->diff($ago);

        $diff->w  = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago': 'just now';
    }

    public static function hari_indo($tgl)
    {
        $tgl = strtotime($tgl);
        switch(date('l', $tgl))
        {
            case 'Monday':$nmh    = "Senin";break;
            case 'Tuesday':$nmh   = "Selasa";break;
            case 'Wednesday':$nmh = "Rabu";break;
            case 'Thursday':$nmh  = "Kamis";break;
            case 'Friday':$nmh    = "Jum'at";break;
            case 'Saturday':$nmh  = "Sabtu";break;
            case 'Sunday':$nmh    = "minggu";break;
        }
        switch(date("F", $tgl))
        {
            case 'January':     $nmb = "Januari";     break;
            case 'February':    $nmb = "Februari";    break;
            case 'March':       $nmb = "Maret";       break;
            case 'April':       $nmb = "April";       break;
            case 'May':         $nmb = "Mei";         break;
            case 'June':        $nmb = "Juni";        break;
            case 'July':        $nmb = "Juli";        break;
            case 'August':      $nmb = "Agustus";     break;
            case 'September':   $nmb = "September";   break;
            case 'October':     $nmb = "Oktober";     break;
            case 'November':    $nmb = "November";    break;
            case 'Desember':    $nmb = "Desember";    break;

        }

        return $nmh.", ".date("d",$tgl)." "."$nmb"." ".date("Y",$tgl);
    }

    public static function bulan_indo($tgl)
    {
        $tgl = strtotime($tgl);
        switch(date("F", $tgl))
        {
            case 'January':     $nmb = "Januari";     break;
            case 'February':    $nmb = "Februari";    break;
            case 'March':       $nmb = "Maret";       break;
            case 'April':       $nmb = "April";       break;
            case 'May':         $nmb = "Mei";         break;
            case 'June':        $nmb = "Juni";        break;
            case 'July':        $nmb = "Juli";        break;
            case 'August':      $nmb = "Agustus";     break;
            case 'September':   $nmb = "September";   break;
            case 'October':     $nmb = "Oktober";     break;
            case 'November':    $nmb = "November";    break;
            case 'Desember':    $nmb = "Desember";    break;

        }

        return $nmb." ".date("Y",$tgl);
    }

    public static function tanggal_indo($tgl)
    {
        $tgl = strtotime($tgl);
        switch(date("F", $tgl))
        {
            case 'January':     $nmb = "Januari";     break;
            case 'February':    $nmb = "Februari";    break;
            case 'March':       $nmb = "Maret";       break;
            case 'April':       $nmb = "April";       break;
            case 'May':         $nmb = "Mei";         break;
            case 'June':        $nmb = "Juni";        break;
            case 'July':        $nmb = "Juli";        break;
            case 'August':      $nmb = "Agustus";     break;
            case 'September':   $nmb = "September";   break;
            case 'October':     $nmb = "Oktober";     break;
            case 'November':    $nmb = "November";    break;
            case 'Desember':    $nmb = "Desember";    break;

        }

        return date("d",$tgl)." "."$nmb"." ".date("Y",$tgl);
    }

    public static function nama_bulan($nomorbulan)
    {
        switch($nomorbulan)
        {
            case 1:     $nmb = "Januari";     break;
            case 2:    $nmb = "Februari";    break;
            case 3:       $nmb = "Maret";       break;
            case 4:       $nmb = "April";       break;
            case 5:         $nmb = "Mei";         break;
            case 6:        $nmb = "Juni";        break;
            case 7:        $nmb = "Juli";        break;
            case 8:      $nmb = "Agustus";     break;
            case 9:   $nmb = "September";   break;
            case 10:     $nmb = "Oktober";     break;
            case 11:    $nmb = "November";    break;
            case 12:    $nmb = "Desember";    break;

        }

        return $nmb;
    }

    public static function rupiah($angka) {
        $hasil_rupiah = "Rp " . number_format($angka,0,'.','.');
        return $hasil_rupiah;
    }

}
