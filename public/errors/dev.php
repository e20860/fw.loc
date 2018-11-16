<!doctype html>
<html>
    <head>
        <title>Ошибка!!!</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Произошла ошибка</h1>
        <p><b>Код ошибки:</b><?= $errno ?></p>
        <p><b>Текст ошибки:</b><?= $errstr ?></p>
        <p><b>Файл ошибки:</b><?= $errfile ?></p>
        <p><b>Строка ошибки:</b><?= $errline ?></p>
    </body>
</html>
