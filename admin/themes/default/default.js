document.addEventListener('DOMContentLoaded', function() {

    /* Support for closing alert boxes */
    [].forEach.call(document.querySelectorAll('.close'), function(e) {
        e.addEventListener('click', function() {
            if(this.parentNode.className == 'panel-heading') {
                this.parentNode.parentNode.className += ' hidden';
            }
            else {
                this.parentNode.className += ' hidden';
            }
        })
    });
    
    
    /* Custom function for minimize/maximize Bootstrap panels */
    [].forEach.call(document.querySelectorAll('.panel-heading'), function(e) {
        e.addEventListener('click', function() {
            var panelbody = this.nextElementSibling;
            if(hasClass(panelbody, 'panel-body')) {
                if(hasClass(panelbody, 'hidden')) {
                    panelbody.className = 'panel-body';
                }
                else {
                    panelbody.className = 'panel-body hidden';
                }
            }
        })
    });
    
    
    
    
    
    /* Event handler for form: BACKUP */
    var form = document.querySelector("#manualbackup");
    var output = document.querySelector("#manualbackup_result");
    form.addEventListener("submit", function(e) {
        e.preventDefault();
        output.innerHTML = '<div class="loader"></div> Please wait while creating backup...';
        var formData = new FormData(form);
        var backuptypes = 'backup=';
        for(var [key, value] of formData.entries()) {
            backuptypes += value + '-';
        }
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (data) {
            if(xhr.readyState === 4) {
                if(xhr.status === 200) {
                    output.innerHTML = xhr.responseText;
                }
            }
        }
        xhr.open('POST', 'inc/function_backup.php');
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(backuptypes);
    });
    
    /* Dynamically disable checkbox in backup form based on selection */
    var checkbox_scorpion = document.querySelector('input[value=Scorpion]');
    var checkbox_content = document.querySelector('input[value=Content]');
    checkbox_scorpion.addEventListener("click", function(e) {
        if(checkbox_content.disabled === true) {
            checkbox_content.disabled = false;
        }
        else {
            checkbox_content.disabled = true;
        }
    });

    
});






function backup_start_full() {
    alert("Starting FULL backup.");
}
//function backup_start_incremental() {
//    alert("Starting INCREMENTAL backup.");
//}


function get_funny_quote() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (data) {
        if(xhr.readyState === 4) {
            if(xhr.status === 200) {
                var obj = JSON.parse(xhr.responseText);
                document.getElementById('funny-quote').innerHTML = obj['value']['joke'];
            }
        }
    }
    xhr.open('GET', 'http://api.icndb.com/jokes/random?limitTo=[nerdy]');
    xhr.send();
}




var hasClass = function (elem, className) {
    return new RegExp(' ' + className + ' ').test(' ' + elem.className + ' ');
}

var addClass = function (elem, className) {
    if (!hasClass(elem, className)) {
        elem.className += ' ' + className;
    }
}

var removeClass = function (elem, className) {
    var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, ' ') + ' ';
    if (hasClass(elem, className)) {
        while (newClass.indexOf(' ' + className + ' ') >= 0 ) {
            newClass = newClass.replace(' ' + className + ' ', ' ');
        }
        elem.className = newClass.replace(/^\s+|\s+$/g, '');
    }
}





/* Toggle functions for showing alerts */

function dont_show_again_missingMetaData() {
    localStorage.show_msg_missingMetaData = false;
    document.getElementById('infobox_missingMetaData').className += ' hidden';
}
function dont_show_again_betaNotice() {
    localStorage.show_msg_betaNotice = false;
    document.getElementById('infobox_betaNotice').className += ' hidden';
}
function dont_show_again_welcome() {
    localStorage.show_msg_welcome = false;
    document.getElementById('infobox_welcome').className += ' hidden';
}
function dont_show_again_backup() {
    localStorage.show_msg_backup = false;
    document.getElementById('infobox_backup').className += ' hidden';
}

function toggle_missingMetaData() {
    if(localStorage.show_msg_missingMetaData === "false") {
        localStorage.show_msg_missingMetaData = true;
        document.getElementById('state_missingMetaData').innerHTML = 'Show';
        document.getElementById('state_missingMetaData').className = "col-md-2 btn btn-success";
    }
    else {
        localStorage.show_msg_missingMetaData = false;
        document.getElementById('state_missingMetaData').innerHTML = 'Hide';
        document.getElementById('state_missingMetaData').className += "col-md-2 btn btn-danger";
    }
}
function toggle_betaNotice() {
    if(localStorage.show_msg_betaNotice === "false") {
        localStorage.show_msg_betaNotice = true;
        document.getElementById('state_betaNotice').innerHTML = 'Show';
        document.getElementById('state_betaNotice').className = "col-md-2 btn btn-success";
    }
    else {
        localStorage.show_msg_betaNotice = false;
        document.getElementById('state_betaNotice').innerHTML = 'Hide';
        document.getElementById('state_betaNotice').className = "col-md-2 btn btn-danger";
    }
}
function toggle_welcome() {
    if(localStorage.show_msg_welcome === "false") {
        localStorage.show_msg_welcome = true;
        document.getElementById('state_welcome').innerHTML = 'Show';
        document.getElementById('state_welcome').className = "col-md-2 btn btn-success";
    }
    else {
        localStorage.show_msg_welcome = false;
        document.getElementById('state_welcome').innerHTML = 'Hide';
        document.getElementById('state_welcome').className = "col-md-2 btn btn-danger";
    }
}
function toggle_backup() {
    if(localStorage.show_msg_backup === "false") {
        localStorage.show_msg_backup = true;
        document.getElementById('state_backup').innerHTML = 'Show';
        document.getElementById('state_backup').className = "col-md-2 btn btn-success";
    }
    else {
        localStorage.show_msg_backup = false;
        document.getElementById('state_backup').innerHTML = 'Hide';
        document.getElementById('state_backup').className = "col-md-2 btn btn-danger";
    }
}
function toggle_resetall() {
    localStorage.clear();
    document.getElementById('state_missingMetaData').innerHTML = 'Show';
    document.getElementById('state_betaNotice').innerHTML = 'Show';
    document.getElementById('state_welcome').innerHTML = 'Show';
    document.getElementById('state_backup').innerHTML = 'Show';
    document.getElementById('state_missingMetaData').className = "col-md-2 btn btn-success";
    document.getElementById('state_betaNotice').className = "col-md-2 btn btn-success";
    document.getElementById('state_welcome').className = "col-md-2 btn btn-success";
    document.getElementById('state_backup').className = "col-md-2 btn btn-success";
}





/* Charts */

function show_chart_visitors_monthly() {
    document.getElementById('visitors-monthly').className = 'btn btn-sm btn-primary';
    document.getElementById('visitors-weekly').className += 'btn btn-sm btn-default';
    var ctx = document.getElementById("chart-visitors");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: 'Unique visitors',
                data: [12, 19, 3, 5, 11, 8],
                fill: false,
                lineTension: 0,
                borderColor: "rgba(255, 153, 102, 1)",
                borderCapStyle: 'butt',
                pointBorderColor: "rgba(255, 153, 102, 1)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 8,
                pointHoverRadius: 15,
                pointHoverBackgroundColor: "rgba(255, 153, 102, 0.8)",
                pointHoverBorderColor: "rgba(255, 153, 102, 1)",
                pointHoverBorderWidth: 2,
                pointRadius: 2,
                pointHitRadius: 5
            }]
        },
        options: {
            legend: {
                display:false
            },
        }
    });
}

function show_chart_visitors_weekly() {
    document.getElementById('visitors-monthly').className = 'btn btn-sm btn-default';
    document.getElementById('visitors-weekly').className += 'btn btn-sm btn-primary';
    var ctx = document.getElementById("chart-visitors");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Monday", "Thirsday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
            datasets: [{
                label: 'Unique visitors',
                data: [1, 2, 5, 2, 3, 7, 5],
                fill: false,
                lineTension: 0,
                borderColor: "rgba(255, 153, 102, 1)",
                borderCapStyle: 'butt',
                pointBorderColor: "rgba(255, 153, 102, 1)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 8,
                pointHoverRadius: 15,
                pointHoverBackgroundColor: "rgba(255, 153, 102, 0.8)",
                pointHoverBorderColor: "rgba(255, 153, 102, 1)",
                pointHoverBorderWidth: 2,
                pointRadius: 2,
                pointHitRadius: 5
            }]
        },
        options: {
            legend: {
                display:false
            },
        }
    });
}

function show_chart_popular() {
    var ctx = document.getElementById("chart-popular");
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["/posts", "/post/hello-world", "/post/guide-to-programming", "/posts/world-of-warcraft", "/posts/hardware"],
            datasets: [{
                label: 'Unique visitors',
                data: [12, 19, 3, 5, 2],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)'
                ],
            }]
        }
    });
}

function show_chart_referrals() {
    var ctx = document.getElementById("chart-referrals");
    ctx.innerHTML = '<div class="list-group">' +
            '<a href="https://example.com/123/post456.html" target="_blank" class="list-group-item"><span class="badge">14</span>https://example.com/123/post456.html</a>' +
            '<a href="https://hello.org/lorem-ipsum-dolor-sit-amet" target="_blank" class="list-group-item"><span class="badge">6</span>https://hello.org/lorem-ipsum-dolor-sit-amet</a>' + 
            '<a href="https://world.info/foo/bar" target="_blank" class="list-group-item"><span class="badge">2</span>https://world.info/foo/bar</a>' + 
            '<a href="https://github.com/kek91/Scorpion" target="_blank" class="list-group-item"><span class="badge">1</span>https://github.com/kek91/Scorpion</a>' + 
            '<a href="https://github.com/kek91/Scorpion/tree/admin" target="_blank" class="list-group-item"><span class="badge">1</span>https://github.com/kek91/Scorpion/tree/admin</a>';
            '</div>';

}
