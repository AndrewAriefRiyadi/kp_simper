<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    @vite('resources/css/navigation.css')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/23.2.3/css/dx.light.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <script type="text/javascript" src="https://cdn3.devexpress.com/jslib/23.2.3/js/dx.all.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>

    @vite('resources/js/navigation.js')
</head>

<body class=" bg-gray-200">
    <div class="demo-container">
        <div class="flex-container">
            <div id="toolbar"></div>
            <div id="drawer">
                <div id="content" class="font-sans">
                    @yield('content')
                </div>
            </div>  
        </div>
    </div>      
</body>
<script>
    var userName = "{{ Auth::user()->name }}";
    var userId = "{{ Auth::user()->id }}";
    var userIsAVP = "{{Auth::user()->hasRole('avp')}}";
    var userIsVP= "{{Auth::user()->hasRole('vp')}}";
</script>
</html>
