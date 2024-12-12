<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Patronato Gaglio</title>

    <!-- BulmaCSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
         --bulma-primary: red;
         --bulma-size-medium: 0.5rem;
       }

       .button {
         background-color: red;
       }
       .fit-picture {
    content:url(URL::asset('/image/logo.png'));
}
     </style>
</head>

<body class="">

    {{ $slot }}

</body>

</html>
