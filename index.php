<?php
include_once('includes/header.php');
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

?>
<div class="container">
    <?php
    switch ($page) {
        case 'purchases':
            require_once('./pages/purchases.php');
            exit;
        case 'edit':
            require_once('./pages/edit.php');
            exit;
        case 'billing':
            require_once('./pages/billing.php');
            exit;
        case 'home':
        default:
            require_once('./pages/listing.php');
    }
    ?>
</div>
<?php
include_once('includes/footer.php');
?>