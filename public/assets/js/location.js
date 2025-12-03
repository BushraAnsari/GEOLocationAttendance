$(document).ready(function() {
        if (navigator.geolocation) {

            navigator.geolocation.watchPosition(showPosition, showError, {
                enableHighAccuracy: true,
                maximumAge: 10000, // cache for 1 minute
                timeout: 20000 // wait for 5 seconds
            });
        } else {
            toastr.error('Geolocation is not supported by this browser.');
        }
    

    function showPosition(position) {
        const latitude = parseFloat(position.coords.latitude);
        const longitude = parseFloat(position.coords.longitude);
        const accuracy = position.coords.accuracy;  // Accuracy in meters
        //toastr.success('Location accuracy '+accuracy);

        if (accuracy <= 25) {  // You can adjust this threshold based on your requirements
           
        $('.latitude').val(latitude);
        $('.longitude').val(longitude);
        $('.latitude').html(latitude);
        $('.longitude').html(longitude);
    }
    else 
    toastr.error('Location accuracy is too low. Please try again.');
    
    }

    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                toastr.error('User denied the request for Geolocation.');
                break;
            case error.POSITION_UNAVAILABLE:
                toastr.error('Location information is unavailable.');
                break;
            case error.TIMEOUT:
                toastr.error('The request to get user location timed out.');
                break;
            case error.UNKNOWN_ERROR:
                toastr.error('An unknown error occurred.');
                break;
        }
    }
  
    toastr.options = {
            "closeButton": true,
            "positionClass": "toast-top-center",
            "timeOut": "3000",          // Duration for the toast to disappear
            "newestOnTop": true,        // Show newest toast on top
            
    };
    document.getElementById('location-button').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor click behavior
    
        // Check if Geolocation is supported
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                // Create the Google Maps link
                const googleMapsUrl = `https://www.google.com/maps?q=${latitude},${longitude}`;
                // Redirect to the Google Maps URL
                window.open(googleMapsUrl, '_blank');
            }, function() {
                alert('Unable to retrieve your location.');
            });
        } else {
            alert('Geolocation is not supported by this browser.');
        }
    });
});