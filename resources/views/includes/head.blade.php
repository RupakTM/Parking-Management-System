<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">

    <style type="text/css">
        /*if you want to remove some content in print display then use .no_print class on it */
        @media print {
            #datatable_wrapper .row:first-child {display:none;}
            #datatable_wrapper .row:last-child {display:none;}
            .no_print {display:none;}
        }
    </style>

    <!-- Custom css-->
    <link rel="stylesheet" href="{{asset('backend/dist/css/custom.css')}}">
{{--    <link rel="stylesheet" href="{{asset('backend/dist/css/login.css')}}">--}}
    <style>
        .parking-buttons button{
            border:1px solid black;
            margin-right: 2px;
            margin-top: 2px;
            padding: 10px 24px;
            text-align: center;
            float: left;
            text-decoration: none;
            width: 100px;
        }
        .parking-buttons button:focus{
            background-color: #218838;
        }

        button[disabled]{
            pointer-events: none;
        }

    </style>
    @yield('css')
</head>
