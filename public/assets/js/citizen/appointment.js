function showSection(sectionId) {
  // Get all sections
  const sections = document.querySelectorAll('.section');

  // Hide all sections
  sections.forEach((section) => {
    section.style.display = 'none';
  });

  // Show the selected section
  document.getElementById(sectionId).style.display = 'block';

  // echo sectionId;
    
    // Update tab styling
    document.querySelectorAll('.tab').forEach(tab => {
        tab.classList.remove('active');
    });
    event.target.classList.add('active');
}

// Replace the existing appointmentDate event listener with this code
document.getElementById("appointmentDate").addEventListener("change", function () {
  let selectedDate = this.value;
  if (selectedDate) {
    // Update booking state with the selected date
    bookingState.date = selectedDate;
    updateBookingSummary();
    
    // Fetch available time slots using AJAX
    fetch(`appointment/getTimeSlots/${selectedDate}`)
      .then(response => response.json())
      .then(data => {
        // Process the time slots data
        updateTimeSlots(data);
      })
      .catch(error => {
        console.error('Error fetching time slots:', error);
      });
  }
});

// Add this function to update the time slots in the UI
function updateTimeSlots(bookedSlots) {
  const slotGrid = document.querySelector('.slot-grid');
  const slotCountElement = document.querySelector('.slot-count');
  
  // Clear existing time slots
  slotGrid.innerHTML = '';
  
  // Define the start and end times
  const start_time = new Date();
  start_time.setHours(9, 0, 0);
  const end_time = new Date();
  end_time.setHours(12, 0, 0);
  const interval = 15 * 60 * 1000; // 15 minutes in milliseconds
  
  // Count available slots
  let availableSlots = 0;
  
  // Generate time slots
  for (let time = start_time.getTime(); time < end_time.getTime(); time += interval) {
    const slotTime = new Date(time);
    const formatted_time = slotTime.toTimeString().split(' ')[0]; // HH:MM:SS format
    
    // Check if slot is booked
    const is_available = !bookedSlots.includes(formatted_time);
    if (is_available) {
      availableSlots++;
    }
    
    // Add class based on availability
    const class_name = is_available ? 'available' : 'unavailable';
    
    // Create time slot element
    const timeSlot = document.createElement('div');
    timeSlot.className = `time-slot ${class_name}`;
    timeSlot.dataset.time = formatted_time;
    
    // Format time for display (12-hour format)
    const hours = slotTime.getHours();
    const minutes = slotTime.getMinutes().toString().padStart(2, '0');
    const ampm = hours >= 12 ? 'PM' : 'AM';
    const displayHours = hours % 12 || 12;
    
    timeSlot.textContent = `${displayHours}:${minutes} ${ampm}`;
    
    // Add click event for available slots
    if (is_available) {
      timeSlot.addEventListener('click', function() {
        // Remove selected class from all time slots
        document.querySelectorAll('.time-slot').forEach(slot => {
          slot.classList.remove('selected');
        });
        
        // Add selected class to this time slot
        this.classList.add('selected');
        
        // Update booking state
        bookingState.time = this.dataset.time;
        updateBookingSummary();
      });
    }
    
    // Add time slot to grid
    slotGrid.appendChild(timeSlot);
  }
  
  // Update slot count
  slotCountElement.textContent = availableSlots;
}


/* -----------------------------------------
  Booking State & Time Slots
----------------------------------------- */
let bookingState = {
  date: null,
  time: null,
  service: null,
  description: ''
};


/* -----------------------------------------
  Service & Description Handlers
----------------------------------------- */
function attachServiceHandlers() {
  const serviceCards = document.querySelectorAll('.service-card');
  serviceCards.forEach(card => {
    card.addEventListener('click', () => {
      serviceCards.forEach(c => c.classList.remove('selected'));
      card.classList.add('selected');
      const selectedService = card.querySelector('h4').textContent;
      bookingState.service = selectedService;
      updateBookingSummary();
      // Mark description as required if service is "Other"
      const descriptionTextarea = document.getElementById('appointmentDescription');
      if (selectedService.toLowerCase() === 'other') {
        descriptionTextarea.setAttribute('required', 'true');
      } else {
        descriptionTextarea.removeAttribute('required');
      }
    });
  });
}

function setupDescriptionHandler() {
  const textarea = document.getElementById('appointmentDescription');
  const charCount = document.querySelector('.char-count');
  textarea.addEventListener('input', () => {
    const length = textarea.value.length;
    charCount.textContent = `${length}/500 characters`;
    bookingState.description = textarea.value;
    updateBookingSummary();
  });
}

/* -----------------------------------------
  Booking Summary & Modal Handlers
----------------------------------------- */
// Update modal content without automatically opening it
function updateBookingSummary() {
  document.getElementById('selected-date').textContent = `Date: ${bookingState.date || 'Not selected'}`;
  document.getElementById('selected-time').textContent = `Time: ${bookingState.time || 'Not selected'}`;
  document.getElementById('selected-service').textContent = `Service: ${bookingState.service || 'Not selected'}`;
  document.getElementById('appointment-description-summary').textContent =
    bookingState.description
      ? `Description: ${bookingState.description.substring(0, 50)}${bookingState.description.length > 50 ? '...' : ''}`
      : 'Description: Not provided';
}

// Open modal only when the Book Appointment button is clicked (with validations)
function openBookingSummary() {
  // Validate required fields
  if (!bookingState.date || !bookingState.time || !bookingState.service) {
    alert("Please select a date, time, and service before booking an appointment.");
    return;
  }
  // If service is "Other", appointment description is required
  if (bookingState.service.toLowerCase() === 'other' && (!bookingState.description || bookingState.description.trim() === '')) {
    alert('Please provide an appointment description for the "Other" service.');
    return;
  }
  // Update summary and open modal
  updateBookingSummary();
  document.querySelector('.booking-summary').classList.add('active');
  document.querySelector('.overlay').classList.add('active');
}

function setupModalHandlers() {
  const closeModalBtn = document.querySelector('.close-modal');
  const overlay = document.querySelector('.overlay');
  const confirmBtn = document.querySelector('.confirm-btn');
  const appointmentForm = document.getElementById('appointmentForm');

  function closeModal() {
    document.querySelector('.booking-summary').classList.remove('active');
    document.querySelector('.overlay').classList.remove('active');
  }

  closeModalBtn.addEventListener('click', closeModal);
  overlay.addEventListener('click', closeModal);

  confirmBtn.addEventListener('click', (e) => {
    e.preventDefault();

    // Format the date as yyyy-mm-dd
    let formattedDate = new Date(bookingState.date).toISOString().split('T')[0];

    // Create hidden input fields to store appointment data
    // Add date input
    let dateInput = document.createElement('input');
    dateInput.type = 'hidden';
    dateInput.name = 'preferred_date';
    dateInput.value = formattedDate;
    appointmentForm.appendChild(dateInput);

    // Add time input
    let timeInput = document.createElement('input');
    timeInput.type = 'hidden';
    timeInput.name = 'preferred_time';
    timeInput.value = bookingState.time;
    appointmentForm.appendChild(timeInput);

    // Add service type input
    let serviceInput = document.createElement('input');
    serviceInput.type = 'hidden';
    serviceInput.name = 'service_type';
    serviceInput.value = bookingState.service;
    appointmentForm.appendChild(serviceInput);

    // Add description input (only if it's not already in the form)
    let descriptionTextarea = document.getElementById('appointmentDescription');
    if (!descriptionTextarea.name) {
        descriptionTextarea.name = 'description';
    }

    // Submit the form
    appointmentForm.submit();

    closeModal();
  });
}

/* -----------------------------------------
  Initialize Everything on DOMContentLoaded
----------------------------------------- */
document.addEventListener('DOMContentLoaded', () => {
  attachServiceHandlers();
  setupDescriptionHandler();
  setupModalHandlers();
  document.getElementById('bookAppointmentBtn').addEventListener('click', (e) => {
    e.preventDefault();
    openBookingSummary();
  });
});


document.addEventListener('DOMContentLoaded', function () {
  const flash = document.getElementById('flash-message');
  if (flash) {
      // Set timeout to hide the message after 3 seconds
      setTimeout(function () {
          flash.style.opacity = '0'; // fade out
          setTimeout(() => flash.remove(), 500); // remove from DOM after fade
      }, 3000); // 3 seconds
  }
});
