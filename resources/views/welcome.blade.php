<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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

    <table>
        <thead>
            <tr>
                <th></th>
                <th>Name/Tanggal</th> <!-- Kolom kosong pada baris pertama -->
                @foreach ($dates as $date)
                    <th style="padding-right: 10px;">{{ $date->format('d') }}</th> <!-- Kolom tanggal dengan jarak -->
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user }}</td> <!-- Baris nama pengguna -->
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
                                    {{ $perjalanan->event->title }}
                                    <!-- Event yang sesuai dengan tanggal dan pengguna -->
                                @endif
                            @endforeach
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>





</body>

</html>
