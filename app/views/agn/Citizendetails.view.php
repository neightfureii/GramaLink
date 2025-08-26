<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGN Review Applications</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/agn/citizendetails.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php $current_page = 'citizendetails'; include '../app/views/agn/partials/navbar.php';?>
    
    <div class="main-content">
        <header class="citizen-header">
            <h2>Citizen Details</h2>
            <?php include '../app/views/agn/partials/header_icons.php'?>
        </header>

        <div class="search-section">
            <!-- Filters -->
            <div class="filters">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" id="search-input" placeholder="Enter NIC number to search...">
                </div>
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

            <div id="resultsSection" class="results-section">
                <table id="citizenTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>NIC Number</th>
                            <th>GN Division</th>
                            <th>Age</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($citizenDetails)):?>
                            <?php foreach($citizenDetails as $i):?>
                                <tr>
                                    <td><?=$i->full_name?></td>
                                    <td><?=$i->nic?></td>
                                    <td><?=$i->division_name?></td>

                                    <!-- code check eddited part task 1 -->
                                    <td><?=$i->age?></td>

                                    <td class="actions-cell">

                                        <!-- code check eddited part task 1 -->
                                        <button 
                                            class="action-btn view-btn" 
                                            onclick="viewCitizenDetails(this)"
                                            data-citizen-image="<?=$i->image?>"
                                            data-citizen-name="<?=$i->full_name?>"
                                            data-citizen-dob="<?=$i->date_of_birth?>"
                                            data-citizen-age="<?=$i->age?>"
                                            data-citizen-gender="<?=$i->gender?>"
                                            data-citizen-nic="<?=$i->nic?>"
                                            data-citizen-bcnumber="<?=$i->bcnumber?>"
                                            data-citizen-civilstatus="<?=$i->civil_status?>"
                                            data-citizen-address="<?=$i->address?>"
                                            data-citizen-email="<?=$i->email?>"
                                            data-citizen-division="<?=$i->division_name?>"
                                            data-citizen-contact="<?=$i->mobileNumber?>"
                                        >
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        <?php else:?>
                            <tr>
                                <td colspan="3" class="no-results">
                                    <div class="empty-state">
                                        <i class="fas fa-user-slash empty-icon"></i>
                                        <p>No Citizen details found.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- view modal -->
    <div id="viewModal" class="modal" style="display:none;">
        <div class="modal-content" style="margin-top:15rem">
            <span class="close" onclick="closeModal('viewModal')">&times;</span>
            <h2>Citizen Details</h2>
            <div style="text-align:center"><img id="citizenImage" src="" alt="Citizen Image" style="width: 8rem;border-radius: 20%;"></div>
            <strong>Name:</strong> <input type="text" id="citizenName" name="citizenName" readonly>
            <strong>Date of Birth:</strong> <input type="text" id="citizenDOB" name="citizenDOB" readonly>
            <strong>Age:</strong> <input type="text" id="citizenAge" name="citizenAge" readonly>
            <strong>Gender:</strong> <input type="text" id="citizenGender" name="citizenGender" readonly>
            <strong>NIC:</strong> <input type="text" id="citizenNIC" name="citizenNIC" readonly>
            <strong>Birth Certificate No:</strong> <input type="text" id="citizenBCN" name="citizenBCN" readonly>
            <strong>Civil Status:</strong> <input type="text" id="citizenCivilStatus" name="citizenCivilStatus" readonly>
            <strong>Address:</strong> <input type="text" id="citizenAddress" name="citizenAddress" readonly>
            <strong>Email:</strong> <input type="text" id="citizenEmail" name="citizenEmail" readonly>
            <strong>Division:</strong> <input type="text" id="citizenDivision" name="citizenDivision" readonly>
            <strong>Contact No:</strong> <input type="text" id="citizenContactNo" name="citizenContactNo" readonly>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializeEventListeners();
        });

        function viewCitizenDetails(button) {
            document.getElementById('citizenImage').src = "<?=ROOT?>" + button.getAttribute('data-citizen-image');
            document.getElementById('citizenName').value = button.getAttribute('data-citizen-name');
            document.getElementById('citizenDOB').value = button.getAttribute('data-citizen-dob');
            document.getElementById('citizenAge').value = button.getAttribute('data-citizen-age');
            document.getElementById('citizenGender').value = button.getAttribute('data-citizen-gender');
            document.getElementById('citizenNIC').value = button.getAttribute('data-citizen-nic');
            document.getElementById('citizenBCN').value = button.getAttribute('data-citizen-bcnumber');
            document.getElementById('citizenCivilStatus').value = button.getAttribute('data-citizen-civilstatus');
            document.getElementById('citizenAddress').value = button.getAttribute('data-citizen-address');
            document.getElementById('citizenEmail').value = button.getAttribute('data-citizen-email');
            document.getElementById('citizenDivision').value = button.getAttribute('data-citizen-division');
            document.getElementById('citizenContactNo').value = button.getAttribute('data-citizen-contact');
            document.getElementById('viewModal').style.display = 'block';
        }

        function closeModal(modalID) {
            document.getElementById(modalID).style.display = 'none';
        }

        function initializeEventListeners() {
            window.onclick = (event) => {
                if (event.target.classList.contains('modal')) {
                    event.target.style.display = 'none';
                }
            };
        }
    </script>

</body>
</html>