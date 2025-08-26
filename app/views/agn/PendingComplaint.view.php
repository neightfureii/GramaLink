<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Complaints</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            padding: 30px;
            line-height: 1.6;
        }
        
        .page-header {
            margin-bottom: 30px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 15px;
        }
        
        .page-header h1 {
            font-size: 28px;
            font-weight: 600;
            color: #2d3748;
        }
        
        .gn-division {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            overflow: hidden;
        }
        
        .gn-division-header {
            background-color: #4299e1;
            color: white;
            padding: 15px 20px;
            font-size: 18px;
            font-weight: 500;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .gn-division-header h2 {
            font-size: 18px;
            font-weight: 500;
            margin: 0;
        }
        
        .complaint-count {
            background-color: white;
            color: #4299e1;
            border-radius: 20px;
            padding: 2px 12px;
            font-size: 14px;
            font-weight: bold;
        }
        
        .complaints-list {
            list-style-type: none;
            padding: 0;
        }
        
        .complaint-item {
            padding: 20px;
            border-bottom: 1px solid #edf2f7;
            position: relative;
        }
        
        .complaint-item:last-child {
            border-bottom: none;
        }
        
        .complaint-item:hover {
            background-color: #f8fafc;
        }
        
        .complaint-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
        }
        
        .complaint-id {
            font-weight: 600;
            color: #4a5568;
            font-size: 16px;
        }
        
        .complaint-date {
            color: #718096;
            font-size: 14px;
        }
        
        .complaint-meta {
            display: flex;
            margin-bottom: 10px;
            align-items: center;
        }
        
        .citizen-info {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }
        
        .citizen-avatar {
            width: 32px;
            height: 32px;
            background-color: #e2e8f0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: 500;
            color: #4a5568;
        }
        
        .citizen-name {
            font-weight: 500;
            color: #2d3748;
        }
        
        .complaint-description {
            background-color: #f7fafc;
            padding: 15px;
            border-radius: 6px;
            color: #4a5568;
            margin-top: 5px;
            border-left: 3px solid #4299e1;
        }
        
        .status-badge {
            background-color: #feebc8;
            color: #c05621;
            padding: 3px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 0;
            color: #718096;
        }
        
        .empty-state p {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .toggle-image,
        .toggle-desc {
            margin-top: 8px;
            display: inline-block;
            color: #4299e1;
            text-decoration: underline;
            cursor: pointer;
        }
        .complaint-images {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .complaint-image {
            flex: 0 0 calc(27.333% - 7px); /* 3 per row with gap */
            box-sizing: border-box;
            margin-top: 10px;
            position: relative; /* required for absolutely positioning "view less" inside */
            padding-bottom: 30px; /* ensure enough space */
        }
        .complaint-image img {
            width: 300px;
            height: 150px; /* or whatever fixed height you want */
            object-fit: cover; /* makes the image fill the space nicely */
            border-radius: 6px;
            display: block;
        }   
        .view-less-image {
        position: absolute;
        bottom: 0;
        right: 0;
        text-decoration: underline;
        color: #4299e1;
        background: white;
        padding: 4px 6px;
        font-size: 14px;
        display: none;
    }

        
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }
            
            .complaint-header {
                flex-direction: column;
            }
            
            .complaint-date {
                margin-top: 5px;
            }
            
            .complaint-meta {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .citizen-info {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Pending Complaints by GN Division</h1>
    </div>
       

    <?php if (!empty($groupedComplaints)): ?>
        <?php foreach ($groupedComplaints as $group): ?>
            <div class="gn-division">
                <div class="gn-division-header">
                    <h2>Handle By : -<?= htmlspecialchars($group['gn_name']) ?></h2>
                    <span class="complaint-count"><?= count($group['complaints']) ?> complaints</span>
                </div>
                <ul class="complaints-list">
                    <?php foreach ($group['complaints'] as $item): ?>
                        <?php $complaint = $item['complaint']; ?>
                        <li class="complaint-item">
                            <div class="complaint-header">
                                <div class="complaint-id">Complaint #<?= htmlspecialchars($complaint->complaint_id) ?></div>
                                <div class="complaint-date"> created at : <?= htmlspecialchars($complaint->date) ?></div>
                            </div>
                            <div class="complaint-meta">
                                <div class="citizen-info">
                                    <div class="citizen-avatar">
                                        <?= strtoupper(substr(htmlspecialchars($complaint->citizen_name), 0, 1)) ?>
                                    </div>
                                    <div class="citizen-name"><?= htmlspecialchars($complaint->citizen_name) ?></div>
                                </div>
                                <span class="status-badge">Pending</span>
                            </div>
        <?php
        $maxLength = 100;
        $desc = htmlspecialchars($complaint->complaint_description);
        $isLong = strlen($desc) > $maxLength;
        $shortDesc = $isLong ? substr($desc, 0, $maxLength) . '...' : $desc;
        $formattedDesc = nl2br(wordwrap($desc, 150, "\n", true));
        ?>
<div class="complaint-description">
    <?php if ($isLong): ?>
        <span class="desc-short"><?= $shortDesc ?></span>
        <span class="desc-full" style="display:none;"><?= $formattedDesc ?></span>
        <a href="#" class="toggle-desc" onclick="toggleDesc(this); return false;">Show more</a>
       <div class="complaint-images">

           <?php foreach ($item['images'] as $index => $image): ?>
               <div class="complaint-image" style=" <?= $index === 0 ? '': 'display:none;'?> ">
               
                   <img src="<?= ROOT. '/' . htmlspecialchars($image->image_path) ?>" alt="Complaint Image">
               </div>
               <?php endforeach; ?>
               <?php if (count($item['images']) > 1): ?>
                    <a href="#" class="toggle-image" onclick="toggleImages(this); return false;" style="color: #4299e1; text-decoration: underline; margin-top: 10px; display: inline-block;">view more images</a>
                    <a href="#" class="view-less-image" onclick="toggleImages(this); return false;" style="display: none; position: absolute; bottom: 10px; right: 10px; color: #4299e1; text-decoration: underline;">view less images</a>
                <?php endif; ?>

             </div>
        
    <?php else: ?>
        <span><?= nl2br(wordwrap($desc, 50, "\n", true)) ?></span>
        
        <div class="complaint-images">

<?php foreach ($item['images'] as $index => $image): ?>
    <div class="complaint-image" style=" <?= $index === 0 ? '': 'display:none;'?> ">
    
        <img src="<?= ROOT. '/' . htmlspecialchars($image->image_path) ?>" alt="Complaint Image" >
    </div>
    <?php endforeach; ?>
    <?php if (count($item['images']) > 1): ?>
        <a href="#" class="toggle-image" onclick="toggleImages(this); return false;" style="color: #4299e1; text-decoration: underline; margin-top: 10px; display: inline-block;">view more images</a>
    <?php endif; ?>
</div>
      
        
    <?php endif; ?>
</div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="empty-state">
            <p>No pending complaints found.</p>
        </div>
    <?php endif; ?>

    <script>
function toggleDesc(link) {
    const container = link.closest('.complaint-description');
    const shortDesc = container.querySelector('.desc-short');
    const fullDesc = container.querySelector('.desc-full');
    
    if (shortDesc.style.display === 'none') {
        shortDesc.style.display = '';
        fullDesc.style.display = 'none';
        link.textContent = 'Show more';
    } else {
        shortDesc.style.display = 'none';
        fullDesc.style.display = '';
        link.textContent = 'Show less';
    }
}

function toggleImages(link) {
    const container = link.closest('.complaint-description').querySelector('.complaint-images');
    const allImages = container.querySelectorAll('.complaint-image');
    const viewMore = container.parentElement.querySelector('.toggle-image');
    const viewLess = container.parentElement.querySelector('.view-less-image');

    const isCollapsed = allImages[1].style.display === 'none'; // assumes at least 2 images

    for (let i = 1; i < allImages.length; i++) {
        allImages[i].style.display = isCollapsed ? '' : 'none';
    }

    viewMore.style.display = isCollapsed ? 'none' : 'inline-block';
    viewLess.style.display = isCollapsed ? 'inline-block' : 'none';
}

</script>
</body>
</html>
