@extends('app')

@section('title', 'Hasil Pengujian')
@section('breadcumb')
    <li class="breadcrumb-item"><a href="javascript:void(0);">Pengujian</a></li>
    <li class="breadcrumb-item">
        <a href="{{ route('uji.proses') }}">Proses
            Pengujian
        </a>
    </li>
    <li class="breadcrumb-item active">Hasil Pengujian</li>
@endsection
@section('content')
    {{-- Grafik --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mt-0 header-title">Grafik Hasil Pengujian | {{ $testing->nama_testing }}</h4>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <canvas id="chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mt-0 header-title">Tabel Hasil Pengujian | {{ $testing->nama_testing }}</h4>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('uji.proses.export', ['testing_id' => $testing->id]) }}" type="button"
                                class="btn btn-success" style="float: right">
                                <i class="fas fa-file-excel"></i>
                                Export Excel
                            </a>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                            <th width="10%">NO</th>
                            <th>USERNAME TWITTER</th>
                            <th>KALIMAT ASLI</th>
                            <th>KALIMAT PRE-PROCESSING</th>
                            <th>KATEGORI</th>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->username_twitter }}</td>
                                    <td>{{ $row->post }}</td>
                                    <td>{{ $row->kalimat }}</td>
                                    <td>
                                        @if ($row->kategori == 'Positif')
                                            <div class="badge badge-success">
                                                {{ $row->kategori }}
                                            </div>
                                        @elseif($row->kategori == 'Negatif')
                                            <div class="badge badge-danger">
                                                {{ $row->kategori }}
                                            </div>
                                        @else
                                            <div class="badge badge-info">
                                                {{ $row->kategori }}
                                            </div>
                                        @endif
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
        var pieChart = {
            labels: [
                "Positif",
                "Negatif",
                "Netral"
            ],
            datasets: [{
                data: [{{ $positif }}, {{ $negatif }},{{ $netral }}],
                backgroundColor: [
                    "#02AC7B",
                    "#FC3B3B",
                    "#40BDFA"
                ],
                hoverBackgroundColor: [
                    "#02AC7B",
                    "#FC3B3B",
                    "#40BDFA"
                ],
                hoverBorderColor: "#fff"
            }]
        };
        var chart = new Chart($("#chart"), {
            type: "pie",
            data: pieChart
        });
    </script>
@endpush
