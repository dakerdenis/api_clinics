document.addEventListener('DOMContentLoaded', function () {
    const cacheKey = 'hospitalsCache';
    const cachedData = localStorage.getItem(cacheKey);

    if (cachedData) {
        displayHospitals(JSON.parse(cachedData));
    } else {
        fetch('api.php')
            .then(response => response.json())
            .then(hospitals => {
                if (hospitals.error) {
                    console.error('API Error:', hospitals.error);
                    console.error('Response:', hospitals.response);
                    return;
                }

                // Sort hospitals by NAME from A to Z
                hospitals.sort((a, b) => a.NAME.localeCompare(b.NAME));

                // Cache the data
                localStorage.setItem(cacheKey, JSON.stringify(hospitals));

                displayHospitals(hospitals);
            })
            .catch(error => console.error('Error fetching hospitals:', error));
    }

    function displayHospitals(hospitals) {
        const container = document.getElementById('hospitals-container');
        container.innerHTML = ''; // Clear any existing content

        hospitals.forEach(hospital => {
            const mapLink = `https://www.google.com/maps?q=${hospital.LOCATION_Y},${hospital.LOCATION_X}`;
            const details = hospital.details ? hospital.details.HOSPITAL : {};

            const hospitalDiv = document.createElement('div');
            hospitalDiv.classList.add('hospital');
            hospitalDiv.innerHTML = `
                <div>
                    <h2>${hospital.NAME}</h2>
                    <p>${details.WORK_ADR_FULL || ''}</p>
                    <p>${details.WORK_PHONE || ''}</p>
                </div>
                <a href="${mapLink}" class="map-link" target="_blank">
                    <img src="https://a-group.az/storage/uploaded_files/Gmza/map-icon.png" alt="Map">
                </a>
            `;
            container.appendChild(hospitalDiv);
        });
    }
});
