@extends('layout.main')

@section('body')
<h3>Edit Klien</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('client.updatedata', ['client' => $client]) }}" method="POST">
    @csrf
    @method('put')
    <div class="form-group col-md-4">
        <label for="namaKabupaten">Nama Klien</label>
        <input type="text" class="form-control" placeholder="Nama Klien" name="namaKlien" value="{{ $client->client_name }}">
    </div>
    <div class="form-group col-md-4">
        <label for="alamatKlien">Alamat Klien</label>
        <textarea class="form-control" name="alamatKlien" rows="3" >{{ $client->client_address }}</textarea>
    </div>
    <div class="form-group col-md-4">
        <label for="tglMulaiKontrak">Tanggal Mulai Kontrak</label>
        <input type="text" class="form-control" name="tglMulaiKontrak" id="tglMulaiKontrak" value="{{ $client->contract_start_date }}">
    </div>
    <div class="form-group col-md-4">
        <label for="tglSelesaiKontrak">Tanggal Selesai Kontrak</label>
        <input type="text" class="form-control" name="tglSelesaiKontrak" id="tglSelesaiKontrak" value="{{ $client->contract_end_date }}">
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
