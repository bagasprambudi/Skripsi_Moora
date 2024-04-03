<!DOCTYPE html>
<html>

<head>
    <title>Daftar Nama Penerima Bantuan Sosial Desa Wonomerto</title>
    <!-- <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        .kop {
            border: 0px;
        }
    </style> -->
</head>

<body>
@php
$periode = session()->get('periode');
@endphp

    <table class="kop " style="border: 0px" width="100%">
        <tr>
            <td align="left" width="15%">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('template/logo.jpg'))) }}"
                    width="90px">
            </td>
            <td style="width: 70%;" align="center">
                <div>
                    <div style="font-size: 14pt;"><strong>PEMERINTAH KABUPATEN JOMBANG</strong></div>
                    <div style="font-size: 13pt;"><strong>KECAMATAN WONOSALAM</strong></div>
                    <div style="font-size: 12pt;"><strong>DESA WONOMERTO</strong></div>
                    <div style="font-size: 11pt;">Jalan Bukit Pinang No.56 Wonomerto, Wonosalam, Jombang, 61476</div>
                </div>
            </td>
            <td style="width: 15%;" align="left"></td>
        </tr>
        <tr>
            <td colspan="3">
                <hr
                    style="border-top: solid 2px; line-height: normal; color: rgb(0, 0, 0); background-color: rgb(0, 0, 0); margin-top: 3px;">
            </td>
        </tr>
    </table>
    <h3 style="text-align: center;">Daftar Nama Penerima Bantuan Sosial Desa Wonomerto</h3>
    <h4>Periode : {{ $periode->periode_nama }}</h4>
    <table border="1" width="100%">
        <thead>
            <tr align="center">
                <th width="6%">No</th>
                <th>Nama Penerima</th>
                <th>Alamat</th>
                <th>RW</th>
                <th>RT</th>
                <th width="15%">Ranking</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach ($hasil as $keys)
            <tr align="center">
                <td>{{ $no }}</td>
                <td align="left">{{ $keys->alternatif_nama }}</td>
                <td class="text-left">{{ $keys->alternatif_alamat }}</td>
                <td>{{ $keys->RT }}</td>
                <td>{{ $keys->RW }}</td>
                <td>{{ $no }}</td>
            </tr>
            @php
            $no++;
            @endphp
            @endforeach
        </tbody>
    </table>
    <div style="margin-top: 20px;">
        <div style="text-align: right;">
            <p>Kepala Seksi Kesejahteraan/Pelayanan</p>
            <br>
            <br>
            <br>
            <p>Luluk Nurhidayati</p>
        </div>
    </div>

    </div>
    <script>
        window.print();

    </script>
</body>

</html>
