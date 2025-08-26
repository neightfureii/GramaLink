<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GN Appointments</title>
  
  <!-- Iconscout CDN -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
  
  <!-- Montserrat Font (Google fonts) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <!-- FullCalendar CSS -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
  
  <!-- Font Awesome CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/gn/appointment.css">
</head>
<body>
  <?php $current_page = 'appointment'; include '../app/views/gn/partials/navbar.php';?>

  <?php if (!empty($_SESSION['flash_message_complete'])): ?>
    <div id="flash-message-success" class="flash-success">
        <?= $_SESSION['flash_message_complete'] ?>
    </div>
    <?php unset($_SESSION['flash_message_complete']); ?>
  <?php endif; ?>
  <?php if (!empty($_SESSION['flash_message_reject'])): ?>
    <div id="flash-message-fail" class="flash-reject">
        <?= $_SESSION['flash_message_reject'] ?>
    </div>
    <?php unset($_SESSION['flash_message_reject']); ?>
  <?php endif; ?>

  <!-- Main Content -->
  <main class="main-content">
    <div class="header">
        <h2>Appointments</h2>
        <div class="right" style="display:flex; gap:20px;">
          <?php include '../app/views/gn/partials/header_icons.php'; ?>
          <div class="search-bar">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search appointments...">
          </div>
        </div>
    </div>

    <div class="tabs">
        <button class="tab active" onclick="showSection('calsection')">Calendar</button>
        <button class="tab" onclick="showSection('reqsection')">Appointment Details</button>
    </div>
            
    <section id="calsection" class="section active">
      <!-- Calendar Section -->
      <div class="calendar-container">
        <header class="calendar-header">
            <button id="prev-month">&lt;</button>
            <h1 id="month-year"></h1>
            <button id="next-month">&gt;</button>
        </header>
        <div class="calendar-grid">
            <div class="day-header">Sun</div>
            <div class="day-header">Mon</div>
            <div class="day-header">Tue</div>
            <div class="day-header">Wed</div>
            <div class="day-header">Thu</div>
            <div class="day-header">Fri</div>
            <div class="day-header">Sat</div>
        </div>
        <div id="calendar-days" class="calendar-grid"></div>
    </div>
    </section>
    <section id="reqsection" class="section" style="display:none;">
      <!-- Requests Section -->
      <div class="table-container">
        <h3>Appointment Details</h3>
        <table id="appointmentHistoryTable">
          <thead>
            <tr>
              <th>Citizen ID</th>
              <th>Date</th>
              <th>Time</th>
              <th>Status</th>
              <th>Remarks</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($appointments)): ?>
              <?php foreach ($appointments as $appointment): ?>
                <tr onclick="openAppointmentModal(<?= htmlspecialchars(json_encode($appointment), ENT_QUOTES, 'UTF-8') ?>)">
                  <td><?= htmlspecialchars($appointment->citizen_id) ?></td>
                  <td><?= htmlspecialchars($appointment->preferred_date) ?></td>
                  <td><?= htmlspecialchars($appointment->preferred_time) ?></td>
                  <td>
                    <span class="<?= strtolower($appointment->status) ?>">
                      <?= htmlspecialchars($appointment->status) ?>
                    </span>
                  </td>
                  <td><?= htmlspecialchars($appointment->remarks) ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5">No appointments found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </section>

    <!-- Appointment Modal -->
    <div id="appointmentModal" class="modal">
      <div class="modal-content">
        <div class="modal-header">
          <h3>Appointment Details</h3>
        <button class="cancel-btn" onclick="closeModal()">
          <i class="uil uil-times"></i>
        </button>
        </div>
        <form method="POST" action="<?= ROOT ?>/gn/appointment/updateStatus">
          <div class="form-content">
            <input type="hidden" name="appointment_id" id="hiddenAppointmentId">
            <p><strong>Citizen ID:</strong> <span id="modalCitizenId"></span></p>
            <p><strong>Date:</strong> <span id="modalDate"></span></p>
            <p><strong>Time:</strong> <span id="modalTime"></span></p>
            <p><strong>Service Type:</strong> <span id="modalService"></span></p>
            <p><strong>Description:</strong> <span id="modalDesc"></span></p>
            <p><strong>Status:</strong> <span id="modalStatus"></span></p>
            <a href="<?=ROOT?>/gn/application/" id="ApplicationLink" onclick="handleLinkClick(event)">View Application</a>
            <a href="<?=ROOT?>/gn/application/" id="PermitLink" onclick="handleLinkClick(event)">View Permit</a>
          </div>

          <label for="remarks">Remarks:</label>
          <textarea name="remarks" id="modalRemarks" placeholder="Add remarks..."></textarea>

          <div class="modal-buttons">
            <button type="submit" name="action" value="completed" class="accept-btn">Mark as Completed</button>
            <button type="submit" name="action" value="reject" class="reject-btn">Reject</button>
          </div>
        </form>
      </div>
    </div>

    
</main>

  <!-- FullCalendar Script -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
  <script src="<?=ROOT?>/assets/js/gn/appointment.js"></script>
  <script>
    function handleLinkClick(event) {
      event.preventDefault();
      localStorage.setItem('openApplication', 'true');
      localStorage.setItem('openPermit', 'true');
      localStorage.setItem('applicationId', applicationtoopen);
      localStorage.setItem('permitId', permittoopen);
      console.log(event.target.href);
      window.location.href = event.target.href;
    }

    const appointments = <?= !empty($appointments) ? json_encode(array_map(function ($appointment) {
      return [
          'appointment_id' => $appointment->appointment_id,
          'application_id' => $appointment->application_id,
          'permit_id' => $appointment->permit_id,
          'citizen_id' => $appointment->citizen_id,
          'date' => $appointment->preferred_date,
          'time' => $appointment->preferred_time,
          'status' => $appointment->status,
          'remarks' => $appointment->remarks,
          'service_type' => $appointment->service_type,
          'description' => $appointment->description
      ];
    }, $appointments), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) : '[]' ?>;
    
    const calendarDays = document.getElementById("calendar-days");
    const monthYear = document.getElementById("month-year");
    const prevMonthBtn = document.getElementById("prev-month");
    const nextMonthBtn = document.getElementById("next-month");

    let currentDate = new Date();

    function renderCalendar() {
        calendarDays.innerHTML = "";
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();

        monthYear.textContent = currentDate.toLocaleString("default", { month: "long", year: "numeric" });

        const firstDayOfMonth = new Date(year, month, 1).getDay();
        const lastDateOfMonth = new Date(year, month + 1, 0).getDate();

        // Add empty cells for days before the first day of the month
        for (let i = 0; i < firstDayOfMonth; i++) {
            const emptyCell = document.createElement("div");
            emptyCell.className = "calendar-day empty";
            calendarDays.appendChild(emptyCell);
        }

        // Render calendar days and appointments
        for (let date = 1; date <= lastDateOfMonth; date++) {
            const dayCell = document.createElement("div");
            dayCell.className = "calendar-day";

            const dateElement = document.createElement("div");
            dateElement.className = "date";
            dateElement.textContent = date;

            const fullDate = `${year}-${String(month + 1).padStart(2, "0")}-${String(date).padStart(2, "0")}`;

            dayCell.appendChild(dateElement);

            // Check appointments for this date
            const dailyAppointments = appointments.filter(app => app.date === fullDate);

            dailyAppointments.forEach(appointment => {
              const appointmentEl = document.createElement("div");
              appointmentEl.className = "appointment";
              appointmentEl.textContent = `${appointment.citizen_id} (${appointment.time})`;

              // Add click event to open modal
              appointmentEl.addEventListener('click', () => {
                  openAppointmentModal({
                      appointment_id: appointment.appointment_id,
                      application_id: appointment.application_id,
                      permit_id: appointment.permit_id,
                      citizen_id: appointment.citizen_id,
                      preferred_date: appointment.date,
                      preferred_time: appointment.time,
                      service_type: appointment.service_type,
                      description: appointment.description,
                      status: appointment.status,
                      remarks: appointment.remarks
                  });
              });

              dayCell.appendChild(appointmentEl);
            });

            calendarDays.appendChild(dayCell);
        }
    }

    prevMonthBtn.addEventListener("click", () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    nextMonthBtn.addEventListener("click", () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    renderCalendar();

    document.addEventListener('DOMContentLoaded', function () {
      const flash = document.getElementById('flash-message-success') || document.getElementById('flash-message-fail');
      if (flash) {
          setTimeout(function () {
              flash.style.opacity = '0'; 
              setTimeout(() => flash.remove(), 500);
          }, 3000); 
      }
    });

  </script>
</body>
</html>
