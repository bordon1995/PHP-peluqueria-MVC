<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Document</title>
</head>

<body>
    <div class="container">

        <div class="img"></div>

        <div class="section">
            <?php echo $contenido ?>
        </div>
    </div>

    <?php
    echo $script ?? '';
    ?>
</body>

</html>