@extends('app')

@section('title', 'Pre-Processing')
@section('breadcumb')
    <li class="breadcrumb-item"><a href="javascript:void(0);">Pengujian</a></li>
    <li class="breadcrumb-item active">Pre-Processing</li>
@endsection
@section('content')
    {{-- Form Testing --}}
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('uji.pre.view') }}" method="post">
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
                                    <button onclick="proses('{{ route('uji.pre.proses', ['testing_id' => $testing_id]) }}')"
                                        type="button" class="btn btn-primary" style="float: right">
                                        <i class="fas fa-redo"></i>
                                        Lakukan Pre-Processing
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

    {{-- Data Pre-Processing --}}
    @if (isset($pre))
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mt-0 header-title">Data Pre-Processing</h4>
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
                                @foreach ($pre['data'] as $key => $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pre['data'][$key] }}</td>
                                        <td>{{ $pre['username'][$key] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('page-js')
    <script>
        function proses(url) {
            Swal.fire({
                title: 'Lakukan Pre-Processing?',
                text: 'Anda akan melakukan Pre-processing. Lanjutkan?',
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
