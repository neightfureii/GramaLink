<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GN Citizen Requests</title>

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

    .comparison-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2rem;
}

.comparison-column h4 {
  margin-bottom: 1rem;
  color: #333;
  font-weight: 600;
}

.comparison-column .info-item {
  margin-bottom: 1rem;
}

.profilepic {
  width: 10rem;
  height: 10rem;
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
          Citizen Requests
        </h2>
      </div>

      <div class="info-card">
        <h3>Edit Request Comparison</h3>
        <div class="comparison-grid">
          <div class="comparison-column">
            <h4>Current Information</h4>
            <div class="info-item">
              <img src="<?=ROOT . $citizen->image ?>" class="profilepic">
            </div>
            <div class="info-item">
              <label>Civil Status</label>
              <input type="text" value="<?= $citizen->civil_status ?>" readonly>
            </div>
            <div class="info-item">
              <label>Email</label>
              <input type="text" value="<?= $citizen->email ?>" readonly>
            </div>
            <div class="info-item">
              <label>Contact</label>
              <input type="text" value="<?= $citizen->mobileNumber ?>" readonly>
            </div>
            <div class="info-item">
              <label>Address</label>
              <input type="text" value="<?= $citizen->address ?>" readonly>
            </div>
          </div>

          <div class="comparison-column">
            <h4>Requested Changes</h4>
            <div class="info-item">
              <img src="<?=ROOT .'/'. $request->image ?>" class="profilepic">
            </div>
            <div class="info-item">
              <label>Civil Status</label>
              <input type="text" value="<?= $request->civil_status ?>" readonly>
            </div>
            <div class="info-item">
              <label>Email</label>
              <input type="text" value="<?= $request->email ?>" readonly>
            </div>
            <div class="info-item">
              <label>Contact</label>
              <input type="text" value="<?= $request->mobileNumber ?>" readonly>
            </div>
            <div class="info-item">
              <label>Address</label>
              <input type="text" value="<?= $request->address ?>" readonly>
            </div>
          </div>

        </div>
        <div class="edit-buttons">
          <button class="btn" onclick="window.location.href='<?=ROOT?>/gn/citizenrequests/handleRequest/<?=$request->editrequest_id?>/accepted'">Accept</button>
          <button class="btn" style="background: red;" onclick="window.location.href='<?=ROOT?>/gn/citizenrequests/handleRequest/<?=$request->editrequest_id?>/rejected'">Reject</button>
        </div>
      </div>

        
    </main>

</body>
</html>
