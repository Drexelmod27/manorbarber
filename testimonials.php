<div id ="contact" ></div>
<div class="l-grid--contain">
    <div class="c-contact">
        <h1 class="c-contact_header">Testimonials</h1>
        <div id="google-reviews"></div>

            <link rel="stylesheet" href="https://cdn.rawgit.com/stevenmonson/googleReviews/master/google-places.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/gh/stevenmonson/googleReviews@6e8f0d794393ec657dab69eb1421f3a60add23ef/google-places.js"></script>
            <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDeivU57j-macv2fXXgbhKGM6cqMLmnAFI&signed_in=true&libraries=places"></script>

            <script>
            jQuery(document).ready(function( $ ) {
            $("#google-reviews").googlePlaces({
                    placeId: 'ChIJp2QxV_sJVFMR1DEp1x_16F8' //Find placeID @: https://developers.google.com/places/place-id
                , render: ['reviews']
                , min_rating: 4
                , max_rows:4
            });
            });
            </script>
    </div>
</div>