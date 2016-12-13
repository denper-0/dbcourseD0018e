<div class="header-top">
    <div class="wrap">

        <div class="cssmenu">
            <ul>
            <?php if (!isset($_SESSION['email'])) {
                echo '<li class="active"><a href="login.php">Account</a></li>';
                //|
                }
                ?>
                <li><a href="cart.php">Checkout</a></li>
                <?php if (isset($_SESSION['email'])) {
                    echo '|';
                    if ($_SESSION['admin'] == 1) {
                        echo '<li><a href="admin.php">View orders</a></li>';
                        echo '|';
                        echo '<li><a href="restock.php">Restock beer</a></li>';
                        echo '|';
                         echo '<li><a href="newBeer.php">Add new beer</a></li>';
                        echo '|';
                    } else {
                        echo '<li><a href="userEdit.php">My pages</a></li>';
                        echo '|';
                    }
                    echo '<li><a href="orders.php">Orders</a></li>';
                    echo '|';
                    echo '<li><a href="logout.html">Log out</a></li>';
                }?>
                <?php if (!isset($_SESSION['email'])) {
                echo '|';
                echo '<li><a href="login.php">Log In</a></li>';
                echo '|';
                echo '<li><a href="register.html">Sign Up</a></li>';
            }
                ?>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="header-bottom">
    <div class="wrap">
        <div class="header-bottom-left">
            <div class="logo">
                <a href="index.html"><img src="pics/omniBS.png" alt=""/></a>
            </div>
        </div>
        <div class="header-bottom-right">
            <!--<div class="tag-list">
                <ul class="icon1 sub-icon1 profile_img">
                    <li><a class="active-icon c1" href="#"> </a>
                        <ul class="sub-icon1 list">
                            <li><h3>sed diam nonummy</h3><a href=""></a></li>
                            <li><p>Lorem ipsum dolor sit amet, consectetuer <a href="">adipiscing elit, sed diam</a></p>
                            </li>
                        </ul>
                    </li>
                </ul>-->
                <ul class="icon1 sub-icon1 profile_img">
                    <li><a class="active-icon c2" href="cart.php"> </a>
                        
                    </li>
                </ul>
                <ul class="last">
                <?php
                $sessionID = session_id();
                $query = $db->prepare("SELECT * FROM cart WHERE cartID = '$sessionID'");
                $query->execute();
                if (isset($_SESSION['email'])) {
                    $email = $_SESSION['email'];
                    $uID = $db->prepare("SELECT userID FROM users WHERE email = '$email'");
                    $uID->execute();
                    $uID = $uID->fetch()['userID'];

                    $query = $db->prepare("UPDATE cart SET cartID = '$sessionID' WHERE userID = $uID");
                    $query->execute();

                    $query = $db->prepare("SELECT * FROM cart WHERE userID = $uID");
                    $query->execute();
                    echo '<li><a href="cart.php">Cart(' . $query->rowCount() . ')</a></li>';
                } else {
                    echo '<li><a href="cart.php">Cart(' . $query->rowCount() . ')</a></li>';
                }
                ?>
                </ul>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>