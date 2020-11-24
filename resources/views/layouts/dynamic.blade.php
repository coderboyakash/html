<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} | Dashboard</title>
    @yield('stylesheets')
  </head>
  <body>
    @yield('content')
    @yield('scripts')
  </body>
</html>