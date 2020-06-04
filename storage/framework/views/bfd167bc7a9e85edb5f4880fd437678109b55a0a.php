<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <index></index>
        </div>
        
        <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    </body>
</html>
<?php /**PATH /home/casa/Documentos/laravel/desafio/resources/views/welcome.blade.php ENDPATH**/ ?>