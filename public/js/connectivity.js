// Check internet connectivity and handle offline mode
document.addEventListener('DOMContentLoaded', function() {
    // Check internet connectivity on page load
    checkInternetConnection();

    // Add event listeners for online/offline events
    window.addEventListener('online', handleOnlineStatus);
    window.addEventListener('offline', handleOfflineStatus);

    // Add click event to the "No Internet Connection" text
    const noInternetText = document.getElementById('no-internet-text');
    if (noInternetText) {
        noInternetText.addEventListener('click', function(e) {
            e.preventDefault();
            openFlappyBird();
        });
    }
});

// Function to check internet connection
function checkInternetConnection() {
    if (!navigator.onLine) {
        handleOfflineStatus();
    }
}

// Handle online status
function handleOnlineStatus() {
    console.log('Back online');
}

// Handle offline status
function handleOfflineStatus() {
    console.log('No internet connection');
    // Open flappybird.html in a new tab when offline
    openFlappyBird();
}

// Function to open the Flappy Bird game in a new tab
function openFlappyBird() {
    window.open('/flappbird_finaltest/flappybird.html', '_blank');
}
