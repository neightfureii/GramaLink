<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGN Review Applications</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/agn/application.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php $current_page = 'application'; include '../app/views/agn/partials/navbar.php';?>
    
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
        <header class="application-header">
            <h2>Review Applications</h2>


            <?php include '../app/views/agn/partials/header_icons.php'?>
        </header>

        <div class="applications-table">
            <div class="table-header">
                <button class="tab-btn active" id="certificatesbtn">Certificates</button>
                <button class="tab-btn" id="permitsbtn">Permits</button>
            </div>

            <div id="certificates">
                <h1>Forwarded Certificates</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Application ID</th>
                            <th>Applicant ID</th>
                            <th>Date Submitted</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="applicationTableBody">
                        <?php if(!empty($applications)):?>
                            <?php foreach ($applications as $application): ?>
                                <tr>
                                    <td><?=$application->application_id?></td>
                                    <td><?=$application->citizen_id?></td>
                                    <td><?=$application->created_at?></td>
                                    <td><span class="status pending"><?=$application->status?></span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button 
                                                class="btn btn-review" 
                                                onclick="openReviewModal(this)" 
                                                data-id="<?=$application->application_id?>"
                                            >
                                                Review
                                            </button>
                                            <button 
                                                class="btn btn-details" 
                                                onclick="fetchApplicationData(<?=$application->application_id?>)" 
                                            >
                                                Details
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
            <div id="permits" style="display:none">
                <h1>Forwarded Permits</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Permit ID</th>
                            <th>Applicant ID</th>
                            <th>Date Submitted</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="applicationTableBody">
                        <?php if(!empty($permits)):?>
                            <?php foreach ($permits as $permit): ?>
                                <tr>
                                    <td><?=$permit->permit_id?></td>
                                    <td><?=$permit->citizen_id?></td>
                                    <td><?=$permit->created_at?></td>
                                    <td><span class="status pending"><?=$permit->status?></span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button 
                                                class="btn btn-review" 
                                                onclick="openReviewModal(this)" 
                                                data-id="<?=$permit->permit_id?>"
                                            >
                                                Review
                                            </button>
                                            <button 
                                                class="btn btn-details" 
                                                onclick="fetchApplicationData(<?=$permit->permit_id?>)" 
                                            >
                                                Details
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Details Modal -->
        <div id="detailsModal" class="modal">	
            <div class="modal-content" style="margin-top:20rem">
                <span class="close" onclick="closeModal('detailsModal')">&times;</span>
                <h2>Application Details</h2>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" id="modalApplicantName" readonly>
                </div>
                <div class="form-group">
                    <label>NIC</label>
                    <input type="text" id="modalNIC" readonly>
                </div>
                <div class="form-group">
                    <label>Contact</label>
                    <input type="text" id="modalContact" readonly>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" id="modalAddress" readonly>
                </div>
                <div class="form-group">
                    <label>Application Type</label>
                    <input type="text" id="modalApplicationType" readonly>
                </div>
                <div class="form-group">
                    <label>Submitted Date</label>
                    <input type="text" id="modalSubmittedDate" readonly>
                </div>
                <div class="form-group">
                    <label>Details</label>
                    <textarea id="modalDetails" readonly></textarea>
                </div>
                <div class="form-group">
                    <label>Current Status</label>
                    <input type="text" id="modalStatus" readonly>
                </div>
                <div id="dynamic-fields"></div>
            </div>
        </div>

        <!-- Review Modal -->
        <div id="reviewModal" class="modal">
            <div class="modal-content review-modal-content">
                <span class="close" onclick="closeModal('reviewModal')">&times;</span>
                <h2>Review Application</h2>
                <div class="form-group">
                    <label>Application ID</label>
                    <input type="text" id="reviewApplicationId" readonly>
                </div>
                <div class="form-group">
                    <label>Feedback/Notes</label>
                    <textarea id="reviewFeedback" placeholder="Enter your feedback or notes here..."></textarea>
                </div>
                <div class="button-group">
                    <button class="btn btn-approve" onclick="handleAction('approved')">Approve</button>
                    <button class="btn btn-reject" onclick="handleAction('rejected')">Reject</button>
                </div>
            </div>
        </div>

        <div id="toast" class="toast"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            initialize();
        });

        function initialize() {
            window.onclick = (event) => {
                if (event.target.classList.contains('modal')) {
                    event.target.style.display = 'none';
                }
            };
        }

        function fetchApplicationData(applicationId) {
            fetch(`<?=ROOT?>/agn/application/fetchDetails/${applicationId}`)
                .then(response => response.json())
                .then(data => {
                    openDetailsModal(data);
                })
                .catch(error => {
                    console.error("Error fetching application data:", error);
                });
        }

        function openDetailsModal(data) {
            
            
            data = data[0];
            console.log(data);

            document.getElementById('modalApplicantName').value = data.full_name || '';
            document.getElementById('modalNIC').value = data.nic || '';
            document.getElementById('modalContact').value = data.mobileNumber || '';
            document.getElementById('modalAddress').value = data.address || '';
            document.getElementById('modalApplicationType').value = data.type || '';
            document.getElementById('modalSubmittedDate').value = data.created_at || '';
            document.getElementById('modalDetails').value = data.gnremarks || '';
            document.getElementById('modalStatus').value = data.status || '';

            const dynamicContainer = document.getElementById('dynamic-fields');
            dynamicContainer.innerHTML = '';

            switch (data.type) {
                case 'residence':
                    dynamicContainer.innerHTML += `
                        <div class="form-group">
                            <label>Years Lived in Residence</label>
                            <input type="text" value="${data.yearsLived || ''}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Reason</label>
                            <input type="text" value="${data.reason || ''}" readonly>
                        </div>
                    `;
                    break;

                case 'character':
                    dynamicContainer.innerHTML += `
                        <div class="form-group">
                            <label>Years Lived in Residence</label>
                            <input type="text" value="${data.yearsLived || ''}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Occupation</label>
                            <input type="text" value="${data.occupation || ''}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Institute requesting Certificate</label>
                            <input type="text" value="${data.institute || ''}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Reason</label>
                            <input type="text" value="${data.reason || ''}" readonly>
                        </div>
                    `;
                    break;
                    
                case 'incomeCertificate':
                    dynamicContainer.innerHTML += `
                        <div class="form-group">
                            <label>Income Amount</label>
                            <input type="text" value="${data.income || ''}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Occupation</label>
                            <input type="text" value="${data.occupation || ''}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Reason</label>
                            <input type="text" value="${data.reason || ''}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Source of Income</label>
                            <input type="text" value="${data.sourceIncome || ''}" readonly>
                        </div>
                    `;
                    break;

                case 'publicAid':
                    dynamicContainer.innerHTML += `
                        <div class="form-group">
                            <label>Household Income Amount</label>
                            <input type="text" value="${data.householdincome || ''}" readonly>
                        </div>
                        <div class="form-group">
                            <label>No of Family Members</label>
                            <input type="text" value="${data.familysize || ''}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Reason</label>
                            <input type="text" value="${data.reason || ''}" readonly>
                        </div>
                    `;
                    break;

                case 'landOwnership':
                    dynamicContainer.innerHTML += `
                        <div class="form-group">
                            <label>Land Size</label>
                            <input type="text" value="${data.landsize || ''}" readonly>
                        </div>
                        <div class="form-group">
                            <label>No of Years Lived/Owned Land</label>
                            <input type="text" value="${data.yearsLived || ''}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Document Type Needed</label>
                            <input type="text" value="${data.docType || ''}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Purpose</label>
                            <input type="text" value="${data.purpose || ''}" readonly>
                        </div>
                    `;
                    break;

                case 'electricityWater':
                    dynamicContainer.innerHTML += `
                        <div class="form-group">
                            <label>Type</label>
                            <input type="text" value="${data.type || ''}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Ownership</label>
                            <input type="text" value="${data.ownership || ''}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Reason</label>
                            <input type="text" value="${data.reason || ''}" readonly>
                        </div>
                    `;
                    break;

                case 'valuationCertificate':
                    dynamicContainer.innerHTML += `
                        <div class="form-group">
                            <label>Address of the Land</label>
                            <input type="text" value="${data.valAddress || ''}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Purpose for Valuation</label>
                            <input type="text" value="${data.purpose || ''}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Is Owner of the Land</label>
                            <input type="text" value="${data.ownership || ''}" readonly>
                        </div>
                    `;
                    break;
                
                case 'deathCertificate':
                    dynamicContainer.innerHTML += `
                        <div class="form-group">
                            <label>Name of Deceased</label>
                            <input type="text" value="${data.name || ''}" readonly>
                        </div>
                        <div class="form-group">
                            <label>NIC of Deceased</label>
                            <input type="text" value="${data.nic || ''}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Deceased Date</label>
                            <input type="text" value="${data.date || ''}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Relationship with Deceased</label>
                            <input type="text" value="${data.relationship || ''}" readonly>
                        </div>
                    `;
                    break;
                            
                case 'idApplication':
                    dynamicContainer.innerHTML += `
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="text" value="${data.dob || ''}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <input type="text" value="${data.gender || ''}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Birth Certificate Number</label>
                            <input type="text" value="${data.bcnumber || ''}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Reason for New ID request</label>
                            <input type="text" value="${data.reason || ''}" readonly>
                        </div>
                    `;
                    break;

                case 'criminalBgCheck':
                    dynamicContainer.innerHTML += `
                        <div class="form-group">
                            <label>Occupation</label>
                            <input type="text" value="${data.occupation || ''}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Institute Requesting Report</label>
                            <input type="text" value="${data.institute || ''}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Purpose</label>
                            <input type="text" value="${data.purpose || ''}" readonly>
                        </div>
                    `;
                    break;
                default:
                    dynamicContainer.innerHTML += `<p>No additional details for this application type.</p>`;
            }

            let modal = document.getElementById('detailsModal');
            modal.style.display = "block";
        }

        function openReviewModal(data) {
            let modal = document.getElementById('reviewModal');
            modal.style.display = "block";

            document.getElementById('reviewApplicationId').value = data.dataset.id || '';
        }

        function closeModal(modalId) {
            let modal = document.getElementById(modalId);
            modal.style.display = "none";
        }

        function handleAction(action) {
            let applicationId = document.getElementById('reviewApplicationId').value;
            let feedback = document.getElementById('reviewFeedback').value || '';

            window.location.href = `<?=ROOT?>/agn/application/handleAction/${applicationId}/${action}/${feedback}`;
        }

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