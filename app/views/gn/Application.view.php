<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GN Applications</title>
    
    <!-- Iconscout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <!-- Montserrat Font (Google fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <link href="<?=ROOT?>/assets/css/gn/application.css" rel="stylesheet">
</head>
<body>
    <?php $current_page = 'application'; include '../app/views/gn/partials/navbar.php';?>

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

    <main class="main-content">
        <div class="header">
            <h2>Applications</h2>
            <div class="right" style="display:flex; gap:20px;">
                <?php include '../app/views/gn/partials/header_icons.php'; ?>
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search applications...">
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="filters">
            <div class="filter-group">
                <label for="status-filter">Status</label>
                <select id="status-filter">
                    <option value="all">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="rejected">Forwarded</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="type-filter">Application Type</label>
                <select id="type-filter">
                    <option value="all">All Types</option>
                    <option value="birth">Birth Certificate</option>
                    <option value="death">Death Certificate</option>
                    <option value="marriage">Marriage Certificate</option>
                    <option value="land">Land Certificate</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="date-filter">Date Range</label>
                <select id="date-filter">
                    <option value="all">All Time</option>
                    <option value="today">Today</option>
                    <option value="week">This Week</option>
                    <option value="month">This Month</option>
                </select>
            </div>
        </div>

        <!-- Applications Table -->
        <div class="table-container">
            <div class="table-header">
                <button class="tab-btn active" id="certificatesbtn">Certificates</button>
                <button class="tab-btn" id="permitsbtn">Permits</button>
            </div>
            <div id="certificates">
                <h1>Applications for Certificates</h1>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Applicant NIC</th>
                            <th>Type</th>
                            <th>Submitted Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="applications-table-body">
                        <?php if(!empty($applicationDetails)):?>
                            <?php foreach($applicationDetails as $i):?>
                                <tr>
                                    <td class="<?= ($i->status == 'Approved' || $i->status == 'Rejected') ? 'faded' : '' ?>"><?=$i->application_id?></td>
                                    <td class="<?= ($i->status == 'Approved' || $i->status == 'Rejected') ? 'faded' : '' ?>"><?=$i->nic?></td>
                                    <td class="<?= ($i->status == 'Approved' || $i->status == 'Rejected') ? 'faded' : '' ?>"><?=$i->type?></td>
                                    <td class="<?= ($i->status == 'Approved' || $i->status == 'Rejected') ? 'faded' : '' ?>"><?=$i->appcreated_at?></td>
                                    <td class="<?= ($i->status == 'Approved' || $i->status == 'Rejected') ? 'faded' : '' ?>"><?=$i->status?></td>
                                    <td>
                                        <button class="view-btn" onclick="fetchApplicationData(<?=$i->application_id?>)">View</button>
                                        <button class="approve-btn" onclick="confirmAction(<?=$i->application_id?>, 'approve')" <?= ($i->status == 'Approved' || $i->status == 'Rejected') ? 'disabled style="cursor:not-allowed"' : '' ?>>Approve</button>
                                        <button class="reject-btn" onclick="confirmAction(<?=$i->application_id?>, 'reject')" <?= ($i->status == 'Approved' || $i->status == 'Rejected') ? 'disabled style="cursor:not-allowed"' : '' ?>>Reject</button>
                                        <button class="forward-btn" onclick="confirmAction(<?=$i->application_id?>, 'forward')" <?= ($i->status == 'Approved' || $i->status == 'Rejected' || $i->status == 'Forwarded') ? 'disabled style="cursor:not-allowed"' : '' ?>>Forward to AGN</button>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
            <div id="permits" style="display:none;">
                <h1>Applications for Permits</h1>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Applicant NIC</th>
                            <th>Type</th>
                            <th>Submitted Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="applications-table-body">
                        <?php if(!empty($permitDetails)):?>
                            <?php foreach($permitDetails as $i):?>
                                <tr>
                                    <td class="<?= ($i->status == 'Approved' || $i->status == 'Rejected') ? 'faded' : '' ?>"><?=$i->permit_id?></td>
                                    <td class="<?= ($i->status == 'Approved' || $i->status == 'Rejected') ? 'faded' : '' ?>"><?=$i->nic?></td>
                                    <td class="<?= ($i->status == 'Approved' || $i->status == 'Rejected') ? 'faded' : '' ?>"><?=$i->type?></td>
                                    <td class="<?= ($i->status == 'Approved' || $i->status == 'Rejected') ? 'faded' : '' ?>"><?=$i->percreated_at?></td>
                                    <td class="<?= ($i->status == 'Approved' || $i->status == 'Rejected') ? 'faded' : '' ?>"><?=$i->status?></td>
                                    <td>
                                        <button class="view-btn" onclick="fetchPermitData(<?=$i->permit_id?>)">View</button>
                                        <button class="approve-btn" onclick="confirmActionPermit(<?=$i->permit_id?>, 'approve')" <?= ($i->status == 'Approved' || $i->status == 'Rejected') ? 'disabled style="cursor:not-allowed"' : '' ?>>Approve</button>
                                        <button class="reject-btn" onclick="confirmActionPermit(<?=$i->permit_id?>, 'reject')" <?= ($i->status == 'Approved' || $i->status == 'Rejected') ? 'disabled style="cursor:not-allowed"' : '' ?>>Reject</button>
                                        <button class="forward-btn" onclick="confirmActionPermit(<?=$i->permit_id?>, 'forward')" <?= ($i->status == 'Approved' || $i->status == 'Rejected' || $i->status == 'Forwarded') ? 'disabled style="cursor:not-allowed"' : '' ?>>Forward to AGN</button>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- View Application Modal -->
    <div id="view-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Application Details</h3>
                <button class="close-btn">&times;</button>
            </div>
            <div class="modal-body">
                <div class="info-group">
                    <label>Applicant Name</label>
                    <input type="text" id="view-name" readonly>
                </div>
                <div class="info-group">
                    <label>NIC</label>
                    <input type="text" id="view-nic" readonly>
                </div>
                <div class="info-group">
                    <label>Contact</label>
                    <input type="text" id="view-contact" readonly>
                </div>
                <div class="info-group">
                    <label>Address</label>
                    <input type="text" id="view-address" readonly>
                </div>
                <div class="info-group">
                    <label>Application Type</label>
                    <input type="text" id="view-type" readonly>
                </div>
                <div class="info-group">
                    <label>AGN Remarks</label>
                    <textarea id="view-details" readonly rows="4"></textarea>
                </div>
                <div id="dynamic-fields"></div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmation-modal" class="modal confirmation-modal">
        <div class="modal-content">
            <h3 id="confirmation-title">Confirm Action</h3>
            <p id="confirmation-message">Are you sure you want to proceed with this action?</p>
            <div class="confirmation-actions">
                <button class="action-btn view-btn" id="confirm-btn">Confirm</button>
                <button class="action-btn reject-btn" id="cancel-btn">Cancel</button>
            </div>
        </div>
    </div>

<script>
    // Tab switching
    const certificatesBtn = document.getElementById('certificatesbtn');
    const permitsBtn = document.getElementById('permitsbtn');
    const certificatesDiv = document.getElementById('certificates');
    const permitsDiv = document.getElementById('permits');
    certificatesBtn.addEventListener('click', () => {
        certificatesDiv.style.display = 'block';
        permitsDiv.style.display = 'none';
        certificatesBtn.classList.add('active');
        permitsBtn.classList.remove('active');
    });
    permitsBtn.addEventListener('click', () => {
        certificatesDiv.style.display = 'none';
        permitsDiv.style.display = 'block';
        permitsBtn.classList.add('active');
        certificatesBtn.classList.remove('active');
    });

    document.addEventListener('DOMContentLoaded', function () {
        const openApp = localStorage.getItem('openApplication') === 'true';
        const openPermit = localStorage.getItem('openPermit') === 'true';

        if (openApp || openPermit) {
            const applicationId = localStorage.getItem('applicationId');
            const permitId = localStorage.getItem('permitId');

            if (applicationId && applicationId !== 'null' && applicationId !== '') {
                fetchApplicationData(applicationId);
            } else if (permitId && permitId !== 'null' && permitId !== '') {
                console.log(applicationId, permitId);
                fetchPermitData(permitId);
            }

            localStorage.removeItem('openApplication');
            localStorage.removeItem('openPermit');
            localStorage.removeItem('applicationId');
            localStorage.removeItem('permitId');
        }

        initializeEventListeners();
    });


    function fetchApplicationData(applicationId) {
        fetch(`<?=ROOT?>/gn/application/fetchDetails/${applicationId}`)
            .then(response => response.json())
            .then(data => {
                viewApplication(data);
            })
            .catch(error => {
                console.error("Error fetching application data:", error);
            });
    }

    function fetchPermitData(permitId) {
        fetch(`<?=ROOT?>/gn/application/fetchPermitDetails/${permitId}`)
            .then(response => response.json())
            .then(data => {
                viewPermit(data);
            })
            .catch(error => {
                console.error("Error fetching permit data:", error);
            });
    }

    function viewPermit(data) {
        data = data[0];

        // Populate the modal fields with the fetched data
        document.getElementById('view-name').value = data.full_name || '';
        document.getElementById('view-nic').value = data.nic || '';
        document.getElementById('view-contact').value = data.mobileNumber || '';
        document.getElementById('view-address').value = data.address || '';
        document.getElementById('view-type').value = data.type || '';
        document.getElementById('view-details').value = data.agnremarks || '';

        // Clear previous dynamic fields
        const dynamicContainer = document.getElementById('dynamic-fields');
        dynamicContainer.innerHTML = '';

        switch (data.type) {
            case 'building_construction':
                dynamicContainer.innerHTML += `
                    <div class="info-group">
                        <label>Address of Construction</label>
                        <input type="text" value="${data.conAddress || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>Plan</label>
                        <input type="text" value="${data.plan || ''}" readonly>
                    </div>
                `;
                break;

            case 'small_business':
                dynamicContainer.innerHTML += `
                    <div class="info-group">
                        <label>Name of Business</label>
                        <input type="text" value="${data.businessname || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>Location of Business</label>
                        <input type="text" value="${data.location || ''}" readonly>
                    </div>
                `;
                break;
                
            case 'cattle_rearing':
                dynamicContainer.innerHTML += `
                    <div class="info-group">
                        <label>Size of the Land</label>
                        <input type="text" value="${data.landsize || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>No of Cattle</label>
                        <input type="text" value="${data.animalcounter || ''}" readonly>
                    </div>
                `;
                break;
            
            case 'loudspeaker':
                dynamicContainer.innerHTML += `
                    <div class="info-group">
                        <label>Location</label>
                        <input type="text" value="${data.location || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>Time</label>
                        <input type="text" value="${data.time || ''}" readonly>
                    </div>
                `;
                break;
                        
            default:
                dynamicContainer.innerHTML += `<p>No additional details for this permit type.</p>`;
        }

        // Show the modal
        document.getElementById('view-modal').style.display = 'block';
    }

    function viewApplication(data) {
        data = data[0];
        console.log(data);
        // Populate the modal fields with the fetched data
        document.getElementById('view-name').value = data.full_name || '';
        document.getElementById('view-nic').value = data.nic || '';
        document.getElementById('view-contact').value = data.mobileNumber || '';
        document.getElementById('view-address').value = data.address || '';
        document.getElementById('view-type').value = data.type || '';
        document.getElementById('view-details').value = data.agnremarks || '';

        // Clear previous dynamic fields
        const dynamicContainer = document.getElementById('dynamic-fields');
        dynamicContainer.innerHTML = '';

        switch (data.type) {
            case 'residence':
                dynamicContainer.innerHTML += `
                    <div class="info-group">
                        <label>Years Lived in Residence</label>
                        <input type="text" value="${data.yearsLived || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>Reason</label>
                        <input type="text" value="${data.reason || ''}" readonly>
                    </div>
                `;
                break;

            case 'character':
                dynamicContainer.innerHTML += `
                    <div class="info-group">
                        <label>Years Lived in Residence</label>
                        <input type="text" value="${data.yearsLived || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>Occupation</label>
                        <input type="text" value="${data.occupation || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>Institute requesting Certificate</label>
                        <input type="text" value="${data.institute || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>Reason</label>
                        <input type="text" value="${data.reason || ''}" readonly>
                    </div>
                `;
                break;
                
            case 'incomeCertificate':
                dynamicContainer.innerHTML += `
                    <div class="info-group">
                        <label>Income Amount</label>
                        <input type="text" value="${data.income || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>Occupation</label>
                        <input type="text" value="${data.occupation || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>Reason</label>
                        <input type="text" value="${data.reason || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>Source of Income</label>
                        <input type="text" value="${data.sourceIncome || ''}" readonly>
                    </div>
                `;
                break;

            case 'publicAid':
                dynamicContainer.innerHTML += `
                    <div class="info-group">
                        <label>Household Income Amount</label>
                        <input type="text" value="${data.householdincome || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>No of Family Members</label>
                        <input type="text" value="${data.familysize || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>Reason</label>
                        <input type="text" value="${data.reason || ''}" readonly>
                    </div>
                `;
                break;

            case 'landOwnership':
                dynamicContainer.innerHTML += `
                    <div class="info-group">
                        <label>Land Size</label>
                        <input type="text" value="${data.landsize || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>No of Years Lived/Owned Land</label>
                        <input type="text" value="${data.yearsLived || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>Document Type Needed</label>
                        <input type="text" value="${data.docType || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>Purpose</label>
                        <input type="text" value="${data.purpose || ''}" readonly>
                    </div>
                `;
                break;

            case 'electricityWater':
                dynamicContainer.innerHTML += `
                    <div class="info-group">
                        <label>Type</label>
                        <input type="text" value="${data.type || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>Ownership</label>
                        <input type="text" value="${data.ownership || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>Reason</label>
                        <input type="text" value="${data.reason || ''}" readonly>
                    </div>
                `;
                break;

            case 'valuationCertificate':
                dynamicContainer.innerHTML += `
                    <div class="info-group">
                        <label>Address of the Land</label>
                        <input type="text" value="${data.valAddress || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>Purpose for Valuation</label>
                        <input type="text" value="${data.purpose || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>Is Owner of the Land</label>
                        <input type="text" value="${data.ownership || ''}" readonly>
                    </div>
                `;
                break;
            
            case 'deathCertificate':
                dynamicContainer.innerHTML += `
                    <div class="info-group">
                        <label>Name of Deceased</label>
                        <input type="text" value="${data.name || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>NIC of Deceased</label>
                        <input type="text" value="${data.nic || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>Deceased Date</label>
                        <input type="text" value="${data.date || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>Relationship with Deceased</label>
                        <input type="text" value="${data.relationship || ''}" readonly>
                    </div>
                `;
                break;
                        
            case 'idApplication':
                dynamicContainer.innerHTML += `
                    <div class="info-group">
                        <label>Date of Birth</label>
                        <input type="text" value="${data.dob || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>Gender</label>
                        <input type="text" value="${data.gender || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>Birth Certificate Number</label>
                        <input type="text" value="${data.bcnumber || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>Reason for New ID request</label>
                        <input type="text" value="${data.reason || ''}" readonly>
                    </div>
                `;
                break;

            case 'criminalBgCheck':
                dynamicContainer.innerHTML += `
                    <div class="info-group">
                        <label>Occupation</label>
                        <input type="text" value="${data.occupation || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>Institute Requesting Report</label>
                        <input type="text" value="${data.institute || ''}" readonly>
                    </div>
                    <div class="info-group">
                        <label>Purpose</label>
                        <input type="text" value="${data.purpose || ''}" readonly>
                    </div>
                `;
                break;
            default:
                dynamicContainer.innerHTML += `<p>No additional details for this application type.</p>`;
        }

        // Show the modal
        document.getElementById('view-modal').style.display = 'block';
    }

    function confirmAction(id, action) {
        const modal = document.getElementById('confirmation-modal');
        const title = document.getElementById('confirmation-title');
        const message = document.getElementById('confirmation-message');
        const confirmBtn = document.getElementById('confirm-btn');

        // Set modal content based on action
        title.textContent = `Confirm ${capitalize(action)}`;
        message.textContent = `Are you sure you want to ${action} this application?`;

        // Set action (you may redirect or call PHP here)
        confirmBtn.onclick = () => {
            window.location.href = `<?=ROOT?>/gn/application/confirmAction/${id}/${action}`;
        };

        // Show modal
        modal.style.display = 'block';
    }

    function confirmActionPermit(id, action) {
        const modal = document.getElementById('confirmation-modal');
        const title = document.getElementById('confirmation-title');
        const message = document.getElementById('confirmation-message');
        const confirmBtn = document.getElementById('confirm-btn');

        // Set modal content based on action
        title.textContent = `Confirm ${capitalize(action)}`;
        message.textContent = `Are you sure you want to ${action} this application?`;

        // Set action (you may redirect or call PHP here)
        confirmBtn.onclick = () => {
            window.location.href = `application/confirmActionPermit/${id}/${action}`;
        };

        // Show modal
        modal.style.display = 'block';
    }


    function initializeEventListeners() {
        // Close modals when clicking outside
        window.onclick = (event) => {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        };

        // Close modal buttons
        document.querySelectorAll('.close-btn').forEach(button => {
            button.onclick = () => {
                button.closest('.modal').style.display = 'none';
            };
        });

        // Cancel button in confirmation modal
        document.getElementById('cancel-btn').onclick = () => {
            document.getElementById('confirmation-modal').style.display = 'none';
        };
    }

    function capitalize(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
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


    // Enhanced filter and search functionality
document.addEventListener('DOMContentLoaded', function() {
    // Get filter and search elements
    const statusFilter = document.getElementById('status-filter');
    const typeFilter = document.getElementById('type-filter');
    const dateFilter = document.getElementById('date-filter');
    const searchInput = document.querySelector('.search-bar input');
    
    // Add event listeners
    statusFilter.addEventListener('change', applyFilters);
    typeFilter.addEventListener('change', applyFilters);
    dateFilter.addEventListener('change', applyFilters);
    searchInput.addEventListener('input', applyFilters);
    
    // Function to apply all filters and search
    function applyFilters() {
        // Get all table rows (both certificates and permits)
        const certificateRows = document.querySelectorAll('#certificates tbody tr');
        const permitRows = document.querySelectorAll('#permits tbody tr');
        
        // Get filter values
        const statusValue = statusFilter.value.toLowerCase();
        const typeValue = typeFilter.value.toLowerCase();
        const dateValue = dateFilter.value.toLowerCase();
        const searchValue = searchInput.value.toLowerCase();
        
        // Filter function
        function filterRow(row) {
            // Get cell values
            const id = row.cells[0].textContent.toLowerCase();
            const nic = row.cells[1].textContent.toLowerCase();
            const type = row.cells[2].textContent.toLowerCase();
            const date = row.cells[3].textContent.toLowerCase();
            const status = row.cells[4].textContent.toLowerCase();
            
            // Apply status filter
            if (statusValue !== 'all' && status !== statusValue) {
                return false;
            }
            
            // Apply type filter (simplified for now)
            if (typeValue !== 'all' && !type.includes(typeValue)) {
                return false;
            }
            
            // Apply date filter
            if (dateValue !== 'all') {
                const rowDate = new Date(date);
                const today = new Date();
                
                if (dateValue === 'today') {
                    if (rowDate.toDateString() !== today.toDateString()) {
                        return false;
                    }
                } else if (dateValue === 'week') {
                    const weekAgo = new Date();
                    weekAgo.setDate(today.getDate() - 7);
                    if (rowDate < weekAgo) {
                        return false;
                    }
                } else if (dateValue === 'month') {
                    const monthAgo = new Date();
                    monthAgo.setMonth(today.getMonth() - 1);
                    if (rowDate < monthAgo) {
                        return false;
                    }
                }
            }
            
            // Apply search filter
            if (searchValue !== '') {
                if (!id.includes(searchValue) && 
                    !nic.includes(searchValue) && 
                    !type.includes(searchValue) && 
                    !status.includes(searchValue)) {
                    return false;
                }
            }
            
            return true;
        }
        
        // Apply filters to certificate rows
        certificateRows.forEach(row => {
            row.style.display = filterRow(row) ? '' : 'none';
        });
        
        // Apply filters to permit rows
        permitRows.forEach(row => {
            row.style.display = filterRow(row) ? '' : 'none';
        });
        
        // Update table messages if no results
        updateNoResultsMessage(certificateRows, '#certificates');
        updateNoResultsMessage(permitRows, '#permits');
    }
    
    // Function to show "No results found" message when necessary
    function updateNoResultsMessage(rows, containerId) {
        const container = document.querySelector(containerId);
        let noResultsElement = container.querySelector('.no-results-message');
        
        // Check if any rows are visible
        const anyVisible = Array.from(rows).some(row => row.style.display !== 'none');
        
        if (!anyVisible && rows.length > 0) {
            // Show no results message if it doesn't exist
            if (!noResultsElement) {
                noResultsElement = document.createElement('div');
                noResultsElement.className = 'no-results-message';
                noResultsElement.innerHTML = '<p>No matching applications found.</p>';
                container.querySelector('table').after(noResultsElement);
            }
        } else {
            // Remove no results message if it exists
            if (noResultsElement) {
                noResultsElement.remove();
            }
        }
    }
});

</script>

</body>
</html>