<?php
include_once('../includes/connect.php');
include_once('../commons/functions.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$resp['msg'] = '';
$resp['success'] = false;

    if(check_csrf_token() && $_POST['product_id'])
    {
        $id = $_POST['product_id'];
        $sql = "DELETE FROM product_details WHERE product_id = '$id'";
        $result = mysqli_query($conn, $sql);
        if($result) 
        {
            $resp['success'] = true;
            $resp['msg'] = 'Product deleted successfully';
        } 
        else 
        {
        $resp['msg'] = 'Something went wrong';
        }
    }
    else
    {
        $resp['msg'] = 'Something went wrong';
    }
echo json_encode($resp);
?>