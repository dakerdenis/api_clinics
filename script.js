document.addEventListener('DOMContentLoaded', function () {
    fetch('api.php')
        .then(response => response.json())
        .then(pharmacies => {
            if (pharmacies.error) {
                console.error('API Error:', pharmacies.error);
                console.error('Response:', pharmacies.response);
                return;
            }
            const container = document.getElementById('pharmacies-container');
            pharmacies.forEach(pharmacy => {
                const pharmacyDiv = document.createElement('div');
                pharmacyDiv.innerHTML = `
                    <h2>${pharmacy.NAME}</h2>
                    <p>ID: ${pharmacy.CUSTOMER_ID}</p>
                    <p>Location: (${pharmacy.LOCATION_X}, ${pharmacy.LOCATION_Y})</p>
                `;
                container.appendChild(pharmacyDiv);
            });
        })
        .catch(error => console.error('Error fetching pharmacies:', error));
});
