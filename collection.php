<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
    <title>Title</title>
    <link rel='stylesheet' href='normalize.css'/>
</head>
<body>
    <form method='POST'>
        <input name='name' type='text'/>
        <input name='genre' type='text'/>
        <input name='length' type='text'/>
        <input name='price' type='text'/>
        <input type='submit'/>
    </form>
    <?php
        require_once('add_item_form.php');
    ?>
</body>
</html>