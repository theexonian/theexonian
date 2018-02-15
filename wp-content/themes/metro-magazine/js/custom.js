jQuery(document).ready(function($){
    
        $('#site-navigation').slicknav({
            label: "MENU", 
            prependTo:'.nav-content'
        });

        $('.secondary-menu').slicknav({
            label: '', 
            prependTo:'.header-t'
        });

        /* Equal Height */
        $('.section-two.top-news .post').matchHeight({
            byRow: true,
            property: 'height',
            target: null,
            remove: false
        });

    
        // Get the modal
        var modal = document.getElementById('formModal');
        
        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");
        
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        
        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        };
        
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        };
        
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };


});