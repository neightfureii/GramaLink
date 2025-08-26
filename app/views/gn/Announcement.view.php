<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGN Announcements</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/gn/announcement.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .truncate-cell {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <?php $current_page = 'announcement'; include '../app/views/gn/partials/navbar.php';?>
    
    <div class="main-content">
        <header class="application-header">
            <h2>Notices</h2>
            <?php include '../app/views/gn/partials/header_icons.php'?>
        </header>

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
                                <td><?= date('n/j/Y, g:i:s A', strtotime($announcement->created_at)) ?></td>
                                <td><?= date('n/j/Y, g:i:s A', strtotime($announcement->updated_at)) ?></td>
                                <td><span class="status-badge <?= $announcement->status == 'Active' ? 'active' : 'inactive' ?>"><?= $announcement->status ?></span></td>
                                <td class="action-icons">
                                    <button class="view-btn" 
                                        data-title="<?=htmlspecialchars($announcement->title)?>"
                                        data-description="<?=htmlspecialchars($announcement->description)?>"
                                        data-created="<?=htmlspecialchars($announcement->created_at)?>"
                                        data-updated="<?=htmlspecialchars($announcement->updated_at)?>"
                                        data-status="<?=htmlspecialchars($announcement->status)?>">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button 
                                    onclick="openEdit(this)"
                                    data-title="<?=$announcement->title?>"
                                    data-description="<?=$announcement->description?>"
                                    data-status="<?=$announcement->status?>"
                                    data-id="<?=$announcement->id?>"
                                    data-toggle="announcementedit"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="<?=ROOT?>/gn/Announcement/deleteAnnouncement" method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="<?=$announcement->id?>">
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this announcement?');">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
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
                <div class="insert-new-wrapper">
                    <button class="insert-btn" onclick="openModal('announcementModalOverlay')">
                        <i class="fas fa-plus"></i> Insert New
                    </button>
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
                                    <button class="view-btn" 
                                        data-title="<?=htmlspecialchars($rule->title)?>"
                                        data-description="<?=htmlspecialchars($rule->description)?>"
                                        data-created="<?=htmlspecialchars($rule->created_at)?>"
                                        data-updated="<?=htmlspecialchars($rule->updated_at)?>"
                                        data-status="<?=htmlspecialchars($rule->status)?>">
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
                                    <button class="view-btn" 
                                        data-title="<?=htmlspecialchars($community_service->title)?>"
                                        data-description="<?=htmlspecialchars($community_service->description)?>"
                                        data-created="<?=htmlspecialchars($community_service->created_at)?>"
                                        data-updated="<?=htmlspecialchars($community_service->updated_at)?>"
                                        data-status="<?=htmlspecialchars($community_service->status)?>">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button
                                    onclick="openEditCommunity(this)"
                                    data-title="<?=$community_service->title?>"
                                    data-description="<?=$community_service->description?>"
                                    data-status="<?=$community_service->status?>"
                                    data-id="<?=$community_service->id?>"
                                    data-toggle="communityEditModal"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="<?=ROOT?>/gn/Announcement/deleteCommunityService" method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="<?=$community_service->id?>">
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this community service?');">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
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
                <div class="insert-new-wrapper">
                    <button class="insert-btn" onclick="openModal('communityModalOverlay')">
                        <i class="fas fa-plus"></i> Insert New
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Announcement Modal Form -->
    <div class="modal-overlay" id="announcementModalOverlay" style="display:none;">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal('announcementModalOverlay')">&times;</span>
            <div class="modal-body">
                <h2>Add New Announcement</h2>
                <form id="announcementForm" action="<?=ROOT?>/gn/Announcement/insertAnnouncement" method="POST">
                    <label>Announcement Title</label>
                    <input type="text" name="title" required>
                    <label>Description</label>
                    <textarea name="description" required></textarea>
                    <label>Status</label>
                    <select name="status">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <button type="submit" class="insert-btn">Save Announcement</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Community Service Modal Form -->
    <div class="modal-overlay" id="communityModalOverlay" style="display:none;">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal('communityModalOverlay')">&times;</span>
            <div class="modal-body">
                <h2>Add New Announcement</h2>
                <form id="communityForm" action="<?=ROOT?>/gn/Announcement/insertCommunityService" method="POST">
                    <label>Announcement Title</label>
                    <input type="text" name="title" required>
                    <label>Description</label>
                    <textarea name="description" required></textarea>
                    <label>Status</label>
                    <select name="status">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <button type="submit" class="insert-btn">Save Service</button>
                </form>
            </div>
        </div>
    </div>

    <!-- <div class="modal-overlay" id="communityModalOverlay" style="display:none;">
        <div class="modal-content"></div>
            <span class="modal-close" onclick="closeModal('communityModalOverlay')">&times;</span>
            <div class="modal-body">
                <h2>Add New Community Service</h2>
                <form id="communityForm" action="<?=ROOT?>/gn/Announcement/insertCommunityService" method="POST"> 
                    <label>Service Title</label>
                    <input type="text" name="title" required>
                    <label>Description</label>
                    <textarea name="description" required></textarea>
                    <label>Status</label>
                    <select name="status">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <button type="submit" class="insert-btn">Save Service</button>
                </form>
            </div>
        </div>
    </div> -->


    <!-- edit announcement modal -->
    <div class="modal-overlay" id="announcementedit" style="display:none;">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal('announcementedit')">&times;</span>
            <div class="modal-body">
                <h2>Edit Announcement</h2>
                <form id="announcementeditform" action="<?=ROOT?>/gn/Announcement/editAnnouncement" method="POST">
                    <input type="hidden" name="id" id="announcementid">
                    <label>Announcement Title</label>
                    <input type="text" name="title" id="announcementtitle" required>
                    <label>Description</label>
                    <textarea name="description" id="announcementdesc" required></textarea>
                    <label>Status</label>
                    <select name="status" id="announcementstatus">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <button type="submit" class="insert-btn">Save Announcement</button>
                </form>
            </div>
        </div>
    </div>

     <!-- edit community Service modal -->
     <div class="modal-overlay" id="communityserviceedit" style="display:none;">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal('communityserviceedit')">&times;</span>
            <div class="modal-body">
                <h2>Edit Community Service</h2>
                <form id="communityserviceeditform" action="<?=ROOT?>/gn/Announcement/editcommunityservice" method="POST">
                    <input type="hidden" name="id" id="communityserviceid">
                    <label>Announcement Title</label>
                    <input type="text" name="title" id="communityservicetitle" required>
                    <label>Description</label>
                    <textarea name="description" id="communityservicedesc" required></textarea>
                    <label>Status</label>
                    <select name="status" id="communityservicestatus">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <button type="submit" class="insert-btn">Save Announcement</button>
                </form>
            </div>
        </div>
    </div>

    <!-- View Announcement Modal -->
    <div class="modal-overlay" id="announcementViewModal" style="display:none;">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal('announcementViewModal')">&times;</span>
            <div class="modal-body" id="announcementViewModalBody">
                <!-- Content will be injected by JS -->
            </div>
        </div>
    </div>

    <!-- View Rule Modal -->
    <div class="modal-overlay" id="ruleViewModal" style="display:none;">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal('ruleViewModal')">&times;</span>
            <div class="modal-body" id="ruleViewModalBody">
                <!-- Content will be injected by JS -->
            </div>
        </div>
    </div>

    <!-- View Community Service Modal -->
    <div class="modal-overlay" id="communityServiceViewModal" style="display:none;">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal('communityServiceViewModal')">&times;</span>
            <div class="modal-body" id="communityServiceViewModalBody">
                <!-- Content will be injected by JS -->
            </div>
        </div>
    </div>

</body>
<script src="<?=ROOT?>/assets/js/gn/announcement.js"></script>
</html>