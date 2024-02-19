{{-- Google Recaptcha v3 --}}
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    function onRecaptchaSubmit(token) {
        document.getElementById("feedback-form").submit();
    }
</script>


{{-- Google Maps --}}
<script>
    let map;

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: 38.578065,
                lng: 68.750778
            },
            zoom: 16,
            mapTypeControl: false,
            streetViewControl: false
        });

        marker = new google.maps.Marker({
            map: map,
            draggable: false,
            animation: google.maps.Animation.BOUNCE,
            position: {
                lat: 38.578065,
                lng: 68.750778
            },
            icon: '/img/main/marker.png'
        });
        marker.addListener('click', toggleBounce);
    }

    function toggleBounce() {
        if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAneCOkP0fjY3gOXV9DYFTdA59yWXDvNLw&loading=async&callback=initMap"></script>
