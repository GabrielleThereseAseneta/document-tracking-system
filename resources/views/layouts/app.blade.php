<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="{{ asset('output.css') }}" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f4f7f9; color: #333; }
        .hero {
            background-image: url('{{ asset('images/your-background-image.png') }}'); /* Replace with your image */
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 100px 20px;
            position: relative;
        }
        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 123, 255, 0.7);
        }
        .hero > * { position: relative; z-index: 1; }
        .hero h1 { font-size: 3em; margin-bottom: 20px; }
        .hero p { font-size: 1.2em; margin-bottom: 30px; }
        .cta-button { display: inline-block; padding: 15px 30px; background-color: white; color: #007bff; text-decoration: none; border-radius: 5px; font-size: 1.1em; transition: background-color 0.3s; }
        .cta-button:hover { background-color: #e0e0e0; }
        .feature i { font-size: 3em; color: #007bff; margin-bottom: 15px; }
        footer { text-align: center; padding: 20px; background-color: #333; color: white; }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
