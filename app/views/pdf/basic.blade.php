<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <link rel="stylesheet" href="{{asset('css/bootstrap-email.css')}}">
    <!-- Latest compiled and minified CSS & JS -->
    <style type="text/css" media="screen">
        body
        {
            font-family: 'Helvetica Neue';
            font-size: 14px;
            font-weight: 12px;
        }
    </style>
</head>

<body>
<?php
$contenido = renderVariables($contenido);
?>
{{ str_replace("<p>&nbsp;</p>","<br>",$contenido) }}
<br>

</body>
</html>
