@extends('app')

@section('title', $test->nama_testing . ' | Ambil Data Dari Twitter')
@section('breadcumb')
    <li class="breadcrumb-item"><a href="javascript:void(0);">Pengujian</a></li>
    <li class="breadcrumb-item"><a href="{{ route('uji.testing') }}">Data Testing</a></li>
    <li class="breadcrumb-item active">Ambil Data Twitter</li>
@endsection
@section('content')
    {{-- Form --}}
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('uji.testing.detail.get') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="form-label">Kata Kunci</label>
                                <input type="hidden" name="test_id" value="{{ $test->id }}">
                                <input type="text" name="keywords" id="keywords" class="form-control"
                                    placeholder="ex : Janji Jiwa" required>
                            </div>
                            <div class="form-group col-md-12 mt-2">
                                <label class="form-label">Jumlah Data</label>
                                <input type="number" value="10" name="qty" id="qty" min="10"
                                    max="100" class="form-control" placeholder="10-100" required>
                                <p style="margin: 0px;color:grey;font-size:11px">Masukan 10-100 Data</p>
                            </div>
                            <div class="form-group col-md-12 mt-2">
                                <button type="submit" class="btn btn-primary" style="float: right">Ambil Data</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <p style="color: grey">
                Pada halaman ini akan mengambil data testing dari postingan netizen pada twitter. pastikan data testing
                kosong sebelum melakukan pengambilan data dari twitter.
            </p>
        </div>
    </div>

    {{-- Data --}}
    <div class="row">
        <div class="col-md-12">
            @if (count($data) > 0)
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Data Testing</h4>
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
            @else
            <div class="alert alert-warning">
                Belum ada data diambil
            </div>
            @endif
        </div>
    </div>
@endsection
