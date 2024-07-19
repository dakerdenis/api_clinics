document.addEventListener('DOMContentLoaded', function () {
    const cacheKey = 'clinicsCache';
    const cachedData = localStorage.getItem(cacheKey);

    if (cachedData) {
        displayClinics(JSON.parse(cachedData));
    } else {
        fetch('api.php')
            .then(response => response.json())
            .then(clinics => {
                if (clinics.error) {
                    console.error('API Error:', clinics.error);
                    console.error('Response:', clinics.response);
                    return;
                }

                // Sort clinics by NAME from A to Z
                clinics.sort((a, b) => a.NAME.localeCompare(b.NAME));

                // Cache the data
                localStorage.setItem(cacheKey, JSON.stringify(clinics));

                displayClinics(clinics);
            })
            .catch(error => console.error('Error fetching clinics:', error));
    }

    function displayClinics(clinics) {
        const container = document.getElementById('clinics-container');
        container.innerHTML = ''; // Clear any existing content

        clinics.forEach(clinic => {
            const mapLink = `https://www.google.com/maps?q=${clinic.LOCATION_Y},${clinic.LOCATION_X}`;
            const details = clinic.details ? clinic.details.DENTAL_CLINIC : {};

            const clinicDiv = document.createElement('div');
            clinicDiv.classList.add('clinic');
            clinicDiv.innerHTML = `
                <div>
                    <h2>${clinic.NAME}</h2>
                    <p>${details.WORK_ADR_FULL || ''}</p>
                    <p>${details.WORK_PHONE || ''}</p>
                </div>
                <a href="${mapLink}" class="map-link" target="_blank">
                    <img src="https://a-group.az/storage/uploaded_files/Gmza/map-icon.png" alt="Map">
                </a>
            `;
            container.appendChild(clinicDiv);
        });
    }
});
