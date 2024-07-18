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
                    <h2>${pharmacy.basic.NAME}</h2>
                    <p>ID: ${pharmacy.basic.CUSTOMER_ID}</p>
                    <p>Location: (${pharmacy.basic.LOCATION_X}, ${pharmacy.basic.LOCATION_Y})</p>
                    <div>
                        <h3>Details:</h3>
                        <pre>${JSON.stringify(pharmacy.details, null, 2)}</pre>
                    </div>
                `;
                container.appendChild(pharmacyDiv);
            });
        })
        .catch(error => console.error('Error fetching pharmacies:', error));
});
