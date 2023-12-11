<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- @include('layout.link') --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Monitoring SPPD</title>
</head>

<body>

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: center;
            padding: 8px;
            border: 1px solid black;
        }

        th:first-child,
        td:first-child {
            text-align: left;
        }
    </style>
    <div class="d-flex justify-content-center " style="text-align: center;">
        <h1>MONITORING ABSENSI PERJALANAN DINAS <br> PPK PERENCANAAN DAN PROGRAM <br> TAHUN ANGGARAN {{ $year->format('Y') }}
        </h1>
    </div>
    <div class="d-flex justify-content-end">
        <h6> Bulan : {{ $year->format('M Y') }}</h6>
    </div>
    <table style="margin-left: 20px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama/Tanggal</th>
                @foreach ($dates as $date)
                    <th style="padding-right: 10px;">{{ $date->format('d') }}</th> <!-- Kolom tanggal dengan jarak -->
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td style="text-align: left;">{{ $user }}</td> <!-- Baris nama pengguna -->
                    @foreach ($dates as $date)
                        <td>
                            @foreach ($userPerjalanan as $perjalanan)
                                @php
                                    $eventStartDate = \Carbon\Carbon::parse($perjalanan->event->start_date)->format('Y-m-d');
                                    $eventEndDate = \Carbon\Carbon::parse($perjalanan->event->end_date)->format('Y-m-d');
                                    $currentDate = $date->format('Y-m-d');
                                    $userName = $perjalanan->user->name; // Mengambil nama pengguna dari relasi 'user'
                                @endphp

                                @if ($eventStartDate <= $currentDate && $eventEndDate >= $currentDate && $userName == $user)
                                    <h6> {{ $perjalanan->event->category }}<br>{{ $perjalanan->event->tujuan }}</h6>
                                    <!-- Event yang sesuai dengan tanggal dan pengguna -->
                                @endif
                            @endforeach
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3 " style="margin-left: 40px;">
        <h2 class="mb-3"> Keterangan : </h2>
        <div class="row" style="margin-left: 40px;">
            <div class="col-md-2 mt-3 mb-3">
                <h6> JKT : Jakarta</h6>
                <h6> BDG : Bandung</h6>
                <h6> SBY : Surabaya</h6>
                <h6> SMG : Semarang</h6>
                <h6> DPS : Denpasar</h6>
                <h6> BMJ : Banjarmasin</h6>
                <h6> MKS : Makasar</h6>
                <h6> YOG : Yogyakarta</h6>
                <h6> SLM : Sleman</h6>
            </div>
            <div class="col-md-2 mt-3 mb-3">
                <h6> KP : Kulonprogo</h6>
                <h6> GK : Gunung Kidul</h6>
                <h6> MGL : Magelang</h6>
                <h6> TMG : Temanggung</h6>
                <h6> PWJ : Purworejo</h6>
                <h6> KTJ : Kutoarjo</h6>
                <h6> KBM : Kebumen</h6>
                <h6> BYM : Banyumas</h6>
                <h6> WSB : Wonosobo</h6>
            </div>
            <div class="col-md-2 mt-3 mb-3">
                <h6> BJG : Banjarnegara</h6>
                <h6> PBL : Purbalingga</h6>
                <h6> CLP : Cilacap</h6>
            </div>
            <div class="col-md-3 mt-3 mb-3">
                <h6> AP : Administrasi Kegiatan PPK PP</h6>
                <h6> PK : Pemantauan Kegiatan Non Konst</h6>
                <h6> LAK : Penyusun Laporan Kinerja Balai</h6>
                <h6> MR : Penyusun Manajemen Risiko</h6>
                <h6> PEPA : Peny. & Evaluasi Progr & Anggaran</h6>
                <h6> UD : Unit Desain BBWS SO</h6>
                <h6> RPSDA : Monitoring Plaks RPSDA</h6>
                <h6> WEB : OP Website dan Pusat Data</h6>
                <h6> DAT : Invent & Penyus Database SDA</h6>
            </div>
            <div class="col-md-3 mt-3 mb-3">
                <h6> PVS : Pengumpul Foto Video SDA</h6>
                <h6> INT : Pemel. Komputer Jar Internet</h6>
                <h6> MEP : Fasilitasi Mon & Koord Pimpinan</h6>
                <h6> UPP : Unit Pelaksana Prog Balai (IPDMIP)</h6>
                <h6> PIU : PIU SIMURP</h6>
            </div>
        </div>
    </div>
</body>

</html>
