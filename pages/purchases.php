<?php
$token = md5(uniqid(rand(), true));
$_SESSION['csrf_token'] = $token;
?>

<div class="container m-3">
    <?php

    $sql = "SELECT * FROM customer_purchased_products ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<div class="table-holder">';
        echo '<table class="table table-light">';
        echo '<thead>';
        echo '<tr>';
        echo "<th>Customer Id</th>";
        echo "<th>Customer Email</th>";
        echo "<th>Email Status</th>";
        echo "<th>Amount Paid</th>";
        echo "<th>Purchase Date</th>";
        echo "<th>Action</th>";
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        

        while ($row = mysqli_fetch_assoc($result)) {

            if ($row['email_sent']) {
                $email_status =  'In Queue';
            } else {
                $email_status = 'Sent';
            }

            echo '<tr>';
            echo "<td>" . validate_output($row['id']) . "</td>";
            echo "<td>" . validate_output($row['customer_email']) . "</td>";
            echo "<td>" .  $email_status  . "</td>";
            echo "<td>" .  validate_output($row['cash_paid'])  . " </td>";
            echo "<td>" .  validate_output($row['purchase_date'])  . "</td>";
            echo '<td>';
            echo "<button customer_id='" . validate_output($row['products_and_quantity']) . "' class='btn btn-primary mx-1'>View Products Purchased</button>";
            echo "</td>";
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    } else { ?>
        <div class="nothing-found">
            <h1 class="emoji">🤷</h1>
            <h2>Nothing Found!</h2>
        <?php
    }
        ?>

        </div>