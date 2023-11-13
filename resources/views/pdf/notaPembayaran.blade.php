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
  <h1>Nota Transaksi</h1>
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
      <th>Pelayanan</th>
      <td>

        @foreach ($p_pelayanan as $item)
          @if (
              $item->kode_rekammedis ==
                  ($data->resepObat ? $data->resepObat->kode_rekamedis : $data->suratRujukan->kode_rekammedis))
            <p>{{ $item->pelayanan->layanan }} - <span
                style="font-weight: bold">{{ 'Rp.' . $item->pelayanan->biaya }}</span>
            </p>
          @endif
        @endforeach
      </td>
    </tr>
    <tr>
      @if ($data->resepObat && $data->resepObat != null)
        <th>Resep Obat</th>
        <td>
          @foreach ($p_resepobat as $resep)
            @if ($resep->resepObat->kode_rekamedis == $data->resepObat->kode_rekamedis)
              <p>{{ $resep->obat->nama_obat }} - Dosis {{ $resep->dosis }} - <span style="font-weight: bold">Harga
                  {{ $resep->qty * $resep->obat->harga }}
                  ({{ $resep->qty . 'x' . $resep->obat->harga }})
                </span>
              </p>
            @endif
          @endforeach
        </td>
      @endif

    </tr>

    <tr style="font-weight: bold">
      <th>Total</th>
      <td>{{ $data->total }}</td>
    </tr>


  </table>
</body>

</html>
