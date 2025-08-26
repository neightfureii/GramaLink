<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GN Election Monitoring - Registered Voters</title>

    <!-- iconscout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <!-- Montserrat Font (Google fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/gn/election.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</head>
<body>
    <?php $current_page = 'election'; include '../app/views/gn/partials/navbar.php';?>

    <div class="main-content">
        <div class="container">
            <h1 class="dashboard-title">Election Monitoring Dashboard</h1>

           

                    <!-- display error message for election date -->
                    <?php if (!empty($_SESSION['error_message'])): ?>
            <div class="error-message" style="color: red; text-align: center; padding: 10px; margin: 10px 0; background-color: #ffeeee; border: 1px solid #ffcccc; border-radius: 4px;">
                <?= htmlspecialchars($_SESSION['error_message']) ?>
                <?php unset($_SESSION['error_message']); ?>
            </div>
            <?php endif; ?>

           
            <!-- display error message for polling center -->
            <?php if (!empty($_SESSION['error_message_polling'])): ?>
            <div class="error-message" style="color: red; text-align: center; padding: 10px; margin: 10px 0; background-color: #ffeeee; border: 1px solid #ffcccc; border-radius: 4px;">
                <?= htmlspecialchars($_SESSION['error_message_polling']) ?>
                <?php unset($_SESSION['error_message_polling']); ?>
            </div>
            <?php endif; ?>

            <!-- display error message for contact number -->
            <?php if (!empty($_SESSION['error_message_number'])): ?>
            <div class="error-message" style="color: red; text-align: center; padding: 10px; margin: 10px 0; background-color: #ffeeee; border: 1px solid #ffcccc; border-radius: 4px;">
                <?= htmlspecialchars($_SESSION['error_message_number']) ?>
                <?php unset($_SESSION['error_message_number']); ?>
            </div>
            <?php endif; ?>




        
            <!-- Statistics Section -->
            
            <div class="stats-grid">
                <div class="stats-card green">
                    <div class="stats-value"><?= $stats['registeredVoters'] ?></div>
                    <div class="stats-label"> Voters</div>
                </div>
                
                <div class="stats-card blue" id="election-date-card" onclick="openElectionModal()">
                    <div class="stats-value"><?= $stats['nextElection'] ?></div>
                    <div class="stats-label">Next Election</div>
                </div>
                
                <div class="stats-card purple" id="polling-centers-card" onclick="openPollingCenterModal()">
                    <div class="stats-value"><?= $stats['pollingCenters'] ?></div>
                    <div class="stats-label">Polling Centers</div>
                </div>
            </div>

            <!-- Filter Section -->
<div class="filter-section">
    <div class="filter-options">
        <button class="filter-btn <?= (!isset($_GET['status']) || $_GET['status'] == 'all') ? 'active' : '' ?>" 
                onclick="filterByStatus('all')">All</button>
        <button class="filter-btn <?= (isset($_GET['status']) && $_GET['status'] == 'Pending') ? 'active' : '' ?>" 
                onclick="filterByStatus('Pending')">Pending</button>
        <button class="filter-btn <?= (isset($_GET['status']) && $_GET['status'] == 'Register') ? 'active' : '' ?>" 
                onclick="filterByStatus('Register')">Registered</button>
        <button class="filter-btn <?= (isset($_GET['status']) && $_GET['status'] == 'Reject') ? 'active' : '' ?>" 
                onclick="filterByStatus('Reject')">Rejected</button>
    </div>
</div>

            
            <!-- Registered Voters Section -->
            <div class="content-card">
                <h2 class="section-title">Voters</h2>
                <div class="table-container">
                
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>NIC</th>
                                <th>Voting Method</th>
                                <th>Name of Head of Household</th>
                                <th>Relationship to Head of Household</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <!-- meka therenne nh $voter seen ek -->
                        <tbody> 
                            <?php if(isset($voters) && is_array($voters) && count($voters) > 0): ?>   
                                <?php foreach($voters as $voter): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($voter->nic_number ?? 'N/A') ?></td>
                                        <td><?= htmlspecialchars($voter->voting_method ?? 'N/A') ?></td>
                                        <td><?= htmlspecialchars($voter->head_of_house ?? 'N/A') ?></td>
                                        <td><?= htmlspecialchars($voter->relationship ?? 'N/A') ?></td>
                                        <td><?= htmlspecialchars($voter->status ?? 'Pending') ?></td>
                                        <td>
                                            <button class="action-btn view" onclick="updateStatus('<?= $voter->nic_number ?>','Register')">
                                                Register
                                            </button>

                                            <button class="action-btn view" onclick="updateStatus('<?= $voter->nic_number ?>','Reject')">
                                                Reject
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="no-data">No voters found</td>
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
        
       

        <!-- Election Date Update Modal -->
        <div id="electionDateModal" class="modal">
            <div class="modal-content">
                <span class="close-modal" onclick="closeElectionModal()">×</span>
                <h2>Update Next Election Date</h2>
                <div class="modal-body">
                    <form method="POST" action="<?=ROOT?>/gn/election/updateDate">
                        <div class="form-group">
                            <label for="election-Date">Election Date:</label>
                            <input type="date" id="election-Date" name="election-Date" required>
                        </div>
                        <div class="form-group">
                            <label for="election-type">Election Type:</label>
                            <select id="election-type" name="election-type" required>
                                <option value="presidential">Presidential Election</option>
                                <option value="parliamentary">Parliamentary Election</option>
                                <option value="Provincial">Provincial Council Election</option>
                                <option value="local">Local Government Election</option>
                            </select>
                        </div>
                        <button type="submit" class="action-btn-update">Update Date</button>
                    </form>
                </div>
            </div>
        </div>

        
        <!-- Polling Center Update Modal -->
        <div id="pollingCenterModal" class="modal">
            <div class="modal-content">
                <span class="close-modal" onclick="closePollingCenterModal()">×</span>
                <h2>Update Polling Center</h2>
                <div class="modal-body">
                    <form method="POST" action="<?=ROOT?>/gn/election/updatePollingCenter">
                        <div class="form-group">
                            <label for="polling-center-name">Polling Center Name:</label>
                            <input type="text" id="polling-center-name" name="polling-center-name" required>
                        </div>
                        <div class="form-group">
                            <label for="polling-center-address">Address:</label>
                            <input type="text" id="polling-center-address" name="polling-center-address" required>
                        </div>
                        <div class="form-group">
                            <label for="polling-center-contact">Contact Number:</label>
                            <input type="text" id="polling-center-contact" name="polling-center-contact" required>
                        </div>
                        <button type="submit" class="action-btn-update">Update Polling Center</button>
                    </form>
                </div>
            </div>
        </div>


        
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Election monitoring dashboard loaded');
        
        // Modal functionality
        const voterModal = document.getElementById('voterModal');
        const electionModal = document.getElementById('electionDateModal');
        const closeBtns = document.querySelectorAll('.close-modal');
        
        // Close modal when clicking the X
        if(closeBtns) {
            closeBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    voterModal.style.display = 'none';
                    electionModal.style.display = 'none';
                });
            });
        }
        
        // Close modal when clicking outside of it
        window.addEventListener('click', function(event) {
            if (event.target == voterModal) {
                voterModal.style.display = 'none';
            }
            if (event.target == electionModal) {
                electionModal.style.display = 'none';
            }
        });
    });
    
    // Function to open the election date modal
    function openElectionModal() {
        document.getElementById('electionDateModal').style.display = 'block';
    }
    
    // Function to close the election date modal
    function closeElectionModal() {
        document.getElementById('electionDateModal').style.display = 'none';
    }

    //Function to open polling center modal
    function openPollingCenterModal(){
        document.getElementById('pollingCenterModal').style.display = 'block';
    }

    //Function to close polling center modal
    function closePollingCenterModal(){
        document.getElementById('pollingCenterModal').style.display = 'none';
    }
    
  
    
    // Function to handle form submission for updating election date
    function updateElectionDate(event) {
        event.preventDefault();
        
        const dateInput = document.getElementById('election-Date');
        const typeInput = document.getElementById('election-type');
        
        if(!dateInput.value) {
            alert('Please select a date');
            return;
        }
        
        // Submit the form
        event.target.submit();
    }

    // Function to handle form submission for updating polling centers
    function updatePollingCenter(event) {
        event.preventDefault();

        const nameInput = document.getElementById('polling-center-name');
        const addressInput = document.getElementById('polling-center-address');
        const contactInput = document.getElementById('polling-center-contact');

        // Validate inputs
        if (!nameInput.value) {
            alert('Please enter the polling center name');
            return;
        }
        if (!addressInput.value) {
            alert('Please enter the polling center address');
            return;
        }
        if (!contactInput.value) {
            alert('Please enter the polling center contact number');
            return;
        }

        // Submit the form
        event.target.submit();
    }

    function updateStatus(nic, status) {

    // Customize confirmation message based on status
    let confirmMessage = status === 'Register' 
        ? 'Are you sure you want to register this voter?' 
        : 'Are you sure you want to reject this voter?';

    if(confirm(confirmMessage)) {
        window.location.href = `election/updateStatus/${nic}/${status}`; //go to the controller function
    
    }
    }

    function deleteVoters(){
        //cutomize confirmation message
        let confirmMessage = 'Are you sure want to delete this voter?';
        if(confirm(confirmMessage)){
            window.location.href = `election/deleteVoter`;
        }
    }

    function filterByStatus(status) {
    // Get current URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    
    // Update status parameter
    urlParams.set('status', status);
    
    // Reset to page 1 when changing filters
    urlParams.set('page', '1');
    
    // Update URL with all parameters preserved
    window.location.search = urlParams.toString();
}

    
</script>
</body>
</html>
