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

        //Initialize the price slider.
        $( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: 500,
            values: [ $( "#min-price" ).val(), $( "#max-price" ).val() ],
            slide: function( event, ui ) {
              $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
              $( "#min-price" ).val( ui.values[0] );
              $( "#max-price" ).val( ui.values[1] );
            }
          });
          $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
            " - $" + $( "#slider-range" ).slider( "values", 1 ) );

    });

})( jQuery );
