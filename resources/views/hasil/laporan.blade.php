<!DOCTYPE html>

<html>
<head>
	<title>Daftar Nama Penerima Bantuan Sosial Desa Wonomerto</title>
</head>
<style>
    table {
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }
    .kop{
        border:0px;
    }
</style>
<body>
<table class="kop " style= "border:0px" width = "986">
  <body>
    <tr>
      <td align="left" width="15%"><img
 src="template/logo.jpg"
 alt="Logo Jombang" title="Logo Jombang" height="120"
 width="120"></td>
      <td style="width: 70%;" align="center">
      <div>
      <div style="font-size: 14pt;"><strong>PEMERINTAH KABUPATEN JOMBANG</div>
      <div style="font-size: 13pt;"><strong>KECAMATAN WONOSALAM</strong></div>
      <div style="font-size: 12pt;"><strong>DESA WONOMERTO</strong></div>
      <div style="font-size: 11pt;">Jalan Bukit Pinang No.56 Wonomerto, Wonosalam, Jombang, 61476 </div>
      </div>
      </td>
      <td style="width: 15%;" align="left"></td>
    </tr>
    <tr>
      <td colspan="3">
      <hr
 style="border-top: solid 2px; line-height: normal; color: rgb(0, 0, 0); background-color: rgb(0, 0, 0); margin-top: 3px;"></td>
    </tr>
  </body>
</table>
<h4>Hasil Akhir Perankingan</h4>
<table border="1" width="100%">
	<thead>
		<tr align="center">
            <th width="6%">No</th>
			<th>Nama Penerima</th>
            <th>Alamat</th>
            <th>RW</th>
            <th>RT</th>
			<th>Nilai Akhir</th>
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
            <td>{{ $keys->nilai }}</td>
            <td>{{ $no }}</td>
        </tr>
        @php
            $no++;
        @endphp
        @endforeach
    </tbody>
</table>
<script>
	window.print();
</script>
</body>
</html>