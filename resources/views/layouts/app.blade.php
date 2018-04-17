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
        body {
            margin: 0;
            padding: 0;
        }
        main {
            max-width: 1000px;
            margin: 0 auto;
            padding: 1em;
        }

        header {
            background-color: #334551;
            color: white;
        }

        header a {
            color: white;
        }

        header a:hover {
            color: lightskyblue;
            text-decoration: none;
        }

        header img {
            margin: 1em;
            max-width: 100px;
        }

        header .toplinks a {
            margin: 1em;
        }

        .sorter:hover {
            cursor: pointer;
            background-color: lightskyblue;
        }

    </style>

</head>
<body>
    <div id="app">
        <header class='d-flex justify-content-between align-items-center'>
            <img src='/images/bcm_logo.png' alt='Breeze logo'/>
            <div class='toplinks d-inline-block mr-3'>
                <a href='people'>People</a>
                <a href='groups'>Groups</a>
            </div>
        </header>
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

        $('#search').on('keyup', function() {
            $.ajax({
                url: '/command/searchdb',
                method: 'post',
                dataType: 'html',
                data: { search: $('#search').attr('data-db'), value: $('#search').val() },
                beforeSend: function() {
                    //console.log('presend');
                },
                complete: function(response) {
                    $('#fillable').html(response.responseText);
                }
            });
        });

        $('.sorter').on('click', function(){
            var sorter = $(this);
            var sortorder = 'asc';

            //handle sort reversing
            if(sorter.hasClass('reverse')) {
                sorter.removeClass('reverse');
                sortorder = 'desc';
            }
            else sorter.addClass('reverse');

            $.ajax({
                url: '/command/searchdb',
                method: 'post',
                dataType: 'html',
                data: { search: $('#search').attr('data-db'), orderedby: sorter.attr('data-orderby'), sortorder: sortorder, value: $('#search').val() },
                beforeSend: function() {
                    console.log('wahtever')
                    console.log($('#search').attr('data-db') + '!');
                },
                complete: function(response) {
                    $('#fillable').html(response.responseText);
                }
            });
        });
    </script>

</body>
</html>
