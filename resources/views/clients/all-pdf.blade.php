<!DOCTYPE html>
<html>
<head>
    <title>Liste de tous les clients</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .client-list {
            margin-top: 20px;
            border-collapse: collapse;
            width: 100%;
        }
        .client-list th,
        .client-list td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        .client-list th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Liste de tous les clients</h1>

    <table class="client-list">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Adresse</th>
                <th>Téléphone</th>
                <th>Genre</th>



            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
            <tr>
                <td>{{ $client->nom }}</td>
                <td>{{ $client->prenom }}</td>
                <td>{{ $client->adresse }}</td>
                <td>{{ $client->telephone }}</td>
                <td>{{ $client->sexe }}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
