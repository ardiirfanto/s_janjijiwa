@extends('app')

@section('title', 'Pengelolaan Data Kata Yang Dihilangkan')
@section('breadcumb')
    <li class="breadcrumb-item"><a href="javascript:void(0);">Kelola Data</a></li>
    <li class="breadcrumb-item active">Kata Dihilangkan</li>
@endsection

@section('content')
    <div class="row">
        {{-- Form --}}
        <div class="col-md-6">
            <form action="{{ route('data.stopwords.store') }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Tambah Data</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-7 mt-2">
                                <input name="kata" type="text" class="form-control"
                                    placeholder="Masukan Kata Yang Dihilangkan" required>
                            </div>
                            <div class="col-md-3 mt-2">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Data Kata Yang Dihilangkan</h4>
                    <br>
                    <table class="table table-bordered">
                        <thead>
                            <th width="10%">NO</th>
                            <th>KATA</th>
                            <th>AKSI</th>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->kata }}</td>
                                    <td>
                                        <button type="button" onclick="deleteData('{{ route('data.stopwords.delete', ['id' => $row->id]) }}')"
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
                text: 'Data Kata Yang Dihilangkan akan Terhapus. Lanjutkan?',
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
