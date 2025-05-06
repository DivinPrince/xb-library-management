<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */
            
        </style>
    @endif
    
    <!-- Print Styles -->
    <style>
        @media print {
            .no-print, button, select, form button, nav a, .reports-nav button {
                display: none !important;
            }
            
            body {
                padding: 20px;
                font-size: 14px;
                background-color: white;
            }
            
            table {
                border-collapse: collapse;
                width: 100%;
            }
            
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            
            h2, h3 {
                margin-top: 20px;
                margin-bottom: 10px;
            }
            
            .print-only {
                display: block;
            }
            
            @page {
                size: auto;
                margin: 0.5cm;
            }
        }
        
        .print-only {
            display: none;
        }
    </style>
</head>

<body class="p-4">
    @if ($errors->any())
        <div class="text-center text-red-600 font-bold">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{ $slot }}
</body>

</html>