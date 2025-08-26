<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GN Citizen Search</title>

    <!-- iconscout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
     <!-- Montserrat Font (Google fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/gn/citizensearch.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    
</head>
<body>
    <?php $current_page = 'citizensearch'; include '../app/views/gn/partials/navbar.php';?>

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

    <div class="main-content">
        <div class="header">
            <h2 class="search-title">Citizen Search</h2>
            <div class="right" style="display:flex; gap:20px;">
                <?php include '../app/views/gn/partials/header_icons.php'; ?>
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Enter NIC number to search...">
                </div>
            </div>
        </div>

        <div class="addnewsection">
            <div class="addnew">
                <button class="addnew-btn" onClick="openAddModal()"><i class="uil uil-plus"></i> Add New Citizen</button>
            </div>
            <div class="addnew" id="openrequests">
                <button class="addnew-btn" onClick="switchTabs('openrequests')"><i class="uil uil-arrow-down-left"></i> Citizen Requests</button>
            </div>
            <div class="addnew" id="closerequests" style="display:none;">
                <button class="addnew-btn" onClick="switchTabs('closerequests')" style="background:red"><i class="uil uil-times"></i> Close Requests</button>
            </div>
        </div>

        <div class="search-section" style="display:none;">
            <div class="search-box">
            </div>

            <div class="filters">
                <select id="genderFilter">
                    <option value="none">Filter by Gender</option>
                    <option value="female">Female</option>
                    <option value="male">Male</option>
                </select>
                <select id="ageFilter">
                    <option value="none">Filter by Age</option>
                    <option value="18-30">18-30</option>
                    <option value="31-50">31-50</option>
                    <option value="51+">51+</option>
                </select>
                <select id="districtFilter">
                    <option value="none">Filter by District</option>
                    <option value="colombo">Colombo</option>
                    <option value="gampaha">Gampaha</option>
                    <option value="kandy">Kandy</option>
                </select>
                <button class="search-btn" onclick="performSearch()">
                    <i class="fas fa-search"></i>
                    Search
                </button>

            </div>
        </div>

        <div id="resultsSection" class="results-section">
            <table id="citizenTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>NIC Number</th>
                        <th>Age</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($citizens)):?>
                        <?php foreach($citizens as $citizen):?>
                            <tr>
                                <td><?=$citizen->full_name?></td>
                                <td><?=$citizen->nic?></td>


                                <!-- code check editted part task 1 -->
                                <td><?=$citizen->age?></td>
                                
                                
                                <td>
                                    <a href="<?=ROOT?>/gn/citizendetails/<?=$citizen->citizen_id?>" class="view-btn">View</a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    <?php else:?>
                        <tr>
                            <td colspan="3" style="text-align:center;">No citizens available</td>
                        </tr>
                    <?php endif;?>
                </tbody>
            </table>
        </div>

        <div id="requestsSection" class="results-section" style="display:none;">
            <table id="requestsTable">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Citizen ID</th>
                        <th>Date Submitted</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($requests)):?>
                        <?php foreach($requests as $request):?>
                            <tr>
                                <td><?=$request->editrequest_id?></td>
                                <td><?=$request->citizen_id?></td>
                                <td><?=$request->created_at?></td>
                                <td>
                                    <a href="<?=ROOT?>/gn/citizenrequests/<?=$request->editrequest_id?>" class="view-btn">View</a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    <?php else:?>
                        <tr>
                            <td colspan="4" style="text-align:center;">No requests available</td>
                        </tr>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- addCitizenModal -->
    <div id="addCitizenModal" class="modal" style="display:none;">
        <div class="modal-content"  style="margin-top:25rem;">
            <span class="close" onclick="closeModal('addCitizenModal')">&times;</span>
            <h2>Add New Citizen</h2>
            <form id="addCitizenForm" action="<?=ROOT?>/gn/citizensearch/addNewCitizen" method="POST" enctype="multipart/form-data">
                <label for="citizenName">Full Name:</label>
                <input type="text" id="citizenName" name="citizenName" required>
                <label for="citizenNIC">NIC:</label>
                <input type="text" id="citizenNIC" name="citizenNIC" required>
                <label for="citizenBCN">Birth Certificate Number:</label>
                <input type="text" id="citizenBCN" name="citizenBCN" required>
                <div class="gender">
                    <label for="citizenGender">Gender:</label>
                    <input type="radio" id="citizenGenderM" value="Male" name="citizenGender" required> Male
                    <input type="radio" id="citizenGenderF" value="Female" name="citizenGender" required> Female
                </div>
                <label for="citizenCivilStatus">Civil Status:</label>
                <select type="text" id="citizenCivilStatus" name="citizenCivilStatus" required>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Widowed">Widowed</option>
                </select>
                <label for="citizenAddress">Address:</label>
                <input type="text" id="citizenAddress" name="citizenAddress" required>
                <label for="citizenEmail">Email:</label>
                <input type="text" id="citizenEmail" name="citizenEmail" required>
                <label for="citizenContact">Contact No:</label>
                <input type="text" id="citizenContact" name="citizenContact" required>
                <label for="citizenDOB">Date of Birth:</label>
                <input type="date" id="citizenDOB" name="citizenDOB" required>

                <!-- code check edditted part task 1 -->
                <label for="citizenAge">Age:</label>
                <input type="number" id="citizenAge" name="citizenAge" required>


                <label for="citizenPhoto">Photo:</label>
                <input type="file" id="citizenPhoto" name="citizenPhoto" required>
                <button type="submit">Add Citizen</button>
            </form>
        </div>
    </div>


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

        function switchTabs(tab) {
            if (tab === 'openrequests') {
                document.getElementById('openrequests').style.display = 'none';
                document.getElementById('closerequests').style.display = 'block';
                document.getElementById('resultsSection').style.display = 'none';
                document.getElementById('requestsSection').style.display = 'block';
            } else {
                document.getElementById('openrequests').style.display = 'block';
                document.getElementById('closerequests').style.display = 'none';
                document.getElementById('resultsSection').style.display = 'block';
                document.getElementById('requestsSection').style.display = 'none';
            }
        }

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

    <script src="<?=ROOT?>/assets/js/gn/citizensearch.js"></script>

</body>
</html>