<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/agn/RandR.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
<?php $current_page = 'notice'; include '../app/views/agn/partials/navbar.php';?>

<div class="main-content">
<header class="application-header">
            <!-- <h2>Review Applications</h2> -->
            <h2>Rules and Regulations  Records</h2>
            <div class="search-bar">
                <input type="text" placeholder="Search rules and regulations...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <?php include '../app/views/agn/partials/header_icons.php'?>
        </header>

<table class="records-table">
    <thead>
        <tr>
            <th>Rule ID</th>
            <th>Title</th>
           
            <th>Last Updated</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($Ruledata)): ?>
            <?php foreach ($Ruledata as $Rule): ?>
            <tr>
                <td><?= htmlspecialchars($Rule->id)?></td>
                <td><?= htmlspecialchars($Rule->Rule_title)?></td>
                
                <td><?= htmlspecialchars($Rule->last_Updated)?></td>
                <td><?= htmlspecialchars($Rule->status)?></td>
                <td class="action-links">
                    <a href="<?=ROOT?>/agn/Editform/editform/<?=$Rule->id?>" class="edit-btn">Edit</a>
                    <a href="<?= ROOT ?>/agn/RandR/delete/<?=$Rule->id ?>" onclick="return confirm('Are you sure?')" class="delete-btn">Delete</a>
                    <a href="<?=ROOT?>/agn/Viewmore/popup/<?=$Rule->id ?>" class="view-btn">View</a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php else:?>
            <p>No rules Available.</p>
        <?php endif; ?>
    </tbody>
</table>

<button id="showPopupBtn" class="add-new-btn">+ Add New</button>

        
<!--view-->



<!-- Popup Form -->
<div id="addRecordPopup" class="popup">
    <div class="popup-content">
        <span class="close-popup" id="closePopup">&times;</span>
        <form class="popup-form" method="POST" action="<?=ROOT?>/agn/RandR/create" enctype="multipart/form-data">
            <label for="ruleName">Rule Title :</label>
            <input type="text" id="ruleName" name="Rule_title" required>
            
            <label for="ruleDescription">Description:</label>
            <textarea id="ruleDescription" name="Description" required></textarea>

            <label for="ruleDescription">Status:</label>
            <select name="status">
                <option>Active</option>
                <option>Inactive</option>
            </select>
            <label for="fileUpload">Upload PDF: </label>
            <input type="file" id="document" name="document">
            <button type="submit">Save</button>
        </form>
    </div>
</div>
</div>

<script src="<?=ROOT?>/assets/js/agn/RandR.js"></script>
</body>
</html>