<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Field Visit Requests</title>

    <!-- Iconscout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <!-- Montserrat Font (Google fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?=ROOT?>/assets/css/citizen/fieldvisit.css">
</head>
<body>
    <?php include '../app/views/citizen/partials/navbar.php'; ?>

    <!-- Breadcrumb Section -->
    <div class="container breadcrumb">
        <p><a href="home" class="crumb">Home</a> > <a href="dashboard" class="crumb">Dashboard</a> > <a href="fieldvisit" class="crumb">Field Visit Requests</a></p>
    </div>

    <div class="visit-container">
        <div class="visit-card">
            <h1>Field Visit Requests</h1>

            <?php if(!empty($groupedRequests)): ?>
    <?php foreach($groupedRequests as $date => $requests): ?>
        <div class="visit-date-block">
            <h2 class="visit-date-heading"><?=htmlspecialchars(date('l, jS F Y', strtotime($date)))?></h2>
            <?php foreach($requests as $request): ?>
                <div class="visit-info">
                    <div class="visit-meta-vertical">

                        <p><strong>Time:</strong> <?=htmlspecialchars(date('g:i A', strtotime($request->visit_time)))?></p>
                        
                        <p><strong class="visit-reason-label">Reason:</strong> 
                            <span class="visit-reason" onclick="toggleReason(this)">
                                <?=htmlspecialchars($request->note)?>
                            </span>
                        </p>
                    </div>
                    <div class="actions">
                        <?php if($request->request_status == 'pending'): ?>
                            <form method="POST" action="<?=ROOT?>/citizen/FieldVisit/visitRequestAction" style="display:inline;">
                                <input type="hidden" name="request_id" value="<?=htmlspecialchars($request->id)?>">
                                <button type="submit" name="action" value="accept" class="btn accept">Accept</button>
                                <button type="submit" name="action" value="reject" class="btn reject">Reject</button>
                            </form>
                        <?php else: ?>
                            <span class="status-label"><?=htmlspecialchars(ucfirst($request->request_status))?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No field visit requests found.</p>
<?php endif; ?>
        </div>
    </div>
            


            <!-- Reschedule Form -->
            <div id="rescheduleform" class="reschedule-section">
                <h3>Reschedule Request</h3>
                <label for="new-date">Select New Date:</label>
                <input type="date" id="new-date" class="input-field">
                
                <label for="new-time">Select New Time:</label>
                <input type="time" id="new-time" class="input-field">
                
                <button class="btn submit-reschedule">Submit Reschedule Request</button>
            </div>
        </div>
    </div>

    <?php include '../app/views/citizen/partials/footer.php'; ?>



    <script src="<?=ROOT?>/assets/js/citizen/fieldvisit.js"></script>
</body>
</html>
