<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" media="print" href='{{ asset('../assets/css/print.css')}}' />
    <link rel="stylesheet" media="screen" href='{{ asset('../assets/css/print.css')}}' />
</head>

<body>
    <div id="container">

        @yield('content')

    </div>
</body>
</html>