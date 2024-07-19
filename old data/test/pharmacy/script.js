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
                const mapLink = `https://www.google.com/maps?q=${pharmacy.LOCATION_Y},${pharmacy.LOCATION_X}`;
                const details = pharmacy.details ? pharmacy.details.PHARMACY : {};

                const pharmacyDiv = document.createElement('div');
                pharmacyDiv.classList.add('pharmacy');
                pharmacyDiv.innerHTML = `
                    <div>
                        <h2>${pharmacy.NAME}</h2>
                        <p>${details.WORK_ADR_FULL || ''}</p>
                        <p>${details.WORK_PHONE || ''}</p>
                    </div>
                    <a href="${mapLink}" class="map-link" target="_blank">
                        <img src="https://a-group.az/storage/uploaded_files/Gmza/map-icon.png">
                    </a>
                `;
                container.appendChild(pharmacyDiv);
            });
        })
        .catch(error => console.error('Error fetching pharmacies:', error));
});
