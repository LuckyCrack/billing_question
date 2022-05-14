<?php
    function validate_output($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function validate_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        global $conn;
        return mysqli_real_escape_string($conn, $data);
    }
    function check_csrf_token()
    {
        if (isset($_SESSION['csrf_token']) && isset($_POST['csrf_token'])) {
            if ($_SESSION['csrf_token'] == $_POST['csrf_token']) {
                return true;
            }
        }
        return false;
    }
?>