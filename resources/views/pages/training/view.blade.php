@extends('app')

@section('title', 'Pengelolaan Data Training')
@section('breadcumb')
    <li class="breadcrumb-item"><a href="javascript:void(0);">Kelola Data</a></li>
    <li class="breadcrumb-item active">Data Training</li>
@endsection
@section('content')
    {{-- Form Tambah Data --}}
    <div class="row">
        {{-- Tambah Satuan --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Tambah Data Satuan</h4>
                    <hr>
                    <form action="{{ route('data.training.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Kalimat</label>
                                <textarea name="kalimat" placeholder="Masukan Kalimat" rows="2" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kategori</label>
                                <select name="kategori" class="form-control">
                                    <option value="Positif">Positif</option>
                                    <option value="Negatif">Negatif</option>
                                    <option value="Netral">Netral</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary btn-sm mt-2" style="float: right"
                                    type="submit">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Import Excel --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Import Excel</h4>
                    <hr>
                    <form action="{{ route('data.training.import') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-7">
                                <input type="file" name="file" accept=".csv,.xls,.xlsx" class="form-control" required>
                                <p style="margin: 0px;color:crimson;font-size:11px">*Format .csv,.xls,.xlsx (Max 2MB)</p>
                            </div>
                            <div class="col-md-5">
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-file-excel"></i>
                                    Import
                                </button>
                            </div>
                            <div class="col-md-12 mt-3">
                                <a href="{{ asset('docs/template/template_data_training.xlsx') }}" class="btn btn-outline-success btn-sm">
                                    <i class="fa fa-file-excel"></i>
                                    Unduh Template
                                </a>
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
                    <table class="table table-bordered dt-responsive nowrap">
                        <thead>
                            <th width="10%">NO</th>
                            <th>KALIMAT</th>
                            <th>KATEGORI</th>
                            <th>AKSI</th>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->kalimat }}</td>
                                    <td>{{ $row->kategori }}</td>
                                    <td>
                                        <button type="button"
                                            onclick="deleteData('{{ route('data.training.delete', ['id' => $row->id]) }}')"
                                            class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
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
                text: 'Data Training akan Terhapus. Lanjutkan?',
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
    </script>
@endpush
