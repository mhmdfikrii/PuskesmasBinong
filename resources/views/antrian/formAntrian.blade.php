<form action="/antrian" method="post" class="mb-5 pb-4">
  @csrf

  <div class="mb-3">
    <input type="hidden" class="form-control" name="name" id="name" value="{{ auth()->user()->name }}">
  </div>
  <input id="NIK" value="{{ auth()->user()->NIK }}" name="NIK" type="hidden">
  <input name="tgllahir" value="{{ auth()->user()->tgllahir }}" id="tgllahir" type="hidden">

  <div class="mb-3">
    <label for="tanggal" class="form-label">Tanggal Pengambilan Poli</label>
    <input class="form-control" type="text" disabled id="tanggal" />

  </div>
  <div class="mb-3">
    <label for="kode_poli" class="form-label">Pilih Poli</label>
    <select class="form-control" name="kode_poli" id="kode_poli">
      <option disabled selected>Pilih Poli</option>
      @foreach ($polis as $poli)
        <option value="{{ $poli->kode_poli }}">{{ $poli->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>

<script>
  let currentDate = new Date();
  let formattedDate = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate();
  document.getElementById('tanggal').value = formattedDate;
</script>
