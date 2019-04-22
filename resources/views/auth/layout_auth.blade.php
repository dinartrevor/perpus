<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- icon -->

    <!-- Font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/css/nunito-font.css') }}">
    <!-- Main Style Css -->
    <link rel="stylesheet" href="{{ asset ('template/css/style.css') }}"/>
  </head>
  <body class="form-v6">
    <div class="page-content">
      <div class="form-v6-content">
        <div class="form-left">
          <img src="{{ asset('/img/5.png') }}" alt="form">
        </div>
        @yield('content')

      </div>
    </div>
  </body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
