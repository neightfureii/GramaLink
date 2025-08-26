document.addEventListener('DOMContentLoaded', function() {
    // Add New Popup
    const showPopupBtn = document.getElementById('showPopupBtn');
    const popup = document.getElementById('addRecordPopup');
    const closePopup = document.getElementById('closePopup');

    showPopupBtn.addEventListener('click', function() {
        popup.style.display = 'flex';
    });

    closePopup.addEventListener('click', function() {
        popup.style.display = 'none';
    });

    popup.addEventListener('click', function(event) {
        if (event.target === popup) {
            popup.style.display = 'none';
        }
    });

    // View Record Popup
    const viewPopup = document.getElementById('viewRecordPopup');
    const closeViewPopup = document.getElementById('closeViewPopup');

    console.log('ROOT value:', ROOT);
async function fetchRuleData(ruleId) {
    console.log('Fetching rule with ID:', ruleId);
    try {
        const url = `${ROOT}/agn/RandR/where/${ruleId}`;
        console.log('Fetch URL:', url);
        
        const response = await fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        if (!response.ok) {
            const errorText = await response.text();
            console.error('Response error:', errorText);
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        console.log('Received data:', data);

        // Populate popup
        document.getElementById('viewRuleName').value = data[0].Rule_title;
        document.getElementById('viewRuleDescription').value = data[0].Description;
        document.getElementById('viewRuleStatus').value = data[0].status;

        viewPopup.style.display = 'flex';
    } catch (error) {
        console.error('Fetch error:', error);
        alert('Failed to fetch rule details: ' + error.message);
    }
}

    // Event delegation: Listen for clicks on any .view-btn
    document.addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('view-btn')) {
            const ruleId = event.target.getAttribute('data-id');
            fetchRuleData(ruleId);
        }
    });

    closeViewPopup.addEventListener('click', function() {
        viewPopup.style.display = 'none';
    });

    viewPopup.addEventListener('click', function(event) {
        if (event.target === viewPopup) {
            viewPopup.style.display = 'none';
        }
    });
});

document.getElementById("showPopupBtn").addEventListener("click", function () {
    document.getElementById("addRecordPopup").style.display = "block";
});

document.getElementById("closePopup").addEventListener("click", function () {
    document.getElementById("addRecordPopup").style.display = "none";
});