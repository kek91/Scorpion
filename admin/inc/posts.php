<h1>Posts</h1>

<?php
/* Find all posts */
$scorpion = new Scorpion();

echo 'get_files():<br>';
echo '<pre>';
print_r($scorpion->get_files());
echo '</pre><br><br>';
echo 'get_pages():<br>';
echo $scorpion->get_pages();