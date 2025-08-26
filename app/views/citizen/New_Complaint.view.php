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

    <link rel="stylesheet" href="<?=ROOT?>/assets/css/citizen/new_complaint.css"> 
</head>
<body>
    <?php include '../app/views/citizen/partials/navbar.php'; ?>

    <!-- Breadcrumb Section -->
    <div class="container breadcrumb">
        <p><a href="home" class="crumb">Home</a> > <a href="dashboard" class="crumb">Dashboard</a> > <a href="complaint" class="crumb">Complaints</a> > <a href="new_complaint" class="crumb">New Complaint</a></p>
    </div>

    <!-- New Complaint Form Section -->
    <div class="container new-complaint">
        <h2>Submit a New Complaint</h2>
        <form id="newComplaintForm">
            <div class="form-group">
                <label for="title">Complaint Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                <option value="" disabled selected>Select complaint type</option>
                <option value="noise">Noise Complaint</option>
                <option value="waste">Waste Disposal Issue</option>
                <option value="water">Water Supply Issue</option>
                <option value="pest">Pest Infestation</option>
                <option value="maintenance">Maintenance Request</option>
                <option value="service">Service Interruption</option>
                <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="attachment">Attachment (optional):</label>
                <input type="file" id="attachment" name="attachment">
            </div>
            <div class="form-group">
                <button type="submit">Submit Complaint</button>
            </div>
        </form>
    </div>
    
    <?php include '../app/views/citizen/partials/footer.php'; ?>

    <script src="<?=ROOT?>/assets/js/citizen/main.js"></script>
    <script src="<?=ROOT?>/assets/js/citizen/new_complaint.js"></script>
</body>
</html>
