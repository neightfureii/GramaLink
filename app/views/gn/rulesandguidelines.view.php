<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GN Rules and Guidelines</title>

    <!-- iconscout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
     <!-- Montserrat Font (Google fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/gn/rng.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</head>
<body>
<?php $current_page = 'rulesandguidelines'; include '../app/views/gn/partials/navbar.php';?>


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
    // Embedding PHP data into JavaScript
        const rulesFromBackend = <?php echo json_encode($RuleData); ?>;
    </script>

<script>
    // Use rules passed from backend
    const rules = rulesFromBackend || [];

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
                    <span class="rule-title">${rule.Rule_title}</span>
                    
                </div>
                <div class="rule-details">
                    <p class="rule-description">${rule.Description}</p>
                    <div class="rule-meta">
                        <span>Last Updated: ${rule.last_Updated}</span>
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
               
                <p><strong>Title:</strong> ${rule.Rule_title}</p>
                <p><strong>Description:</strong> ${rule.Description}</p>
                <p><strong>Last Updated:</strong> ${rule.last_Updated}</p>
                <p><strong>Status:</strong> <span class="rule-status status-${rule.status.toLowerCase()}">${rule.status}</span></p>
                ${rule.pdf ? `
                <p>
                    <strong>PDF File:</strong> 
                    <a href="${rule.pdf}" target="_blank" class="rule-download-btn">
                        Download PDF
                    </a>
                </p>
            ` : '<p>No PDF file available for this rule.</p>'}
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