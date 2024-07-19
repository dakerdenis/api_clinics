document.addEventListener('DOMContentLoaded', function () {
    fetch('api.php')
        .then(response => response.json())
        .then(optics => {
            if (optics.error) {
                console.error('API Error:', optics.error);
                console.error('Response:', optics.response);
                return;
            }
            const container = document.getElementById('optics-container');
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
        })
        .catch(error => console.error('Error fetching optics:', error));
});
