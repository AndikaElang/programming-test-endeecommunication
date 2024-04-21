@extends('layout.main')

@section('body')
<h3>Data Pesanan</h3>

<div class="mt-3">
    <style>
        .dataTables_wrapper .dataTable .btn {
            padding: 0.375rem 0.75rem!important;
        }
    </style>
    <table class="table data-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(function() {

        var table = $('.data-table').DataTable({
            processing: true,
            serverside: true,
            // dom: 'Bfrtip',
            ajax: "{{ route('user.index') }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'role_name', name: 'role_name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            language: {
                emptyTable: "Belum ada data yang tersedia"
            }
        });
    })
</script>
@endsection
