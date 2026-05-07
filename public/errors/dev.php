<?php
/**
*$errno \shop\ErrorHandler
*$errstr \shop\ErrorHandler
*$errfile \shop\ErrorHandler
*$errline \shop\ErrorHandler
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Ошибка</title>
</head>
<body>
   <h1>Произошла ошибка!</h1>
   <p>Код ошибки: <?=$errno ?></p>
   <p>Текст ошибки: <?=$errstr ?></p>
   <p>Файл ошибки: <?=$errfile ?></p>
   <p>Строка ошибки: <?=$errline ?></p>
</body>
</html>