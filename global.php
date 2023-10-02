<?php
$_rootPath = "/nail360UserLight";
$_adminApi = "https://dev.nail360.info/light/api";

$_domain = "192.168.1.46"; //Use for set cookies

$_baseApi = "https://dev.nail360.info";
$_baseImg = "https://dev.nail360.info";

define('JWT_EXPIRED_MINUTES', 10);
define('JWT_PASS', 'changeit');
define("IS_DEBUG", true);

// Global Function
function format_phone_number($phone_num) {
    // Remove any non-numeric characters from the phone number
    $phone_num = preg_replace('/[^0-9]/', '', $phone_num);

    // Format the phone number as "613-555-0184"
    $formatted_phone_num = substr($phone_num, 0, 3) . '-' . substr($phone_num, 3, 3) . '-' . substr($phone_num, 6);

    return $formatted_phone_num;
}

// Example usage
// $phone_num = '(613) 555-0184';
// $formatted_phone_num = format_phone_number($phone_num);
// echo $formatted_phone_num; // Output: 613-555-0184

function format_currency($num) {
    // Format the number as a dollar amount with two decimal places, a dollar sign, and thousands separators
    $formatted_num = '$' . number_format($num, 2, '.', ',');

    return $formatted_num;
}

// // Example usage
// $num = 1234567.89;
// $formatted_num = format_currency($num);
// echo $formatted_num; // Output: $1,234,567.89

function format_number($num, $decimal_places) {
    // Format the number with the specified number of decimal places
    $formatted_num = number_format($num, $decimal_places);

    return $formatted_num;
}

// // Example usage
// $num = 1234.56789;
// $decimal_places = 2;
// $formatted_num = format_number($num, $decimal_places);
// echo $formatted_num; // Output: 1234.57

?>