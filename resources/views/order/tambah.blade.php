@extends('layout.main')

@section('body')
<h3>Tambah Pesanan</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('order.simpandata') }}" method="POST">
    @csrf
    <div class="form-group col-md-4">
        <label for="namaKlien">Nama Klien</label>
        <select name="namaKlien" class="form-control select2">
            <option value="">=== Nama Klien ===</option>
            @foreach ($clients as $client)
                <option value="{{ $client->id_client }}">{{ $client->client_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="namaItem">Nama Item</label>
        <input type="text" class="form-control" name="namaItem" placeholder="Nama Item">
    </div>
    <div class="form-group col-md-4">
        <label for="hargaItem">Harga Item</label>
        <input type="number" class="form-control" name="hargaItem" step="0.01" min="0" placeholder="Harga Item">
    </div>
    <div class="mt-2">
        <a href="{{ route('order.index') }}" class="btn btn-warning">Kembali</a>
        <button type="submit" class="btn btn-success">Simpan</button>
    </div>
</form>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection
