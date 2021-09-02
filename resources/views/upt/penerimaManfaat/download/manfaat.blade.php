<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('assets/images/logo-dinsos.ico')}}">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"> -->
    @yield('head')

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <title>Jurnal Dinsos</title>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <style type="text/css">
      .table thead th{ background-color:#007bff; color:#FFFFFF; border: 1px solid black;}
      .table tbody td{ border: 1px solid black;}
    </style>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

    </head>
<body>
    <center>
    <table class="table table-stripped">
        <thead>
        {{-- <tr>
            <td colspan=12 height="24" align="center" valign=bottom>
                <img src="kemenparekraf.png" alt="">
            </td>
        </tr> --}}
            <tr>
                <td colspan=12 height="24" align="center" valign=bottom><b><font face="Arial" size=4 color="#000000">Data Manfaat</font></b></td>
            </tr>
            <tr>
                <td height="24" align="left" valign=bottom><font face="Arial" size=4 color="#000000"><br></font></td>
                <td align="left" valign=bottom><font face="Arial" size=4 color="#000000"><br></font></td>
                <td align="left" valign=bottom><font face="Arial" size=4 color="#000000"><br></font></td>
                <td align="left" valign=bottom><font face="Arial" size=4 color="#000000"><br></font></td>
                <td align="left" valign=bottom><font face="Arial" size=4 color="#000000"><br></font></td>
                <td align="left" valign=bottom><font face="Arial" size=4 color="#000000"><br></font></td>
                <td align="left" valign=bottom><font face="Arial" size=4 color="#000000"><br></font></td>
                <td align="left" valign=bottom><font face="Arial" size=4 color="#000000"><br></font></td>
                <td align="left" valign=middle><font face="Arial" size=4 color="#000000"><br></font></td>
                <td align="left" valign=middle><font face="Arial" size=4 color="#000000"><br></font></td>
                <td align="left" valign=middle><font face="Arial" size=4 color="#000000"><br></font></td>
                <td align="left" valign=middle><font face="Arial" size=4 color="#000000"><br></font></td>
            </tr>
            @if(isset($pendaftar->nama_lengkap))
            <tr>
                <td height="32" align="left" valign=top><font face="Arial" size=4 color="#000000"><br></font></td>
                <td align="left" valign=top><b><font face="Arial" size=4 color="#000000"><br></font></b></td>
                <td align="left" valign=top><font face="Arial" size=4 color="#000000">Nama </font></td>
                <td align="left" valign=top><font face="Arial" size=4 color="#000000"><br></font></td>
                <td align="left" valign=top><b><font face="Arial" size=4 color="#000000"><br></font></b></td>
                <td colspan=7 align="left" valign=top><b><font face="Arial" size=4 color="#000000"> : {{ucwords($pendaftar->nama_lengkap)}}</font></b></td>
            </tr>
            @endif
            @if(isset($pendaftar->tempat_lahir))
            <tr>
                <td height="32" align="left" valign=top><font face="Arial" size=4 color="#000000"><br></font></td>
                <td align="left" valign=top><b><font face="Arial" size=4 color="#000000"><br></font></b></td>
                <td align="left" valign=top><font face="Arial" size=4 color="#000000">Tempat Lahir </font></td>
                <td align="left" valign=top><font face="Arial" size=4 color="#000000"><br></font></td>
                <td align="left" valign=top><b><font face="Arial" size=4 color="#000000"><br></font></b></td>
                <td colspan=7 align="left" valign=top><b><font face="Arial" size=4 color="#000000"> : {{ucwords($pendaftar->tempat_lahir)}}</font></b></td>
            </tr>
            @endif
            @if(isset($pendaftar->tanggal_lahir))
            <tr>
                <td height="32" align="left" valign=top><font face="Arial" size=4 color="#000000"><br></font></td>
                <td align="left" valign=top><b><font face="Arial" size=4 color="#000000"><br></font></b></td>
                <td align="left" valign=top><font face="Arial" size=4 color="#000000">Tanggal Lahir </font></td>
                <td align="left" valign=top><font face="Arial" size=4 color="#000000"><br></font></td>
                <td align="left" valign=top><b><font face="Arial" size=4 color="#000000"><br></font></b></td>
                <td colspan=7 align="left" valign=top><b><font face="Arial" size=4 color="#000000"> : {{date('Y-m-d', strtotime($pendaftar->tanggal_lahir))}}</font></b></td>
            </tr>
            @endif
            @if(isset($pendaftar->jeniskelamin->nama))
            <tr>
                <td height="32" align="left" valign=top><font face="Arial" size=4 color="#000000"><br></font></td>
                <td align="left" valign=top><b><font face="Arial" size=4 color="#000000"><br></font></b></td>
                <td align="left" valign=top><font face="Arial" size=4 color="#000000">Jenis Kelamin </font></td>
                <td align="left" valign=top><font face="Arial" size=4 color="#000000"><br></font></td>
                <td align="left" valign=top><b><font face="Arial" size=4 color="#000000"><br></font></b></td>
                <td colspan=7 align="left" valign=top><b><font face="Arial" size=4 color="#000000"> : {{ucwords($pendaftar->jeniskelamin->nama)}}</font></b></td>
            </tr>
            @endif
            <tr>
                <td height="32" align="left" valign=top><font face="Arial" size=4 color="#000000"><br></font></td>
                <td align="left" valign=top><b><font face="Arial" size=4 color="#000000"><br></font></b></td>
                <td align="left" valign=top><font face="Arial" size=4 color="#000000">Tanggal  </font></td>
                <td align="left" valign=top><font face="Arial" size=4 color="#000000"><br></font></td>
                <td align="left" valign=top><b><font face="Arial" size=4 color="#000000"><br></font></b></td>
                <td colspan=7 align="left" valign=top><b><font face="Arial" size=4 color="#000000"> : {{date('Y-m-d', strtotime($pendaftar->tanggal_lahir))}}</font></b></td>
            </tr>
            <tr>
        </thead>
    </table>
    </center>
    <table class="table table-stripped table-bordered" style="width: 100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Bantuan</th>
                <th>Bukti</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $id => $item)
                <tr>
                    <td style="width: calc(5%)">{{$item['no']}}</td>
                    <td style="width: calc(10%)">{{$item['tanggal_beri']}}</td>
                    <td style="width: calc(20%)">{{$item['bantuan']}}</td>
                    <td style="width: calc(65%)"><img src="{{$item['bukti']}}" alt=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
<script>
document.addEventListener('DOMContentLoaded', function(event) {
    var css = '@page { size: landscape; }',
        head = document.head || document.getElementsByTagName('head')[0],
        style = document.createElement('style');

    style.type = 'text/css';
    style.media = 'print';

    if (style.styleSheet){
        style.styleSheet.cssText = css;
    } else {
        style.appendChild(document.createTextNode(css));
    }

    head.appendChild(style);
    window.print();
});
</script>
</body>
</html>
