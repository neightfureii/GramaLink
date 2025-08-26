<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GN Citizen Details</title>

  <!-- Iconscout CDN -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

  <!-- Montserrat Font (Google fonts) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">

  <!-- Font Awesome CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/gn/appointment.css">

  <style>
    .profile-container {
      width: 95%;
      margin: 2rem auto;
      display: grid;
      grid-template-columns: 300px 1fr;
      gap: 2rem;
      background: white;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
      overflow: hidden;
    }

    .profile-left {
      background: #f0f0f0;
      padding: 2rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      border-right: 1px solid #e0e0e0;
    }

    .profile-image {
      width: 140px;
      height: 140px;
      border-radius: 50%;
      overflow: hidden;
      border: 4px solid white;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      margin-bottom: 1rem;
    }

    .profile-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .profile-left h2 {
      font-size: 1.5rem;
      color: #2c3e50;
      margin-bottom: 1rem;
    }

    .basic-info p {
      margin: 0.5rem 0;
    }

    .basic-info input {
      width: 100%;
      border: none;
      background: transparent;
      font-size: 0.95rem;
      font-weight: 500;
      color: #333;
    }

    .profile-right {
      padding: 2rem;
    }

    .info-card {
      background: #fff;
      border-radius: 10px;
      padding: 1.5rem;
      margin-bottom: 1.5rem;
      box-shadow: 0 1px 6px rgba(0, 0, 0, 0.05);
    }

    .info-card h3 {
      color: #0077cc;
      margin-bottom: 1rem;
      font-size: 1.2rem;
    }

    .info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1rem;
    }

    .info-item label {
      color: #666;
      font-size: 0.9rem;
    }

    .info-item input,
    .info-item select,
    .info-item textarea {
      width: 100%;
      padding: 0.5rem;
      margin-top: 0.3rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 0.95rem;
    }

    .edit-buttons {
      display: flex;
      justify-content: flex-end;
    }

    .btn {
      padding: 0.6rem 1.2rem;
      border-radius: 5px;
      border: none;
      cursor: pointer;
      font-weight: 500;
      background: #4caf50;
      color: #fff;
      transition: background 0.3s;
    }

    .btn:hover {
      background: #43a047;
    }

    @media (max-width: 768px) {
      .profile-container {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>

    <?php $current_page = 'citizensearch'; include '../app/views/gn/partials/navbar.php'; ?>

    <main class="main-content">
        <div class="header">
          <h2>
            <a href="<?=ROOT?>/gn/CitizenSearch" style="display: inline-flex; align-items: center; gap: 0.5rem;">
              <i class="uil uil-arrow-left"></i> 
            </a>
            Citizen Details
          </h2>
        </div>
        <form action="<?=ROOT?>/gn/CitizenDetails/update_citizen_profile" method="POST" class="profile-container">
            <div class="profile-left">
                <div class="profile-image">
                <img src="<?=ROOT.$citizen->image?>" alt="Citizen Photo">
                </div>
                <h2><?=$citizen->full_name?></h2>
                <div class="basic-info">
                <p>NIC: <input type="text" name="nic" value="<?=$citizen->nic?>" disabled></p>
                <p>Birth Certificate Number: <input type="text" name="bcnumber" value="<?=$citizen->bcnumber?>" disabled></p>
                <p>Grama Niladhari Division: <input type="text" name="division_name" value="<?=$citizen->division_name?>" disabled></p>
                <p>District: <input type="text" name="district" value="<?=$citizen->district?>" disabled></p>
                <p>Province: <input type="text" name="province" value="<?=$citizen->province?>" disabled></p>
                <p>Registered: <input type="text" value="<?=date('F Y', strtotime($citizen->created_at))?>" disabled></p>
                </div>
            </div>

            <div class="profile-right">
                <div class="info-card">
                <h3><i class="uil uil-user"></i> Personal Information</h3>
                <div class="info-grid">
                    <div class="info-item">
                    <label>Date of Birth:</label>
                    <input type="date" name="date_of_birth" value="<?=$citizen->date_of_birth?>" disabled>
                    </div>
                    <div class="info-item">

                    <!-- code check edditted part task 1 -->
                    <label>Age:</label>
                    <input type="age" name="age" value="<?=$citizen->age?>" disabled>
                    </div>

                    
                    <div class="info-item">
                    <label>Gender:</label>
                    <select name="gender" disabled>
                        <option value="male" <?= $citizen->gender === 'male' ? 'selected' : '' ?>>Male</option>
                        <option value="female" <?= $citizen->gender === 'female' ? 'selected' : '' ?>>Female</option>
                        <option value="other" <?= $citizen->gender === 'other' ? 'selected' : '' ?>>Other</option>
                    </select>
                    </div>
                    <div class="info-item">
                    <label>Civil Status:</label>
                    <select name="civil_status" disabled>
                        <option value="single" <?= $citizen->civil_status === 'single' ? 'selected' : '' ?>>Single</option>
                        <option value="married" <?= $citizen->civil_status === 'married' ? 'selected' : '' ?>>Married</option>
                        <option value="widowed" <?= $citizen->civil_status === 'widowed' ? 'selected' : '' ?>>Widowed</option>
                    </select>
                    </div>
                    <div class="info-item">
                    <label>Phone:</label>
                    <input type="text" name="mobileNumber" value="<?=$citizen->mobileNumber?>" disabled>
                    </div>
                    <div class="info-item">
                    <label>Email:</label>
                    <input type="email" name="email" value="<?=$citizen->email?>" disabled>
                    </div>
                    <div class="info-item" style="grid-column: 1 / -1;">
                    <label>Address:</label>
                    <textarea name="address" disabled><?=$citizen->address?></textarea>
                    </div>
                </div>
                </div>

                <div class="info-card">
                <h3><i class="uil uil-file-alt"></i> Activity</h3>
                <div class="info-grid">
                    <div class="info-item">
                    <label>Last Login:</label>
                    <input type="text" name="last_login" value="<?=$citizen->last_login?>" disabled>
                    </div>
                    <div class="info-item">
                    <label>Account Status:</label>
                    <select name="is_active" disabled>
                        <option value="1" <?= $citizen->is_active ? 'selected' : '' ?>>Active</option>
                        <option value="0" <?= !$citizen->is_active ? 'selected' : '' ?>>Inactive</option>
                    </select>
                    </div>
                </div>
                </div>

                <div class="edit-buttons">
                    <button type="button" class="btn" onclick="editDetails()" id="editbtn"><i class="uil uil-edit"></i> Edit</button>
                    <button type="submit" class="btn" style="display:none" id="savebtn"><i class="uil uil-save"></i> Save Changes</button>
                </div>
            </div>
        </form>
    </main>


    <script>
        function editDetails() {
            const editbtn = document.getElementById('editbtn');
            const savebtn = document.getElementById('savebtn');
            
            editbtn.style.display = 'none';
            savebtn.style.display = 'block';

            // Enable all input, select, and textarea elements
            const form = document.querySelector('.profile-container');
            form.querySelectorAll('input:not([readonly]), select, textarea').forEach(element => {
              element.disabled = false;
            });
        }
    </script>

</body>
</html>
