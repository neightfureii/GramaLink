<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback & Suggestions</title>

    <!-- Iconscout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <!-- Montserrat Font(Google fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Iconscout CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/citizen/feedback.css"> 
   

    <style>
        .feedback-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: 'Montserrat', sans-serif;
        }

        .feedback-table th, .feedback-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .feedback-table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .feedback-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .feedback-table tr:hover {
            background-color: #f1f1f1;
        }

        .feedback-type {
            padding: 5px 10px;
            border-radius: 5px;
            color: #fff;
            font-weight: bold;
        }

        .type-neutral {
            background-color: #ffcc00;
        }

        .type-positive {
            background-color: #4caf50;
        }

        .action-btn {
            color: #007bff;
            text-decoration: none;
            margin-left: 10px;
        }

        .action-btn:hover {
            text-decoration: underline;
        }

        .no-feedback {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            color: #555;
        }
    </style>
</head>
<body>
<?php include '../app/views/citizen/partials/navbar.php'; ?>
<!-- Breadcrumb Section -->
<div class="container breadcrumb">
        <p><a href="home" class="crumb">Home</a> > <a href="dashboard" class="crumb">Dashboard</a> > <a href="feedback" class="crumb">Feedback</a></p>
    </div>
<div class="container feedbackcont">
    <!-- Left Panel -->
    <!-- <div class="left-panel">
        <div class="chat-icon">
            <i class="fas fa-comments"></i>
        </div>
        <h1>GN Link System Feedback</h1>
        <p>Help us improve our services with your valuable feedback</p>
    </div> -->
    <!-- Right Panel -->
    <div class="right-panel">
        <!-- GN Officer Profile Card -->
        <div class="profile-card">
            <div class="profile-image">
                <img src="<?=ROOT?>/assets/images/Profile_image_2.png" alt="GN Officer Photo" id="officerPhoto">
            </div>
            <h2 class="officer-name">Amantha Tharusha</h2>
            <div class="officer-stats">
                <div class="stat">
                    <i class="fas fa-star"></i>
                    <p>Rating</p>
                    <span>4.5/5</span>
                </div>
                <div class="stat">
                    <i class="far fa-clock"></i>
                    <p>Response Time</p>
                    <span>24hrs</span>
                </div>
                <div class="stat">
                    <i class="fas fa-briefcase"></i>
                    <p>Experience</p>
                    <span>5 years</span>
                </div>
            </div>
        </div>

        <!-- Feedback Form -->
        <form class="feedback-form" method="POST">
            <div class="form-row">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" id="name" name="name" placeholder="Your Name" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email" placeholder="Your Email" required>
                </div>
            </div>

            <!-- Star Rating Section -->
            <div class="star-rating">
                <label>Rate your experience:</label>
                <div class="stars">
                    <input type="radio" id="star1" name="rating" value="1">
                    <label for="star1" class="fas fa-star"></label>
                    <input type="radio" id="star2" name="rating" value="2">
                    <label for="star2" class="fas fa-star"></label>
                    <input type="radio" id="star3" name="rating" value="3">
                    <label for="star3" class="fas fa-star"></label>
                    <input type="radio" id="star4" name="rating" value="4">
                    <label for="star4" class="fas fa-star"></label>
                    <input type="radio" id="star5" name="rating" value="5">
                    <label for="star5" class="fas fa-star"></label>
                </div>
            </div>

            <div class="input-group">
                <i class="fas fa-comment"></i>
                <textarea id="massage" name="text" placeholder="Write your feedback" required></textarea>
            </div>
            <div class="button-group">
                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i>
                    Submit Feedback
                </button>
            </div>
        </form>

        <!-- Feedback Table -->
        <?php if (!empty($feedbackData)): ?>
            <table class="feedback-table">
    <thead>
        <tr>
            <th>Feedback</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($feedbackData as $feedback): ?>
        <tr>
        <td><?= htmlspecialchars(strlen($feedback->Text) > 10 ? substr($feedback->Text, 0, 10) . '...' : $feedback->Text) ?></td>

            <td>
                <span class="feedback-type 
                    <?= $feedback->Mark_as_Read === 0 ? 'type-neutral' : 'type-positive' ?>">
                    <?= $feedback->Mark_as_Read === 0 ? 'send' : 'seen' ?>
                </span>
            </td>
            <td>
                <a href="<?=ROOT?>/citizen/Feedbackview/popup/<?=$feedback->ID?>" style="text-decoration: none;">
                    <button class="btn">
                    View
                    
                    </button>
                   
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
        <?php else: ?>
        <p class="no-feedback">No feedback available.</p>
        <?php endif; ?>


             
        
          
    </div>
</div>

<?php include '../app/views/citizen/partials/footer.php'; ?>

<script>
    <?php if ($isSucess): ?>
        alert("Feedback submitted successfully!");
    <?php elseif (!empty($errors)): ?>
        alert("There was an error with your feedback. Please try again.");
    <?php endif; ?>
</script>



<script src="<?=ROOT?>/assets/js/citizen/feedback.js"></script>
</body>
</html>
