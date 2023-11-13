<!DOCTYPE html>
<html>

<head>
  <title>Surat Rujukan Pasien</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      line-height: 1.4;
    }

    .header-logo {
      text-align: center;
    }

    .title {
      font-size: 18px;
      font-weight: bold;
    }

    .sub-title {
      font-size: 14px;
      font-weight: bold;
    }

    .content {
      margin-bottom: 20px;
      font-size: 14px
    }

    .content ol {
      padding-left: 20px;
    }

    .signature {
      text-align: right;
      font-size: 14px;
    }
  </style>
</head>

<body>
  <div class="header-logo">
    <div class="header-img">
      <img src="https://res.cloudinary.com/dt91kxctr/image/upload/v1691501308/image-removebg-preview_1_mv80cz.png"
        alt="Logo Puskesmas" style="width: 100%; height: 20vh">
    </div>
  </div>
  <div style="text-align:right">
    <p class="title">{{ $data->kode_rujukan }}</p>
    <p class="sub-title">Subang,
      {{ \Carbon\Carbon::parse($data->created_at)->setTimezone('Asia/Jakarta')->format('d/m/Y H:i:s') }}</p>
  </div>

  <div class="content">
    <p>Kepada,</p>
    <p>Bapak/Ibu Dokter</p>
    <p>Perihal: Surat Rujukan Pasien</p>

    <p>Dengan hormat,</p>

    <p>Kami dari Pusat Kesehatan Masyarakat Puskesmas Binong Subang ingin merujuk salah satu pasien kami dengan data
      sebagai berikut:</p>

    <ol>
      <li>Nama Pasien: {{ $data->rekamMedis->dataAntrian->User->name }}</li>
      <li>Umur: {{ $data->rekamMedis->dataAntrian->User->age }} Tahun</li>
      <li>Alamat: {{ $data->rekamMedis->dataAntrian->User->alamat }}</li>
      <li>NIK: {{ $data->rekamMedis->dataAntrian->User->NIK }}</li>
      <li>Nomor Rekam Medis: {{ $data->rekamMedis->kode_rekammedis }}</li>
      @if ($data->rencana_tindak_lanjut != null)
        <li>Rencana Tindak Lanjut: {{ $data->rencana_tindak_lanjut }}</li>
      @endif
      @if ($data->fasilitas != null)
        <li>Fasilitas Diperlukan: {{ $data->fasilitas }}</li>
      @endif
    </ol>

    <p>Setelah kami melakukan evaluasi dan perawatan awal terhadap pasien tersebut, kami berpendapat bahwa kondisi
      pasien memerlukan perawatan lebih lanjut yang sesuai dengan spesialisasi Anda di Rumah Sakit. Oleh karena itu,
      kami mohon bantuan dan pertimbangan Anda untuk memberikan perawatan yang sesuai agar pasien dapat mendapatkan
      penanganan yang optimal.</p>

    <p>Kami berharap agar Anda dapat memberikan perawatan yang terbaik untuk pasien kami dan kami siap untuk memberikan
      informasi lebih lanjut jika diperlukan. Kami sangat menghargai kerjasama antara Puskesmas Binong dan Rumah Sakit
      Anda dalam memberikan pelayanan kesehatan kepada masyarakat.</p>

    <p>Terima kasih atas perhatian dan kerjasamanya.</p>
  </div>

  <div class="signature">
    <p>Hormat kami,</p>
    <p>{{ $data->rekamMedis->dataDokter->name }}</p>
    <p>Dokter {{ $data->rekamMedis->dataDokter->poli->name }}</p>
  </div>
</body>

</html>
