// Sample citizen data - Replace this with your actual database fetch
const citizensData = [
    {
        nic: '199534567890',
        name: 'Sarah Perera',
        age: 28,
        gender: 'Female',
        address: '123 Main St, Colombo',
        contact: '+94 71 234 5678',
        email: 'sarah.perera@email.com',
        district: 'Colombo'
    }
];

// Fetch citizen details by NIC
document.getElementById('fetchDetailsBtn').addEventListener('click', function () {
    const nicInput = document.getElementById('nic').value.trim();
    const citizen = citizensData.find(c => c.nic === nicInput);

    if (!citizen) {
        alert('Citizen not found. Please check the NIC number.');
        return;
    }

    populateCitizenTable(citizen);
});

// Populate table with existing and editable fields
function populateCitizenTable(citizen) {
    const tableBody = document.querySelector('#citizenTable tbody');
    tableBody.innerHTML = ''; // Clear any existing rows

    Object.keys(citizen).forEach(key => {
        if (key !== 'nic') {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${key.charAt(0).toUpperCase() + key.slice(1)}</td>
                <td>${citizen[key]}</td>
                <td><input type="text" placeholder="Enter new ${key}" data-field="${key}"></td>
            `;
            tableBody.appendChild(row);
        }
    });
}

// Update details
document.getElementById('updateBtn').addEventListener('click', function () {
    const nicInput = document.getElementById('nic').value.trim();
    const citizen = citizensData.find(c => c.nic === nicInput);

    if (!citizen) {
        alert('No citizen selected for update.');
        return;
    }

    const inputs = document.querySelectorAll('#citizenTable tbody input');
    inputs.forEach(input => {
        const field = input.getAttribute('data-field');
        const newValue = input.value.trim();
        if (newValue) {
            citizen[field] = newValue;
        }
    });

    alert('Citizen details updated successfully!');
    console.log('Updated Citizen:', citizen);
});
