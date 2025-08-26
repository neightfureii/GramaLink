<?php
    $lang = $_COOKIE['language'] ?? 'en';
    $text = include "../app/lang/$lang.php";
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citizen Voter Registration</title>

    <!-- iconscout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
     <!-- Montserrat Font (Google fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/citizen/voter.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    
</head>
<body>
    <?php $current_page = 'voter'; include '../app/views/citizen/partials/navbar.php';?>

    <div class="container wrapper">
        <div class="container applications-container">
            <!-- <h1 class="page-title">Voter Registration</h1> -->

            <!-- display error message -->
            <?php if (!empty($_SESSION['error_message_NIC'])): ?>
                <div class="error-message" style="color: red; text-align: center; padding: 10px; margin: 10px 0; background-color: #ffeeee; border: 1px solid #ffcccc; border-radius: 4px;">
                    <?= htmlspecialchars($_SESSION['error_message_NIC']) ?>
                    <?php unset($_SESSION['error_message_NIC']); ?>
                </div>
            <?php endif; ?>
            
            <div class="registration-card">
            <h1 class="page-title"><?=$text['VoterRegistration']?></h1>
                <form action="<?=ROOT?>/citizen/voter/register" method="POST" class="registration-form">
                <div class="form-group">
                            <label><?=$text['VotingMethod']?>(Postal Voting/Polling Station Voting)</label>
                            <input type="text" name="votingMethod" required>
                        </div>
                        
                        <div class="form-group">
                        <label><?=$text['NICNumber']?></label>
                            <?php if(!empty($citizenDetails) && is_object($citizenDetails)): ?>
                                <input type="text" name="nicNumber" value = '<?=htmlspecialchars($citizenDetails->nic)?>' required>
                            <?php else: ?>
                           
                                <input type="text" name="nicNumber" value = "Not Nic Available" required>
                            <?php endif;?>
                        </div>
                        
                        <div class="form-group">
                            <label><?=$text['NameOfHeadOfHousehold']?></label>
                            <input type = "text" name = "headofHouse" required>
                        </div>
                        
                        <div class="form-group">
                            <label><?=$text[ 'RelationshipToHeadOfHousehold']?></label>
                            <input type="text" name="relationship" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="submit-button">
                    <?=$text['SubmitRegistration']?>
                    </button>
                </form>
            </div>
        </div>
        <div class="stats-card blue" id="election-date-card">
                    <div class="stats-value"><?= $stats['nextElection'] ?></div>
                    <div class="stats-label"><?=$text['NextElection']?></div>
                </div>

            

                
                <!-- Polling Centers Section -->
            <div class="content-card">
                <h2 class="section-title"><?=$text['PollingCenters']?></h2>

                <!-- search_bar -->
                <div class="search-container">
                    <form action="" method="GET" class="search-form">
                        <div class="search-input-group">
                            <input type="text" name="search_center" placeholder="Search Polling Center" value="<?=htmlspecialchars($_GET['search_center'] ?? '')?>">
                            <button type="submit" class="search-btn"><i class="uil uil-search"></i></button>
                            <?php if(isset($_GET['search_center']) && !empty($_GET['search_center'])): ?>
                                <a href="<?=ROOT?>/citizen/voter" class="clear-search-btn"><i class="uil uil-times"></i></a>
                            <?php endif; ?>
                        </div>
                    </form>
               </div>

                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                               
                                <th><?=$text['Name']?></th>
                                <th><?=$text['Address']?></th>
                                <th><?=$text['Contact']?></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($pollcenters) && is_array($pollcenters) && count($pollcenters) > 0): ?>
                                <?php foreach($pollcenters as $i): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($i->name ?? 'N/A') ?></td>
                                        <td><?= htmlspecialchars($i->address ?? 'N/A') ?></td>
                                        <td><?= htmlspecialchars($i->contact ?? 'N/A') ?></td>
                                        
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="no-data">No Polling Centers found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="pagination">
                    <button class="pagination-btn"><i class="uil uil-angle-left"></i></button>
                    <span class="pagination-info">Page 1 of 1</span>
                    <button class="pagination-btn"><i class="uil uil-angle-right"></i></button>
                </div>
            </div>
    </div>

    <?php include '../app/views/citizen/partials/footer.php'; ?>

    <script>
        function openAddModal() {
            document.getElementById('addCitizenModal').style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }
        
        window.onclick = function(event) {
            var modal = document.getElementById('addCitizenModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
