document.addEventListener('DOMContentLoaded', function () {
    const cacheKey = 'opticsCache';
    const cachedData = localStorage.getItem(cacheKey);

    if (cachedData) {
        displayOptics(JSON.parse(cachedData));
    } else {
        fetch('api.php')
            .then(response => response.json())
            .then(optics => {
                if (optics.error) {
                    console.error('API Error:', optics.error);
                    console.error('Response:', optics.response);
                    return;
                }

                // Sort optics by NAME from A to Z
                optics.sort((a, b) => a.NAME.localeCompare(b.NAME));

                // Cache the data
                localStorage.setItem(cacheKey, JSON.stringify(optics));

                displayOptics(optics);
            })
            .catch(error => console.error('Error fetching optics:', error));
    }

    function displayOptics(optics) {
        const container = document.getElementById('optics-container');
        container.innerHTML = ''; // Clear any existing content

        optics.forEach(optic => {
            const mapLink = `https://www.google.com/maps?q=${optic.LOCATION_Y},${optic.LOCATION_X}`;
            const details = optic.details ? optic.details.OPTIC : {};

            const opticDiv = document.createElement('div');
            opticDiv.classList.add('optic');
            opticDiv.innerHTML = `
                <div>
                    <h2>${optic.NAME}</h2>
                    <p>${details.WORK_ADR_FULL || ''}</p>
                    <p>${details.WORK_PHONE || ''}</p>
                </div>
                <a href="${mapLink}" class="map-link" target="_blank">
                    <img src="https://a-group.az/storage/uploaded_files/Gmza/map-icon.png" alt="Map">
                </a>
            `;
            container.appendChild(opticDiv);
        });
    }
});
