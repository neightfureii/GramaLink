let isEditing = false;

function toggleEdit() {
    isEditing = !isEditing;
    const detailItems = document.querySelectorAll('.detail-item');
    const formGroups = document.querySelectorAll('.form-group');
    const editBtn = document.querySelector('.edit-btn');
    const saveBtn = document.querySelector('.save-btn');
    const cancelBtn = document.querySelector('.cancel-btn');

    detailItems.forEach(item => {
        if (isEditing) {
            item.classList.add('editing');
        } else {
            item.classList.remove('editing');
        }
    });
    formGroups.forEach(item => {
        if (isEditing) {
            item.classList.add('editing');
        } else {
            item.classList.remove('editing');
        }
    });

    if (isEditing) {
        editBtn.style.display = 'none';
        saveBtn.style.display = 'block';
        cancelBtn.style.display = 'block';
    } else {
        editBtn.style.display = 'block';
        saveBtn.style.display = 'none';
        cancelBtn.style.display = 'none';
    }
}

function saveChanges() {
    const detailItems = document.querySelectorAll('.detail-item');
    
    detailItems.forEach(item => {
        const value = item.querySelector('.value');
        const input = item.querySelector('input, select');
        if (input) {
            value.textContent = input.value;
        }
    });

    toggleEdit();
}

function cancelEdit() {
    const detailItems = document.querySelectorAll('.detail-item');
    
    detailItems.forEach(item => {
        const value = item.querySelector('.value');
        const input = item.querySelector('input, select');
        if (input) {
            input.value = value.textContent;
        }
    });

    toggleEdit();
}

function confirmDelete() {
    if (confirm('Are you sure you want to delete your account? This action cannot be undone for 6 months.')) {
        alert('Account deletion request submitted.');
    }
}

// Image upload preview
document.querySelector('.upload-photo').addEventListener('click', function() {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.onchange = function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile-image').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    };
    input.click();
});

// Password Strength Checker
function checkPasswordStrength() {
    const password = document.getElementById('new-password').value;
    const meter = document.querySelector('.strength-meter');
    
    // Reset classes
    meter.classList.remove('weak', 'medium', 'strong');
    
    // Check strength
    if (password.length === 0) {
        meter.style.width = '0';
    } else if (password.length < 8) {
        meter.classList.add('weak');
    } else if (password.length < 12 || !/[A-Z]/.test(password) || !/[0-9]/.test(password)) {
        meter.classList.add('medium');
    } else {
        meter.classList.add('strong');
    }
}

// Password Update
function updatePassword() {
    const currentPassword = document.getElementById('current-password').value;
    const newPassword = document.getElementById('new-password').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    if (newPassword !== confirmPassword) {
        alert('New passwords do not match!');
        return;
    }

    if (newPassword.length < 8) {
        alert('Password must be at least 8 characters long!');
        return;
    }

    // Here you would typically make an API call to update the password
    alert('Password updated successfully!');
    
    // Clear fields
    document.getElementById('current-password').value = '';
    document.getElementById('new-password').value = '';
    document.getElementById('confirm-password').value = '';
    document.querySelector('.strength-meter').style.width = '0';
}

// Two-Factor Authentication Toggle
function toggle2FA(checkbox) {
    if (checkbox.checked) {
        if (confirm('Enable Two-Factor Authentication? This will add an extra layer of security to your account.')) {
            // Here you would typically initiate the 2FA setup process
            alert('Please set up 2FA using your authenticator app');
        } else {
            checkbox.checked = false;
        }
    } else {
        if (confirm('Are you sure you want to disable Two-Factor Authentication? This will make your account less secure.')) {
            alert('2FA has been disabled');
        } else {
            checkbox.checked = true;
        }
    }
}

// Dark Mode Toggle
function toggleDarkMode(checkbox) {
    if (checkbox.checked) {
        document.body.style.backgroundColor = '#1a1a1a';
        // Add more dark mode styles as needed
    } else {
        document.body.style.backgroundColor = '#f0f2f5';
        // Reset to light mode styles
    }
}

// Logout from all devices
function logoutAllDevices() {
    if (confirm('Are you sure you want to log out from all devices? You will need to log in again on each device.')) {
        // Here you would typically make an API call to invalidate all sessions
        alert('You have been logged out from all devices');
    }
}

// Profile Photo Upload
function handleProfilePhotoUpload(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector('.profile-photo img').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}

// Save Contact & Address
function saveContactAddress() {
    // Here you would typically make an API call to save the contact and address information
    alert('Contact and address information saved successfully!');
}

// Notification Settings
function updateNotificationSettings(type, enabled) {
    // Here you would typically make an API call to update notification preferences
    alert(`${type} notifications ${enabled ? 'enabled' : 'disabled'}`);
}

// Language Change
function changeLanguage(language) {
    // Here you would typically make an API call to update language preference
    alert(`Language changed to ${language}`);
}

// Form Validation
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function validatePhone(phone) {
    const re = /^\+?[\d\s-]{10,}$/;
    return re.test(phone);
}

// Generic Form Submission Handler
function handleFormSubmit(formData) {
    // Here you would typically make an API call to save the form data
    console.log('Form data:', formData);
    alert('Changes saved successfully!');
}

// Error Handler
function handleError(error) {
    console.error('Error:', error);
    alert('An error occurred. Please try again.');
}

// Session Timer
let sessionTimeout;
function resetSessionTimer() {
    clearTimeout(sessionTimeout);
    sessionTimeout = setTimeout(() => {
        if (confirm('Your session is about to expire. Would you like to stay logged in?')) {
            resetSessionTimer();
        } else {
            // Logout
            window.location.href = '/logout';
        }
    }, 30 * 60 * 1000); // 30 minutes
}

// Initialize session timer
document.addEventListener('mousemove', resetSessionTimer);
document.addEventListener('keypress', resetSessionTimer);
resetSessionTimer();

// Add smooth scrolling for better UX
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Form autosave functionality
let autosaveTimeout;
function setupAutosave() {
    const inputs = document.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('input', () => {
            clearTimeout(autosaveTimeout);
            autosaveTimeout = setTimeout(() => {
                // Here you would typically make an API call to save the form data
                console.log('Autosaving...');
            }, 1000);
        });
    });
}

// Initialize autosave
setupAutosave();

// Prevent form submission on enter key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Enter' && event.target.nodeName === 'INPUT') {
        event.preventDefault();
    }
});

// Add unsaved changes warning
let hasUnsavedChanges = false;
function setupUnsavedChangesWarning() {
    const inputs = document.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('input', () => {
            hasUnsavedChanges = true;
        });
    });

    window.addEventListener('beforeunload', (event) => {
        if (hasUnsavedChanges) {
            event.preventDefault();
            event.returnValue = '';
        }
    });
}

// Initialize unsaved changes warning
setupUnsavedChangesWarning();
