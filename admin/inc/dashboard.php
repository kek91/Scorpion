<h1>Dashboard</h1>

<?php
if(isset($_SESSION['welcome'])) {
    ?>
    <div class="alert alert-success hidden" id="infobox_welcome">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?php echo $_SESSION['welcome']; ?>
    <br><br>
    <b><div id="funny-quote" onClick="get_funny_quote();"></div></b><br>
    <button class="btn btn-sm btn-success" onClick='dont_show_again_welcome();'>Don't show again</button>
    </div>
    <script>get_funny_quote();</script>
    <?php $_SESSION['welcome'] = null;
}
?>
<script>
    if(localStorage.show_msg_welcome !== "false") {
        document.getElementById('infobox_welcome').className = 'alert alert-success';
    }
</script>

<div class="alert alert-danger hidden" id="infobox_betaNotice">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <b>Scorpion CMS Beta</b><br><br>
    Statistics data on "Dashboard" are for demonstration purposes and not actually real data.<br><br>
    <button class="btn btn-sm btn-danger" onClick='dont_show_again_betaNotice();'>Don't show again</button>
</div>
<script>
    if(localStorage.show_msg_betaNotice !== "false") {
        document.getElementById('infobox_betaNotice').className = 'alert alert-danger';
    }
</script>

<!--<div class="panel panel-primary">...</div>
<div class="panel panel-success">...</div>
<div class="panel panel-info">...</div>
<div class="panel panel-warning">...</div>
<div class="panel panel-danger">...</div>-->
<div class="container col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Unique visitors &nbsp; 
            <button onClick="show_chart_visitors_monthly();" id="visitors-monthly" class="btn btn-sm btn-primary">Monthly</button>
            <button onClick="show_chart_visitors_weekly();" id="visitors-weekly" class="btn btn-sm btn-default">Weekly</button>
            <button type="button" class="close close-canvas" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div></div>
        <div class="panel-body">
            <canvas id="chart-visitors" id="chart-visitors-parent" height="100"></canvas>
        </div>
    </div>
</div>
<div class="container col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            Popular pages
            <button type="button" class="close close-canvas" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="panel-body">
            <canvas id="chart-popular"></canvas>
        </div>
    </div>
</div>
<div class="container col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            Referrals
            <button type="button" class="close close-canvas" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="panel-body">
            <div id="chart-referrals"></div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js"></script>

<script>
show_chart_visitors_monthly();

show_chart_popular();

show_chart_referrals();


</script>