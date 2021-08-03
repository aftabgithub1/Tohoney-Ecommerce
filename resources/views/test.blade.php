<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>body{margin: 20px 40px; font-family: Verdana}</style>
</head>
<body>
  <h4>URLs</h4>
  <p>
    env('APP_NAME') = <br>
    {{ env('APP_NAME') }}
  </p>
  <p>
    config('app.name') = <br>
    {{ config('app.name') }}
  </p>
  <p>
    env('APP_URL') = <br>
    {{ env('APP_URL') }}
  </p>
  <p>
    config('app.url') = <br>
    {{ config('app.url') }}
  </p>
  <p>
    route('test') = <br>
    {{ route('test') }}
  </p>
  <p>
    url('bla-bla') = <br>
    {{ url('bla-bla') }}
  </p>
</body>
</html>