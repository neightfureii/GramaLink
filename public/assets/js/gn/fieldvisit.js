document.addEventListener('DOMContentLoaded', function() {
    if(window.location.hash === '#today-schedule') {
        showSection('today-schedule');
    }else{
        showSection('new-request');
    }
});

// Tab switching functionality
function showSection(sectionId) {
    // Hide all sections
    document.querySelectorAll('.section').forEach(section => {
        section.classList.remove('active');
    });
    // Show selected section
    const sectionElem = document.getElementById(sectionId);
    if (sectionElem) {
        sectionElem.classList.add('active');
    }
    // Update tab styling
    document.querySelectorAll('.tab').forEach(tab => {
        tab.classList.remove('active');
        if(tab.getAttribute('onclick') && tab.getAttribute('onclick').includes(sectionId)) {
            tab.classList.add('active');
        }
    });
    if(event && event.target) {
        event.target.classList.add('active');
    }
}

function renderScheduleList() {
    const container = document.getElementById('schedule-list');
    if(!container) return;
    container.innerHTML = '';
    console.log('todayvisit :', todayVisit);
    if(!Array.isArray(todayVisit) || todayVisit.length === 0){
        container.innerHTML ='<p>No visits scheduled for today.</p>';
        return;
    }

    todayVisit.forEach((visit, idx) => {
        const card = document.createElement('div');
        card.className = 'visit-card';
        card.innerHTML =`
        <p>Time : ${visit.visit_time || ''}</p>
        <p>Address: ${visit.Address || ''}</p>`;
        container.appendChild(card);
    });
}

document.addEventListener('DOMContentLoaded', renderScheduleList); 
// Initialize Google Maps

function cleanAddress(address) {
    return address.replace(/^[^,]+,\s*/, '');
}
  

function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
        center: { lat: 7.8731, lng: 80.7718 } ,
        mapTypeId: 'roadmap'// Center of India as fallback
    });
    // If no visits, just show current location marker
    if (!Array.isArray(todayVisit) || todayVisit.length === 0) {
        navigator.geolocation.getCurrentPosition((position) => {
            const userLocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            map.setCenter(userLocation);
            new google.maps.Marker({
                position: userLocation,
                map: map,
                title: "Your Current Location"
            });
        });
        // Optionally clear route stats and schedule
        document.getElementById('route-stats').innerHTML = '';
        document.getElementById('schedule-list').innerHTML = '<p>No visits scheduled for today.</p>';
        return;
    }
    const scheduleContainer = document.getElementById('schedule-list');
    scheduleContainer.innerHTML = '';
    const directionsService = new google.maps.DirectionsService();
    const directionsRenderer = new google.maps.DirectionsRenderer({ suppressMarkers: false });
    directionsRenderer.setMap(map);

    navigator.geolocation.getCurrentPosition(async (position) => {
        const userLocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
        };

        const geocoder = new google.maps.Geocoder();

        try {
            const addressLocations = await Promise.all(
                todayVisit.map(item => geocodeAddress(geocoder, item.Address))
            );

            // Sort addresses by distance from user's current location
            const sortedLocations = addressLocations.sort((a, b) =>
                getDistance(userLocation, a.location) - getDistance(userLocation, b.location)
            );

            // Prepare destination and waypoints
            let destination = sortedLocations[0].location;
            let waypoints = [];

            if (sortedLocations.length > 1) {
                waypoints = sortedLocations.slice(0, sortedLocations.length - 1).map(addr => ({
                    location: addr.location,
                    stopover: true
                }));
                destination = sortedLocations[sortedLocations.length - 1].location;
            }

            directionsService.route({
                origin: userLocation,
                destination: destination,
                waypoints: waypoints,
                optimizeWaypoints: false, // Keep your custom nearest-first order
                travelMode: google.maps.TravelMode.DRIVING
            }, (response, status) => {
                if (status === "OK") {
                    directionsRenderer.setDirections(response);

                    const route = response.routes[0];
                    let totalDuration = 0;

                    // List each step
                    route.legs.forEach((leg, index) => {
                        totalDuration += leg.duration.value;
                        const card = document.createElement('div');
                        
                        card.className = 'visit-card';
                        card.innerHTML = `
                        <h3>Step ${index + 1}</h3>
                        <p><strong>From:</strong>${cleanAddress(leg.start_address)}</p>
                        <p><strong>To:</strong> ${cleanAddress(leg.end_address)}</p>
                        <p><strong>Duration:</strong> ${leg.duration.text}</p>
                        <div class="card-action">
                            <button class="done-btn" data-visit-id="${todayVisit[index].id}" data-complaint-id="${todayVisit[index].complaint_id || '' }" manualid="${todayVisit[index].idnamual || ''}" style="flot: right; margin-top: 10px;">Done</button>
                            </div>`;
                        scheduleContainer.appendChild(card);
                    });

                    

                    const routeStats = document.getElementById('route-stats');
                        if (routeStats) {
                            const totalMinutes = Math.round(totalDuration / 60);
                            let totalDistance = 0;
                            route.legs.forEach(leg => {
                                totalDistance += leg.distance.value; // in meters
                            });
                            routeStats.innerHTML = `
                                <p><strong>Total Distance:</strong> ${(totalDistance / 1000).toFixed(2)} km</p>
                                <p><strong>Estimated Time:</strong> ${Math.floor(totalMinutes / 60)} hrs ${totalMinutes % 60} mins</p>
                            `;
}
                    console.log("Total Estimated Time:", Math.round(totalDuration / 60), "mins");
                } else {
                    alert("Directions request failed due to " + status);
                }
            });

        } catch (err) {
            console.error("Geocoding error:", err);
        }
    });
}

    function geocodeAddress(geocoder, address) {
        return new Promise((resolve, reject) => {
            geocoder.geocode({ address: address }, (results, status) => {
                if (status === "OK") {
                    resolve({ address: address, location: results[0].geometry.location });
                } else {
                    reject("Geocode failed: " + status + " for address: " + address);
                }
            });
        });
    }

    function getDistance(loc1, loc2) {
        const rad = Math.PI / 180;
        const dLat = (loc2.lat() - loc1.lat) * rad;
        const dLng = (loc2.lng() - loc1.lng) * rad;
        const a = Math.sin(dLat/2)**2 + Math.cos(loc1.lat * rad) * Math.cos(loc2.lat() * rad) * Math.sin(dLng/2)**2;
        return 6371 * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a)); // Haversine
    }

    


// Initialize map when page loads
window.onload = initMap;


document.addEventListener('click', function(e){
    if(e.target.classList.contains('done-btn')){
        const visitId = e.target.getAttribute('data-visit-id');
        const complaint_id = e.target.getAttribute('data-complaint-id');
        const manualid = e.target.getAttribute('manualid');
        if(manualid){
            fetch(`${ROOT}/gn/fieldvisit/deletemanualvisit/${manualid}`, {
                method: 'POST',
                headers: {
                    'Content-Type' : 'application/json'
                },
                
        })
        .then(res => res.json())
        .then(data =>{
            if(data.status === 'success'){
                e.target.closest('.visit-card').remove();
                window.location.hash = '#today-schedule';
                window.location.reload();
                // initMap();
            }else{
                alert('failed to delete visit' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting visit');
        });
    }else if(visitId){

        fetch(`${ROOT}/gn/fieldvisit/deletevisit/${visitId}`, {
            method: 'POST',
            headers: {
                'Content-Type' : 'application/json'
            },
            body: JSON.stringify({ complaint_id: complaint_id })
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'success'){
                e.target.closest('.visit-card').remove();
                window.location.hash = '#today-schedule';
                window.location.reload();
                initMap();
            }else{
                alert('failed to delete visit' + data.message);
            }
        })
        .catch(error =>{
            console.error('Error:', error);
            alert('Error deleting visit');
        });
    }
}
});


// Simple script to handle NIC input and show citizen details
document.querySelector('input[type="text"]').addEventListener('input', function() {
    if(this.value.length >= 10) { // NIC number length check
        document.querySelector('.citizen-details').classList.add('visible');
    } else {
        document.querySelector('.citizen-details').classList.remove('visible');
    }
});
