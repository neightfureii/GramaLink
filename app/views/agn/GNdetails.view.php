<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGN Management System</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/agn/gndetails.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php $current_page = 'gndetails'; include '../app/views/agn/partials/navbar.php';?>
    
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
        <header class="gn-header">
            <h2>GN Details</h2>
            <div class="header-actions">
                <?php include '../app/views/agn/partials/header_icons.php'?>
            </div>
        </header>

        <div class="dashboard-cards">
        
        </div>

        <div class="search-section">
            <div class="buttons" style="display:flex;gap:2rem;">
                <button class="add-btn" onclick="addNewGN()">
                    <i class="fas fa-plus"></i>
                    Add New GN
                </button>
                <button class="add-btn" onclick="switchTabs('openrequests')" id="openrequests">
                    <i class="fas fa-file"></i>
                    GN Requests
                </button>
                <button class="add-btn" onclick="switchTabs('closerequests')" style="background:red;display:none" id="closerequests">
                    <i class="fas fa-times"></i>
                    Close Requests
                </button>
            </div>

            <script>
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
            </script>
            <div class="filters">
            <!-- Filters -->
                <!-- <select id="genderFilter">
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
                <select id="statusFilter">
                    <option value="none">Filter by Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select> -->
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" id="search-input" placeholder="Search by ID, name or division...">
                </div>
                
                <button class="search-btn" onclick="performSearch()">
                    <i class="fas fa-search"></i>
                    Search
                </button>
            </div>

            <div id="resultsSection" class="results-section">
                <table id="citizenTable">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Employee ID</th>
                            <th>Division</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($gnDetails)):?>
                            <?php foreach($gnDetails as $gn):?>
                                <tr <?=$gn->is_active==0 ?'class="inactive-row"':''?>>
                                    <td><img src="<?=ROOT . $gn->image?>" style="border-radius:20%;width:2rem;"></td>
                                    <td><?=$gn->full_name?></td>
                                    <td><?=$gn->employee_id?></td>
                                    <td><?=$gn->division_name ?? 'N/A'?></td>
                                    <td><?=$gn->is_active == 1 ? 'Active' : 'Inactive'?></td>
                                    <td class="actions-cell">
                                        <button 
                                            class="action-btn view-btn" 
                                            onClick="viewGNDetails(this)"
                                            data-gn-id="<?=$gn->gn_id ?? 'N/A'?>"
                                            data-gn-image="<?=$gn->image ?? 'N/A'?>"
                                            data-gn-name="<?=$gn->full_name ?? 'N/A'?>"
                                            data-gn-employee-id="<?=$gn->employee_id ?? 'N/A'?>"
                                            data-gn-appointed-date="<?=$gn->appointed_date ?? 'N/A'?>"
                                            data-gn-nic="<?=$gn->nic ?? 'N/A'?>"
                                            data-gn-address="<?=$gn->address ?? 'N/A'?>"
                                            data-gn-email="<?=$gn->email ?? 'N/A'?>"
                                            data-gn-division-name="<?=$gn->division_name ?? 'N/A'?>"
                                            data-gn-contact="<?=$gn->mobileNumber ?? 'N/A'?>"
                                            data-gn-active="<?=$gn->is_active?>"
                                        >
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button 
                                            class="action-btn edit-btn"
                                            onClick="editGNDetails(this)"
                                            data-gn-id="<?=$gn->gn_id ?? 'N/A'?>"
                                            data-gn-name="<?=$gn->full_name ?? 'N/A'?>"
                                            data-gn-employee-id="<?=$gn->employee_id ?? 'N/A'?>"
                                            data-gn-appointed-date="<?=$gn->appointed_date ?? 'N/A'?>"
                                            data-gn-nic="<?=$gn->nic ?? 'N/A'?>"
                                            data-gn-address="<?=$gn->address ?? 'N/A'?>"
                                            data-gn-division-id="<?=$gn->gn_division_id ?? 'N/A'?>"
                                            data-gn-contact="<?=$gn->mobileNumber ?? 'N/A'?>"
                                            data-gn-active="<?=$gn->is_active?>"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete-btn" onClick="deleteGN(<?=$gn->gn_id?>)" <?=$gn->is_active==0 ?'style="display:none"':''?>>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        <?php else:?>
                            <tr>
                                <td colspan="6" class="no-results">
                                    <div class="empty-state">
                                        <i class="fas fa-user-slash empty-icon"></i>
                                        <p>No GN details found.</p>
                                        <button class="action-btn add-btn">
                                            <i class="fas fa-plus"></i>
                                            Add New GN
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endif;?>
                    </tbody>
                </table>
                
            </div>

            <div id="requestsSection" class="results-section" style="display:none">
                <table id="citizenTable">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>GN ID</th>
                            <th>Date Submitted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($requests)):?>
                            <?php foreach($requests as $request):?>
                                <tr>
                                    <td><?=$request->editrequestgn_id?></td>
                                    <td><?=$request->gn_id?></td>
                                    <td><?=$request->created_at ?? 'N/A'?></td>
                                    <td class="actions-cell">
                                        <a href="<?=ROOT?>/agn/gnrequests/<?=$request->editrequestgn_id?>">View</a>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        <?php else:?>
                            <tr>
                                <td colspan="6" class="no-results">
                                    <div class="empty-state">
                                        <i class="fas fa-user-slash empty-icon"></i>
                                        <p>No GN Requests found.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif;?>
                    </tbody>
                </table>
                
            </div>
        </div>

        <!-- view modal -->
        <div id="viewModal" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close" onclick="closeModal('viewModal')">&times;</span>
                <h2>GN Details</h2>
                <div style="text-align:center"><img id="gnImage" src="" alt="GN Image" style="width: 8rem;border-radius: 20%;"></div>
                <strong>Name:</strong> <input type="text" id="gnName" name="gnName" readonly>
                <strong>Employee ID:</strong> <input type="text" id="gnEmployeeId" name="gnEmployeeId" readonly>
                <strong>Appointed Date:</strong> <input type="text" id="gnAppointedDate" name="gnAppointedDate" readonly>
                <strong>NIC:</strong> <input type="text" id="gnNIC" name="gnNIC" readonly>
                <strong>Address:</strong> <input type="text" id="gnAddress" name="gnAddress" readonly>
                <strong>Email:</strong> <input type="text" id="gnEmail" name="gnEmail" readonly>
                <strong>Division:</strong> <input type="text" id="gnDivision" name="gnDivision" readonly>
                <strong>Contact No:</strong> <input type="text" id="gnContactNo" name="gnContactNo" readonly>
            </div>
        </div>

        <!-- Add New GN Modal -->
        <div id="addModal" class="modal" style="display:none;">
            <div class="modal-content"  style="margin-top:20rem;">
                <span class="close" onclick="closeModal('addModal')">&times;</span>
                <h2>Add New GN</h2>
                <form id="addGNForm" action="<?=ROOT?>/agn/gndetails/addNewGN" method="POST">
                    <label for="gnNameadd">Full Name:</label>
                    <input type="text" id="gnNameadd" name="gnNameadd" required>
                    <label for="gnEmployeeIdadd">Employee ID:</label>
                    <input type="text" id="gnEmployeeIdadd" name="gnEmployeeIdadd" required>
                    <label for="gnNICadd">NIC:</label>
                    <input type="text" id="gnNICadd" name="gnNICadd" required>
                    <label for="gnAddressadd">Address:</label>
                    <input type="text" id="gnAddressadd" name="gnAddressadd" required>
                    <label for="gnEmailadd">Email:</label>
                    <input type="text" id="gnEmailadd" name="gnEmailadd" required>
                    <label for="gnContactadd">Contact No:</label>
                    <input type="text" id="gnContactadd" name="gnContactadd" required>
                    <label for="gnAppointedDateadd">Appointed Date:</label>
                    <input type="date" id="gnAppointedDateadd" name="gnAppointedDateadd" required>
                    <label for="gnDivisionadd">Division:</label>
                    <!-- select -->
                    <select id="gnDivisionadd" name="gnDivisionadd" required>
                        <option value="" disabled selected>Select Division</option>
                        <?php foreach($divisions as $division): ?>
                            <option value="<?=$division->gn_division_id?>"><?=$division->division_name?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit">Add GN</button>
                </form>
            </div>
        </div>

        <!-- edit modal -->
        <div id="editModal" class="modal" style="display:none;">
            <div class="modal-content" style="margin-top:15rem;">
                <span class="close" onclick="closeModal('editModal')">&times;</span>
                <h2>Edit GN Details</h2>
                <form id="editGN" action="<?=ROOT?>/agn/gndetails/editGN" method="POST">
                    <input type="hidden" id="gnIdedit" name="gnIdedit">
                    <label for="gnNameedit">Full Name:</label>
                    <input type="text" id="gnNameedit" name="gnNameedit">
                    <label for="gnEmployeeIdedit">Employee ID:</label>
                    <input type="text" id="gnEmployeeIdedit" name="gnEmployeeIdedit">
                    <label for="gnAppointedDateedit">Appointed Date:</label>
                    <input type="date" id="gnAppointedDateedit" name="gnAppointedDateedit">
                    <label for="gnNICedit">NIC:</label>
                    <input type="text" id="gnNICedit" name="gnNICedit">
                    <label for="gnAddressedit">Address:</label>
                    <input type="text" id="gnAddressedit" name="gnAddressedit">
                    <label for="gnDivisionedit">Division:</label>
                    <select id="gnDivisionedit" name="gnDivisionedit">
                        <option value="" disabled selected>Select Division</option>
                        <?php foreach($divisions as $division): ?>
                            <option value="<?=$division->gn_division_id?>"><?=$division->division_name?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="gnContactNoedit">Contact No:</label>
                    <input type="text" id="gnContactNoedit" name="gnContactNoedit" readonly>
                    <button type="submit">Save</button>
                </form>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializeEventListeners();
        });

        function viewGNDetails(button) {
            document.getElementById('gnImage').src = "<?=ROOT?>" + button.getAttribute('data-gn-image');
            document.getElementById('gnName').value = button.getAttribute('data-gn-name');
            document.getElementById('gnEmployeeId').value = button.getAttribute('data-gn-employee-id');
            document.getElementById('gnAppointedDate').value = button.getAttribute('data-gn-appointed-date');
            document.getElementById('gnNIC').value = button.getAttribute('data-gn-nic');
            document.getElementById('gnAddress').value = button.getAttribute('data-gn-address');
            document.getElementById('gnEmail').value = button.getAttribute('data-gn-email');
            document.getElementById('gnDivision').value = button.getAttribute('data-gn-division-name');
            document.getElementById('gnContactNo').value = button.getAttribute('data-gn-contact');
            document.getElementById('viewModal').style.display = 'block';
        }

        function editGNDetails(button) {
            document.getElementById('gnIdedit').value = button.getAttribute('data-gn-id');
            document.getElementById('gnNameedit').value = button.getAttribute('data-gn-name');
            document.getElementById('gnEmployeeIdedit').value = button.getAttribute('data-gn-employee-id');
            document.getElementById('gnAppointedDateedit').value = button.getAttribute('data-gn-appointed-date');
            document.getElementById('gnNICedit').value = button.getAttribute('data-gn-nic');
            document.getElementById('gnAddressedit').value = button.getAttribute('data-gn-address');
            document.getElementById('gnDivisionedit').value = button.getAttribute('data-gn-division-id');
            document.getElementById('gnContactNoedit').value = button.getAttribute('data-gn-contact');
            document.getElementById('editModal').style.display = 'block';
        }

        function addNewGN() {
            document.getElementById('addModal').style.display = 'block';
        }

        function deleteGN(gnid) {
            if (confirm("Are you sure you want to delete this GN?")) {
                window.location.href=`<?=ROOT?>/agn/gndetails/deleteGN/${gnid}`;
            }
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
</body>
</html>