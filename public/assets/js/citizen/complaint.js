// Store complaints in localStorage

window.onload = function () {

    document.getElementById('viewTab').addEventListener('click',
        () => showTab('view')
    );
    document.getElementById('submitTab').addEventListener('click',
        () => showTab('submit')
    );
    document.getElementById('visitRequestTab').addEventListener('click',
        () => showTab('visitRequest')
    );  
}


function showTab(tabName) {
    document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));

    
    if (tabName === 'view') {
        document.getElementById('viewTab').classList.add('active');
        document.getElementById('viewComplaints').style.display = 'block';
        document.getElementById('submitComplaint').style.display = 'none';
        document.getElementById('visitRequest').style.display = 'none';
        loadComplaints?.();
    } else if (tabName === 'visitRequest') {
        document.getElementById('visitRequestTab').classList.add('active'); 
        document.getElementById('visitRequest').style.display = 'block';
        document.getElementById('viewComplaints').style.display = 'none';
        document.getElementById('submitComplaint').style.display = 'none';
        
    }else{
        document.getElementById('submitTab').classList.add('active');
        document.getElementById('viewComplaints').style.display = 'none';
        document.getElementById('submitComplaint').style.display = 'block';
        document.getElementById('visitRequest').style.display = 'none';
        
    }
}




function closeModal() {
    document.getElementById('complaintModal').style.display = 'none';
}

// Close modal when clicking outside of it
window.onclick = function(event) {
    const modal = document.getElementById('complaintModal');
    if (event.target === modal) {
        closeModal();
    }
}



function openModal(id) {
    fetch(`${BASE_URL}/citizen/Complaint/getComplaintDetails/${id}`)
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                console.log(data);
                const complaint = data.complaint;
                const images = data.images || [];
                const modalContent = document.getElementById('modalContent');
                let imagesHtml = '';
                if(images && images.length > 0){  
                    imagesHtml = '<div><label>Uploaded Images: </label><div class="images-grid">';
                    
                    images.forEach(img => {
                        // Adjust the path if needed
                        imagesHtml += `<img src="${BASE_URL}/${img.image_path}" style="width:100px; margin:5px;">`;
                    });
                    imagesHtml += '</div></div>';
                }
                modalContent.innerHTML = `
                    <h3 style=align: center;>Complaint Details </h3><br>
                    <label>Complaint Date:</label>
                    <input type="text" value="${complaint.date}" readonly>
                    <label>Complaint Time:</label>
                    <input type="text" value="${complaint.time}" readonly>
                    <label>Complaint Category:</label>
                    <input type="text" value="${complaint.complaint_category}" readonly>
                    <label>Complaint Description:</label>
                    <textarea readonly>${complaint.complaint_description}</textarea>
                    <label>Status:</label>
                    <input type="text" value="${complaint.status}" readonly>
                    ${imagesHtml}
                   
                `;
                document.getElementById('complaintModal').style.display = 'block';
            } else {
                alert("Complaint not found.");
            }
        })
        .catch(err => {
            console.error(err);
            alert("Error loading complaint.");
        });
}


function closeModal() {
    document.getElementById("complaintModal").style.display = "none";
}

window.addEventListener('DOMContentLoaded', () => {
    const dateInput = document.getElementById('date');
    const timeInput = document.getElementById('time');
    const now = new Date();

    //format data as YYYY-MM-DD

    const year = now.getFullYear();
    const month = String(now.getMonth() +1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    dateInput.value = `${year}-${month}-${day}`;

    const hours =String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    timeInput.value = `${hours}:${minutes}`;
});

let selectedImages = [];

document.getElementById('imageUpload').addEventListener('change', function (e) {
    const newFiles = Array.from(e.target.files);

    // Add newly selected files to existing list
    selectedImages.push(...newFiles);

    // Clear previous previews
    document.getElementById('previewContainer').innerHTML = '';

    selectedImages.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function (event) {
            const img = document.createElement('img');
            img.src = event.target.result;
            img.style.width = '100px';
            img.style.margin = '10px';
            document.getElementById('previewContainer').appendChild(img);
        };
        reader.readAsDataURL(file);
    });

    // Create a new DataTransfer object to re-populate input with all files
    const dataTransfer = new DataTransfer();
    selectedImages.forEach(file => dataTransfer.items.add(file));
    document.getElementById('imageUpload').files = dataTransfer.files;
});






