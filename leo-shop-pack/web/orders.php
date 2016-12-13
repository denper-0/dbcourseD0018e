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
    <h1>Orders are sorted by date</h1>
    <hr>
    <table class="table table-striped table-hover table-bordered">
        <?php
        echo '<tbody>';
            $query2 = $db->prepare("SELECT userID FROM users where email = ?");
            $email = $_SESSION['email'];
            $query2->execute(array($email));
            $uid = $query2->fetch()[0];
            $query = $db->prepare("SELECT * FROM `order` where userID = '$uid'");
            $query->execute();
            if ($query->rowCount() != 0) {


            $query = $db->prepare("SELECT orderinfo.orderID,  `date`, userID, name, quantity, paid, shipped, price FROM orderinfo
                                LEFT JOIN `order` ON orderinfo.orderID = order.orderID LEFT JOIN products ON orderinfo.productID = products.prodID
                                WHERE order.userID = ? ORDER BY `orderID`, `date`");
            $query->execute(array($uid));
            $res = $query->fetchAll();

            $totalCost = 0;
            $shipping = 70;
            echo "<br>";
            $ordID = null;
            foreach ($res as $row){
                if ((is_null($ordID) || ($ordID == $row['orderID']))) {
                        $totalCost = $totalCost + ($row['quantity'] * $row['price']);
                    } else {
                        echo '<th>
                            <th> Total Price (shipping included)</th>
                            <td>' . ($totalCost + $shipping) . ' </td></th>';
                            $totalCost = $row['price'] * $row['quantity']; 

                    }
                if ((is_null($ordID) || ($ordID != $row['orderID']))) {
                        echo '<tr>
                            <th>Order number</th>
                            <th>Date and time</th>
                            <th>Paid</th>
                            <th>Shipped</th>
                            </tr>
                            <tr>
                        <td>' . $row['orderID'] . ' </td>
                        <td>' . $row['date'] . '</td>
                        <td>' . $row['paid'] . '</td>
                        <td>' . $row['shipped'] . '</td>
                        </tr>
                        <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        </tr>';
                    }
                    echo '<tr>
                    <td>' . $row['name'] . '</td>
                    <td> '. $row['quantity'] . ' </td>
                    <td> ' . ($row['price'] * $row['quantity']) . ' </td></tr>';
            $ordID = $row['orderID']; 
        }

        echo '<th></th>
            <th>Total Price (shipping included)</th>
            <td>' . ($totalCost + $shipping) . '</td>
        </tr>
        </tbody>'; 
        } else {
        echo 'There is no orders.';
      } 

      ?>
        </tbody>
    </table>

</div>
<hr>
<div class="clear"></div>
</body>
</html>