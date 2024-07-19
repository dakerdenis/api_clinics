document.addEventListener('DOMContentLoaded', function () {
    fetch('api.php')
        .then(response => response.json())
        .then(hospitals => {
            if (hospitals.error) {
                console.error('API Error:', hospitals.error);
                console.error('Response:', hospitals.response);
                return;
            }
            const container = document.getElementById('hospitals-container');
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
        })
        .catch(error => console.error('Error fetching hospitals:', error));
});
