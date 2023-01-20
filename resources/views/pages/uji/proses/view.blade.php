@extends('app')

@section('title', 'Proses Pengujian')
@section('breadcumb')
    <li class="breadcrumb-item"><a href="javascript:void(0);">Pengujian</a></li>
    <li class="breadcrumb-item active">Proses Pengujian</li>
@endsection
@section('content')
    {{-- Form Testing --}}
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('uji.proses.view') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Pilih Testing</label>
                        <select name="testing" class="form-control">
                            @foreach ($testing as $tes)
                                <option value="{{ $tes->id }}">{{ $tes->nama_testing }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3" style="margin-top:28px">
                        <button type="submit" class="btn btn-primary">Tampilkan Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Data Testing --}}
    @if ($data != null)
        @if (count($data) <= 0)
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="alert alert-warning">
                        Data Testing belum ada
                    </div>
                </div>
            </div>
        @else
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mt-0 header-title">Data Testing dari Twitter</h4>
                                </div>
                                <div class="col-md-6">
                                    <button
                                        onclick="proses('{{ route('uji.proses.proses', ['testing_id' => $testing_id]) }}')"
                                        type="button" class="btn btn-primary" style="float: right">
                                        <i class="fas fa-redo"></i>
                                        Proses Klasifikasi
                                    </button>
                                </div>
                            </div>
                            <hr>
                            <table class="table table-bordered">
                                <thead>
                                    <th width="10%">NO</th>
                                    <th>POSTINGAN</th>
                                    <th>USERNAME TWITTER</th>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->post }}</td>
                                            <td>{{ $row->username_twitter }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
@endsection

@push('page-js')
    <script>
        function proses(url) {
            Swal.fire({
                title: 'Memproses Klasifikasi Naive Bayes',
                text: 'Anda akan melakukan proses klasifikasi Naive Bayes. Lanjutkan?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Proses',
                cancelButtonText: 'Batalkan'
            }).then((res) => {
                if (res.isConfirmed) {
                    window.location.href = url;
                }
            })
        }
    </script>
@endpush
