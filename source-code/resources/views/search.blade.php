

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <x-navbar />
    {{ $phrase }}
    <br>
    
    @foreach ($guitars as $guitar)
        {{ $guitar }}
        <br>
    @endforeach
    
    <div class="w-48 mt-4 mx-auto">
        {{ $guitars->appends(['phrase' => $phrase])->links() }}
    </div>
</body>
</html>
