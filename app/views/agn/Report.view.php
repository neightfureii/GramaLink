<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Log Report</title>
    <!-- Include jsPDF library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <!-- Include jsPDF autoTable plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.0/jspdf.plugin.autotable.min.js"></script>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/agn/application.css">
    <style>
        /* body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f7fa;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        } */
        h2 {
            color: #003366;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e0e0e0;
            font-weight: 600;
        }
        .search-panel {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 25px;
            border: 1px solid #e0e0e0;
        }
        .form-group {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        .form-group label {
            flex: 0 0 120px;
            font-weight: 500;
            color: #555;
        }
        select, input[type="date"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            width: 200px;
        }
        button {
            background-color: #003366;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #004480;
        }
        #downloadPDF {
            background-color: #d9534f;
            margin-top: 20px;
        }
        #downloadPDF:hover {
            background-color: #c9302c;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        thead {
            background-color: #003366;
            color: white;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tbody tr:hover {
            background-color: #f0f7ff;
        }
        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            color: #666;
            font-style: italic;
        }
    </style>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<?php $current_page = 'report'; include '../app/views/agn/partials/navbar.php';?>

    <div class="main-content">
        <h2>Activity Log Report</h2>
        
        <!-- Date and GN Division Selection Form -->
        <div class="search-panel">
            <form id="searchForm">
                <div class="form-group">
                    <label for="gn_division">GN Division:</label>
                    <select id="gn_division" name="gn_division">
                        <option value="1001">1001</option>
                        <option value="1002">1002</option>
                        <option value="1003">1003</option>
                        <option value="1004">1004</option>
                        <option value="1005">1005</option>
                        <!-- Add more options as required -->
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="selected_date">Select Date:</label>
                    <input type="date" id="selected_date" name="selected_date">
                </div>
                
                <div class="form-group">
                    <label></label>
                    <button type="button" onclick="searchLogs()">Search</button>
                </div>
            </form>
        </div>

        <!-- Table to display activity logs -->
        <div class="table-responsive">
            <table id="activityLogTable" style="display: none;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Action Type</th>
                        <th>Action Description</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <div class="no-data" id="noDataMessage" style="display: none;">
                No activity logs found for the selected criteria.
            </div>
        </div>

        <!-- Button to generate PDF -->
        <div class="actions">
            <button id="downloadPDF" onclick="generatePDF()" style="display: none;">Download as PDF</button>
        </div>
    </div>

    <script>
        // Function to fetch activity logs based on selected date and GN division
        function searchLogs() {
            const gn_division = document.getElementById('gn_division').value;
            const selected_date = document.getElementById('selected_date').value;

            // Construct the URL with the selected parameters
            const url = `http://localhost/GramaLink/public/agn/report?gn_division=${gn_division}&selected_date=${selected_date}`;

            // Fetch the data
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Populate the table with fetched data
                    populateTable(data, url); // Pass the URL to generatePDF
                })
                .catch(error => {
                    console.error('Error fetching activity logs:', error);
                    document.getElementById('activityLogTable').style.display = 'none';
                    document.getElementById('noDataMessage').style.display = 'block';
                    document.getElementById('downloadPDF').style.display = 'none';
                });
        }

        // Function to populate the table with the logs data
        function populateTable(data, url) {
            const tableBody = document.querySelector('#activityLogTable tbody');
            tableBody.innerHTML = '';  // Clear any existing rows
            
            if (data.length === 0) {
                document.getElementById('activityLogTable').style.display = 'none';
                document.getElementById('noDataMessage').style.display = 'block';
                document.getElementById('downloadPDF').style.display = 'none';
                return;
            }

            data.forEach(log => {
                const row = document.createElement('tr');

                row.innerHTML = ` 
                    <td>${log.id}</td>
                    <td>${log.user_id}</td>
                    <td>${log.action_type}</td>
                    <td>${log.action_des || 'N/A'}</td>
                    <td>${log.timestamp}</td>
                `;
                tableBody.appendChild(row);
            });

            // Show the table and download button after data is loaded
            document.getElementById('activityLogTable').style.display = 'table';
            document.getElementById('noDataMessage').style.display = 'none';
            document.getElementById('downloadPDF').style.display = 'inline';

            // Store the URL for later use when generating PDF
            window.reportUrl = url;
        }

        // Function to generate PDF from the activity log table
        async function generatePDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
      
            // Set default styling
            doc.setDrawColor(0, 51, 102); // Dark blue for borders
            doc.setTextColor(0, 51, 102); // Dark blue for text
      
            // Use the stored URL to fetch the data for the report
            const url = window.reportUrl;

            const response = await fetch(url);
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
                    doc.line(15, y, 195, y);
                    y += 5;
                });
            }
      
            // Download the generated PDF
            doc.save('activity_log_report.pdf');
        }
    </script>
</body>
</html>