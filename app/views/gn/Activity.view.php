  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Activity Report</title>
    
    <!-- Iconscout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <!-- Montserrat Font (Google fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/gn/activity.css">
</head>
<body>
    <?php $current_page = 'activity'; include '../app/views/gn/partials/navbar.php';?>

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
      <div class="application-header">
        <h2>Daily Activity</h2>
        <div class="right" style="display:flex; gap:20px;">
          <?php include '../app/views/gn/partials/header_icons.php'; ?>
        </div>
      </div>
    
      <div class="date-display">
        <div>Date: <strong id="currentDate"></strong></div>
        <div>Generated: <span id="generationTime"></span></div>
      </div>
    
      <div class="card">
        <div class="card-header">
          Activity Log Summary
        </div>
        <div class="card-body">
          <table id="activityTable">
            <thead>
              <tr>
                <th width="5%">#</th>
                <th width="25%">Action Type</th>
                <th width="70%">Description</th>
              </tr>
            </thead>
            <tbody id="activityBody">
              <!-- Will be populated by JavaScript -->
            </tbody>
          </table>
        </div>
      </div>
    
      <div class="action-container">
        <button class="btn-download" onclick="generatePDF()">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
          </svg>
          Download Daily Report
        </button>
      </div>
    </main>

  <script>
    // Format current date
    const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const today = new Date();
    document.getElementById('currentDate').textContent = today.toLocaleDateString('en-US', dateOptions);
    
    // Format generation time
    const timeOptions = { hour: '2-digit', minute: '2-digit' };
    document.getElementById('generationTime').textContent = today.toLocaleTimeString('en-US', timeOptions);
    
    // Fetch and display activity logs
    document.addEventListener('DOMContentLoaded', async () => {
      try {
        const response = await fetch("<?=ROOT?>/gn/Activity/getTodayActivityLog");
        const logs = await response.json();
        const tbody = document.getElementById('activityBody');
        
        if(!logs || logs.length === 0){
          const tr = document.createElement('tr');
          tr.innerHTML = `<td colspan="3" class="empty-message">No activity logs found for today</td>`;
          tbody.appendChild(tr);
        } else {
          logs.forEach((log, index) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
              <td>${index + 1}</td>
              <td><span class="action-type">${log.action_type}</span></td>
              <td class="description">${log.action_des}</td>
            `;
            tbody.appendChild(tr);
          });
        }
      } catch (error) {
        console.error("Error fetching activity logs:", error);
        const tbody = document.getElementById('activityBody');
        const tr = document.createElement('tr');
        tr.innerHTML = `<td colspan="3" class="empty-message">Error loading activity logs</td>`;
        tbody.appendChild(tr);
      }
    });

    // Generate PDF function (keeping your original logic)
    async function generatePDF() {
      const { jsPDF } = window.jspdf;
      const doc = new jsPDF();
      
      // Set default styling
      doc.setDrawColor(0, 51, 102); // Dark blue for borders
      doc.setTextColor(0, 51, 102); // Dark blue for text
      
      // Get data from API
      const response = await fetch("<?= ROOT?>/gn/Activity/getTodayActivityLog");
      const logs = await response.json();
    
      // Add header with blue background
      doc.setFillColor(0, 51, 102);
      doc.rect(0, 0, 210, 25, 'F');
      
      // Add logo placeholder (left side)
      const logoUrl = "<?= ROOT ?>/assets/images/logo_white.png"; // Replace with your logo URL
        const logoImage = await fetch(logoUrl).then(res => res.blob()).then(blob => {
          return new Promise((resolve) => {
            const reader = new FileReader();
            reader.onload = () => resolve(reader.result);
            reader.readAsDataURL(blob);
          });
      });

        doc.addImage(logoImage, 'PNG', 15, 5, 15, 15); // Add the image to the PDF
      
      // Header title
      doc.setFontSize(16);
      doc.setFont("helvetica", "bold");
      doc.setTextColor(255, 255, 255);
      doc.text("GOVERNMENT DAILY ACTIVITY REPORT", 105, 15, { align: "center" });
      
      // Blue footer
      doc.setFillColor(0, 51, 102);
      doc.rect(0, 282, 210, 15, 'F');
      
      // Page number in footer
      doc.setFontSize(10);
      doc.setTextColor(255, 255, 255);
      doc.text("Page 1", 105, 290, { align: "center" });
      
      // Content area with border
      doc.setDrawColor(0, 51, 102);
      doc.rect(10, 30, 190, 245, 'S');
      
      // Report date
      let y = 40;
      doc.setTextColor(0, 51, 102);
      doc.setFontSize(12);
      doc.setFont("helvetica", "bold");
      doc.text("Date: <?= date('Y-m-d') ?>", 15, y);
      
      // Blue separator line
      y += 5;
      doc.setLineWidth(0.5);
      doc.line(15, y, 195, y);
      y += 10;
      
      // Content
      let pageNum = 1;
      if (!logs || logs.length === 0) {
          doc.setFontSize(12);
          doc.setFont("helvetica", "normal");
          doc.setTextColor(0, 0, 0);
          doc.text("No office work today", 20, y);
      } else {
      
          logs.forEach((log, index) => {
            // Check if we need a new page
            if (y > 260) {
              // Add new page with same header and footer
              doc.addPage();
              pageNum++;
              
              // Header with blue background
              doc.setFillColor(0, 51, 102);
              doc.rect(0, 0, 210, 25, 'F');
              
              // Logo placeholder
              doc.addImage(logoImage, 'PNG', 15, 5, 15, 15);

              
              // Header title
              doc.setFontSize(16);
              doc.setFont("helvetica", "bold");
              doc.setTextColor(255, 255, 255);
              doc.text("GRAMA NILADARI DAILY ACTIVITY REPORT", 105, 15, { align: "center" });
              
              // Blue footer
              doc.setFillColor(0, 51, 102);
              doc.rect(0, 282, 210, 15, 'F');
              
              // Page number in footer
              doc.setFontSize(10);
              doc.setTextColor(255, 255, 255);
              doc.text("Page " + pageNum, 105, 290, { align: "center" });
              
              // Content area with border
              doc.setDrawColor(0, 51, 102);
              doc.rect(10, 30, 190, 245, 'S');
              
              // Reset Y position
              y = 40;
            }
            
            // Activity entry with light blue background
            doc.setFillColor(240, 248, 255); // Light blue background
            doc.rect(15, y - 5, 180, 7, 'F');
            
            // Activity title
            doc.setTextColor(0, 51, 102);
            doc.setFontSize(11);
            doc.setFont("helvetica", "bold");
            const title = `${index + 1}. [${log.action_type.toUpperCase()}]`;
            doc.text(title, 20, y);
            y += 10;
            
            // Activity details
            doc.setFont("helvetica", "normal");
            doc.setFontSize(10);
            doc.setTextColor(0, 0, 0); // Black text for details
            
            const wrappedText = doc.splitTextToSize(log.action_des, 165);
            
            // Check if we need a page break within the text
            if (y + (wrappedText.length * 5) > 260) {
              doc.addPage();
              pageNum++;
              
              // Header with blue background
              doc.setFillColor(0, 51, 102);
              doc.rect(0, 0, 210, 25, 'F');
              
              // Logo placeholder
              doc.setFillColor(255, 255, 255);
              doc.rect(15, 5, 15, 15, 'F');
              doc.setDrawColor(0, 51, 102);
              doc.rect(15, 5, 15, 15, 'S');
              doc.setFontSize(9);
              doc.setTextColor(0, 51, 102);
              doc.text("LOGO", 18, 13);
              
              // Header title
              doc.setFontSize(16);
              doc.setFont("helvetica", "bold");
              doc.setTextColor(255, 255, 255);
              doc.text("GOVERNMENT DAILY ACTIVITY REPORT", 105, 15, { align: "center" });
              
              // Blue footer
              doc.setFillColor(0, 51, 102);
              doc.rect(0, 282, 210, 15, 'F');
              
              // Page number in footer
              doc.setFontSize(10);
              doc.setTextColor(255, 255, 255);
              doc.text("Page " + pageNum, 105, 290, { align: "center" });
              
              // Content area with border
              doc.setDrawColor(0, 51, 102);
              doc.rect(10, 30, 190, 245, 'S');
              
              // Reset Y position
              y = 40;
            }
            
            doc.text(wrappedText, 25, y);
            y += wrappedText.length * 5;
            
            // Add dotted line separator between activities
            y += 5;
            doc.setLineDashPattern([1, 1], 0);
            doc.setDrawColor(0, 51, 102);
            doc.line(20, y, 190, y);
            doc.setLineDashPattern([], 0); // Reset to solid line
            y += 10;
          });
      }
      
      // Get current date for the filename
      doc.save("Daily_Report_<?= date('Y-m-d') ?>.pdf");
    }
  </script>
</body>
</html>
