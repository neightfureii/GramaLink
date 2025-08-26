<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daily Activity Report</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f7fa;
      color: #333;
    }
    
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }
    
    .header {
      background-color: #003366;
      color: white;
      padding: 20px;
      border-radius: 10px 10px 0 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .logo-placeholder {
      
      width: 40px;
      height: 40px;
      border-radius: 5px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 10px;
      color: #003366;
    }
    
    .header h1 {
      margin: 0;
      font-weight: 500;
      font-size: 24px;
    }
    
    .date-display {
      background-color: white;
      border-left: 4px solid #003366;
      padding: 10px 15px;
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
      border-radius: 0 5px 5px 0;
    }
    
    .card {
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      margin-bottom: 20px;
      overflow: hidden;
    }
    
    .card-header {
      padding: 15px 20px;
      background-color: #f8f9fa;
      border-bottom: 1px solid #eee;
      font-weight: 500;
    }
    
    .card-body {
      padding: 0;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
    }
    
    thead th {
      background-color: #e9ecef;
      color: #495057;
      font-weight: 500;
      text-align: left;
      padding: 15px 20px;
    }
    
    tbody td {
      padding: 15px 20px;
      border-bottom: 1px solid #eee;
    }
    
    tbody tr:hover {
      background-color: #f8f9fa;
    }
    
    tbody tr:last-child td {
      border-bottom: none;
    }
    
    .action-type {
      font-weight: 500;
      color: #003366;
      background-color: #e6f0ff;
      padding: 5px 10px;
      border-radius: 4px;
      text-transform: uppercase;
      font-size: 12px;
    }
    
    .description {
      color: #555;
      line-height: 1.5;
    }
    
    .action-container {
      margin-top: 20px;
      display: flex;
      justify-content: flex-end;
    }
    
    .btn-download {
      background-color: #003366;
      color: white;
      padding: 12px 24px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: all 0.3s ease;
    }
    
    .btn-download:hover {
      background-color: #002347;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .empty-message {
      padding: 40px;
      text-align: center;
      color: #6c757d;
    }

    .footer {
      margin-top: 30px;
      text-align: center;
      color: #6c757d;
      font-size: 14px;
      padding-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <div class="logo-placeholder"><img src="<?=ROOT?>/assets/images/logo_white.png" width="70px" style="margin-left: 50px;" ></div>
      <h1>GOVERNMENT DAILY ACTIVITY REPORT</h1>
      <div></div>
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
    
    <div class="footer">
      &copy; Government Department - Daily Activity Reporting System
    </div>
  </div>

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
        const response = await fetch("<?=ROOT?>/agn/Report/getActivityLog");
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
      const response = await fetch("<?= ROOT?>/agn/Report/getActivityLog");
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