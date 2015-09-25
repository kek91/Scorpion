

function changeTimezone() {
    document.getElementById("header").style.display = "none";
    document.getElementById("timezone_box").style.display = "block";
    document.getElementById("select_timezone").focus();
}
function close_timezone_box() {
    document.getElementById("header").style.display = "block";
    document.getElementById("timezone_box").style.display = "none";
}




function hideDiv(object) {
    object.style.display = "none";
}


function changeBg(bg) {
    document.body.style.backgroundImage = "url('resources/bg/" + bg + ".jpg')";
}


function addZero(x, n) {
    if (x.toString().length < n) {
        x = "0" + x;
    }
    return x;
}


function refreshPage() {
    location.reload();
    var z = setTimeout(function(){
        refreshPage();
    },1000);
}


/* JavaScript autoComplete v1.0.2 - https://github.com/Pixabay/JavaScript-autoComplete */
var autoComplete=function(){function e(e){function t(e,t){return e.classList?e.classList.contains(t):new RegExp("\\b"+t+"\\b").test(e.className)}function s(e,t,s){e.attachEvent?e.attachEvent("on"+t,s):e.addEventListener(t,s)}function o(e,t,s){e.detachEvent?e.detachEvent("on"+t,s):e.removeEventListener(t,s)}function n(e,o,n,l){s(l||document,o,function(s){for(var o,l=s.target||s.srcElement;l&&!(o=t(l,e));)l=l.parentElement;o&&n.call(l,s)})}if(document.querySelector){var l={selector:0,source:0,minChars:3,delay:150,cache:1,menuClass:"",renderItem:function(e,t){t=t.replace(/[-\/\\^$*+?.()|[\]{}]/g,"\\$&");var s=new RegExp("("+t.split(" ").join("|")+")","gi");return'<div class="autocomplete-suggestion" data-val="'+e+'">'+e.replace(s,"<b>$1</b>")+"</div>"},onSelect:function(e,t,s){}};for(var c in e)e.hasOwnProperty(c)&&(l[c]=e[c]);for(var a="object"==typeof l.selector?[l.selector]:document.querySelectorAll(l.selector),u=0;u<a.length;u++){var i=a[u];i.sc=document.createElement("div"),i.sc.className="autocomplete-suggestions "+l.menuClass,i.setAttribute("data-sc",i.sc),i.autocompleteAttr=i.getAttribute("autocomplete"),i.setAttribute("autocomplete","off"),i.cache={},i.last_val="",i.updateSC=function(e,t){var s=i.getBoundingClientRect();if(i.sc.style.left=s.left+(window.pageXOffset||document.documentElement.scrollLeft)+"px",i.sc.style.top=s.bottom+(window.pageYOffset||document.documentElement.scrollTop)+1+"px",i.sc.style.width=s.right-s.left+"px",!e&&(i.sc.style.display="block",i.sc.maxHeight||(i.sc.maxHeight=parseInt((window.getComputedStyle?getComputedStyle(i.sc,null):i.sc.currentStyle).maxHeight)),i.sc.suggestionHeight||(i.sc.suggestionHeight=i.sc.querySelector(".autocomplete-suggestion").offsetHeight),i.sc.suggestionHeight))if(t){var o=i.sc.scrollTop,n=t.getBoundingClientRect().top-i.sc.getBoundingClientRect().top;n+i.sc.suggestionHeight-i.sc.maxHeight>0?i.sc.scrollTop=n+i.sc.suggestionHeight+o-i.sc.maxHeight:0>n&&(i.sc.scrollTop=n+o)}else i.sc.scrollTop=0},s(window,"resize",i.updateSC),document.body.appendChild(i.sc),n("autocomplete-suggestion","mouseleave",function(e){var t=i.sc.querySelector(".autocomplete-suggestion.selected");t&&setTimeout(function(){t.className=t.className.replace("selected","")},20)},i.sc),n("autocomplete-suggestion","mouseover",function(e){var t=i.sc.querySelector(".autocomplete-suggestion.selected");t&&(t.className=t.className.replace("selected","")),this.className+=" selected"},i.sc),n("autocomplete-suggestion","mousedown",function(e){if(t(this,"autocomplete-suggestion")){var s=this.getAttribute("data-val");i.value=s,l.onSelect(e,s,this),i.sc.style.display="none"}},i.sc),i.blurHandler=function(){try{var e=document.querySelector(".autocomplete-suggestions:hover")}catch(t){var e=0}e?i!==document.activeElement&&setTimeout(function(){i.focus()},20):(i.last_val=i.value,i.sc.style.display="none",setTimeout(function(){i.sc.style.display="none"},350))},s(i,"blur",i.blurHandler);var r=function(e){var t=i.value;if(i.cache[t]=e,e.length&&t.length>=l.minChars){for(var s="",o=0;o<e.length;o++)s+=l.renderItem(e[o],t);i.sc.innerHTML=s,i.updateSC(0)}else i.sc.style.display="none"};i.keydownHandler=function(e){var t=window.event?e.keyCode:e.which;if((40==t||38==t)&&i.sc.innerHTML){var s,o=i.sc.querySelector(".autocomplete-suggestion.selected");return o?(s=40==t?o.nextSibling:o.previousSibling,s?(o.className=o.className.replace("selected",""),s.className+=" selected",i.value=s.getAttribute("data-val")):(o.className=o.className.replace("selected",""),i.value=i.last_val,s=0)):(s=40==t?i.sc.querySelector(".autocomplete-suggestion"):i.sc.childNodes[i.sc.childNodes.length-1],s.className+=" selected",i.value=s.getAttribute("data-val")),i.updateSC(0,s),!1}if(27==t)i.value=i.last_val,i.sc.style.display="none";else if(13==t||9==t){var o=i.sc.querySelector(".autocomplete-suggestion.selected");o&&"none"!=i.sc.style.display&&(l.onSelect(e,o.getAttribute("data-val"),o),setTimeout(function(){i.sc.style.display="none"},20))}},s(i,"keydown",i.keydownHandler),i.keyupHandler=function(e){var t=window.event?e.keyCode:e.which;if((35>t||t>40)&&13!=t&&27!=t){var s=i.value;if(s.length>=l.minChars){if(s!=i.last_val){if(i.last_val=s,clearTimeout(i.timer),l.cache){if(s in i.cache)return void r(i.cache[s]);for(var o=1;o<s.length-l.minChars;o++){var n=s.slice(0,s.length-o);if(n in i.cache&&!i.cache[n].length)return void r([])}}i.timer=setTimeout(function(){l.source(s,r)},l.delay)}}else i.last_val=s,i.sc.style.display="none"}},s(i,"keyup",i.keyupHandler),i.focusHandler=function(e){i.last_val="\n",i.keyupHandler(e)},l.minChars||s(i,"focus",i.focusHandler)}this.destroy=function(){for(var e=0;e<a.length;e++){var t=a[e];o(window,"resize",t.updateSC),o(t,"blur",t.blurHandler),o(t,"focus",t.focusHandler),o(t,"keydown",t.keydownHandler),o(t,"keyup",t.keyupHandler),t.autocompleteAttr?t.setAttribute("autocomplete",t.autocompleteAttr):t.removeAttribute("autocomplete"),document.body.removeChild(t.sc),t=null}}}}return e}();!function(){"function"==typeof define&&define.amd?define("autoComplete",function(){return autoComplete}):"undefined"!=typeof module&&module.exports?module.exports=autoComplete:window.autoComplete=autoComplete}();