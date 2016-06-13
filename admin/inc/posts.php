<h1>Posts</h1>

<?php
$scorpion = new Scorpion();
$posts = $scorpion->get_pages('post');
?>

<table class="table table-striped table-hover" id="datatable">
    <thead>
        <tr>
            <th>Date</th>
            <th>Author</th>
            <th>Category</th>
            <th>Title</th>
        </tr>
    </thead>
    <tbody>
<?php
foreach($posts as $key => $val) {
    echo '<tr onClick="location.href=\'posts/'.$val['title'].'\'">';
    echo !empty($val['date']) ? '<td>'.$val['date'].'</td>' : '<td class="danger"></td>';
    echo !empty($val['author']) ? '<td>'.$val['author'].'</td>' : '<td class="danger"></td>';
    echo !empty($val['category']) ? '<td>'.$val['category'].'</td>' : '<td class="danger"></td>';
    echo !empty($val['title']) ? '<td><a href="posts/'.$val['title'].'">'.$val['title'].'</a></td>' : '<td class="danger"></td>';
    echo '</tr>';
}
?>
    </tbody>
</table>

<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="themes/default/datatables.js"></script>
<link rel="stylesheet" href="themes/default/datatables.css" type="text/css">
<script>
$(document).ready(function() {
    $('#datatable').DataTable({
        "iDisplayLength":25
    });
} );
</script>