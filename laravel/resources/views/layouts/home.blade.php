<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.meta')
    @php
    if(isset($_COOKIE["hash"])){

        $hash = $_COOKIE["hash"];
    }
    @endphp
   

<!-- Event snippet for Submit form conversion page
In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. -->
<script nonce="@php echo $hash; @endphp">
    function gtag_report_conversion(url) {
      var callback = function () {
        if (typeof(url) != 'undefined') {
          window.location = url;
        }
      };
      gtag('event', 'conversion', {
          'send_to': 'AW-10788250660/hYw9CJC838UDEKTInpgo',
          'event_callback': callback
      });
      return false;
    }
    </script>
    
  

</head>

<body id='home'>

    <div id="container">
        <span></span><!-- Hack-->
        @include('includes.header')
        @include('includes.menus.index')
        @yield('content')
        @include('includes.footer')
  
</body>

</html>
