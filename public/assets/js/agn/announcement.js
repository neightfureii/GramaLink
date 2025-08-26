function openModal(modalId) {
    document.getElementById(modalId).style.display = 'flex';
}
function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

//tab switching
document.addEventListener('DOMContentLoaded', () => {
    const tabs = [
        { btn: 'announcementBtn', content: 'announcement-container' },
        { btn: 'rulesBtn', content: 'rules-container' },
        { btn: 'communityBtn', content: 'communityservice-container' }
    ];

    tabs.forEach(({ btn, content }) => {
        document.getElementById(btn).addEventListener('click', () => {
            tabs.forEach(({ btn: b, content: c }) => {
                document.querySelector('.' + c).style.display = (c === content) ? 'block' : 'none';
                document.getElementById(b).classList.toggle('active', b === btn);
            });
        });
    });
});

function openEdit(data) {
    document.getElementById('announcementid').value = data.dataset.id;
    document.getElementById('announcementtitle').value = data.dataset.title;
    document.getElementById('announcementdesc').value = data.dataset.description;
    document.getElementById('announcementstatus').value = data.dataset.status;

    openModal('announcementedit');
}

function openEditRules(data) {

    document.getElementById('ruleid').value = data.dataset.id;
    document.getElementById('ruletitle').value = data.dataset.title;
    document.getElementById('ruledesc').value = data.dataset.description;
    document.getElementById('rulestatus').value = data.dataset.status;

    openModal('ruleedit');
}

function openEditCommunity(data) {
    document.getElementById('communityserviceid').value = data.dataset.id;
    document.getElementById('communityservicetitle').value = data.dataset.title;
    document.getElementById('communityservicedesc').value = data.dataset.description;
    document.getElementById('communityservicestatus').value = data.dataset.status;

    openModal('communityserviceedit');
}

// Templates for view modals (same as citizen)
function getAnnouncementView(data = {}) {
    return `
        <h2>View Announcement</h2>
        <form>
            <label>Announcement Title</label>
            <input type="text" value="${data.title || ''}" readonly>
            <label>Description</label>
            <textarea readonly>${data.description || ''}</textarea>
            <label>Status</label>
            <input type="text" value="${data.status || ''}" readonly>
        </form>
    `;
}
function getRuleView(data = {}) {
    return `
        <h2>View Rule</h2>
        <form>
            <label>Rule Title</label>
            <input type="text" value="${data.title || ''}" readonly>
            <label>Description</label>
            <textarea readonly>${data.description || ''}" readonly>
            <label>Status</label>
            <input type="text" value="${data.status || ''}" readonly>
        </form>
    `;
}
function getCommunityView(data = {}) {
    return `
        <h2>View Community Service</h2>
        <form>
            <label>Service Title</label>
            <input type="text" value="${data.title || ''}" readonly>
            <label>Description</label>
            <textarea readonly>${data.description || ''}</textarea>
            <label>Status</label>
            <input type="text" value="${data.status || ''}" readonly>
        </form>
    `;
}

// Announcement view button
document.querySelectorAll('.announcement-container .view-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('announcementViewModalBody').innerHTML = getAnnouncementView({
            title: btn.dataset.title,
            description: btn.dataset.description,
            status: btn.dataset.status
        });
        openModal('announcementViewModal');
    });
});

// Rule view button
document.querySelectorAll('.rules-container .view-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('ruleViewModalBody').innerHTML = getRuleView({
            title: btn.dataset.title,
            description: btn.dataset.description,
            status: btn.dataset.status
        });
        openModal('ruleViewModal');
    });
});

// Community Service view button
document.querySelectorAll('.communityservice-container .view-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('communityServiceViewModalBody').innerHTML = getCommunityView({
            title: btn.dataset.title,
            description: btn.dataset.description,
            status: btn.dataset.status
        });
        openModal('communityServiceViewModal');
    });
});

// Allow closing modals by clicking overlay
document.querySelectorAll('.modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) overlay.style.display = 'none';
    });
});