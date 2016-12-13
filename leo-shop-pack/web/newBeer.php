<html>
<head>
    <title>Omnipollo Bottle Shop | Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css"
          integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
    <link href="web/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="web/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="web/css/form.css" rel="stylesheet" type="text/css" media="all"/>
    <link href='http://fonts.googleapis.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js"
            integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK"
            crossorigin="anonymous"></script>


</head>
<body>
<div class="container">
    <h1>Add new beer</h1>
    <hr>
    <table class="table table-striped table-hover table-bordered">
        <?php
        echo 'On style we have <br><br>
            0: IPAs <br>
            1: Stout/Porter <br>';
         echo '<form action="dbstuff.php" method="post">
        <tr>
            <th>Name</th>
            <tr><td><input type="text" name="beerName" value=""></td></tr>
            <th>Style</th>
             <tr><td><input type="text" name="style" value=""></td></tr>
            <th>brewery</th>
             <tr><td><input type="text" name="brewery" value=""></td></tr>
            <th>percentage</th>
             <tr><td><input type="text" name="percentage" value=""></td></tr>
            <th>description</th>
             <tr><td><input type="text" name="description" value=""></td></tr>
            <th>picpath</th>
             <tr><td><input type="text" name="picpath" value=""></td></tr>
            <th>price</th>
             <tr><td><input type="text" name="price" value=""></td></tr>
            <th>stock</th>
             <tr><td><input type="text" name="stock" value=""></td></tr>
        </tr>
    </table>
                <input type="submit" name="addBeer" value="add" title="">
                </form>


</div>
<hr>
<div class="clear"></div>
</body>
</html>';
?>