<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GN Complaints</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/gn/complaint.css">
</head>
<body>
  <?php $current_page = 'complaint'; include '../app/views/gn/partials/navbar.php';?>

  <main class="main-content">
    <div class="header">
      <h2>Complaints</h2>
      <div class="right" style="display:flex; gap:20px;">
        <?php include '../app/views/gn/partials/header_icons.php'; ?>
        <div class="search-bar">
          <i class="fas fa-search"></i>
          <input type="text" placeholder="Search complaints..." id="search-input">
        </div>
      </div>
    </div>

    <form method="GET" action="<?=ROOT?>/gn/Complaint" class="filters">
      <div class="filter-group">
        <label for="status-filter">Status</label>
        <select id="status-filter" name="status" onchange="this.form.submit()">
          <option value="all" <?= isset($_GET['status']) && $_GET['status'] == 'all' ? 'selected' : '' ?>>All</option>
          <option value="unresolved" <?= isset($_GET['status']) && $_GET['status'] == 'unresolved' ? 'selected' : '' ?>>Unresolved</option>
          <option value="resolved" <?= isset($_GET['status']) && $_GET['status'] == 'resolved' ? 'selected' : '' ?>>Resolved</option>
          <option value="rejected" <?= isset($_GET['status']) && $_GET['status'] == 'rejected' ? 'selected' : '' ?>>Rejected</option>
        </select>
      </div>

      <div class="filter-group">
        <label for="type-filter">Complaint Type</label>
        <select id="type-filter" name="complaint_category" onchange="this.form.submit()">
          <option value="all" <?= isset($_GET['complaint_category']) && $_GET['complaint_category'] == 'all' ? 'selected' : '' ?>>All Types</option>
          <option value="NoiseComplaint" <?= isset($_GET['complaint_category']) && $_GET['complaint_category'] == 'NoiseComplaint' ? 'selected' : '' ?>>Noise Complaint</option>
          <option value="LandDispute" <?= isset($_GET['complaint_category']) && $_GET['complaint_category'] == 'LandDispute' ? 'selected' : '' ?>>Land Dispute</option>
          <option value="StreetLightIssue" <?= isset($_GET['complaint_category']) && $_GET['complaint_category'] == 'StreetLightIssue' ? 'selected' : '' ?>>Street Light Issue</option>
          <option value="DrainageProblem" <?= isset($_GET['complaint_category']) && $_GET['complaint_category'] == 'DrainageProblem' ? 'selected' : '' ?>>Drainage Problem</option>
          
        </select>
      </div>
    </form>

      
    
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Filed by</th>
            <th>Submitted Date</th>
            <th>Type</th>
            <th>Status</th>
            
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="applications-table-body">
            <?php if(!empty($complaints)): ?>
              <?php foreach($complaints as $complaint): ?>
          <tr>
            <td><?= htmlspecialchars($complaint->complaint_id) ?></td>
            <td><?= htmlspecialchars($complaint->citizen_name ?? 'N/A') ?></td>
            <td><?= htmlspecialchars($complaint->date) ?></td>
            <td><?= htmlspecialchars($complaint->complaint_category) ?></td>
            <td>
                <span class="status-badge 
                    <?php
                      $status = strtolower($complaint->status);
                      echo $status === 'pending' ? 'status-unresolved' :
                          ($status === 'resolved' ? 'status-resolved' :
                          ($status === 'rejected' ? 'status-rejected' : ''));
                    ?>">
                    <?= $status === 'pending' ? 'unresolved' : htmlspecialchars($complaint->status) ?>
               </span>
            </td>
        

            <td class="action-buttons">
              <button class="btn view-btn" onclick="viewDetails(<?= htmlspecialchars($complaint->complaint_id) ?>)">View</button>
          
              <?php if($status === 'pending'): ?>
                <button class="btn resolve-btn" onclick="resolveComplaint(<?= htmlspecialchars($complaint->complaint_id) ?>)">Resolve</button>
                <button class="btn reject-btn" onclick="rejectComplaint(<?= htmlspecialchars($complaint->complaint_id) ?>)">Reject</button>
              <?php endif; ?>

              <?php 
                $visitStatus = strtolower($complaint->visit_status?? '');
                $disabled = $visitStatus === 'accepted' || in_array($status, ['resolved', 'rejected']);
              ?>
              <button 
                class="btn schedule-btn<?= $disabled ? ' btn-disabled' : '' ?>" 
                <?= $disabled ? 'disabled' : '' ?>
                onclick="if(this.disabled) return false; window.location.href='<?=ROOT?>/gn/FieldVisit?complaint_id=<?= htmlspecialchars($complaint->complaint_id) ?>'">
                Add Schedule
                <?= $disabled ? '<i class="fas fa-lock"></i>' : '' ?>
              </button>
            </td>
          </tr>
              <?php endforeach; ?>
           <?php else: ?>
          <tr>
              <td colspan="7" style="text-align: center;">No complaints found.</td>
          </tr>
         <?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>
  


  <div id="view-modal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Complaint Details</h3>
        <button class="close-btn">&times;</button>
      </div>
      <div class="modal-body">
        <div class="info-group">
          <label>Citizen Name</label>
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
          <label>Complaint Type</label>
          <input type="text" id="view-type" readonly>
        </div>
        <div class="info-group">
          <label>Description</label>
          <textarea id="view-details" readonly rows="4"></textarea>
        </div>
        <div class="info-group">
          <label>Documents</label>
          <ul id="view-documents" style="display:flex; flex-wrap:wrap; gap:10px;"></ul>
        </div>
      </div>
    </div>
  </div>

  <script>
    
   
    const complaints = <?= json_encode(array_map(function($complaint){
      return [
        'id' => $complaint->complaint_id,
        'filedBy' => $complaint->citizen_name ?? '',
        'nic' => $complaint->nic ?? '',
        'contact' => $complaint->phone_number ?? '',
        'address' => $complaint->address ?? '',
        'type' => $complaint->complaint_category ?? '',
        'description' => $complaint->complaint_description ?? '',
        'status' => $complaint->status ?? '',
    ];

    }, $complaints))?>;
    
    document.addEventListener("DOMContentLoaded", () =>{
      fetchComplaints();
    })


    


    
    function getStatusBadgeClass(status) {
      switch(status.toLowerCase()) {
        case 'unresolved': return 'status-unresolved';
        case 'resolved': return 'status-resolved';
        case 'rejected': return 'status-rejected';
        default: return '';
      }
    }

    
    function getUrgencyHTML(urgency) {
      const iconClass = urgency.toLowerCase() === 'high' ? 'fas fa-exclamation-circle' :
                       urgency.toLowerCase() === 'medium' ? 'fas fa-exclamation' : 'fas fa-info-circle';
      const colorClass = urgency-${urgency.toLowerCase()};
      return <i class="${iconClass} ${colorClass}"></i> ${urgency};
    }

    
    
    function viewDetails(id) {
      const complaint = complaints.find(c => String(c.id) === String(id));
      if(!complaint){
        alert("Complaint not found");
        return;
      }
     
      document.getElementById('view-name').value = complaint.filedBy;
      document.getElementById('view-nic').value = complaint.nic;
      document.getElementById('view-contact').value = complaint.contact;
      document.getElementById('view-address').value = complaint.address;
      document.getElementById('view-type').value = complaint.type;
      document.getElementById('view-details').value = complaint.description;

     
      const documentsList = document.getElementById('view-documents');

      documentsList.innerHTML = '';
     
      fetch(<?=ROOT?>/gn/complaint/getComplaintImages/${complaint.id})
    .then(res => res.json())
    .then(data => {
      if (data.success && Array.isArray(data.images)) {
        data.images.forEach(img => {
          const imgEl = document.createElement("img");
          imgEl.src = <?=ROOT?>/${img.image_path}; // Adjust path as needed
          imgEl.style.width = "120px";
          imgEl.style.height = "auto";
          imgEl.style.border = "1px solid #ccc";
          imgEl.style.borderRadius = "5px";
          documentsList.appendChild(imgEl);
        });
      }else{
        const noImageMessage = document.createElement("li");
        noImageMessage.textContent = "No documents uploaded";
        documentsList.appendChild(noImageMessage);
      }
      })
      .catch(error => {
        console.error("Error fetching images:", error);
      });
        


      document.getElementById('view-modal').style.display = 'block';
    }


    function resolveComplaint(id) {
  if (confirm('Are you sure you want to resolve this complaint?')) {
    fetch(<?=ROOT?>/gn/Complaint/resolve, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ id })
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) location.reload();
      else alert('Failed to resolve complaint.');
    })
    .catch(console.error);
  }
}

    
    function rejectComplaint(id) {
  if (confirm('Are you sure you want to reject this complaint?')) {
    fetch(<?=ROOT?>/gn/Complaint/reject, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ id })
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) location.reload();
      else alert('Failed to reject complaint.');
    })
    .catch(console.error);
  }
}
    


   

    
    document.querySelector('.close-btn').addEventListener('click', () => {
      document.getElementById('view-modal').style.display = 'none';
    });

    
    window.addEventListener('click', (e) => {
      const modal = document.getElementById('view-modal');
      if (e.target === modal) {
        modal.style.display = 'none';
      }
    });

    

    
    document.addEventListener('DOMContentLoaded', () => {
      populateTable();
    });

  </script>
</body>
</html>