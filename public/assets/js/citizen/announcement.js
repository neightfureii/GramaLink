// Helper functions for modals
function openModal(modalId) {
    document.getElementById(modalId).style.display = 'flex';
}
function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

// Templates for forms (view/add)
function getAnnouncementForm(data = {}) {
    return `
        <h2>${data.title ? 'View Announcement' : 'Add New Announcement'}</h2>
        <form>
            <label>Announcement Title</label>
            <input type="text" name="title" value="${data.title || ''}" readonly>
            <label>Description</label>
            <textarea name="description" readonly>${data.description || ''}</textarea>
            <label>Status</label>
            <input type="text" name="status" value="${data.status || ''}" readonly>
        </form>
    `;
}
function getRulesForm(data = {}) {
    return `
        <h2>${data.title ? 'View Rule' : 'Add New Rule'}</h2>
        <form>
            <label>Rule Title</label>
            <input type="text" name="title" value="${data.title || ''}" readonly>
            <label>Description</label>
            <textarea name="description" readonly>${data.description || ''}</textarea>
            <label>Status</label>
            <input type="text" name="status" value="${data.status || ''}" readonly>
        </form>
    `;
}
function getCommunityForm(data = {}) {
    return `
        <h2>${data.title ? 'View Community Service' : 'Add New Community Service'}</h2>
        <form>
            <label>Service Title</label>
            <input type="text" name="title" value="${data.title || ''}" readonly>
            <label>Description</label>
            <textarea name="description" readonly>${data.description || ''}</textarea>
            <label>Status</label>
            <input type="text" name="status" value="${data.status || ''}" readonly>
        </form>
    `;
}

// Tab switching (run directly since script is at end of body)
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

// View logic for all three tables (use .view-btn)
document.querySelectorAll('.announcement-container .view-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const row = btn.closest('tr');
        document.getElementById('announcementModalBody').innerHTML = getAnnouncementForm({
            title: row.children[1].textContent,
            description: row.children[2].textContent,
            status: row.children[5].innerText.trim()
        });
        openModal('announcementModalOverlay');
    });
});
document.querySelectorAll('.rules-container .view-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const row = btn.closest('tr');
        document.getElementById('rulesModalBody').innerHTML = getRulesForm({
            title: row.children[1].textContent,
            description: row.children[2].textContent,
            status: row.children[5].innerText.trim()
        });
        openModal('rulesModalOverlay');
    });
});
document.querySelectorAll('.communityservice-container .view-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const row = btn.closest('tr');
        document.getElementById('communityModalBody').innerHTML = getCommunityForm({
            title: row.children[1].textContent,
            description: row.children[2].textContent,
            status: row.children[5].innerText.trim()
        });
        openModal('communityModalOverlay');
    });
});

// Allow closing modals by clicking overlay (optional)
document.querySelectorAll('.modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) overlay.style.display = 'none';
    });
});