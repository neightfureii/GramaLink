<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GN Field Visit Management</title>


    <script src="https://maps.googleapis.com/maps/api/js?key=(Google_API_Id)" defer></script>

    


    <script src="https://maps.googleapis.com/maps/api/js?key=(Google_API_Id)" defer></script>

    <link rel="stylesheet" href="<?=ROOT?>/assets/css/gn/fieldvisit.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

</head>
<body>
    <?php $current_page = 'fieldvisit'; include '../app/views/gn/partials/navbar.php';?>

    <div class="main-content">
        <div class="header">
            <h2>Field Visits</h2>
            <div class="right" style="display:flex; gap:20px;">
                <?php include '../app/views/gn/partials/header_icons.php'; ?>
                <!-- <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search field visits...">
                </div> -->
            </div>
        </div>

        <div class="tabs">
            <button class="tab active" onclick="showSection('new-request')">New Request</button>

            <button class="tab" onclick="showSection('today-schedule')">Today's Schedule</button>
        </div>

        <section id="new-request" class="section active">
        <h2>New Field Visit Request</h2>
        
        <?php if (!empty($_SESSION['error_message'])): ?>
            <div style="background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 12px; margin-bottom: 20px; border-radius: 4px; text-align:center;">
            <?= htmlspecialchars($_SESSION['error_message']) ?>
        </div>
            <?php unset($_SESSION['error_message']); ?>

        <?php elseif (!empty($_SESSION['success_message'])): ?>
                <div style="background: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 12px; margin-bottom: 20px; border-radius: 4px; text-align:center;">
                 <?= htmlspecialchars($_SESSION['success_message']) ?>
                 </div>
                <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>
        <?php 
        $complaint_id = $data['complaint_id'] ?? '';
        $complaint = $data['complaint'] ?? null ;
        $citizen = $data['citizen'] ?? null ;
        ?>
        <form class="request-form" method="POST" action="<?=ROOT?>/gn/fieldvisit/addRequest">
            <input type="hidden" name="complaint_id" value="<?=htmlspecialchars($complaint_id ?? '')?>">

            <!-- Citizen Lookup Section -->
            <div class="citizen-lookup">
                <div class="form-group">
                    <label>Household NIC Number</label>

                    <input type="text" placeholder="Enter household head's NIC number" value="<?=htmlspecialchars($citizen->nic ?? '')?>" required readonly>

                    <div class="hint">Enter the NIC number to automatically fetch household details</div>
                </div>
                
                <!-- Citizen Details Preview (shown after NIC input) -->
                <div class="citizen-details visible">
                    <div class="citizen-details-grid">
                        <div class="detail-item">
                            <span class="detail-label">Household Head</span>
                            <?php if (!empty($citizen->full_name)): ?>
                                <span class="detail-value"><?= htmlspecialchars($citizen->full_name) ?></span>
                            <?php else: ?>
                                <span class="detail-value">No citizen name</span>
                            <?php endif; ?>
                            
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Address</span>
                            <?php if(!empty($citizen->address)): ?>
                                <span class="detail-value"><?= htmlspecialchars($citizen->address)?></span>
                                
                            <?php else: ?>
                               <span class="detail-value">No Address</span>
                            <?php endif; ?>
                            
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Contact</span>
                            <?php if (!empty($phone_number) && !empty($phone_number->mobileNumber)): ?>
                                <span class="detail-value"><?= htmlspecialchars($phone_number->mobileNumber) ?></span>
                            <?php else: ?>
                                <span class="detail-value">No contact Number</span>
                            <?php endif; ?>
                        </div>
                        
                    </div>
                </div>
            </div>

            <!-- Visit Details Section -->
            <div class="form-group">

                <label>Complaint Type</label>
                <input type="text" value="<?=htmlspecialchars($complaint->complaint_category ?? '')?>"readonly>
                

            </div>

            <div class="form-group">
                <label>Priority Level</label>
                <div class="checkbox-group">
                    <label class="checkbox-item priority-high">
                        <input type="radio" name="priority" value="high">
                        High Priority
                    </label>
                    <label class="checkbox-item priority-medium">
                        <input type="radio" name="priority" value="medium">
                        Medium Priority
                    </label>
                    <label class="checkbox-item priority-low">
                        <input type="radio" name="priority" value="low">
                        Low Priority
                    </label>
                </div>
            </div>
            <div id="dateError" style="display:none; background-color: #ffe0e0; color: #a94442; padding: 10px; border: 1px solid #a94442; border-radius: 5px; margin-bottom: 15px;">
            You cannot select a past date for the visit. Please choose a valid date.
            </div>


          


            <div class="form-group">
                <label>Preferred Visit Dates</label>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">

                    <input type="date" name="visit_date" required>
                    <select name="visit_time" required>
                        <option value="">Select time slot</option>
                        <option value="09:00:00-12:00:00">Morning (9:00 AM - 12:00 PM)</option>
                        <option value="14:00:00-17:00:00">Afternoon (2:00 PM - 5:00 PM)</option>

                    </select>
                </div>
                <div class="hint">Select a primary date and time slot for the visit</div>
            </div>

            <div class="form-group">
                <label>Additional Notes</label>

                <textarea name="note" placeholder="Enter any specific requirements or notes for the visit" rows="4"></textarea>
                <div class="hint">Include any special considerations or requirements for the visit</div>
            </div>
            


            <button type="submit" class="submit-button">Submit Visit Request</button>
        </form>
    </section>

      

      <!-- Today's Schedule Section -->
      <section id="today-schedule" class="section">
      <?php if (!empty($_SESSION['error_message'])): ?>
            <div style="background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 12px; margin-bottom: 20px; border-radius: 4px; text-align:center;">
            <?= htmlspecialchars($_SESSION['error_message']) ?>
        </div>
            <?php unset($_SESSION['error_message']); ?>

        <?php elseif (!empty($_SESSION['success_message'])): ?>
                <div style="background: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 12px; margin-bottom: 20px; border-radius: 4px; text-align:center;">
                 <?= htmlspecialchars($_SESSION['success_message']) ?>
                 </div>
                <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>
      <div class="search-bar" style="margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between;">
            <div style="flex-grow: 1; display: flex; align-items: center;">
                <i class="fas fa-map-marker-alt" style="margin-right: 8px;"></i>
                <form id ="add-manual-visit-form" action="<?= ROOT ?>/gn/FieldVisit/addManualVisit" method="POST" style="display: flex; width: 100%;">
                    <input type="text" name="address" placeholder="Enter Address to Add Schedule" required
                    style="flex-grow: 1; padding: 8px; border: 1px solid #ccc; border-radius: 5px 0 0 5px;">
                    <button type="submit"
                    style="padding: 8px 16px; background-color: #007BFF; color: white; border: none; border-radius: 0 5px 5px 0; cursor: pointer;">
                    Add
                    </button>
                </form>
            </div>
        </div>
          <h2>Today's Schedule</h2>
          <div class="route-summary">
              <h3>Route Overview</h3>
              <div class="route-stats" id="route-stats">
                  
              </div>
          </div>
          <div class="schedule-container">
              <div class="schedule-list" id="schedule-list" ></div>
              <div id="map"></div>
          </div>
      </section>
    </div>

    <script>
        const todayVisit = <?= json_encode($todayVisit ?? []) ?>;
        document.addEventListener('DOMContentLoaded', function () {
    const visitDateInput = document.querySelector('input[name="visit_date"]');
    const dateErrorDiv = document.getElementById('dateError');
    
    visitDateInput.addEventListener('change', function () {
        const selectedDate = new Date(this.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        if (selectedDate < today) {
            dateErrorDiv.style.display = 'block'; // Show error
            this.value = ''; // Clear the invalid input
             // Reload the page to reset the form
        } else {
            dateErrorDiv.style.display = 'none'; // Hide error if corrected
        }
    });
});
        
    </script>
    <script>
        const ROOT = "<?=ROOT?>";
        
        
    </script>

    <script src="<?=ROOT?>/assets/js/gn/fieldvisit.js"></script>
</body>
</html>
