//Search functionality
document.querySelector('.search').addEventListener('input', (e) => {
    const searchTerm = e.target.value.toLowerCase();
    const cards = document.querySelectorAll('.feedback-card');
    
    cards.forEach(card => {
        const text = card.textContent.toLowerCase();
        card.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});

// Filter positive feedback data
const positiveFeedback = feedbackData.filter(feedback => 
    ['Meets Expectations', 'Above Expectations', 'Exemplary Service'].includes(feedback.Status)
);

// Log positive feedback to verify
console.log(positiveFeedback);

// Type filter
document.getElementById('typeFilter').addEventListener('change', (e) => {
    const filterValue = e.target.value;
    const cards = document.querySelectorAll('.feedback-card');
    
    cards.forEach(card => {
        const type = card.querySelector('.feedback-type').textContent.toLowerCase();
        
        if (filterValue === 'positive') {
            // Show only positive feedback
            const isPositive = card.querySelector('.feedback-type').textContent.includes('Meets Expectations') ||
                                card.querySelector('.feedback-type').textContent.includes('Above Expectations') ||
                                card.querySelector('.feedback-type').textContent.includes('Exemplary Service');
            card.style.display = isPositive ? '' : 'none';
        } else if (filterValue === 'all' || type === filterValue) {
            // Show all or specific type
            card.style.display = '';
        } else {
            // Hide others
            card.style.display = 'none';
        }
    });
});
        

    
// On page load, adjust opacity based on `mark_as_read` status
document.querySelectorAll('.feedback-card').forEach(card => {
    const isMarkedAsRead = card.getAttribute('data-mark-as-read') === 'true';
    if (isMarkedAsRead) {
        card.style.opacity = '0.7'; // Reduce opacity for "read" feedback
    }
});


