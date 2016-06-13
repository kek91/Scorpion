<h1>Posts</h1>

<?php
/* Find all posts */
$scorpion = new Scorpion();

echo 'get_files():<br>';
echo '<pre>';
print_r($scorpion->get_files());
echo '</pre><br><br>';
echo 'get_pages():<br><pre>';
print_r($scorpion->get_pages());
echo '</pre><br>';

//$posts = $scorpion->get_pages();
//
//foreach($posts as $post => $val) {
//    echo $post .' => '. $val .' ... <br>';
//    foreach($val as $k => $v) {
//        echo $k .' => '. $v .'<br>';
//    }
//    echo '<hr><br><br>';
//}