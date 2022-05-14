<?php
$product_id = $_GET['id'];

if (empty($product_id)) {
    header('Location: index.php');
}

$sql = "SELECT * FROM product_details WHERE product_id = '$product_id'";
$result = mysqli_query($conn, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    if (mysqli_num_rows($result) > 0) {
        $product_name = validate_output($row['name']);
        $stocks = validate_output($row['stocks']);
        $ppu = validate_output($row['unit_price']);
        $tax_perc = validate_output($row['tax_perc']);
    }
} else {
    echo "Something went wrong";
    exit;
}
?>
<div class="add_product_wrapper">
    <form id="add_product_form" method="post">
        <input class="form-control" type="hidden" name="csrf_token" value="<?php echo $token; ?>">
        <div class="form-group my-1">
            <label for="product_name">Product Name</label>
            <input class="form-control" type="text" name="product_name" placeholder="Product Name" value="<?php echo $product_name ?>">
        </div>
        <div class="form-group my-1">
            <label for="stocks">Available Stocks</label>
            <input class="form-control" type="text" name="stocks" placeholder="Available Stocks" value="<?php echo $stocks ?>">
        </div>
        <div class="form-group my-1">
            <label for="ppu">Price per unit</label>
            <input class="form-control" type="text" name="ppu" placeholder="Price Per Unit" value="<?php echo $ppu ?>">
        </div>
        <div class="form-group my-1">
            <label for="tax_perc">Tax percentage</label>
            <input class="form-control" type="text" name="tax_perc" placeholder="Tax Percentage" value="<?php echo $tax_perc ?>">
        </div>
        <div class="form-group my-1">
            <button type="button" id="add-item" class="btn btn-primary my-2">Update</button>
        </div>
    </form>
</div>