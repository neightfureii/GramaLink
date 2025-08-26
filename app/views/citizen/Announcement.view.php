<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements</title>

    <!-- Iconscout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <!-- Montserrat Font(Google fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?=ROOT?>/assets/css/citizen/announcement.css"> 
    <style>
        /* Add this style for truncating long text in table cells */
        .truncate-cell {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <?php include '../app/views/citizen/partials/navbar.php'; ?>

    <!-- Breadcrumb Section -->
    <div class="container breadcrumb">
        <p><a href="home" class="crumb">Home</a> > <a href="application" class="crumb">Announcements</a></p>
    </div>

    <div class="container wrapper">

        <div class="main-sections-wrapper">
            <div class="tab-buttons-container">
                <button id="announcementBtn" class="tab-btn active">Announcement</button>
                <button id="rulesBtn" class="tab-btn">Rule & Regulation</button>
                <button id="communityBtn" class="tab-btn">Community Service</button>
            </div>
         
            <div class="announcement-container" style="display:block;">
                <div class="announcement-header">
                    <h2>Announcements</h2>
                </div>
                
                <div class="announcement-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Announcement ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Created</th>
                                <th>Last Updated</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($announcements)): ?>
                            <?php foreach ($announcements as $announcement): ?>
                            <tr>
                                <td><?=$announcement->id?></td>
                                <td><?=$announcement->title?></td>
                                <td class="truncate-cell" title="<?=htmlspecialchars($announcement->description)?>"><?=$announcement->description?></td>
                                <td><?= $announcement->created_at ? date('n/j/Y, g:i:s A', strtotime($announcement->created_at)) : 'Not yet created' ?></td>
                                <td><?= $announcement->updated_at ? date('n/j/Y, g:i:s A', strtotime($announcement->updated_at)) : 'Not yet updated' ?></td>
                                <td><span class="status-badge <?= $announcement->status == 'Active' ? 'active' : 'inactive' ?>"><?= $announcement->status ?></span></td>
                                <td class="action-icons ">
                                    <button class="view-btn">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="7" class="no-data">No announcements available.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="rules-container" style="display:none;">
                <div class="rules-header">
                    <h2>Rules & Regulations</h2>
                </div>
                
                <div class="rules-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Rule ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Created</th>
                                <th>Last Updated</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($rules)): ?>
                            <?php foreach ($rules as $rule): ?>
                            <tr>
                                <td><?=$rule->id?></td>
                                <td><?=$rule->title?></td>
                                <td class="truncate-cell"><?=$rule->description?></td>
                                <td><?= $rule->created_at ? date('n/j/Y, g:i:s A', strtotime($rule->created_at)) : 'Not yet created' ?></td>
                                <td><?= $rule->updated_at ? date('n/j/Y, g:i:s A', strtotime($rule->updated_at)) : 'Not yet updated' ?></td>
                                <td><span class="status-badge <?= $rule->status == 'Active' ? 'active' : 'inactive' ?>"><?= $rule->status ?></span></td>
                                <td class="action-icons">
                                    <button class="view-btn">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="7" class="no-data">No rules available.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="communityservice-container" style="display:none;">
                <div class="communityservice-header">
                    <h2>Community Services</h2>
                </div>
                
                <div class="communityservice-table">
                    <table>
                        <thead>
                            <tr>
                                <th>CommunityService ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Created</th>
                                <th>Last Updated</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($community_services)): ?>
                            <?php foreach ($community_services as $community_service): ?>
                            <tr>
                                <td><?=$community_service->id?></td>
                                <td><?=$community_service->title?></td>
                                <td class="truncate-cell"><?=$community_service->description?></td>
                                <td><?= $community_service->created_at ? date('n/j/Y, g:i:s A', strtotime($community_service->created_at)) : 'Not yet created' ?></td>
                                <td><?= $community_service->updated_at ? date('n/j/Y, g:i:s A', strtotime($community_service->updated_at)) : 'Not yet updated' ?></td>
                                <td><span class="status-badge <?= $community_service->status == 'Active' ? 'active' : 'inactive' ?>"><?= $community_service->status ?></span></td>
                                <td class="action-icons">
                                    <button class="view-btn">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="7" class="no-data">No community services available.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- View Announcement Modal -->
    <div class="modal-overlay" id="announcementModalOverlay" style="display:none;">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal('announcementModalOverlay')">&times;</span>
            <div class="modal-body" id="announcementModalBody">
                <!-- Content will be injected by JS -->
            </div>
        </div>
    </div>

    <!-- View Rules Modal -->
    <div class="modal-overlay" id="rulesModalOverlay" style="display:none;">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal('rulesModalOverlay')">&times;</span>
            <div class="modal-body" id="rulesModalBody">
                <!-- Content will be injected by JS -->
            </div>
        </div>
    </div>

    <!-- View Community Service Modal -->
    <div class="modal-overlay" id="communityModalOverlay" style="display:none;">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal('communityModalOverlay')">&times;</span>
            <div class="modal-body" id="communityModalBody">
                <!-- Content will be injected by JS -->
            </div>
        </div>
    </div>
    <?php include '../app/views/citizen/partials/footer.php'; ?>

</body>
<script src="<?=ROOT?>/assets/js/citizen/announcement.js"></script>
</html>