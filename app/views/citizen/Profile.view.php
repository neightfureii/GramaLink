<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citizen Profile Management</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/citizen/profile.css"> 
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <a href="home"><div class="logo"><img src="<?=ROOT?>/assets/images/logo_white.png" alt="gramalinklogo"></div></a>
            <ul>
                <li><a href="profile" class="active">Personal Info</a></li>
                <li><a href="security">Password & Security</a></li>
                <li><a href="contact">Contact & Address</a></li>
                <li><a href="notification">Notifications</a></li>
                <li><a href="settings">Settings</a></li>
            </ul>
        </div>

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

        <!-- Main Profile Section -->
        <div class="profile-content">
            <div class="profile-header">
                <h3>Personal Information</h3>
            </div>

            <div class="profile-section">
                <div class="profile-photo" style="width: 30%;">
                    <img src="<?=ROOT . $userDetails->image?>" alt="Profile Photo" id="profile-image">
                </div>

                <div class="profile-details">
                    <div class="detail-item">
                        <label>Full Name</label>
                        <div class="value"><?=$userDetails->full_name?></div>
                        <input type="text" value="<?=$userDetails->full_name?>">
                    </div>

                    <div class="detail-item">
                        <label>Date of Birth</label>
                        <div class="value"><?=$userDetails->date_of_birth?></div>
                        <input type="date" value="<?=$userDetails->date_of_birth?>">
                    </div>

                    <div class="detail-item">
                        <label>Gender</label>
                        <div class="value"><?=$userDetails->gender?></div>
                        <select>
                            <option value="male" <?= $userDetails->gender == 'male' ? 'selected' : '' ?>>Male</option>
                            <option value="female" <?= $userDetails->gender == 'female' ? 'selected' : '' ?>>Female</option>
                            <option value="other" <?= $userDetails->gender == 'other' ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>

                    <div class="detail-item">
                        <label>NIC</label>
                        <div class="value"><?=$userDetails->nic?></div>
                        <input type="text" value="<?=$userDetails->nic?>">
                    </div>

                    <div class="detail-item">
                        <label>Civil Status</label>
                        <div class="value"><?=$userDetails->civil_status?></div>
                        <select>
                            <option value="single" <?= $userDetails->civil_status == 'single' ? 'selected' : '' ?>>Single</option>
                            <option value="married" <?= $userDetails->civil_status == 'married' ? 'selected' : '' ?>>Married</option>
                            <option value="divorced" <?= $userDetails->civil_status == 'divorced' ? 'selected' : '' ?>>Divorced</option>
                            <option value="widowed" <?= $userDetails->civil_status == 'widowed' ? 'selected' : '' ?>>Widowed</option>
                            <option value="other" <?= $userDetails->civil_status == 'other' ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>

                    <div class="actions">
                        <button class="edit-btn" onClick="openEditModal()">Edit Details</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div id="edit-modal" class="modal" style="display: none;">
            <div class="modal-content" style="margin-top: 1rem;">
                <span class="close" onclick="closeEditModal()">&times;</span>
                <h3>Edit Personal Information</h3>
                <div class="modal-body">
                    <form action="<?=ROOT?>/citizen/profile/submitEditRequest" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="edit-image">Profile Photo</label>
                            <input type="file" id="edit-image" name="image">
                        </div>
                        <div class="form-group">
                            <label for="edit-dob">Civil Status</label>
                            <select id="edit-civilstatus" name="civilstatus">
                                <option value="single" <?= $userDetails->civil_status == 'single' ? 'selected' : '' ?>>Single</option>
                                <option value="married" <?= $userDetails->civil_status == 'married' ? 'selected' : '' ?>>Married</option>
                                <option value="divorced" <?= $userDetails->civil_status == 'divorced' ? 'selected' : '' ?>>Divorced</option>
                                <option value="widowed" <?= $userDetails->civil_status == 'widowed' ? 'selected' : '' ?>>Widowed</option>
                                <option value="other" <?= $userDetails->civil_status == 'other' ? 'selected' : '' ?>>Other</option>
                            </select>
                        </div>
                        <button type="submit" class="save-btn">Submit Edit Request</button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>

    <script>
        function openEditModal() {
            // Open the edit modal
            document.getElementById('edit-modal').style.display = 'block';
        }

        function closeEditModal() {
            // Close the edit modal
            document.getElementById('edit-modal').style.display = 'none';
        }

        window.onclick = function(event) {
            var modal = document.getElementById('edit-modal');
            if (event.target == modal) {
                closeEditModal();
            }
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
    </script>
</body>
</html>