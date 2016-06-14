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


});



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

function toggle_missingMetaData() {
    if(localStorage.show_msg_missingMetaData === "true") {
        localStorage.show_msg_missingMetaData = false;
        document.getElementById('state_missingMetaData').innerHTML = 'Hide';
    }
    else if(localStorage.show_msg_missingMetaData === "false") {
        localStorage.show_msg_missingMetaData = true;
        document.getElementById('state_missingMetaData').innerHTML = 'Show';
    }
}
function toggle_betaNotice() {
    if(localStorage.show_msg_betaNotice === "true") {
        localStorage.show_msg_betaNotice = false;
        document.getElementById('state_betaNotice').innerHTML = 'Hide';
    }
    else if(localStorage.show_msg_betaNotice === "false") {
        localStorage.show_msg_betaNotice = true;
        document.getElementById('state_betaNotice').innerHTML = 'Show';
    }
}
function toggle_welcome() {
    if(localStorage.show_msg_welcome === "true") {
        localStorage.show_msg_welcome = false;
        document.getElementById('state_welcome').innerHTML = 'Hide';
    }
    else if(localStorage.show_msg_welcome === "false") {
        localStorage.show_msg_welcome = true;
        document.getElementById('state_welcome').innerHTML = 'Show';
    }
}

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
