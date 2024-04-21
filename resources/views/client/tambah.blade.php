@extends('layout.main')

@section('body')
<h3>Tambah Klien</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('client.simpandata') }}" method="POST">
    @csrf
    <div class="form-group col-md-4">
        <label for="namaKlien">Nama Klien</label>
        <input type="text" class="form-control" placeholder="Nama Klien" name="namaKlien">
    </div>
    <div class="form-group col-md-4">
        <label for="alamatKlien">Alamat Klien</label>
        <textarea class="form-control" name="alamatKlien" rows="3"></textarea>
    </div>
    <div class="form-group col-md-4">
        <label for="tglMulaiKontrak">Tanggal Mulai Kontrak</label>
        <input type="text" class="form-control" name="tglMulaiKontrak" id="tglMulaiKontrak">
    </div>
    <div class="form-group col-md-4">
        <label for="tglSelesaiKontrak">Tanggal Selesai Kontrak</label>
        <input type="text" class="form-control" name="tglSelesaiKontrak" id="tglSelesaiKontrak">
    </div>
    <div class="mt-2">
        <a href="{{ route('client.index') }}" class="btn btn-warning">Kembali</a>
        <button type="submit" class="btn btn-success">Simpan</button>
    </div>
</form>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
      $('#tglMulaiKontrak').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
      });

      $('#tglSelesaiKontrak').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
      });
    })
</script>
@endsection
