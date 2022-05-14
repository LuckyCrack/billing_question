<?php
include_once('../includes/connect.php');
include_once('../commons/functions.php');

$resp['msg'] = '';
$resp['success'] = false;

if(empty($_POST['customer_email']) && empty($_POST['cash_paid']))
{
    header('Location: index.php?page="billing"');
    exit;
}
else
{
    $customer_email = validate_input($_POST['customer_email']);
    $cash_paid = validate_input($_POST['cash_paid']);

    $product_id = implode(',', $_POST['product_id']);

    $product_quantity_ar = array_combine($_POST['product_id'], $_POST['product_quantity']);

    $query = "SELECT * FROM product_details WHERE product_id IN ($product_id) Group by product_id";
    $result = mysqli_query($conn, $query);
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);


    if (empty($products)) {
        $resp['msg'] = "No products found with provided id";
    }


    $product_table = '';
    $price_without_tax = 0;
    $product_tax_payable = 0;
    $net_price_of_purchased_item = 0;
    $rounded_net_price_of_purchased_item = 0;
    $balance_payable_to_customer = 0;

    foreach($products as $product)
        {
            $product_id = $product['product_id'];
            $product_price = $product['unit_price'];
            $tax_perc = $product['tax_perc'];
            $product_tax = $tax_perc;
            $product_quantity = $product_quantity_ar[$product_id];
            $product_tax_payable = $product_price * $product_tax / 100;
            $product_total_price = $product_price + $product_tax_payable;
            $product_total_price = $product_total_price * $product_quantity;
            $product_total_price = number_format($product_total_price, 2);
            $product_tax_payable = number_format($product_tax_payable, 2);
            $product_price = number_format($product_price, 2);

            $price_without_tax += $product_price * $product_quantity;
            $product_tax_payable += $price_without_tax * $tax_perc / 100;
            $net_price_of_purchased_item += $price_without_tax + $product_tax_payable;
            


            $product_table .= '<tr>
                                <td>'.$product_id.'</td>
                                <td>'.$product_price. '</td>
                                <td>' . $product_quantity . '</td>
                                <td>' . $tax_perc. '</td>
                                <td>'.$product_tax_payable.'</td>
                                <td>'.$product_total_price.'</td>
                            </tr>';

        }

        $rounded_net_price_of_purchased_item = round($net_price_of_purchased_item);
        $balance_payable_to_customer =  $cash_paid - $rounded_net_price_of_purchased_item;
        $balance_payable_to_customer = round($balance_payable_to_customer);

        $balance_payable_to_customer_2 = $balance_payable_to_customer;

        //calculate denominations
        $denominations = array(500, 50, 20, 10, 5, 2, 1);
        $denomination_table = '';
        $denomination_total = 0;
        

        foreach($denominations as $denomination)
        {
            
            //calculate denominations for 500, 50, 20, 10, 5, 2, 1 of balance payable to customer
            $denomination_count = floor($balance_payable_to_customer_2 / $denomination);
            $balance_payable_to_customer_2 = $balance_payable_to_customer_2 % $denomination;
            $denomination_total += $denomination_count * $denomination;
            $denomination_table .= '<tr>
                                    <td align="right" valign="middle">'. $denomination. '</td>
                                    <td align="right" valign="middle">' . $denomination_count . '</td>
                                </tr>';
        }
}

$html = '<table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
    <tbody>
        <tr>
            <td align="center" valign="middle">
                <h2>Billing Page</h2>
            </td>
        </tr>
    </tbody>
</table>
<table width="25%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
    <tbody>
        <tr>
            <td align="left" valign="middle">
                <h3 style="margin-bottom: 0; margin-right: 10px;">Customer Email</h3>
            </td>
            <td align="left" valign="middle">
                '. $customer_email .'
            </td>
        </tr>
    </tbody>
</table>
<table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
    <tbody>
        <tr>
            <td align="left" valign="middle">
                <h3 style="margin-bottom: 0">Billing Section</h3>
            </td>
            <td align="left" valign="middle">
                <table cellpadding="10" cellspacing="10" border="1" style="border-collapse: collapse;">
                    <thead> 
                        <tr>
                            <th>Product Id</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Tax % for item</th>
                            <th>Tax payable for item</th>
                            <th>Total price of the item</th>
                        </tr>
                     </thead>
                    <tbody>
                        '. $product_table.'
                    </tbody>
                </table>
                </td>
        </tr>
    </tbody>
</table>
<table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
    <tbody>
        <tr>
            <td align="right" valign="middle">
                <h3 style="margin-bottom: 0; margin-top:0;  margin-right:25px;">Total price without tax: </h3>
            </td>
            <td align="right" valign="middle">
                '. $price_without_tax .'
            </td>
        </tr>
        <tr>
            <td align="right" valign="middle">
                <h3 style="margin-bottom: 0; margin-top:0;  margin-right:25px;">Total tax payable:</h3>
            </td>
            <td align="right" valign="middle">
                '. $product_tax_payable .'
            </td>
        </tr>
        <tr>
            <td align="right" valign="middle">
                <h3 style="margin-bottom: 0; margin-top:0;  margin-right:25px;">Net price of the purchased item:</h3>
            </td>
            <td align="right" valign="middle">
                '. $net_price_of_purchased_item .'
            </td>
        </tr>
        <tr>
            <td align="right" valign="middle">
                <h3 style="margin-bottom: 0; margin-top:0;  margin-right:25px;">Round down value of the purchased item new price:</h3>
            </td>
            <td align="right" valign="middle">
                '. $rounded_net_price_of_purchased_item .'
            </td>
        </tr>
        <tr>
            <td align="right" valign="middle">
                <h3 style="margin-bottom: 0; margin-top:0;  margin-right:25px;">Balance payable to the customer:</h3>
            </td>
            <td align="right" valign="middle">
                '. $balance_payable_to_customer .'
            </td>
        </tr>
    </tbody>
</table>
<hr>
<table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
    <tbody>
        <tr>
            <td align="right" valign="middle">
                <h3 style="margin-bottom: 0">Balance Denominations</h3>
            </td>
        </tr>
        '. $denomination_table .'
    </tbody>
</table>';

$products = json_encode($product_quantity_ar);
$sql = "INSERT INTO customer_purchased_products (customer_email, cash_paid, email_sent, products_and_quantity) VALUES ('$customer_email', '$cash_paid' , '0', '$products')";
$result = mysqli_query($conn, $sql);
if ($result)
{
    $customer_id = $conn->insert_id;
}
else
{
    $resp['msg'] = 'Something went wrong!';
    exit;
}




require_once('../commons/dompdf/autoload.inc.php');

use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->render();
$output = $dompdf->output();
file_put_contents('../invoices/invoice_'.$customer_id.'.pdf', $output);


//send email with pdf attachment
$to = $_POST['customer_email'];
$subject = 'Invoice';
$message = 'Please find the attached invoice';
$headers = 'From: sender@gmail.com';
$file = '../invoices/invoice.pdf';

if (mail($to, $subject, $message, $headers, $file)) {
    //update email sent status in customer_purchased_products table
    $sql = "UPDATE customer_purchased_products SET email_sent = 1 WHERE customer_email = '$customer_email'";
    $result = mysqli_query($conn, $sql);
    if ($result)
    {
        $resp['msg'] = 'Email sent successfully!';
    }
    else
    {
        $resp['msg'] = 'Something went wrong!';
    }
} else {
    $resp['msg'] = "Email sending failed";
}
echo json_encode($resp);

?>