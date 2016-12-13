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
<html>
<body>
    <h1>Orders are displayed by time.</h1>
    <hr>
    <table class="table table-striped table-hover table-bordered">
        <?php
        if (isset($_SESSION['email'])){
        $uemail = $_SESSION['email'];
        $adminCheck = $db->prepare("SELECT admin FROM users WHERE email = '$uemail'");
        $adminCheck->execute();
        $admin = $adminCheck->fetch();
        $row = $adminCheck->rowCount();

            if ($admin['admin'] == 1) {
            $query = $db->prepare("SELECT orderID, `date`, userID, paid, shipped FROM `order` ORDER BY `date`");
            $query->execute();
            $res = $query->fetchAll();
            $row = $query->rowCount();
            if ($row == 0){
                echo "There are no orders";
            } else {
            echo '<tbody>';
                echo "<br>";
                // PRINTING ALL THAT ARE NOT SHIPPED
                for ($i = 0; $i < $row; $i++){
                    if (($res[$i]['shipped']) != "yes"){
                          echo '<tr>
                                <th>Order number</th>
                                <th>userID</th>
                                <th>Date</th>
                                <th>Paid</th>
                                <th>Shipped</th>
                                </tr>
                            <tr>
                            <td>' . $res[$i]['orderID'] . ' </td>
                            <td>' . $res[$i]['userID'] . '</td>
                            <td>' . $res[$i]['date'] . '</td>
                            <td>' . $res[$i]['paid'] . '</td>
                            <td>
                            <form action="dbstuff.php" method="post" name="">
                            <input type="text-center" align="right" class="form-control input-sm" type="" name="updateShipping" value="' . $res[$i]['shipped'] . '">
                            <input type="hidden" name="updateOrder" value="'. $res[$i]['orderID'] . '">
                            </form>
                            </td>
                    </tr>';
                    // PRINTING ALL SHIPPED
                    } else {
                        echo '<tr>
                                <th>Order number</th>
                                <th>userID</th>
                                <th>Date</th>
                                <th>Paid</th>
                                <th>Shipped</th>
                                </tr>
                            <tr>
                            <td>' . $res[$i]['orderID'] . ' </td>
                            <td>' . $res[$i]['userID'] . '</td>
                            <td>' . $res[$i]['date'] . '</td>
                            <td>' . $res[$i]['paid'] . '</td>
                            <td>' . $res[$i]['shipped'] . '</td>';
                            /*<form action="dbstuff.php" method="post" name="">
                            <input type="text-center" align="right" class="form-control input-sm" type="" name="updateShipping" value="' . $res[$i]['shipped'] . '">
                            <input type="hidden" name="updateOrder" value="'. $res[$i]['orderID'] . '">
                            </form>
                            </td>*/
                        echo '</tr>';
                        }
                    }
                }
                } else {
                    echo "You do not have access here.";
            }
            } else {
                echo "You do not have access here.";
        }

      ?>
        </tbody>
    </table>

</div>
<hr>
<div class="clear"></div>
</body>
</html>