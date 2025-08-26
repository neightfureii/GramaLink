<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Appointments</title>
  <!-- Iconscout CDN -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
  <!-- Montserrat Font (Google Fonts) -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/citizen/appointment.css" />
</head>
<body>
  <?php include '../app/views/citizen/partials/navbar.php'; ?>

  <?php if (!empty($_SESSION['flash_message'])): ?>
    <div id="flash-message" class="flash-success">
        <?= $_SESSION['flash_message'] ?>
    </div>
    <?php unset($_SESSION['flash_message']); ?>
  <?php endif; ?>

  <div class="container breadcrumb">
    <p>
      <a href="home" class="crumb">Home</a> > 
      <a href="dashboard" class="crumb">Dashboard</a> > 
      <a href="appointment" class="crumb">Appointments</a>
    </p>
  </div>

  <div class="container wrapper">
    <div class="tabs">
      <!-- Pass the event object to toggle the active state -->
      <button class="tab active" onclick="showSection('new-appointment')">Book Appointment</button>
      <button class="tab" onclick="showSection('appointment-history')">Appointment History</button>
    </div>

    <!-- New Appointment Section -->
    <section id="new-appointment" class="section active">
      <form class="appointment-form" id="appointmentForm" method="POST">
        <input type="hidden" name="application_id" value="<?=$applicationDetails['application_id'] ?? null?>">
        <input type="hidden" name="permit_id" value="<?=$permitDetails['permit_id'] ?? null?>">
        <div class="booking-header">
          <h2>Book Your Appointment</h2>
          <p>Schedule a meeting with your Grama Niladhari</p>
        </div>

        <div class="booking-grid">
          <div class="time-slots">
            <div class="calendar-section">
              <h3>Select Date</h3>
              <select id="appointmentDate" name="appointmentDate">
                <option value="">Select a date</option>
                <?php 
                $today = new DateTime();
                $count = 0;
                
                while ($count < 10) { // Show next 10 available dates
                    $dayOfWeek = $today->format('N'); // 2 = Tuesday, 4 = Thursday, 6 = Saturday
                    if ($dayOfWeek == 2 || $dayOfWeek == 4 || $dayOfWeek == 6) {
                        echo "<option value='".$today->format('Y-m-d')."'>".$today->format('l, F j, Y')."</option>";
                        $count++;
                    }
                    $today->modify("+1 day");
                }
                ?>
              </select>
            </div>
            <div class="time-slots-header">
                <h3>Available Time Slots</h3>
                <span class="slot-count">
                  <?php if(!empty($timeslots)): 
                      echo 12-count($timeslots); 
                    else: echo 12;
                  endif; 
                  ?>
                </span>
            </div>
            <div class="slot-grid">
                <?php
                // Define the start and end times
                $start_time = strtotime("09:00");
                $end_time = strtotime("12:00");
                $interval = 15 * 60; // 15 minutes in seconds
                
                // Example array of booked slots (these should be retrieved from the database)
                $booked_slots = $timeslots ?? []; // Ensure $timeslots is defined

                // Generate time slots
                for ($time = $start_time; $time < $end_time; $time += $interval) {
                    $formatted_time = date("H:i:s", $time); // 24-hour format (use "g:i A" for 12-hour format)
                    $is_available = !in_array($formatted_time, $booked_slots); // Check if slot is booked
                    // Add class based on availability
                    $class = $is_available ? 'available' : 'unavailable';
                    
                    echo "<div class='time-slot $class' data-time='$formatted_time'>";
                    echo date("g:i A", $time); // Display time in 12-hour format
                    echo "</div>";
                }
                ?>
            </div>
          </div>
        </div>

        <div class="service-selection" style="display:<?=$applicationDetails||$permitDetails ? 'none' : 'block' ?>">
          <h3>Select Service</h3>
          <div class="service-grid">
            <div class="service-card">
              <i class="uil uil-home"></i>
              <h4>Residence Certificate</h4>
              <p>Proof of your current residential address.</p>
              <small>Required: NIC, Utility Bills</small>
            </div>

            <div class="service-card">
              <i class="uil uil-graduation-cap"></i>
              <h4>Character Certificate</h4>
              <p>Certification of good character for official purposes.</p>
              <small>Required: NIC, Police Report</small>
            </div>

            <div class="service-card">
              <i class="uil uil-money-bill"></i>
              <h4>Income Certificate</h4>
              <p>Statement of your income for government or official use.</p>
              <small>Required: NIC, Utility Bills</small>
            </div>

            <div class="service-card">
              <i class="uil uil-heart"></i>
              <h4>Public Aid Request</h4>
              <p>Apply for government support or assistance programs.</p>
              <small>Required: NIC, Utility Bills</small>
            </div>

            <div class="service-card">
              <i class="uil uil-bolt"></i>
              <h4>Electricity & Water Connection</h4>
              <p>Apply for utility services in your residence.</p>
              <small>Required: NIC, Utility Bills</small>
            </div>

            <div class="service-card">
              <i class="uil uil-shield-check"></i>
              <h4>Criminal Background Check</h4>
              <p>Official verification of criminal record status.</p>
              <small>Required: NIC</small>
            </div>

            <div class="service-card">
              <i class="uil uil-file-alt"></i>
              <h4>Death Certificate</h4>
              <p>Apply for a certificate confirming a death.</p>
              <small>Required: Hospital Documents</small>
            </div>

            <div class="service-card">
              <i class="uil uil-estate"></i>
              <h4>Valuation Certificate</h4>
              <p>Request an assessment of property or land value.</p>
              <small>Required: NIC, Utility Bills</small>
            </div>

            <div class="service-card">
              <i class="uil uil-postcard"></i>
              <h4>ID Card Application</h4>
              <p>Assistance with applying for a national ID card.</p>
              <small>Required: NIC, Utility Bills</small>
            </div>

            <div class="service-card">
              <i class="uil uil-mountains"></i>
              <h4>Land Ownership Assessment</h4>
              <p>Clarify or dispute land ownership issues.</p>
              <small>Required: Land Deed, Survey Plan</small>
            </div>

            <div class="service-card">
              <i class="uil uil-constructor"></i>
              <h4>Building Construction Permit</h4>
              <p>Authorization for new construction, extension, or renovation of buildings.</p>
              <small>Required: Land Ownership Documents, Building Plan, NIC</small>
            </div>

            <div class="service-card">
              <i class="uil uil-briefcase-alt"></i>
              <h4>Small Business Operating Permit</h4>
              <p>Legal approval to start or operate a small-scale business in the locality.</p>
              <small>Required: NIC, Business Proposal, Location Proof</small>
            </div>

            <div class="service-card">
              <i class="uil uil-trees"></i>
              <h4>Cattle Rearing Permit</h4>
              <p>Permission to rear livestock within the village or community limits.</p>
              <small>Required: NIC, Land Ownership or Rental Agreement, Veterinary Certificate</small>
            </div>

            <div class="service-card">
              <i class="uil uil-megaphone"></i>
              <h4>Loudspeaker Permit</h4>
              <p>Approval to use loudspeakers for events or announcements.</p>
              <small>Required: NIC, Event Details, Location Permission</small>
            </div>

            <div class="service-card">
              <i class="uil uil-comment-dots"></i>
              <h4>Other</h4>
              <p>Request a service not listed above.</p>
              <small>Required: Relevant Supporting Documents</small>
            </div>

          </div>

          <div class="appointment-description">
            <h3>Appointment Description</h3>
            <textarea
              id="appointmentDescription"
              name="appointmentDescription"
              rows="4"
              placeholder="Please provide a brief description of your appointment purpose..."
              maxlength="500"
            ></textarea>
            <div class="char-count">0/500 characters</div>
          </div>

        </div>
        <!-- Book Appointment Button -->
        <div class="book-appointment-container" style="text-align: center; margin: 20px 0;">
          <button id="bookAppointmentBtn" class="book-btn">
            Book Appointment <i class="uil uil-angle-right"></i>
          </button>
        </div>

        <div class="overlay"></div>

        <div class="booking-summary">
          <button class="close-modal">
            <i class="uil uil-times"></i>
          </button>
          <div class="summary-content">
            <div class="summary-header">
              <h3>Booking Summary</h3>
            </div>
            <div class="summary-details">
              <p id="selected-date">Date: Not selected</p>
              <p id="selected-time">Time: Not selected</p>
              <p id="selected-service">Service: Not selected</p>
              <p id="appointment-description-summary">Description: Not provided</p>
              <p>Duration: 15 minutes</p>
            </div>
          </div>
          <button class="confirm-btn">Confirm Appointment</button>
        </div>
      </form>
    </section>

    <!-- Appointment History Section -->
    <section id="appointment-history" class="section">
      <h3>Appointment History</h3>
      <table id="appointmentHistoryTable">
        <thead>
          <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Service Type</th>
            <th>Status</th>
            <th>GN Remarks</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($appointments)): ?>
            <?php foreach ($appointments as $appointment): ?>
              <tr>
                <td><?= htmlspecialchars($appointment->preferred_date) ?></td>
                <td><?= htmlspecialchars($appointment->preferred_time) ?></td>
                <td><?= htmlspecialchars($appointment->service_type) ?></td>
                <td><?= htmlspecialchars($appointment->status) ?></td>
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
    </section>
  </div>

  <?php include '../app/views/citizen/partials/footer.php'; ?>

  <script src="<?=ROOT?>/assets/js/citizen/appointment.js"></script>
  <?php if(!empty($applicationDetails)):?>
    <script>bookingState.service = "<?=$applicationDetails['documentType']?>"</script>
  <?php elseif(!empty($permitDetails)):?>
    <script>bookingState.service = "<?=$permitDetails['documentType']?>"</script>
  <?php endif;?>
</body>
</html>
