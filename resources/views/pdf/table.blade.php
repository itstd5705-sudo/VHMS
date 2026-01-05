<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'cairo', sans-serif; direction: rtl; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; text-align: right; }
        th { background: #eee; }
    </style>
</head>
<body>
<table>
    <thead>
        <tr>
            @foreach($columns as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
            <tr>
                @foreach($fields as $field)
                    <td>{{ data_get($record, $field) }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
