<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
        <div class="footer">
            @yield('footer')
            <script>alert('hello visiter')</script>
        </div>
</body>
</html>
