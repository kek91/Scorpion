document.addEventListener('DOMContentLoaded', function() {
    
    /* Support for closing alert boxes */
    [].forEach.call(document.querySelectorAll('.close'), function(e) {
        e.addEventListener('click', function() {
            this.parentNode.className += ' hidden';
        })
    });


});