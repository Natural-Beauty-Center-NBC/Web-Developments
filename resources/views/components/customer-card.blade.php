<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NBC Membership Card</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f3f4f6;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .card {
            width: 500px;
            height: 300px;
            background-color: #ffffff;
            padding: 16px;
            border: 2px solid black;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }

        .flex-center {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        /* Cannot be centered */
        .logo { 
            width: 400px;
            justify-content: center;
            align-items: center;
            margin-bottom: 8px;
            margin: 0 auto;
        }

        .text-center {
            text-align: center;
        }

        .text-xs {
            font-size: 0.75rem;
        }

        .text-3xl {
            font-size: 1.875rem;
            font-weight: bold;
            margin: 16px 0;
        }

        .card-holder-info {
            position: absolute;
            bottom: 70px;
            left: 16px;
        }

        .text-md {
            font-size: 1rem;
        }

        .font-semibold {
            font-weight: 600;
        }

        .absolute {
            position: absolute;
        }

        .bottom-4 {
            bottom: 16px;
        }

        .left-4 {
            left: 16px;
        }

        .right-4 {
            right: 16px;
        }

        .font-bold {
            font-weight: bold;
        }

        .text-lg {
            font-size: 1.125rem;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="flex-center">
            <img src="{{ public_path('assets/nbc_logo_full.png') }}" alt="NBC Logo" class="logo">
            <div class="text-center text-xs">
                <p>Jl. Babarsari No. 43 Yogyakarta 55281</p>
                <p>Telp. (0274) 487711</p>
            </div>
        </div>
        <div class="text-center text-3xl">
            {{ chunk_split($user->id_customer, 4, ' ') }}
        </div>
        <div class="card-holder-info">
            <div class="text-sm">Card Holder Since</div>
            <div class="text-md font-semibold">{{ $user->created_at->format('m') }}/{{ $user->created_at->format('y') }}</div>
        </div>
        <div class="absolute bottom-4 left-4">
            <p class="font-bold text-lg">{{ $user->nama }}</p>
        </div>
        <div class="absolute bottom-4 right-4 text-xs">
            Your NBC Card has no expiration date
        </div>
    </div>
</body>

</html>