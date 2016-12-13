<?php
    session_start();
    $user='root';
    $password='';
    $database='dbcourse';
    $host='localhost';

    try {
        $db = new PDO("mysql:host=localhost; dbname=$database", $user, $password);
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

    catch(PDOException $e)
        {
        echo $db . "<br>" . $e->getMessage();
        }


    if(isset($_POST["login"])){
        login($db);

    } elseif (isset($_POST["register"])) {
        insertUser($db);
        header('Location: login.php');

    } elseif (isset($_POST['beerIDcomment'])) {
        comment($db);
        $beerID = $_POST['beerIDcomment'];
        header('Refresh: 0; url=http://localhost/leo-shop-pack/beer.html?id='.$beerID);

    } elseif (isset($_POST["userEdit"])) {
        userEdit($db);
        header('Refresh: 0; url=http://localhost/leo-shop-pack/userEdit.php');

    } elseif (isset($_POST['restockID'])) {
        restock($db);
        header('Location: restock.php');

    } elseif (isset($_POST['beerID'])) {
        buybeer($db);
        $beerID = $_POST['beerID'];
        header('Refresh: 0; url=http://localhost/leo-shop-pack/beer.html?id='.$beerID);
    
    } elseif (isset($_POST['removeBeer'])){
        removeBeer($db);
        header('Location: cart.php');

    } elseif (isset($_POST['update'])) {
        updateCart($db);
        header('Refresh: 0; url=http://localhost/leo-shop-pack/cart.php');
    
    } elseif (isset($_POST['updateOrder'])) {
        updateOrder($db);
        header('Location: admin.php');

    } elseif (isset($_POST['checkoutCart'])) {
        header('Location: checkout.php');

    } elseif (isset($_POST['addBeer'])) {
        addBeer($db);
        header('Refresh: 0; url=http://localhost/leo-shop-pack/index.html');
    
    } else {
        echo "else function";
    }

    function comment($db) {
        $email = $_SESSION['email'];
        $beerID = $_POST['beerIDcomment'];
        $comment = $_POST['comment'];
        $rating = $_POST['rating'];
        $date = date('j F Y');
        $query = $db->prepare("SELECT userID FROM users where email = ?");
        $query->execute(array($email));
        $uid = $query->fetch()['userID'];

        $check = $db->prepare("SELECT userID FROM usersinput WHERE productID = '$beerID' AND userID = '$uid'");
        $check->execute();
        $res = $check->fetchAll();
        if ($check->rowCount() == 0) {
            $query = $db->prepare("INSERT INTO `usersinput` (comment, rating, userID, productID, `date`) VALUES (?,?,?,?,?)");
            $array = array($comment, $rating, $uid, $beerID, $date);
            $query->execute($array);
        } else {
            echo '<script> alert("You already have a comment on this product."); </script>';
        }

    }

    function addBeer($db){
        $beername = $_POST['beerName'];
        $style = $_POST['style'];
        $brewery = $_POST['brewery'];
        $percentage = $_POST['percentage'];
        $description = $_POST['description'];
        $picpath = $_POST['picpath'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];

        $check = $db->prepare("SELECT name FROM products WHERE name = '$beername'");
        $check->execute();
        $name = $check->rowCount();
        if ($beername == "" || $style == "" || $brewery == "" || $percentage == "" || $description == "" || $picpath == "" || $price == "" || $stock == ""){
         echo '<script> alert("All windows needs to be filled"); </script>';   
        } else if ($name == 0) {
            $query = $db->prepare("INSERT INTO products (name, style, brewery, percentage, description, picpath, price, stock) VALUES (?,?,?,?,?,?,?,?)");
            $array = array($beername, $style, $brewery, $percentage, $description, $picpath, $price, $stock);
            $query->execute($array);
           echo '<script> alert("Beer successfully added"); </script>';


        } else {
            echo '<script> alert("This beer is already in storage"); </script>';
        }







    }

    function userEdit($db) {
        $email = $_SESSION['email'];
        $query = $db->prepare("SELECT password FROM users WHERE email = '$email'");
        $query->execute();
        $firstname=$_POST['firstname'];
        echo $firstname;
        $password=$_POST['password'];
        $lastname=$_POST['lastname'];
        $address=$_POST['address'];
        $city=$_POST['city'];
        $country=$_POST['country'];
        $phone=$_POST['phone'];
        $newpw = $_POST['newpw'];
        $newpw2 = $_POST['newpw2'];
        // Not changing password
        if ($newpw == "" && $newpw2 == "" && password_verify($password, $query->fetch()['password'])){
            $query = $db->prepare("UPDATE users SET firstname= '$firstname', lastname = '$lastname', address = '$address', city = '$city', country = '$country', phone = '$phone' WHERE email = '$email'");
            $query->execute();
            echo '<script> alert("Information successfully changedddddddd."); </script>';
        }
        // Also changing new password
        else if (password_verify($password, $query->fetch()['password'])) {
            $password = password_hash($newpw, PASSWORD_DEFAULT);
            $query = $db->prepare("UPDATE users SET firstname= '$firstname', lastname = '$lastname', password = '$password', address = '$address', city = '$city', country = '$country', phone = '$phone' WHERE email = '$email'");
            $query->execute();
            echo '<script> alert("Information successfully changed."); </script>';
        } else {
            echo '<script> alert("Wrong password, try again."); </script>';
        }
 }
    function updateOrder($db) {
        $id = $_POST['updateOrder'];
        $shipped = $_POST['updateShipping'];
        echo "id: " . $id . "<br>";
        echo "shipped: " . $shipped . "<br>";
        $query = $db->prepare("UPDATE `order` SET shipped = ? WHERE orderID = '$id'");
        $query->execute(array($shipped));
    }

    function updateCart($db){
        $sessionID = session_id();
        $id = $_POST['update'];
        $newQuantity = $_POST['quantity'];
        $check = $db->prepare("SELECT stock FROM products WHERE prodID = $id");
        $check->execute();
        $beerNum = $check->fetch();
        $trigg = 0;
        if ($newQuantity > $beerNum['stock']) {
            echo '<script> alert("There\'s not enough beer of this sort"); </script>';
        }
        else {
            $query = $db->prepare("UPDATE cart SET quantity = ? WHERE productID = ?");
            $query->execute(array($newQuantity, $id));
        }
    }


    function removeBeer($db) {
        $beerID = $_POST['removeBeer'];
        $query = $db->prepare("DELETE FROM cart WHERE cart.productID = $beerID");
        $query->execute();
    }

    function login($db) {
        $_SESSION['timeout'] = time();
        //isset checks if there is something.
        if (isset($_POST['email']) and (isset($_POST['password']))) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            //Preparing to check usernames.
            $query = $db->prepare("SELECT password, admin, userID FROM users WHERE email = ?");
            $admin = $db->prepare("SELECT admin FROM users WHERE email = ?");
            $user = $db->prepare("SELECT userID from users where email = ?");

            //Running the query in my prepared statement, where "?"" = array elements of $name.
            $sessionID = session_id(); 
            $query->execute(array($email));
            $admin->execute(array($email));
            $user->execute(array($email));
            $result = $admin->fetch();
            $user = $user->fetch();
            $userID = $user[0];
            $userCart = $db->prepare("UPDATE cart SET userID = '$userID' WHERE cartID = '$sessionID'");
            $userCart->execute();
            

            //query->fetchColumn() fetches our password since our query says so. 0 means first argument.
            if (password_verify($password, $query->fetchColumn())) {
                //$_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                $query = $db->prepare("SELECT cartID FROM cart WHERE userID = $userID");
                $query->execute();

                if ($result[0] == 1) {
                    $_SESSION['admin'] = 1;
                    header('Location: index.html');
                } else {
                    $_SESSION['admin'] = 0;
                    header('Location: index.html');
                }
            } else {           
                echo "Invalid username or password <br>";
            }
        }
    }

    function buybeer($db) {
        $user = 0;
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
            $user = $db->prepare("SELECT userID from users WHERE email = ?");
            $user->execute(array($email));
            $user = $user->fetch();
            $userID = $user[0];
            $user = 1;
        }
        $trigg = false;
        $beerID = $_POST['beerID'];
        $_SESSION['temp'] = $_POST['beerID'];
        $sessionID = session_id();
        //echo "session: " . $sessionID;
        $check = $db->prepare("SELECT productID, quantity FROM cart WHERE productID = '$beerID' AND cartID = '$sessionID'");
        $check->execute();
        $row = $check->rowCount();
        $result = $check->fetch();

        $query = $db->prepare("SELECT stock FROM products WHERE prodID = $beerID");
        $query->execute();
        $numBeer = $query->fetch();
        //Here is only 1 row since we use buy button in beer.php and send that beerID here.
        if ($row == 1) {
            $trigg = true;
            $newQuantity = $result['quantity'] + 1;

            if ($numBeer['stock'] < $newQuantity) {
                echo '<script> alert("There\'s not enough beer of this sort"); </script>';

            } else {
                $query = $db->prepare("UPDATE cart SET quantity = $newQuantity WHERE productID = $beerID");
                $query->execute();
                }
            }
        if (!$trigg){
            if ($numBeer['stock'] < 1) {
                echo '<script> alert("There\'s not enough beer of this sort"); </script>';
            } else {
                if ($user == 1){
                $product = $db->prepare("INSERT INTO cart (cartID, productID, userID) VALUES (?,?,?)");
                $product->execute(array($sessionID, $beerID, $userID));
                } else {
                $product = $db->prepare("INSERT INTO cart (cartID, productID) VALUES (?,?)");
                $product->execute(array($sessionID, $beerID));
                }
            }
        }
    }

    function restock($db) {
        //Set the variables.
        $stock = $_POST['stock'];
        $prodID = $_POST['restockID'];

        $query = $db->prepare("UPDATE products
            SET stock=? WHERE prodID = ?");
        
        $query2 = $db->prepare("SELECT stock from products where prodID = $prodID");
        $query2->execute();
        $quantity = $query2->fetch()[0];
        $newStock = ($stock + $quantity);

        //Execute the command.
        $array = array($newStock, $prodID);
        $query->execute($array);
    }

    function insertUser($db) {
    	//try {
    	$statement = $db->prepare("INSERT INTO users (password, firstname, lastname, phone, address, city, country, email)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        
        //Set the variables.
        $firstname=$_POST['firstname'];
    	$password=$_POST['password'];
    	$lastname=$_POST['lastname'];
        $address=$_POST['address'];
        $city=$_POST['city'];
        $country=$_POST['country'];
    	$phone=$_POST['phone'];
    	$email=$_POST['email'];

        /*password_hash sets a random salt automaticly dependent on windows backgrond noice (I think)
         so we don't need to do it manually. It also concatenates it with the hashed password. */
        if (!empty($password)) {
             $password = password_hash($password, PASSWORD_DEFAULT);
        }
        //We need to have an if-statement on the password since the salt will always "become" part of the password, even if it's empty.
        $array = array($password, $firstname, $lastname, $phone, $address, $city, $country, $email);
        
        $set = 0;
        $k = 1;
        for ($i = 0; $i < count($array); $i++) {
            if (!empty($array[$i])) {
                $k = $k+1;
                if (count($array) == $k) {
                        $statement->execute($array);
                        //echo "You are now registered.";
                }
            } 
            elseif ($set == 0) {
                $set = 1;
                echo "Please fill out all the forms";
            }
        }
    }

    // Gotten all we need from db so we close the connection.
    $db = null;
    //header('Location: index.php');
    ?>