
<?php

function getId()
{
    $random = substr(md5(mt_rand()), 0, 5);
    return $random;
}
require_once 'global.php';
if(IS_DEBUG) error_reporting(E_ALL);

define('INCLUDE_DIR', dirname(__FILE__) . '/views/');

$rules =  array(

    'nail360pro/index'  => "/nail360pro",
    'nail360/pages/salon-detail'      => "/salon/(.+)",
    'nail360/pages/write-review'      => "/write-review/(.+)",
    'nail360/pages/view-review'      => "/view-review/(.+)",
    'nail360/pages/thankyou'      => "/thankyou/(.+)",
    'nail360/pages/search'      => "/search",
    'nail360/pages/404'      => "/404",
    'nail360/pages/home_2'      => "/home2",
    'nail360/pages/home'      => "/|'index.php'",
);


$uri = rtrim(dirname($_SERVER["SCRIPT_NAME"]), '/');
$uri = '/' . trim(str_replace($uri, '', $_SERVER['REQUEST_URI']??''), '/');
$uri = urldecode($uri);

foreach ($rules as $action => $rule) {
    if (preg_match('~^' . $rule . '$~i', $uri, $params)) {
        /* now you know the action and parameters so you can 
         * include appropriate template file ( or proceed in some other way )
         */

        $param1 = "";
        $param2 = "";
        if (isset($params[1]) && $params[1] != "") {
            $param1 = $params[1];
        }
        if (isset($params[2]) && $params[2] != "") {
            $param2 = $params[2];
        }
        include(INCLUDE_DIR . $action . '.php');
        // exit to avoid the 404 message 
        exit();
    }
}

// nothing is found so handle the 404 error
include(INCLUDE_DIR . '404.php');

?>