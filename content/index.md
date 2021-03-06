/*
Title: Scorpion CMS - Modern flat file CMS for websites
Description: Scorpion CMS is a modern flat-file based content management systems
Author: Scorpion
Date: 2015/09/30
Type: page
*/


<div class="bss-slides">

    <figure>
        <img src="themes/default/images/scorpion-ss1.png" width="100%">
    </figure>

    <figure>
        <img src="themes/default/images/scorpion-ss2.png" width="100%">
    </figure>

</div> 


<h1 class="indexh1">A better way to manage your websites</h1>


<div id="features">

    <p>
    <i class="icon-database"></i><br>
    Flat-file based, no database needed
    </p>

    <p>
    <i class="icon-websitebuilder"></i><br>
    Easy to install<br>and configure
    </p>

    <p>
    <i class="icon-edit"></i><br>
    Powerful editor &amp; administration
    </p>

    <div class="clearboth"></div>

    <p>
    <i class="icon-speed"></i><br>
    Extremely fast<br>and lightweight
    </p>

    <p>
    <i class="icon-code"></i><br>
    Scorpion is open source
    </p>

    <p>
    <i class="icon-code"></i><br>
    Scorpion is open source
    </p>

    <div class="clearboth"></div>

</div>

<br><br>

<div style="width:430px; padding:10px; margin:0 auto; text-align:center;">
    <b style=text-align:center;">Markdown editor quick example</b><br><br>
    This code:<br><br>
<pre>
| Look   | How          | Easy  | This  | Is    |
|--------|--------------|-------|-------|-------|
| 1      | Awesome      | Hello | Yes   | Lorem |
| 2      | Cool         | Hi    | Yeah  | Ipsum |
| 3      | That rocks   | Hey   | Yay   | Lorem |
| 4      | Awesome      | Hello | Yes   | Lorem |
| 5      | Cool         | Hi    | Yeah  | Ipsum |
| 6      | That rocks   | Hey   | Yay   | Lorem |
</pre>
</div>

<div style="width:370px; padding:10px; margin:0 auto;" markdown="1">

<p style="text-align:center;">Produces this:</p><br>


| Look   | How          | Easy  | This  | Is    |
|--------|--------------|-------|-------|-------|
| 1      | Awesome      | Hello | Yes   | Lorem |
| 2      | Cool         | Hi    | Yeah  | Ipsum |
| 3      | That rocks   | Hey   | Yay   | Lorem |
| 4      | Awesome      | Hello | Yes   | Lorem |
| 5      | Cool         | Hi    | Yeah  | Ipsum |
| 6      | That rocks   | Hey   | Yay   | Lorem |
</div>

<script>
var makeBSS=function(a,b){var c=document.querySelectorAll(a),d={},e={init:function(a,b){this.counter=0,this.el=a,this.$items=a.querySelectorAll("figure"),this.numItems=this.$items.length,b=b||{},b.auto=b.auto||!1,this.opts={auto:"undefined"==typeof b.auto?!1:b.auto,speed:"undefined"==typeof b.auto.speed?1500:b.auto.speed,pauseOnHover:"undefined"==typeof b.auto.pauseOnHover?!1:b.auto.pauseOnHover,fullScreen:"undefined"==typeof b.fullScreen?!1:b.fullScreen,swipe:"undefined"==typeof b.swipe?!1:b.swipe},this.$items[0].classList.add("bss-show"),this.injectControls(a),this.addEventListeners(a),this.opts.auto&&this.autoCycle(this.el,this.opts.speed,this.opts.pauseOnHover),this.opts.fullScreen&&this.addFullScreen(this.el),this.opts.swipe&&this.addSwipe(this.el)},showCurrent:function(a){this.counter=a>0?this.counter+1===this.numItems?0:this.counter+1:this.counter-1<0?this.numItems-1:this.counter-1,[].forEach.call(this.$items,function(a){a.classList.remove("bss-show")}),this.$items[this.counter].classList.add("bss-show")},injectControls:function(a){var b=document.createElement("span"),c=document.createElement("span"),d=document.createDocumentFragment();b.classList.add("bss-prev"),c.classList.add("bss-next"),b.innerHTML="&laquo;",c.innerHTML="&raquo;",d.appendChild(b),d.appendChild(c),a.appendChild(d)},addEventListeners:function(a){var b=this;a.querySelector(".bss-next").addEventListener("click",function(){b.showCurrent(1)},!1),a.querySelector(".bss-prev").addEventListener("click",function(){b.showCurrent(-1)},!1),a.onkeydown=function(a){a=a||window.event,37===a.keyCode?b.showCurrent(-1):39===a.keyCode&&b.showCurrent(1)}},autoCycle:function(a,b,c){var d=this,e=window.setInterval(function(){d.showCurrent(1)},b);c&&(a.addEventListener("mouseover",function(){e=clearInterval(e)},!1),a.addEventListener("mouseout",function(){e=window.setInterval(function(){d.showCurrent(1)},b)},!1))},addFullScreen:function(a){var b=this,c=document.createElement("span");c.classList.add("bss-fullscreen"),a.appendChild(c),a.querySelector(".bss-fullscreen").addEventListener("click",function(){b.toggleFullScreen(a)},!1)},addSwipe:function(a){var b=this,c=new Hammer(a);c.on("swiperight",function(){b.showCurrent(-1)}),c.on("swipeleft",function(){b.showCurrent(1)})},toggleFullScreen:function(a){document.fullscreenElement||document.mozFullScreenElement||document.webkitFullscreenElement||document.msFullscreenElement?document.exitFullscreen?document.exitFullscreen():document.msExitFullscreen?document.msExitFullscreen():document.mozCancelFullScreen?document.mozCancelFullScreen():document.webkitExitFullscreen&&document.webkitExitFullscreen():document.documentElement.requestFullscreen?a.requestFullscreen():document.documentElement.msRequestFullscreen?a.msRequestFullscreen():document.documentElement.mozRequestFullScreen?a.mozRequestFullScreen():document.documentElement.webkitRequestFullscreen&&a.webkitRequestFullscreen(a.ALLOW_KEYBOARD_INPUT)}};[].forEach.call(c,function(a){d=Object.create(e),d.init(a,b)})};
makeBSS('.bss-slides');
</script>