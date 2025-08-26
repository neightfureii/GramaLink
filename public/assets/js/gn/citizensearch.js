// Sample citizen data (replace with actual data from your backend)
const sampleCitizens = [
    {
        id: 1,
        name: "John Perera",
        nic: "199856741V",
        gender: "male",
        age: 25,
        district: "colombo"
    },
    {
        id: 2,
        name: "Sarah Silva",
        nic: "199756123V",
        gender: "female",
        age: 26,
        district: "gampaha"
    },
    // Add more sample data as needed
];

function performSearch() {
    const searchInput = document.getElementById('search-input').value.trim();
    const genderFilter = document.getElementById('genderFilter').value;
    const ageFilter = document.getElementById('ageFilter').value;
    const districtFilter = document.getElementById('districtFilter').value;
    const resultsSection = document.getElementById('resultsSection');
    const citizenTable = document.getElementById('citizenTable').getElementsByTagName('tbody')[0];

    // Clear previous results
    citizenTable.innerHTML = '';

    // Filter citizens based on search criteria
    let filteredCitizens = sampleCitizens.filter(citizen => {
        const matchesNIC = citizen.nic.toLowerCase().includes(searchInput.toLowerCase());
        const matchesGender = genderFilter === 'none' || citizen.gender === genderFilter;
        const matchesDistrict = districtFilter === 'none' || citizen.district === districtFilter;
        
        // Age filter logic
        let matchesAge = true;
        if (ageFilter !== 'none') {
            const [minAge, maxAge] = ageFilter.split('-').map(num => parseInt(num));
            if (maxAge) {
                matchesAge = citizen.age >= minAge && citizen.age <= maxAge;
            } else {
                matchesAge = citizen.age >= minAge;
            }
        }

        return matchesNIC && matchesGender && matchesDistrict && matchesAge;
    });

    if (filteredCitizens.length === 0) {
        // Show no results message
        citizenTable.innerHTML = `
            <tr>
                <td colspan="3" class="no-results">
                    No citizens found matching your search criteria
                </td>
            </tr>`;
    } else {
        // Display results
        filteredCitizens.forEach(citizen => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${citizen.name}</td>
                <td>${citizen.nic}</td>
                <td>
                    <button class="view-more-btn" onclick="updateCitizen(${citizen.id})">
                        Update Details
                    </button>
                </td>
            `;
            citizenTable.appendChild(row);
        });
    }

    // Show results section with animation
    resultsSection.style.display = 'block';
    setTimeout(() => {
        resultsSection.classList.add('active');
    }, 10);
}

function updateCitizen(citizenId) {
    // Redirect to the update page with the citizen ID
    window.location.href = `updatecitizen?id=${citizenId}`;
}

// Add event listener for enter key in search input
document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        performSearch();
    }
});

// Optional: Add debounce to search for better performance
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Optional: Initialize the search results as empty when the page loads
document.addEventListener('DOMContentLoaded', () => {
    const resultsSection = document.getElementById('resultsSection');
    resultsSection.style.display = 'none';
    resultsSection.classList.remove('active');
});