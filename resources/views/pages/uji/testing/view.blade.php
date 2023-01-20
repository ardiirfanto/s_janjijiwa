@extends('app')

@section('title', 'Kelola Data Testing')
@section('breadcumb')
    <li class="breadcrumb-item"><a href="javascript:void(0);">Pengujian</a></li>
    <li class="breadcrumb-item active">Data Testing</li>
@endsection
@section('content')
    {{-- Form Tambah Data --}}
    <div class="row">
        {{-- Tambah Satuan --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Tambah Data</h4>
                    <hr>
                    <form id="form" action="{{ route('uji.testing.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Nama Testing</label>
                                <input type="hidden" name="id" id="id">
                                <input type="text" name="nama" id="nama" class="form-control"
                                    placeholder="Masukan Nama Testing" required>
                            </div>
                            <div class="col-md-12">
                                <button id="button" class="btn btn-primary btn-sm mt-2" style="float: right"
                                    type="submit">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- List Data --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Data Training</h4>
                    <br>
                    <table class="table table-bordered">
                        <thead>
                            <th width="10%">NO</th>
                            <th>NAMA TESTING</th>
                            <th>TANGGAL</th>
                            <th>JUMLAH DATA</th>
                            <th>AKSI</th>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->nama_testing }}</td>
                                    <td>{{ $row->tgl_testing }}</td>
                                    <td>
                                        @if (count($row->data) > 0)
                                            <div class="badge badge-primary">{{ count($row->data) }} Data</div>
                                        @else
                                            <div class="badge badge-danger">Belum ada data</div>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button"
                                            onclick="deleteData('{{ route('uji.testing.delete', ['id' => $row->id]) }}')"
                                            class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <button type="button"
                                            onclick="editData('{{ $row->id }}','{{ $row->nama_testing }}','{{ route('uji.testing.update') }}')"
                                            class="btn btn-info btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <a href="{{ route('uji.testing.detail.view',['testing_id' => $row->id]) }}" class="btn btn-sm btn-success">
                                            Detil
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page-js')
    <script>
        function deleteData(url) {
            Swal.fire({
                title: 'Menghapus Data',
                text: 'Testing akan Terhapus. Lanjutkan?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batalkan'
            }).then((res) => {
                if (res.isConfirmed) {
                    window.location.href = url;
                }
            })
        }

        function editData(id, nama, action) {
            $('#id').val(id)
            $('#nama').val(nama)
            $('#button').html("Ubah Data")
            $('#form').attr('action', action)
        }
    </script>
@endpush
