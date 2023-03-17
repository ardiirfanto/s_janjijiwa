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
    {{-- @if (!isset($pre)) --}}
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
    {{-- @endif --}}

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
                        <table class="tablepre table-bordered">
                            <thead>
                                <th>NO</th>
                                <th>USERNAME</th>
                                <th>CLEANSING</th>
                                <th>CASE FOLDING</th>
                                <th>TOKENIZING</th>
                                <th>STOPWORDS</th>
                                <th>STEMMING</th>
                                <th>CLEAN DATA</th>
                            </thead>
                            <tbody>
                                @foreach ($pre['pre'] as $key => $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->username }}</td>
                                        <td style="white-space:nowrap">{{ $row->cleansing }}</td>
                                        <td style="white-space:nowrap">{{ $row->casefolding }}</td>
                                        <td>{{ $row->tokenizing }}</td>
                                        <td>{{ $row->stopwords }}</td>
                                        <td>{{ $row->stemming }}</td>
                                        <td style="white-space:nowrap">{{ $row->union }}</td>
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
        $(document).ready(function() {
            $('.tablepre').DataTable({
                "scrollX": true,
                "searching": false,
                "paging": false,
                "info": false
                // "scrollCollapse": true,
                // "columnDefs": [{
                //     "width": "20%",
                //     "targets": [1]
                // }, ],
            });
        });

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
