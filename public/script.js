document.addEventListener("DOMContentLoaded", () => {
    // Fonction pour mettre à jour l'heure
    function updateTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const formattedTime = `${hours}:${minutes}:${seconds}`;

        // Affiche l'heure dans l'élément avec l'ID currentTime
        document.getElementById("currentTime").textContent = `Heure actuelle : ${formattedTime}`;
    }

    // Mettre à jour l'heure toutes les secondes
    setInterval(updateTime, 1000);

    // Appeler une première fois la fonction pour afficher l'heure immédiatement
    updateTime();
});


document.addEventListener('DOMContentLoaded', function () {
    // Vérifier si le consentement aux cookies a été donné
    if (!document.cookie.includes('cookieConsent=true')) {
        // Show the popup
        document.getElementById('cookiePopup').style.display = 'block';

        // Action when user accepts cookies
        document.getElementById('acceptCookies').addEventListener('click', function () {
            document.cookie = "cookieConsent=true; path=/"; // Set cookie
            document.getElementById('cookiePopup').style.display = 'none';
        });

        // Action when user rejects cookies
        document.getElementById('rejectCookies').addEventListener('click', function () {
            document.cookie = "cookieConsent=false; path=/"; // Set cookie
            document.getElementById('cookiePopup').style.display = 'none';
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    var scrollToTopButton = document.getElementById('scrollToTop');

    // Afficher la flèche de remontée lorsqu'on défile
    window.addEventListener('scroll', function () {
        if (window.scrollY > 150) { // Afficher la flèche si l'utilisateur a défilé plus de 300px
            scrollToTopButton.style.display = 'block';
        } else {
            scrollToTopButton.style.display = 'none';
        }
    });

    // Action lors du clic sur la flèche remontante
    scrollToTopButton.addEventListener('click', function () {
        window.scrollTo({
            top: 0,
            behavior: 'smooth' // Remontée en douceur
        });
    });
});
