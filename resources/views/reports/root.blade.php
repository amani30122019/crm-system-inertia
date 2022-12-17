<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title')</title>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th {
                background-color: #ddd4d4;
                text-transform: uppercase;
            }

            th,
            td {
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            .report-header {
                margin-bottom: 25px;
                text-align: center;
                font-size: 56px;
                font-weight: bold;
            }

            footer {
                width: 100%;
                position: fixed;
                bottom: -62px;
                right: 0px;
                left: 0px;
                height: 100px;
                color: 000;
                text-align: right;
                line-height: 35px;
                border-top: 1px solid #000;
                font-size: 12px;
            }

            hr.header {
                border: 2px dashed black;
            }
        </style>
    </head>

    <body>
        @include('reports.partials.header')
        @yield('content')
        @include('reports.partials.footer')
    </body>

</html>