<?php
$token = md5(uniqid(rand(), true));
$_SESSION['csrf_token'] = $token;
?>

<div class="container m-3">
    <div class="add-products-div text-end">
        <button class="add-products-btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#addItem">Add Product</button>
    </div>
</div>

<div class="modal fade" id="addItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="add_product_wrapper">
                    <form id="add_product_form" method="post">
                        <input id="csrf" class="form-control" type="hidden" name="csrf_token" value="<?php echo $token; ?>">
                        <div class="form-group my-1">
                            <label for="product_name">Product Name</label>
                            <input class="form-control" type="text" name="product_name" placeholder="Product Name">
                        </div>
                        <div class="form-group my-1">
                            <label for="stocks">Available Stocks</label>
                            <input class="form-control" type="text" name="stocks" placeholder="Available Stocks">
                        </div>
                        <div class="form-group my-1">
                            <label for="ppu">Price per unit</label>
                            <input class="form-control" type="text" name="ppu" placeholder="Price Per Unit">
                        </div>
                        <div class="form-group my-1">
                            <label for="tax_perc">Tax percentage</label>
                            <input class="form-control" type="text" name="tax_perc" placeholder="Tax Percentage">
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="add-item" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="container m-3">
    <?php

    $sql = "SELECT * FROM product_details";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<div class="table-holder">';
        echo '<table class="table table-light">';
        echo '<thead>';
        echo '<tr>';
        echo "<th>Sr. No.</th>";
        echo "<th>Product Name</th>";
        echo "<th>Available Stocks</th>";
        echo "<th>Price Per Unit</th>";
        echo "<th>Tax Percentage</th>";
        echo "<th>Action</th>";
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';


        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo "<td>" . validate_output($row['product_id']) . "</td>";
            echo "<td>" . validate_output($row['name']) . "</td>";
            echo "<td>" .  validate_output($row['stocks'])  . "</td>";
            echo "<td>" .  validate_output($row['unit_price'])  . "</td>";
            echo "<td>" .  validate_output($row['tax_perc'])  . "% </td>";
            echo "<td>";
            echo "<a href='index.php?page=edit&id=" . validate_output($row['product_id']) . "' class='btn btn-primary mx-1'>Edit</a>";
            echo "<button id='delete-item' token=".$token."  product_id=" . validate_output($row['product_id']) . " class='btn btn-danger mx-1'>Delete</button>";
            echo "</td>";
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    } else { ?>
        <div class="nothing-found">
            <h1 class="emoji">🤷</h1>
            <h2>No products Found!</h2>
        <?php
    }
        ?>

        </div>