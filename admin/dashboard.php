<h1>Dashboard</h1>

<?php
if(isset($_SESSION['welcome'])) {
    echo $_SESSION['welcome'];
}
?>