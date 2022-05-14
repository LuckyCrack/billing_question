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

    if(check_csrf_token())
    {
        if (isset($_POST['product_name']) && isset($_POST['stocks']) && isset($_POST['ppu']) && isset($_POST['tax_perc']) && $_POST['product_name'] != ' ' && $_POST['stocks'] != ' ' && $_POST['ppu'] != ' ' && $_POST['tax_perc'] != ' ')
        {
            $product_name = validate_input($_POST['product_name']);
            $available_stocks = validate_input($_POST['stocks']);
            $price_per_unit = validate_input($_POST['ppu']);
            $tax_perc = validate_input($_POST['tax_perc']);
            if(isset($_POST['product_id']))
            {
                $product_id = $_POST['product_id'];

                $sql = "UPDATE product_details SET name = '$product_name', stocks = '$available_stocks', unit_price = '$price_per_unit', tax_perc = '$tax_perc' WHERE product_id = '$product_id'";
                $result = mysqli_query($conn, $sql);
                
                if($result)
                {
                    $resp['success'] = true;
                    $resp['msg'] = 'Product Updated Successfully!';
                }
                else
                {
                    $resp['msg'] = 'Something went wrong!';
                }
                echo json_encode($resp);
            }
            else
            {
                $sql = "INSERT INTO product_details (name, stocks, unit_price, tax_perc) VALUES ('$product_name', '$available_stocks', '$price_per_unit', '$tax_perc')";

                $result = mysqli_query($conn, $sql);
                if($result)
                {
                    $resp['success'] = true;
                    $resp['msg'] = 'Product Added Successfully!';
                }
                else
                {
                    $resp['msg'] = 'Something went wrong!';
                }
            }
            
        } 
        else 
        {
            $resp['msg'] = 'All Fields Are Mandatory!';
        }
    }
    else
    {
        header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
        exit; 
    }
    echo json_encode($resp);
?>