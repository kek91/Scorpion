<h1>Dashboard</h1>

<div class="alert alert-dismissable alert-info" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<div id="funny-quote"></div>
<!--<br><br><button type="button" class="btn btn-sm btn-danger">Disable funny quotes?</button>-->
</div>

<script>
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (data) {
        if(xhr.readyState === 4) {
            if(xhr.status === 200) {
                var obj = JSON.parse(xhr.responseText);
                console.log(obj['value']['joke']);
                document.getElementById('funny-quote').innerHTML = obj['value']['joke'];
            }
        }
    }
    xhr.open('GET', 'http://api.icndb.com/jokes/random?limitTo=[nerdy]');
    xhr.send();
</script>