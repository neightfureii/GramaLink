<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
    <!-- iconscout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
     <!-- Montserrat Font (Google fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/gn/feedback.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    
</head>
<body>
<?php $current_page = 'feedback'; include '../app/views/gn/partials/navbar.php';?>

    <?php
    // Count positive feedback based on specified statuses
    $positiveFeedbackCount = 0;

    if (isset($feedbackData) && is_array($feedbackData)) {
        $positiveFeedbackCount = count(array_filter($feedbackData, function ($feedback) {
            return in_array($feedback->Status, ['Meets Expectations', 'Above Expectations', 'Exemplary Service']);
        }));
    }
    ?>

    
    <div class="main-content">

        <div class="header">
            <h1>Feedback Overview</h1>
            <!-- <p>Review and manage feedback received from your team and stakeholders</p> -->
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <h3>Total Feedback</h3>
                <div class="stat-value">

                    <!--count feedback data-->
                    <?= isset($feedbackData) && is_array($feedbackData) ? count($feedbackData) : 0 ?>
                

                    <!-- <span class="trend positive">+12%</span> -->
                </div>
            </div>
            <div class="stat-card">
                <h3>Positive Feedback</h3>
                <div class="stat-value">
                    <?= $positiveFeedbackCount ?>
                    <!-- <span class="trend positive">+8%</span> -->
                </div>
            </div>
            <div class="stat-card">
                <h3>Average Rating</h3>
                <div class="stat-value">
                    4.6
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <h3>Response Rate</h3>
                <div class="stat-value">
                    92%
                    <span class="trend positive">+5%</span>
                </div>
            </div>
        </div>

        <div class="controls">
            <!-- <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="search" class="search" placeholder="Search feedback...">
            </div> -->
            <select id="typeFilter">
                <option value="all">Select Type</option>
                <option value="positive">Positive</option>
                
            </select>
           
        </div>

        <div class="feedback-grid">
            <!--display feedback cards-->
            <?php if (!empty($feedbackData)): ?>
                <?php foreach ($feedbackData as $feedback): ?>
            
            <div class="feedback-card <?= $feedback->Mark_as_Read ? 'mark-as-read' : '' ?>">

                <div class="feedback-header">
                    <div class="sender-info">
                       
                        <div class="sender-details">
                            <h3><?= htmlspecialchars($feedback->Name)?></h3>
                           
                        </div>
                    </div>
                   
                </div>
                <div class="feedback-content">
                    <textarea readonly style="max-height: 150px; overflow-y: auto;">
                    <?= htmlspecialchars($feedback->Text)?>
                    </textarea>
                
                </div>
                <div class="feedback-footer">
                    <span class="feedback-type 
                    <?= $feedback->Status === 'Unacceptable Service' ? 'type-suggestion' :
                        ($feedback->Status === 'Below Expectations' ? 'type-suggestion' :
                        ($feedback->Status === ' Meets Expectations' ? 'type-neutral' : 'type-positive'))?>">
                        <?= htmlspecialchars($feedback->Status)?>
                    </span>
                    <div class="feedback-actions">
                    <a href="<?=ROOT?>/gn/feedback/markAsRead/<?= $feedback->ID ?>" class="action-btn" title="Mark as Read"> 
                        <button >
                            
                            <i class="fas fa-check"></i>
                        </button>
                    </a>
                    <a href="<?= ROOT ?>/gn/feedback/delete/<?=$feedback->ID ?>" class="action-btn" title="Delete" onclick="return confirm('Are you sure you want to delete this feedback?')">
                        <button>
                        
                            <i class="fas fa-archive"></i>
                        
                        </button>
                    </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else:?>
                <p>No feedback Avaliable.</p>
            <?php endif; ?>
        </div>

        <script>
            const feedbackData = <?= json_encode($feedbackData) ?>;
        </script>
    <script src="<?=ROOT?>/assets/js/gn/feedback.js"></script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>