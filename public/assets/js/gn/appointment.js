//show section function
function showSection(sectionId) {
  // Get all sections
  const sections = document.querySelectorAll('.section');

  // Hide all sections
  sections.forEach((section) => {
    section.style.display = 'none';
  });

  // Show the selected section
  document.getElementById(sectionId).style.display = 'block';
    
    // Update tab styling
    document.querySelectorAll('.tab').forEach(tab => {
        tab.classList.remove('active');
    });
    event.target.classList.add('active');
}


let selectedAppointment = null;
let applicationtoopen = null;
let permittoopen = null;

function openAppointmentModal(appointment) {
  selectedAppointment = appointment;
  applicationtoopen = appointment.application_id ?? null;
  permittoopen = appointment.permit_id ?? null;

  document.getElementById('hiddenAppointmentId').value = appointment.appointment_id;
  document.getElementById('modalCitizenId').innerText = appointment.citizen_id;
  document.getElementById('modalDate').innerText = appointment.preferred_date;
  document.getElementById('modalTime').innerText = appointment.preferred_time;
  document.getElementById('modalService').innerText = appointment.service_type;
  document.getElementById('modalDesc').innerText = appointment.description;
  document.getElementById('modalStatus').innerText = appointment.status;
  document.getElementById('modalRemarks').value = appointment.remarks || '';

  if(!applicationtoopen) {
    document.getElementById('ApplicationLink').style.display = 'none';
  } else {
    document.getElementById('ApplicationLink').style.display = 'block';
  }
  if(!permittoopen) {
    document.getElementById('PermitLink').style.display = 'none';
  } else {
    document.getElementById('PermitLink').style.display = 'block';
  }

  document.getElementById('appointmentModal').style.display = 'flex';
}


// Function to close the modal
function closeModal() {
  document.getElementById('appointmentModal').style.display = 'none';
  selectedAppointment = null;
}

window.onclick = function(event) {
  const modal = document.getElementById('appointmentModal');
  if (event.target == modal) {
    closeModal();
  }
}


