// Dummy data
const applications = [
    {
        id: 1,
        applicant_name: "John Doe",
        application_type: "Birth Certificate",
        submitted_date: "2024-03-15",
        status: "pending",
        details: "Birth certificate request for child born at Colombo General Hospital",
        feedback: "",
        nic: "199934567890",
        contact: "0771234567",
        address: "123 Main St, Colombo 03",
        documents: ["Birth Declaration.pdf", "Parents' NIC copies.pdf"]
    },
    {
        id: 2,
        applicant_name: "Sarah Silva",
        application_type: "Death Certificate",
        submitted_date: "2024-03-14",
        status: "more-info",
        details: "Death certificate request for father who passed away on 2024-02-28",
        feedback: "Please provide hospital discharge summary",
        nic: "196845678901",
        contact: "0777654321",
        address: "45 Church Road, Kandy",
        documents: ["Death Declaration.pdf"]
    },
    {
        id: 3,
        applicant_name: "Kumar Perera",
        application_type: "Marriage Certificate",
        submitted_date: "2024-03-13",
        status: "approved",
        details: "Marriage certificate request for ceremony held on 2024-01-15",
        feedback: "Approved. Certificate will be issued within 5 working days",
        nic: "199156789012",
        contact: "0718901234",
        address: "78 Beach Road, Galle",
        documents: ["Marriage Registration.pdf", "Witness Declarations.pdf"]
    },
    {
        id: 4,
        applicant_name: "Amara Fernando",
        application_type: "Land Certificate",
        submitted_date: "2024-03-12",
        status: "rejected",
        details: "Land ownership certificate request for property in Matara",
        feedback: "Submitted deed appears to be outdated. Please provide updated documentation.",
        nic: "198767890123",
        contact: "0765432109",
        address: "91 Hill Street, Matara",
        documents: ["Land Deed.pdf", "Survey Plan.pdf"]
    }
];

let selectedApplicationId = null;

// Initialize the application
document.addEventListener('DOMContentLoaded', function() {
    renderApplications();
    initializeModalHandlers();
});

// UI Rendering
function renderApplications() {
    const tbody = document.getElementById('applicationTableBody');
    tbody.innerHTML = '';

    applications.forEach(app => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${app.id}</td>
            <td>${app.applicant_name}</td>
            <td>${app.application_type}</td>
            <td>${formatDate(app.submitted_date)}</td>
            <td><span class="badge badge-${app.status}">${capitalizeFirstLetter(app.status)}</span></td>
            <td>
                <button class="btn btn-view" onclick="viewApplication(${app.id})">View</button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

// Modal Handlers
function initializeModalHandlers() {
    const modal = document.getElementById('applicationModal');
    const closeBtn = document.getElementsByClassName('close')[0];

    closeBtn.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

function viewApplication(id) {
    const application = applications.find(app => app.id === id);
    if (application) {
        selectedApplicationId = id;
        document.getElementById('modalApplicantName').value = application.applicant_name;
        document.getElementById('modalApplicationType').value = application.application_type;
        document.getElementById('modalSubmittedDate').value = formatDate(application.submitted_date);
        document.getElementById('modalDetails').value = application.details;
        document.getElementById('modalNIC').value = application.nic;
        document.getElementById('modalContact').value = application.contact;
        document.getElementById('modalAddress').value = application.address;
        document.getElementById('modalDocuments').innerHTML = application.documents
            .map(doc => `<li>${doc}</li>`)
            .join('');
        document.getElementById('modalFeedback').value = application.feedback;
        document.getElementById('applicationModal').style.display = "block";
    }
}

function handleAction(action) {
    if (!selectedApplicationId) return;

    const feedback = document.getElementById('modalFeedback').value;
    const applicationIndex = applications.findIndex(app => app.id === selectedApplicationId);
    
    if (applicationIndex !== -1) {
        applications[applicationIndex].status = action;
        applications[applicationIndex].feedback = feedback;
        
        renderApplications();
        document.getElementById('applicationModal').style.display = "none";
        selectedApplicationId = null;
        
        showToast(`Application ${action}`, 'success');
    }
}

// Utility Functions
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-GB'); // DD/MM/YYYY format
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function showToast(message, type) {
    const toast = document.getElementById('toast');
    toast.textContent = message;
    toast.className = `toast toast-${type}`;
    toast.style.opacity = 1;

    setTimeout(() => {
        toast.style.opacity = 0;
    }, 3000);
}