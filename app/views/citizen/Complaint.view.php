
<?php
    $lang = $_COOKIE['language'] ?? 'en';
    $text = include "../app/lang/$lang.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints</title>

    <!-- Iconscout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Montserrat Font(Google fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?=ROOT?>/assets/css/citizen/complaint.css"> 
</head>
<body>
    <?php include '../app/views/citizen/partials/navbar.php'; ?>
    <!-- newcomment -->
    <!-- Breadcrumb Section -->
    <div class="container breadcrumb">
        <p><a href="home" class="crumb">Home</a> > <a href="dashboard" class="crumb">Dashboard</a> > <a href="complaint" class="crumb">Complaints</a></p>
    </div>

    <div class="container wrapper">
        <div class="header">
           
                <?php if (!empty($_SESSION['error_message'])): ?>
                    <div class="error-message">
                        <?= htmlspecialchars($_SESSION['error_message']) ?>
                    </div>
                    <?php unset($_SESSION['error_message']); ?>
                
                <?php endif; ?>
                <?php if (!empty($_SESSION['success_message'])): ?>
                    <div class="success_message">
                        <?= htmlspecialchars($_SESSION['success_message']) ?>
                    </div>
                    <?php unset($_SESSION['success_message']); ?>
                
                <?php endif; ?>



                       
            

            <h2><?=$text['complain']?></h2>
        </div>
       
             

        <div class="tabs">
            <button class="tab active" id="viewTab"><?=$text['viewComplaint']?></button>
            <button class="tab" id="submitTab">+ <?=$text['submitComplaint']?></button>
            <!-- <button class="tab" id="visitRequestTab" >Visit Request</button> -->

        </div>

        <div class="content">
            <div id="viewComplaints">
                <table class="complaint-table">
                    <thead>
                        <tr>

                            <th><?=$text['Date']?></th>
                            <th>Category</th>
                            

                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="complaintTableBody">
   
            <?php if (!empty($complainDetails) && is_array($complainDetails)): ?>
                <?php foreach ($complainDetails as $complaint): ?>
                    <tr>
                        <td><?= htmlspecialchars($complaint->date) ?></td>
                        <td><?= htmlspecialchars($complaint->complaint_category) ?></td>
                        <td><?= htmlspecialchars($complaint->status) ?></td>
                        <td>
                            <button onclick="openModal(<?= htmlspecialchars($complaint->complaint_id) ?>)">View</button>
                        </td>
                     </tr>
                <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="5" style="text-align: center; color: blue;">No complaints found</td>
            </tr>
    <?php endif; ?>
</tbody>
                </table>
            </div>

            <div id="submitComplaint" style="display: none;">
                

                <form id="complaintForm" method="POST" enctype="multipart/form-data">
                    <?php if (!empty($citizenData) && is_object($citizenData)): ?>
                    <div class="form-group">
                        <label for="name"><?=$text['fullName']?>:</label>
                        <input type="text" id="name" name="name" value="<?= htmlspecialchars($citizenData->full_name)?>" readonly required>
                    </div>
                    

                    <div class="form-group">
                        <label for="nic"><?=$text['Nic']?>:</label>
                        <input type="text" id="nic" name="nic" value="<?= htmlspecialchars($citizenData->nic ?? '')?>" readonly required>
                    </div>

                    <div class="form-group">
                        <label for="phone"><?=$text['phoneNumber']?>:</label>
                        <input type="tel" id="phone" name="phone" placeholder="07xxxxxxx" required>

                    </div>

                    <div class="form-group">
                        
                        <label for="email">Email:</label>

                        <input type="email" id="email" name="email" required value="<?=htmlspecialchars($user->email ?? '')?>">
                    </div>

                    <div class="form-group">
                        <label for="address"><?=$text['Address']?>:</label>
                        <textarea id="address" name="address" rows="3"  required><?=htmlspecialchars($citizenData->address ?? '')?></textarea>
                    </div>
                    

                        
                    <?php else: ?>
                        <p>No citizen data available </p>
                    <?php endif; ?>   
                    
                    
                    <div class="form-group">
                        <label for="time"><?=$text['Time']?> :</label>
                        <input type="time" id="time" name="time" required>
                    </div>
                    <div class="form-group">
                        <label for="date"><?=$text['Date']?> :</label>
                        <input type="date" id="date" name="date" required>
                    </div>

                    <div class="form-group">
                        <label for="category"><?=$text['ComplaintCategory']?>:</label>
                        <select id="category" name="complaintCategory" required>
                            <option value="">Select a category</option>
                            <option value="Land Dispute">Land Dispute</option>
                            <option value="Street Light Issue">Street Light Issue</option>
                            <option value="Drainage Problem">Drainage Problem</option>
                            <option value="Sanitation">Sanitation</option>

                            <option value="Noise Complaint">Noise Complaint</option>
                            <option value="Utility Services">Utility Services</option>
                            <option value="Neighbor Dispute">Neighbor Dispute</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">

                        <label for="description"><?=$text['ComplaintDes']?>:</label>
                        <textarea id="description" rows="5" name="text" placeholder="Explain about Complain brifly...."required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Upload Image</label>
                        <input type="file" id="imageUpload" name="image[]" accept="image/*" style="display: none;" multiple>
                        <div class="upload-trigger" onclick="document.getElementById('imageUpload').click()">
                                <i class="uil uil-plus-circle add-icon"></i> Add Image
                         </div>
                         <div id="previewContainer" class="image-preview-container"></div>
                    </div>

                    <button type="submit"><?=$text['submitComplaint']?></button>
                </form>
            </div>
            


        </div>
    </div>

    <!-- View/Edit Modal -->
    <div id="complaintModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <div id="modalContent"></div>
        </div>
    </div>

    <?php include '../app/views/citizen/partials/footer.php'; ?>

    <script>
    const BASE_URL = "<?=ROOT?>";
    

    
    
    </script>   
    
    <script src="<?=ROOT?>/assets/js/citizen/complaint.js"></script>
    

</body>
</html>
