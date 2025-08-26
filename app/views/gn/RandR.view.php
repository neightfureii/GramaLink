<!DOCTYPE html>
<html lang="en">
<head>
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
    <link rel="stylesheet" href="assets/css/Dstyle.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f3f4f6;
            color: #333;
        }

        /* Sidebar */
        .sidebar {
            width: 290px;
            background-color: #32506D;
            color: #fff;
            min-height: 100vh;
            padding: 20px;
        }

        .sidebar-title {
            font-size: 24px;
            color: #fff;
            margin-bottom: 30px;
            padding: 20px 15px;
        }

        .sidebar-menu {
            list-style-type: none;
            padding: 0;
        }

        .sidebar-menu li {
            margin: 15px 0;
        }

        .sidebar-menu a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            display: block;
            padding: 10px 15px;
            border-radius: 4px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .sidebar-menu a:hover {
            background-color: #1a252f;
            color: #3498db;
        }

        .sidebar-menu a.active {
            background-color: #1a252f;
            color: #3498db;
            font-weight: bold;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 40px;
            background-color: #ffffff;
        }

        .section-header {
            margin-bottom: 30px;
        }

        .section-header h2 {
            font-size: 24px;
            color: #333;
        }

        /* Rules List Styles */
        .rules-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .rule-card {
            background-color: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .rule-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .rule-title {
            font-size: 18px;
            color: #32506D;
            font-weight: 600;
        }

        .rule-id {
            color: #666;
            font-size: 14px;
        }

        .rule-details {
            margin-top: 10px;
        }

        .rule-description {
            color: #4a5568;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .rule-meta {
            display: flex;
            justify-content: space-between;
            color: #718096;
            font-size: 14px;
            border-top: 1px solid #e2e8f0;
            padding-top: 15px;
        }

        .rule-status {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-active {
            background-color: #ebf7ed;
            color: #0f766e;
        }

        .status-inactive {
            background-color: #fef2f2;
            color: #dc2626;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
        }

        .modal-content {
            background-color: #ffffff;
            width: 90%;
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #ddd;
        }

        .modal-header h2 {
            color: #32506D;
            font-size: 24px;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #666;
        }

        .close-btn:hover {
            color: #c33;
        }

        .modal-body {
            margin-top: 20px;
        }

        .modal-body p {
            margin-bottom: 15px;
            line-height: 1.6;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                min-height: auto;
            }

            .main-content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        <h1 class="sidebar-title">GN Dashboard</h1>
        <ul class="sidebar-menu">
            <li><a href="Rules and Regulation Citizen.html" class="active">Rules & Regulation</a></li>
            <li></li>
            <li><a href="Announcement Citizen.html">Announcement</a></li>
            <li></li>
            <li><a href="Community Services Citizen.html">Community Services</a></li>
        </ul>
    </aside>

    <main class="main-content">
        <div class="section-header">
            <h2>Rules & Regulations</h2>
        </div>

        <div class="rules-container" id="rulesContainer">
            <!-- Rules will be dynamically populated here -->
        </div>
    </main>

    <!-- View Rule Modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Rule Details</h2>
                <button class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Rule details will be populated here -->
            </div>
        </div>
    </div>

    <script>
        // Get rules from localStorage (shared with AGN's page)
        let rules = JSON.parse(localStorage.getItem('rules')) || [];

        // Initialize with sample data if empty
        if (rules.length === 0) {
            rules = [
                {
                    id: 'R001',
                    title: 'General Duties of Grama Niladhari',
                    description: 'Basic responsibilities and duties',
                    lastUpdated: '2024-03-15',
                    status: 'Active'
                },
                {
                    id: 'R002',
                    title: 'Documentation Requirements',
                    description: 'Required documentation procedures',
                    lastUpdated: '2024-03-14',
                    status: 'Active'
                }
            ];
            localStorage.setItem('rules', JSON.stringify(rules));
        }

        // Function to display rules in cards
        function displayRules() {
            const container = document.getElementById('rulesContainer');
            container.innerHTML = '';

            // Filter to show only active rules for citizens
            const activeRules = rules.filter(rule => rule.status === 'Active');

            activeRules.forEach(rule => {
                const card = document.createElement('div');
                card.className = 'rule-card';
                card.innerHTML = `
                    <div class="rule-header">
                        <span class="rule-title">${rule.title}</span>
                        <span class="rule-id">${rule.id}</span>
                    </div>
                    <div class="rule-details">
                        <p class="rule-description">${rule.description}</p>
                        <div class="rule-meta">
                            <span>Last Updated: ${rule.lastUpdated}</span>
                            <span class="rule-status status-${rule.status.toLowerCase()}">${rule.status}</span>
                        </div>
                    </div>
                `;
                
                // Add click event to view details
                card.addEventListener('click', () => viewRule(rule.id));
                container.appendChild(card);
            });
        }

        // View rule details
        function viewRule(ruleId) {
            const rule = rules.find(r => r.id === ruleId);
            if (rule) {
                const modal = document.getElementById('viewModal');
                const modalBody = document.getElementById('modalBody');
                
                modalBody.innerHTML = `
                    <p><strong>Rule ID:</strong> ${rule.id}</p>
                    <p><strong>Title:</strong> ${rule.title}</p>
                    <p><strong>Description:</strong> ${rule.description}</p>
                    <p><strong>Last Updated:</strong> ${rule.lastUpdated}</p>
                    <p><strong>Status:</strong> <span class="rule-status status-${rule.status.toLowerCase()}">${rule.status}</span></p>
                `;
                
                modal.style.display = 'block';
            }
        }

        // Close modal function
        function closeModal() {
            const modal = document.getElementById('viewModal');
            modal.style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('viewModal');
            if (event.target === modal) {
                closeModal();
            }
        };

        // Initial display of rules
        displayRules();
    </script>
</body>
</html>