<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Leads Dashboard</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
    </head>
    <body>
        <div class="container text-center vh-100 py-auto">
            <h1 class="pt-4">Leads Management System</h1>
            <p>Filter &amp; download leads data</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        </div>
        <footer class="text-center align-bottom" style="margin-top:-40px">
            &copy; iVistaz Ecomm Services Pvt Ltd <?php echo date('Y'); ?>. All rights reserved.
        </footer>
    </body>
</html>
