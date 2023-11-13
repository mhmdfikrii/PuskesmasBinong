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
  <h1>Resep Obat</h1>
  <table>
    <tr>
      <th>Kode Rekam Medis</th>
      <td>{{ $resepObat->kode_rekamedis }}</td>
    </tr>
    <tr>
      <th>Kode Resep</th>
      <td>{{ $resepObat->kode_resep_obat }}</td>
    </tr>
    <tr>
      <th>Obat</th>
      <td>
        @foreach ($resepObat->p_resepobat as $item)
          <p>{{ $item->obat->nama_obat }} - Dosis {{ $item->dosis }} - Qty {{ $item->qty }}</p>
        @endforeach
      </td>
    </tr>
  </table>
</body>

</html>
