document.addEventListener('DOMContentLoaded', function () {
    const cacheKey = 'pharmaciesCache';
    const cachedData = localStorage.getItem(cacheKey);

    if (cachedData) {
        displayPharmacies(JSON.parse(cachedData));
    } else {
        fetch('api.php')
            .then(response => response.json())
            .then(pharmacies => {
                if (pharmacies.error) {
                    console.error('API Error:', pharmacies.error);
                    console.error('Response:', pharmacies.response);
                    return;
                }

                // Sort pharmacies by NAME from A to Z
                pharmacies.sort((a, b) => a.NAME.localeCompare(b.NAME));

                // Cache the data
                localStorage.setItem(cacheKey, JSON.stringify(pharmacies));

                displayPharmacies(pharmacies);
            })
            .catch(error => console.error('Error fetching pharmacies:', error));
    }

    function displayPharmacies(pharmacies) {
        const container = document.getElementById('pharmacies-container');
        container.innerHTML = ''; // Clear any existing content

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
    }
});
