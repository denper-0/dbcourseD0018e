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
    <h1>Shopping Cart</h1>
    <hr>
    <table class="table table-striped table-hover table-bordered">
        <?php
        if ($query->rowCount() != 0) {
            $sessionID = session_id();
        echo '<tbody>
        <tr>
            <th></th>
            <th>Item</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Total Price</th>
        </tr>';

            $query = $db->prepare("SELECT prodID, name, picpath, price, quantity FROM products
                                JOIN cart ON cart.productID = products.prodID
                                WHERE cart.cartID = '$sessionID'"); //Need to change 2 so it becomes dynamic.


            $query2 = $db->prepare("SELECT * FROM cart where cart.cartID = '$sessionID'");
            $query->execute();
            $query2->execute();
            $row = $query2->rowCount();
            $res = $query->fetchAll();
            $num;
            $totalCost = 0;
            $shipping = 70;
            for ($i = 0; $i < $row; $i++){
                $amount = $res[$i]['quantity'];
                echo '<tr>
                <td>
                    <center>
                    <img src="' . $res[$i]['picpath'] . '" height=90px width=70px>
                    </center>
                </td>
                <td>' . $res[$i]['name'] . '</td>
                <td>
                    <div class="col-xs-3 pull-right">
                    <form action="dbstuff.php" method="post" name="">
                        <input type="text-center" align="right" class="form-control input-sm" type="'. $res[$i]['quantity'] . '" name="quantity" value="' .$amount . '" maxlength="3">
                        <input type="hidden" name="update" value="'. $res[$i]['prodID'] . '">
                        </form>
                    <form action="dbstuff.php" method="post" name="remove">
                        <!--<input type="submit" class="pull-right btn btn-primary" value="remove">-->
                        <input type="submit" value="remove" title="">
                        <input type="hidden" name="removeBeer" value="'. $res[$i]['prodID'] . '">
                    </form>
                    </div>
                </td>
                <td> '. $res[$i]['price'] . ' </td>
                <td> ' . ($res[$i]['quantity'] * $res[$i]['price']) . ' </td>
        </tr>'; 
    }
        for ($i = 0; $i < $row; $i++){
            $totalCost = $totalCost + ($res[$i]['quantity'] * $res[$i]['price']); 

        }
        echo '<tr>
            <th colspan="3"><span class="pull-right"></span></th>
            <th>Shipping</th>
            <th>' . ($shipping) . ' kr </th>
        </tr>
        <tr>
            <th colspan="3"><span class="pull-right"></span></th>
            <th>Total</th>
            
            <th>'; 
        if ($totalCost != 0) {
                echo ($totalCost  + $shipping) . ' kr</th>';
        } else {
                echo $totalCost;
            };
        echo '</tr> 
        <tr>
            <!--<td colspan="4"><a href="index.html" class="btn btn-primary">Continue Shopping</a></td>-->
            <td colspan="4">
            <div class="btn_form">
                <form action="index.php" method="post">
                    <input type="submit" name="Continue shopping" value="Continue shopping" title="">
                </form>
                </div>
            </td>
            <!--<td><a href="checkout.php?id=checkout" class="pull-right btn btn-success">Checkout</a></td>-->
            <td>
            <div class="btn_form">
                <form action="dbstuff.php" method="post">
                    <input type="submit" value="Checkout" title="">
                    <input type="hidden" name="checkoutCart" value="checkout">
                </form>
                </div>
            </td>
            
        </tr>'; 
      } else {
        echo 'Your Shopping Cart is empty.';
      } 

      ?>
        </tbody>
    </table>

</div>
<hr>
<div class="clear"></div>
</body>
</html>