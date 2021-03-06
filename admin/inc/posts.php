<h1>Posts</h1>

<div>
    <a href="posts-new"><button class="btn btn-success">New post</button></a>
</div><br>


<div class="alert alert-info hidden" id="infobox_missingMetaData">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <b>Information</b><br><br>
    Red cells indicates missing meta data.<br>
    You should correct the missing data to increase search engine optimization
    and improve your visitors experience.<br><br>
    <button class="btn btn-sm btn-info" onClick='dont_show_again_missingMetaData();'>Don't show again</button>
</div>
<script>
    if(localStorage.show_msg_missingMetaData !== "false") {
        document.getElementById('infobox_missingMetaData').className = 'alert alert-info';
    }
</script>

<?php
$scorpion = new Scorpion();
$posts = $scorpion->get_pages('post');
?>

<div class="panel panel-primary">
    <div class="panel-heading">Posts - used for news or article system</div>
    <div class="panel-body">
        <table class="table table-striped table-hover" id="datatable">
            <thead>
                <tr>
                    <th>Filename</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Author</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
        <?php
        foreach($posts as $key => $val) {
            echo '<tr onClick="location.href=\'posts/'.$val['title'].'\'">';
            echo !empty($val['filename']) ? '<td><a href="posts/'.$val['title'].'">'.$val['filename'].'</a></td>' : '<td class="danger"></td>';
            echo !empty($val['title']) ? '<td>'.$val['title'].'</td>' : '<td class="danger"></td>';
            echo !empty($val['date']) ? '<td>'.$val['date'].'</td>' : '<td class="danger"></td>';
            echo !empty($val['author']) ? '<td>'.$val['author'].'</td>' : '<td class="danger"></td>';
            echo !empty($val['category']) ? '<td>'.$val['category'].'</td>' : '<td class="danger"></td>';
            echo '</tr>';
        }
        ?>
            </tbody>
        </table>
    </div>
</div>

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