<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Data Alumni</title>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: white;
        }

        #customers tr:hover {
            background-color: white;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: white;
        }

        #title {
            text-align: center;
            margin: auto;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 20px;
            font-weight: bold;
            padding-bottom: 25px;
        }
        
        #date {
            font-family: Arial, Helvetica, sans-serif;
            text-align: left;
            font-size: 15px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1 id="title">{{$title}}</h1>
    <p id="date">Tanggal: {{$date}}</p>
    <table id="customers">
        <tr>
            <th>Nama</th>
            <th>Nomor Induk Mahasiswa</th>
            <th>Angkatan</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->nim}}</td>
            <td>{{$user->angkatan}}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>