<?php
if(isset($_SESSION['error'])) {
    echo '<div class="alert alert-dismissable alert-danger" role="alert">';
    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    echo $_SESSION['error'];
    echo '</div>';
    $_SESSION['error'] = null;
}
/*
 * Moved to /inc/dashboard.php
if(isset($_SESSION['welcome'])) {
    echo '<div class="alert alert-dismissable alert-success" role="alert">';
    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    echo $_SESSION['welcome'];
    echo '<br><br>';
//    echo '<blockquote><div id="funny-quote"></div></blockquote>';
    echo '<b><div id="funny-quote"></div></b><br>';
    
    echo '<a onClick="get_funny_quote();">Click here to load more funny quotes</a>';
    echo '</div>';
    echo '<script>get_funny_quote();</script>';
    $_SESSION['welcome'] = null;
}
*/
?>