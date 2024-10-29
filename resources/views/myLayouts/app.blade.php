<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title') </title>
    <style>
        body {
            direction: rtl;
        }

        .error_message {
            color: red;
        }


        .error-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }

        .error-code {
            font-size: 6rem;
            font-weight: bold;
            color: #dc3545;
        }

        .error-message {
            font-size: 1.5rem;
            color: #6c757d;
        }



        .Message-body {
            font-size: 16px;
            display: table-cell;
            vertical-align: middle;
            padding: 30px 20px 30px 10px;
            background-color: #3f413f;
        }

        .Message-button {
            position: relative;
            margin-left: 315px;
            margin-top: 2px;
            background-color: rgba(0, 0, 0, 0.25);
            box-shadow: 0 3px rgba(171, 190, 139, 0.4);
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            font-family: "Source Sans Pro";
            color: #fff;
            outline: none;
            cursor: pointer;
        }

        .Message-button:hover {
            background-color: grey;
        }

        .Message {
            display: block;
            position: relative;
            width: 200px;
            height: 200px;
            left: calc(57% - 196px);
            top: calc(60% - 100px);
            text-align: center;
            padding: 10px;
            border-radius: 5%;
            grid-template-rows: auto 1fr auto;
            font-size: 20px;
            margin-top: 20px;
            color: #fff;
            transition: all 0.2s ease;
        }

        .Message-icon {
            display: table-cell;
            vertical-align: middle;
            width: 2px;
            padding: 20px;
            text-align: center;
            background-color: #8b8a8a;
        }

        .Message {
            left: 50%;
            top: 50%;
            position: absolute;
            margin-top: 258px;
            border-radius: 5%;
            grid-template-rows: auto 1fr auto;
            font-size: 20px;
            margin-top: 0px;
            color: #fff;
            transition: all 0.2s ease;
            transform: translate(-50%, -50%);
            z-index: 5;
        }
    </style>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    @if (session()->has('message'))
    <div class="Message" id="Message">
        <div class="Message-icon">
            <i class="fa fa-bell-o"></i>
        </div>
        <div class="Message-body">
            <p> {{ session('message') }} </p>
            <button value="Message" value="Message" onclick="Message()" class="Message-button js-messageClose">close
            </button>
        </div>
    </div>
    @endif

    @if (session()->has('errorMessage'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        @yield('success')
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script>
        function Message() {
    document.getElementById('Message').style.display = "none";
}

    </script>

</body>

</html>