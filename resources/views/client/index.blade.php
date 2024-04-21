@extends('layout.main')

@section('body')
<h3>Data Klien</h3>

<div class="mt-3">
    <div class="row">
        <div class="d-flex justify-content-between">
            <div class="p-2">
                @if (Auth::user()->id_role == 1 || Auth::user()->id_role == 2)
                    <a href="{{ route('client.tambahdata') }}" class="btn btn-primary"><b>+</b>Tambah Klien</a>
                @endif
            </div>
            {{-- <div class="p-2">
                <a href="#" class="btn btn-danger btn-sm">
                    Unduh
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
                    </svg>
                </a>
            </div> --}}
        </div>
    </div>
</div>

<div class="mt-3">
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <ul>
            <li>{{ session('error') }}</li>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <style>
        .dataTables_wrapper .dataTable .btn {
            padding: 0.375rem 0.75rem!important;
        }
    </style>
    <table class="table data-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Klien</th>
                <th>Alamat Klien</th>
                <th>Tanggal Mulai Kontrak</th>
                <th>Tanggal Berakhir Kontrak</th>
                @if (Auth::user()->id_role == 1 || Auth::user()->id_role == 2)
                    <th>Aksi</th>
                @endif
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
            ajax: "{{ route('client.index') }}",
            columns: [
                {data: 'row_number', name: 'row_number'},
                {data: 'client_name', name: 'client_name'},
                {data: 'client_address', name: 'client_address'},
                {data: 'contract_start_date', name: 'contract_start_date'},
                {data: 'contract_end_date', name: 'contract_end_date'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            language: {
                emptyTable: "Belum ada data yang tersedia"
            }
        });
    })
</script>
@endsection
