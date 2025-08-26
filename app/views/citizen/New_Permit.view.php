<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Application</title>

    <!-- Iconscout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <!-- Montserrat Font(Google fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?=ROOT?>/assets/css/citizen/new_application.css"> 
</head>
<body>
    <?php include '../app/views/citizen/partials/navbar.php'; ?>

    <!-- Breadcrumb Section -->
    <div class="container breadcrumb">
        <p><a href="home" class="crumb">Home</a> > <a href="dashboard" class="crumb">Dashboard</a> > <a href="permit" class="crumb">Permits</a> > <a href="new_permit" class="crumb">New Permit</a></p>
    </div>

    <div class="container wrapper">

        <h2>Permit Request Form</h2>
        <form id="documentRequestForm" method="post">
            <div class="form-group">
                <!-- Common Details -->
                <label for="fullName">Full Name:</label>
                <input type="text" id="fullName" name="fullName" value="<?=htmlspecialchars($userDetails->full_name)?>" readonly><br>
            </div>
            
            <div class="form-group">
                <label for="nic">NIC Number:</label>
                <input type="text" id="nic" name="nic" value="<?=htmlspecialchars($userDetails->nic)?>" readonly><br>
            </div>
            
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?=htmlspecialchars($userDetails->address)?>" readonly><br>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" value="<?=htmlspecialchars($userDetails->mobileNumber)?>" readonly><br>
            </div>

            <div class="form-group">
                <!-- Document Selection -->
                <label for="documentType">Select Permit Type:</label>
                <select id="documentType" name="documentType" required>
                    <option value="">-- Select --</option>
                    <option value="building_construction">Building Construction Permit</option>
                    <option value="small_business">Small Business Operating Permit</option>
                    <option value="cattle_rearing">Cattle Rearing Permit</option>
                    <option value="loudspeaker">Loudspeaker Permit</option>
                </select>
            </div>

            <!-- Document Specific Fields -->
            <div id="building_constructionFields" class="form-group hidden">
                <label for="site_address">Construction Site Address:</label>
                <input type="text" name="site_address" id="site_address">

                <label for="building_plan">Upload Building Plan (PDF):</label>
                <input type="file" name="building_plan" id="building_plan" accept=".pdf">
            </div>
            <div id="small_businessFields" class="form-group hidden">
                <label for="business_name">Business Name:</label>
                <input type="text" name="business_name" id="business_name">

                <label for="business_location">Business Location:</label>
                <input type="text" name="business_location" id="business_location">
            </div>
            <div id="cattle_rearingFields" class="form-group hidden">
                <label for="land_size">Land Size (in Perches):</label>
                <input type="number" name="land_size" id="land_size" min="1">

                <label for="animal_count">Number of Cattle:</label>
                <input type="number" name="animal_count" id="animal_count" min="1">
            </div>
            <div id="loudspeakerFields" class="form-group hidden">
                <label for="event_location">Event Location:</label>
                <input type="text" name="event_location" id="event_location">

                <label for="event_time">Event Time:</label>
                <input type="datetime-local" name="event_time" id="event_time">
            </div>

            <div class="form-group">
                <label for="reason">Reason / Purpose:</label>
                <textarea name="reason" id="reason" required placeholder="Explain why you need this permit..."></textarea>
            </div>

            <button type="submit" class="submit_new_application">Submit Request</button>
        </form>

    </div>

    <script>
        const documentTypeSelect = document.getElementById("documentType");

        documentTypeSelect.addEventListener("change", function() {
            // First, hide all and remove "required" attributes
            document.querySelectorAll(".hidden").forEach(el => {
                el.style.display = "none";
                el.querySelectorAll("input, select").forEach(input => {
                    input.required = false;
                });
            });

            // Then show selected fields and make their inputs/selects required
            const selectedType = this.value;
            if (selectedType) {
                const fieldsSection = document.getElementById(selectedType + "Fields");
                if (fieldsSection) {
                    fieldsSection.style.display = "block";
                    fieldsSection.querySelectorAll("input, select").forEach(input => {
                        input.required = true;
                    });
                }
            }
        });
    </script>

    <?php include '../app/views/citizen/partials/footer.php'; ?>

    <script src="<?=ROOT?>/assets/js/citizen/main.js"></script>
</body>
</html>
