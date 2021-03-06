<html>
<head>
    <title>Omnipollo Bottle Shop | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="web/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href='http://fonts.googleapis.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="web/js/jquery1.min.js"></script>
    <!-- dropdown -->
    <script src="web/js/jquery.easydropdown.js"></script>
</head>
<body>
<div class="login">
    <div class="wrap">
        <div class="col_1_of_login span_1_of_login">
            <h4 class="title">New Customers</h4>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
                laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor
                in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at
                vero eros et accumsan</p>
            <div class="button1">
                <a href="register.html"><input type="submit" name="Submit" value="Create an Account"></a>
            </div>
            <div class="clear"></div>
        </div>
        <div class="col_1_of_login span_1_of_login">
            <div class="login-title">
                <h4 class="title">Registered Customers</h4>
                <div id="loginbox" class="loginbox">
                    <form action="dbstuff.php" method="post" name="login" id="login-form">
                        <fieldset class="input">
                            <p id="login-form-username">
                                <label for="modlgn_username">E-mail</label>
                                <input id="modlgn_username" type="text" name="email" class="inputbox" size="18"
                                       autocomplete="off">
                            </p>
                            <p id="login-form-password">
                                <label for="modlgn_passwd">Password</label>
                                <input id="modlgn_passwd" type="password" name="password" class="inputbox" size="18"
                                       autocomplete="off">
                            </p>
                            <div class="remember">
                                <p id="login-form-remember">
                                    <label for="modlgn_remember"><a href="#">Forget Your Password ? </a></label>
                                </p>
                                <input type="submit" name="login" class="button" value="Login">
                                <div class="clear"></div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
</body>
</html>