<?php
session_start();
$_SESSION['timeout'] = time();
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
    echo $sql . "<br>" . $e->getMessage();
    }

include "app/config.php";
include "app/detect.php";
include "app/session.php";
include 'web/header.php';


$_SESSION['sessionTime'] = time();
$_SESSION['loginTime'] = time();

if ($page_name == '') {
    $page_name == '';
    include $browser_t . '/index.html';

} elseif ($page_name == 'index.html') {
    include $browser_t . '/index.html';

} elseif ($page_name == 'review.html'){
    include $browser_t . '/review.html';
    
} elseif ($page_name == 'login.php') {
    include $browser_t . '/login.php';

} elseif ($page_name == 'register.html') {
    include $browser_t . '/register.html';

} elseif ($page_name == 'cart.php') {
    include $browser_t . '/cart.php';

} elseif ($page_name == 'about.html') {
    include $browser_t . '/about.html';

} elseif ($page_name == 'delivery.html') {
    include $browser_t . '/delivery.html';

} elseif ($page_name == 'contact.html') {
    include $browser_t . '/contact.html';

} elseif ($page_name == '404.html') {
    include $browser_t . '/404.html';

} elseif ($page_name == 'contact-post.html') {
    include $browser_t . '/contact.html';
    include 'app/contact.php';

} elseif ($page_name == 'logout.html') {
    //$uid = $_SESSION['email'];
    session_unset();
    session_regenerate_id();
    session_destroy();

    header('Location: index.html');

} elseif ($page_name == 'orders.php') {
    include $browser_t . '/orders.php';

} elseif ($page_name == 'checkout.php') {
    include $browser_t . '/checkout.php';

} elseif ($page_name == 'admin.php') {
    include $browser_t . '/admin.php';

} elseif ($page_name == 'userEdit.php') {
    include $browser_t . '/userEdit.php';

} elseif ($page_name == 'restock.php'){
    include $browser_t . '/restock.php';

} elseif ($page_name == 'newBeer.php'){
    include $browser_t . '/newbeer.php';

} elseif ($page_name == 'beer.html?id='.$_GET['id']) {
    include $browser_t . '/beer.html';

} else {
    include $browser_t . '/404.html';
}
include 'web/footer.php';
?>
//