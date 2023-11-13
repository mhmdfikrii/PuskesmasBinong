<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Data Pasien</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
  </style>
</head>

<body>
  <h1>Rekam Medis</h1>
  <table>
    <tr>
      <th>Nama</th>
      <td>
        {{ $data->resepObat ? $data->resepObat->rekamMedis->dataAntrian->User->name : $data->suratRujukan->rekamMedis->dataAntrian->User->name }}
      </td>
    </tr>
    <tr>
      <th>BPJS</th>
      <td>
        {{ $data->resepObat ? $data->resepObat->rekamMedis->dataAntrian->User->bpjs : $data->suratRujukan->rekamMedis->dataAntrian->User->bpjs }}
      </td>
    </tr>

    <tr>
      <th>Dokter</th>
      <td>{{ $data->dataAntrian->poli->dataDokter->name }}</td>
    </tr>

    <tr>
      <th>Pemeriksaan Fisik</th>
      <td>{{ $data->pemeriksaan_fisik }}</td>
    </tr>

    <tr>
      <th>Diagnosa</th>
      <td>{{ $data->diagnosa }}</td>
    </tr>
    <tr>
      <th>Anamnesa</th>
      <td>{{ $data->anamnesa }}</td>
    </tr>
  </table>
</body>

</html>
