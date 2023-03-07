(function($) {

    $(document).ready(function() {
        
        //Initialize form rating.
        $(".my-rating").starRating({
            starSize: 25,
            disableAfterRate: false,
            callback: function(currentRating, $el){
                $('[name="book-rating"]').attr('value', currentRating);
            },
        });

        //Initialize comments rating.
        $(".comment-rating").starRating({
            starSize: 25,
            initialRating: $(this).data('rating'),
            readOnly: true,
        });

    });

})( jQuery );
