<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tes Upload</title>
</head>
<body>
<form action="/upload-attachment" enctype="multipart/form-data" method="POST">
    <input type="hidden" value="{{ csrf_token() }}" name="_token">
    <input name="filw[]" type="file" multiple>
    <button type="submit">ayooooo</button>
</form>
</body>
</html>
