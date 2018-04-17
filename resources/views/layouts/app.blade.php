<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Breeze Challenge</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        main {
            max-width: 1000px;
            margin: 0 auto;
        }

    </style>

</head>
<body>
    <div id="app">
        <header></header>
        <nav></nav>
        <main class="p-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>

    <script>
        $('#fileinputfacade').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            $('#fileinput').click();
        });

        $('#fileinput').val('');

        $('#fileinput').on('change', function() {
            $('#fileform').submit();
        });
    </script>

</body>
</html>