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
    <h1>Restock storage</h1>
    <hr>
    <table class="table table-striped table-hover table-bordered">
        <?php
        echo '<tr>
            <th></th>
            <th>Item</th>
            <th>Left in storage</th>
            <th>Update with</th>
        </tr>';

            $query = $db->prepare("SELECT prodID,  name, picpath, stock FROM products");
            $query->execute();
            $res = $query->fetchAll();
            $row = $query->rowCount();
            $amount = "";
            for ($i = 0; $i < $row; $i++){
                echo '<tr>
                <td>
                    <center>
                    <img src="' . $res[$i]['picpath'] . '" height=90px width=70px>
                    </center>
                </td>
                <td>' . $res[$i]['name'] . '</td>
                <td> '. $res[$i]['stock'] . ' </td>
                <td>
                    <form action="dbstuff.php" method="post" name="">
                    <input type="text-center" align="right" class="form-control input-sm" name="stock" value="'. $amount . '" maxlength="3">
                    <input type="hidden" name="restockID" value="'. $res[$i]['prodID'] . '">
                    </form>
                </td>
        </tr>'; 
    }
      ?>
        </tbody>
    </table>

</div>
<hr>
<div class="clear"></div>
</body>
</html>