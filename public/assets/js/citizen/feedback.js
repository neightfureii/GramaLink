// Feedback status constants
const FEEDBACK_STATUS = {
    SUBMITTED: 'Submitted',
    DELIVERED: 'Delivered',
    SEEN: 'Seen',
    IN_PROGRESS: 'In Progress',
    COMPLETED: 'Completed'
};

// Store for feedback submissions
let feedbackStore = [];

class FeedbackSubmission {
    constructor(data, files) {
        this.id = Date.now().toString();
        this.data = data;
        this.files = files;
        this.submittedAt = new Date();
        this.status = FEEDBACK_STATUS.SUBMITTED;
        this.statusHistory = [{
            status: FEEDBACK_STATUS.SUBMITTED,
            timestamp: new Date()
        }];
    }

    updateStatus(newStatus) {
        this.status = newStatus;
        this.statusHistory.push({
            status: newStatus,
            timestamp: new Date()
        });
    }
}

// File handling
document.addEventListener('DOMContentLoaded', () => {
    const fileInput = document.querySelector('input[type="file"]');
    const attachBtn = document.querySelector('.attach-btn');
    const form = document.querySelector('.feedback-form');
    const fileList = document.createElement('div');
    fileList.className = 'file-list';
    form.insertBefore(fileList, document.querySelector('.button-group'));

    let attachedFiles = [];

    fileInput.addEventListener('change', (e) => {
        const files = Array.from(e.target.files);
        attachedFiles = [...attachedFiles, ...files];
        updateFileList();
    });

    function updateFileList() {
        fileList.innerHTML = '';
        attachedFiles.forEach((file, index) => {
            const fileItem = document.createElement('div');
            fileItem.className = 'file-item';
            fileItem.innerHTML = `
                <span>${file.name}</span>
                <button type="button" class="remove-file" data-index="${index}">
                    <i class="fas fa-times"></i>
                </button>
            `;
            fileList.appendChild(fileItem);
        });

        // Add styles to file list
        const style = document.createElement('style');
        style.textContent = `
            .file-list {
                margin-top: 10px;
            }
            .file-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 5px 10px;
                background: #f5f5f5;
                border-radius: 5px;
                margin-bottom: 5px;
            }
            .remove-file {
                background: none;
                border: none;
                color: #ff4444;
                cursor: pointer;
                padding: 2px 5px;
            }
            .remove-file:hover {
                transform: none;
                box-shadow: none;
            }
        `;
        document.head.appendChild(style);
    }

    // Remove file handling
    fileList.addEventListener('click', (e) => {
        if (e.target.closest('.remove-file')) {
            const index = e.target.closest('.remove-file').dataset.index;
            attachedFiles.splice(index, 1);
            updateFileList();
        }
    });

    // Form submission
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        // Gather form data
        const formData = new FormData(form);
        const submissionData = {
            name: formData.get('name'),
            email: formData.get('email'),
            gnOfficer: formData.get('gnOfficer'),
            rating: formData.get('rating'),
            feedback: formData.get('feedback')
        };

        // Create new feedback submission
        const submission = new FeedbackSubmission(submissionData, attachedFiles);
        feedbackStore.push(submission);

        // Show success message
        showNotification('Feedback submitted successfully!');
        
        // Redirect to status page
        setTimeout(() => {
            redirectToStatusPage(submission.id);
        }, 2000);
    });
});

// Notification system
function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.textContent = message;

    // Add styles for notification
    const style = document.createElement('style');
    style.textContent = `
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #4CAF50;
            color: white;
            padding: 15px 25px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            animation: slideIn 0.5s ease-out;
        }
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    `;
    document.head.appendChild(style);
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Redirect to status page
function redirectToStatusPage(submissionId) {
    // Store submission ID in localStorage for status page
    localStorage.setItem('currentSubmissionId', submissionId);
    window.location.href = 'feedback-status.html';
}

// Status page functionality
function initializeStatusPage() {
    const submissionId = localStorage.getItem('currentSubmissionId');
    const submission = feedbackStore.find(s => s.id === submissionId);

    if (submission) {
        updateStatusDisplay(submission);
    }
}

function updateStatusDisplay(submission) {
    const statusContainer = document.createElement('div');
    statusContainer.className = 'status-container';
    
    // Create status timeline
    const timeline = submission.statusHistory.map(status => `
        <div class="status-item ${status.status.toLowerCase()}">
            <div class="status-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="status-details">
                <h3>${status.status}</h3>
                <p>${status.timestamp.toLocaleString()}</p>
            </div>
        </div>
    `).join('');

    statusContainer.innerHTML = `
        <h2>Feedback Status</h2>
        <div class="status-timeline">
            ${timeline}
        </div>
    `;

    // Add styles for status page
    const style = document.createElement('style');
    style.textContent = `
        .status-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
        }
        .status-timeline {
            margin-top: 30px;
        }
        .status-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .status-icon {
            margin-right: 15px;
            color: #1e3c72;
        }
        .status-icon i {
            font-size: 24px;
        }
        .status-details h3 {
            margin: 0;
            color: #1e3c72;
        }
        .status-details p {
            margin: 5px 0 0;
            color: #666;
            font-size: 14px;
        }
    `;
    document.head.appendChild(style);

    // Append to body or specific container
    document.body.appendChild(statusContainer);
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('feedbackForm');
    const tableBody = document.getElementById('feedbackTableBody');
    let feedbacks = [];

    // Load existing feedback data if any
    loadFeedbackData();

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = {
            id: document.getElementById('editId').value || Date.now().toString(),
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            rating: document.querySelector('input[name="rating"]:checked')?.value || '0',
            message: document.getElementById('message').value
        };

        if (formData.id === document.getElementById('editId').value) {
            // Update existing feedback
            updateFeedback(formData);
        } else {
            // Add new feedback
            addFeedback(formData);
        }

        // Reset form
        form.reset();
        document.getElementById('editId').value = '';
        document.getElementById('submitButtonText').textContent = 'Submit Feedback';
    });

    function addFeedback(feedback) {
        feedbacks.push(feedback);
        saveFeedbackData();
        renderFeedbackTable();
    }

    function updateFeedback(updatedFeedback) {
        const index = feedbacks.findIndex(f => f.id === updatedFeedback.id);
        if (index !== -1) {
            feedbacks[index] = updatedFeedback;
            saveFeedbackData();
            renderFeedbackTable();
        }
    }

    function editFeedback(id) {
        const feedback = feedbacks.find(f => f.id === id);
        if (feedback) {
            document.getElementById('editId').value = feedback.id;
            document.getElementById('name').value = feedback.name;
            document.getElementById('email').value = feedback.email;
            document.getElementById('message').value = feedback.message;
            
            // Set rating
            const ratingInput = document.querySelector(`input[name="rating"][value="${feedback.rating}"]`);
            if (ratingInput) ratingInput.checked = true;

            document.getElementById('submitButtonText').textContent = 'Update Feedback';
        }
    }

    function renderFeedbackTable() {
        tableBody.innerHTML = '';
        feedbacks.forEach(feedback => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${feedback.name}</td>
                <td>${feedback.email}</td>
                <td>${'⭐'.repeat(parseInt(feedback.rating))}</td>
                <td>${feedback.message}</td>
                <td>
                    <button class="edit-btn" onclick="editFeedback('${feedback.id}')">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    function saveFeedbackData() {
        localStorage.setItem('feedbackData', JSON.stringify(feedbacks));
    }

    function loadFeedbackData() {
        const savedFeedback = localStorage.getItem('feedbackData');
        if (savedFeedback) {
            feedbacks = JSON.parse(savedFeedback);
            renderFeedbackTable();
        }
    }

    // Make editFeedback function globally available
    window.editFeedback = editFeedback;
});



