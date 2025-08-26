<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GN Appointments</title>
  
  <!-- Iconscout CDN -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
  
  <!-- Montserrat Font (Google fonts) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <!-- FullCalendar CSS -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
  
  <!-- Font Awesome CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/gn/CommunityS.css">
</head>
<body>
<aside class="sidebar">
        <h1 class="sidebar-title">AGN Dashboard</h1>
        <ul class="sidebar-menu">
            <li><a href="Rules and Regulation AGN.html">Rules & Regulation</a></li>
            <li></li>
            <li><a href="Announcement AGN.html">Announcement</a></li>
            <li></li>
            <li><a href="Community Services AGN.html" class="active">Community Services</a></li>
        </ul>
    </aside>

    <main class="main-content">
        <div class="section-header">
            <h2>Community Services Management</h2>
        </div>

        <table class="rules-table">
            <thead>
                <tr>
                    <th>Rule ID</th>
                    <th>Title</th>
                    <th>Last Updated</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="rulesTableBody">
                <!-- Table content will be dynamically populated -->
            </tbody>
        </table>
        <div class="table-footer">
            <button class="add-rule-btn" onclick="openModal()">
                <i class="fas fa-plus"></i>Insert New
            </button>
        </div>
    </main>

    <!-- Modal for Add/Edit/View Rule -->
    <div id="ruleModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Add New Rule</h2>
                <button class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            <form id="ruleForm">
                <input type="hidden" id="ruleId">
                <div class="form-group">
                    <label for="ruleTitle">Rule Title</label>
                    <input type="text" id="ruleTitle" required>
                </div>
                <div class="form-group">
                    <label for="ruleDescription">Description</label>
                    <textarea id="ruleDescription" required></textarea>
                </div>
                <div class="form-group">
                    <label for="ruleStatus">Status</label>
                    <select id="ruleStatus" required>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
                <div class="form-group" id="lastUpdatedGroup" style="display: none;">
                    <label for="lastUpdated">Last Updated</label>
                    <input type="text" id="lastUpdated" readonly>
                </div>
                <button type="submit" class="submit-btn">Save Rule</button>
            </form>
        </div>
    </div>
    <script src="<?=ROOT?>/assets/js/gn/CommunityS.js"></script>
</body>
</html>