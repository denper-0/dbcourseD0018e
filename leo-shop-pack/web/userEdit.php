<html>
<head>
    <title>Omnipollo Bottle Shop | Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="web/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href='http://fonts.googleapis.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="web/js/jquery1.min.js"></script>
    <script src="web/js/jquery.easydropdown.js"></script>
</head>
<body>
<div class="register_account">
    <div class="wrap">
        <h4 class="title">Edit your account</h4>
        <form action="dbstuff.php" method="post">
            <div class="col_1_of_2 span_1_of_2">
                <?php
                $email = $_SESSION['email'];
                $query = $db->prepare("SELECT * FROM users WHERE email = (?)");
                $query->execute(array($email));
                $values = $query->fetch();
                //echo $values['email'];
                echo "First name";
                echo '<div><input type="text" value="' . $values['firstname'] . '" name="firstname"></div>
                Last name
                <div> <input type="text" value="' . $values['lastname'] . '" name="lastname"></div>
                Password
                <div><input type="password" value="" name="password"></div>
                New password
                <div><input type="password" value="" name="newpw"></div>
                <div><input type="text" value="" name="newpw2"></div>
            </div>
            <div class="col_1_of_2 span_1_of_2">
                Adress
                <div><input type="text" value="' . $values['address'] . '" name="address"></div>
                Country
                <div><input type="text" value="' . $values['country'] . '" name="country"></div>
                City
                <div><input type="text" value="' . $values['city'] . '" name="city"></div>
                <div>
            </div>
                Phone Number
                <div><input type="text" value="' . $values['phone'] . '" name="phone"></div>
            </div>'; ?>
            <!--<input type="Submit" name="register" value="register">-->
            <button class="grey" name="userEdit">Submit</button>
            <!--<p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>-->
            </form>
            <div class="clear"></div>
        </form>
    </div>
</div>
</body>
</html>