@extends('layout.main')

@section('body')
<h3>Edit User</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('user.updatedata', ['user' => $user]) }}" method="POST">
    @csrf
    @method('put')
    <div class="form-group col-md-4">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" name="nama" placeholder="Nama" value="{{ $user->name }}">
    </div>
    <div class="form-group col-md-4">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" step="0.01" min="0" placeholder="email " value="{{ $user->email }}">
    </div>
    <div class="form-group col-md-4">
        <label for="role">Nama Klien</label>
        <select name="role" class="form-control select2">
            <option value="">=== Nama Klien ===</option>
            @foreach ($roles as $role)
                <option value="{{ $role->id_role }}" {{ $role->id_role == $user->id_role ? 'selected' : '' }}>{{ $role->role_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mt-2">
        <a href="{{ route('user.index') }}" class="btn btn-warning">Kembali</a>
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
