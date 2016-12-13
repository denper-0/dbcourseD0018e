<html>
<head>
    <title>Omnipollo Bottle Shop | Checkout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="web/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href='http://fonts.googleapis.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="web/js/jquery1.min.js"></script>
    <!-- dropdown -->
    <script src="web/js/jquery.easydropdown.js"></script>
</head>
<body>

<div class="register_account">
    <div class="wrap">
    <?php 
    if (isset($_SESSION['email'])) {
        $sessionID = session_id();
        $query = $db->prepare("SELECT cartID, productID, quantity, userID FROM cart WHERE cartID = '$sessionID'"); //sessionID = cartID maybe needs to be more precise?
        $query->execute();
        $result = $query->fetchAll();
        $cartID = $result[0]['cartID'];
        $userID = $result[0]['userID'];

        $date = date('d/m-y G:i');
        $order = $db->prepare("INSERT INTO `order` (orderID, userID, `date`) VALUES (?,?, ?)");
        $order->execute(array($cartID, $userID, $date));


        $insertOrder = $db->prepare("INSERT INTO orderinfo (orderID, productID, quantity) VALUES (?,?,?)");        
        foreach ($result as $row){
            $cartID = $row['cartID'];
            $prod = $row['productID'];
            $quant = $row['quantity'];
            $insertOrder->execute(array($cartID, $prod, $quant));
        }
        $tempCart = $db->prepare("DELETE FROM cart WHERE userID = '$userID'");
        $tempCart->execute();

        echo "<br><br> Checkout complete!";
        session_regenerate_id(true);
        //session_destroy();

    } else {
        echo "You need to log in to checkout.";
    }
    ?>
    </div>
</div>
</body>
</html>