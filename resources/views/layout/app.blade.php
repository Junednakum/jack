<!DOCTYPE html>
<html lang="en">
  @include('layout.head')
  <meta name="csrf-token" content="{{ csrf_token() }}">
<body>

@yield('content')

</body>
</html>    