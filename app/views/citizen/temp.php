<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GN Appointment Booking</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --background-color: #f8fafc;
            --text-color: #1e293b;
            --border-color: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .booking-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .booking-header h1 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .booking-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            padding: 1rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .step {
            text-align: center;
            flex: 1;
            padding: 1rem;
        }

        .step.active {
            color: var(--primary-color);
            font-weight: bold;
        }

        .booking-grid {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .calendar-section {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .calendar {
            width: 100%;
            border-collapse: collapse;
        }

        .calendar th, .calendar td {
            padding: 0.5rem;
            text-align: center;
            border: 1px solid var(--border-color);
        }

        .calendar td.available {
            background-color: #dcfce7;
            cursor: pointer;
        }

        .calendar td.unavailable {
            background-color: #fee2e2;
            color: #999;
        }

        .time-slots {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .slot-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .time-slot {
            padding: 0.75rem;
            text-align: center;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .time-slot.available {
            background-color: #dcfce7;
        }

        .time-slot.available:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .time-slot.unavailable {
            background-color: #fee2e2;
            cursor: not-allowed;
        }

        .service-selection {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-top: 2rem;
        }

        .service-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .service-card {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .service-card:hover {
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .service-card i {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        /* Previous styles remain the same until booking-summary */
        
        .booking-summary {
            background: white;
            padding: 1rem;
            border-radius: 8px 8px 0 0;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            transform: translateY(100%);
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 999;
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .booking-summary.active {
            transform: translateY(0);
        }

        .confirm-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
            margin-top: 1rem;
        }

        .confirm-btn:hover {
            background-color: var(--secondary-color);
        }

        .slot-count {
            background: var(--primary-color);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.875rem;
            margin-left: 0.5rem;
        }

        @media (max-width: 768px) {
            .booking-grid {
                grid-template-columns: 1fr;
            }
        }

        .selected {
            background-color: var(--primary-color) !important;
            color: white !important;
            border-color: var(--primary-color) !important;
        }

        .close-modal {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            color: #666;
        }

        .close-modal:hover {
            color: #000;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="booking-header">
            <h1>Book Your Appointment</h1>
            <p>Schedule a meeting with your Grama Niladhari</p>
        </div>

        <div class="booking-steps">
            <div class="step active">
                <i class="fas fa-calendar"></i>
                <p>Select Date</p>
            </div>
            <div class="step">
                <i class="fas fa-clock"></i>
                <p>Choose Time</p>
            </div>
            <div class="step">
                <i class="fas fa-list"></i>
                <p>Select Service</p>
            </div>
            <div class="step">
                <i class="fas fa-check-circle"></i>
                <p>Confirm</p>
            </div>
        </div>

        <div class="booking-grid">
            <div class="calendar-section">
                <h3>Select Date</h3>
                <table class="calendar">
                    <thead>
                        <tr>
                            <th colspan="7">February 2025</th>
                        </tr>
                        <tr>
                            <th>Su</th>
                            <th>Mo</th>
                            <th>Tu</th>
                            <th>We</th>
                            <th>Th</th>
                            <th>Fr</th>
                            <th>Sa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="unavailable">28</td>
                            <td class="unavailable">29</td>
                            <td class="available">30</td>
                            <td class="unavailable">31</td>
                            <td class="available">1</td>
                            <td class="unavailable">2</td>
                            <td class="available">3</td>
                        </tr>
                        <!-- Additional calendar rows would be dynamically generated -->
                    </tbody>
                </table>
                <div class="calendar-legend" style="margin-top: 1rem; font-size: 0.875rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                        <div style="width: 16px; height: 16px; background: #dcfce7; border-radius: 4px;"></div>
                        <span>Available</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 16px; height: 16px; background: #fee2e2; border-radius: 4px;"></div>
                        <span>Unavailable</span>
                    </div>
                </div>
            </div>

            <div class="time-slots">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h3>Available Time Slots</h3>
                    <span class="slot-count">12 slots available</span>
                </div>
                <div class="slot-grid">
                    <div class="time-slot available">9:00 AM</div>
                    <div class="time-slot available">9:15 AM</div>
                    <div class="time-slot unavailable">9:30 AM</div>
                    <div class="time-slot available">9:45 AM</div>
                    <div class="time-slot available">10:00 AM</div>
                    <div class="time-slot unavailable">10:15 AM</div>
                    <div class="time-slot available">10:30 AM</div>
                    <div class="time-slot available">10:45 AM</div>
                    <div class="time-slot available">11:00 AM</div>
                    <div class="time-slot unavailable">11:15 AM</div>
                    <div class="time-slot available">11:30 AM</div>
                    <div class="time-slot available">11:45 AM</div>
                    <div class="time-slot available">12:00 PM</div>
                    <div class="time-slot available">12:15 PM</div>
                </div>
            </div>
        </div>

        <div class="service-selection">
            <h3>Select Service</h3>
            <div class="service-grid">
                <div class="service-card">
                    <i class="fas fa-home"></i>
                    <h4>Address Verification</h4>
                    <p>Verify your current residential address</p>
                    <small>Required documents: NIC, Utility bills</small>
                </div>
                <div class="service-card">
                    <i class="fas fa-certificate"></i>
                    <h4>Character Certificate</h4>
                    <p>Request a character certificate</p>
                    <small>Required documents: NIC, Police report</small>
                </div>
                <div class="service-card">
                    <i class="fas fa-file-alt"></i>
                    <h4>Death Certificate</h4>
                    <p>Apply for a death certificate</p>
                    <small>Required documents: Hospital documents</small>
                </div>
                <div class="service-card">
                    <i class="fas fa-map-marked-alt"></i>
                    <h4>Land Matters</h4>
                    <p>Discuss land-related issues</p>
                    <small>Required documents: Land deed, Survey plan</small>
                </div>
            </div>
        </div>

        <div class="overlay"></div>
    <div class="booking-summary">
        <button class="close-modal">
            <i class="fas fa-times"></i>
        </button>
        <div style="display: flex; justify-content: space-between; align-items: start;">
            <div>
                <h3>Booking Summary</h3>
                <p id="selected-date">Date: Not selected</p>
                <p id="selected-time">Time: Not selected</p>
                <p id="selected-service">Service: Not selected</p>
            </div>
            <div style="text-align: right;">
                <p><strong>Reference: #APT2025021801</strong></p>
                <p>Duration: 15 minutes</p>
            </div>
        </div>
        <button class="confirm-btn">Confirm Appointment</button>
    </div>

    <script>
        // Get DOM elements
        const timeSlots = document.querySelectorAll('.time-slot.available');
        const serviceCards = document.querySelectorAll('.service-card');
        const bookingSummary = document.querySelector('.booking-summary');
        const overlay = document.querySelector('.overlay');
        const closeModalBtn = document.querySelector('.close-modal');
        const selectedDate = document.getElementById('selected-date');
        const selectedTime = document.getElementById('selected-time');
        const selectedService = document.getElementById('selected-service');

        // Booking state
        let bookingState = {
            date: null,
            time: null,
            service: null
        };

        // Time slot selection
        timeSlots.forEach(slot => {
            slot.addEventListener('click', () => {
                timeSlots.forEach(s => s.classList.remove('selected'));
                slot.classList.add('selected');
                bookingState.time = slot.textContent;
                selectedTime.textContent = `Time: ${slot.textContent}`;
                updateBookingSummary();
            });
        });

        // Service card selection
        serviceCards.forEach(card => {
            card.addEventListener('click', () => {
                serviceCards.forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');
                bookingState.service = card.querySelector('h4').textContent;
                selectedService.textContent = `Service: ${card.querySelector('h4').textContent}`;
                updateBookingSummary();
            });
        });

        // Calendar date selection (example)
        document.querySelectorAll('.calendar td.available').forEach(date => {
            date.addEventListener('click', () => {
                document.querySelectorAll('.calendar td').forEach(d => d.classList.remove('selected'));
                date.classList.add('selected');
                bookingState.date = `February ${date.textContent}, 2025`;
                selectedDate.textContent = `Date: February ${date.textContent}, 2025`;
                updateBookingSummary();
            });
        });

        // Update booking summary and show modal
        function updateBookingSummary() {
            if (bookingState.date && bookingState.time && bookingState.service) {
                bookingSummary.classList.add('active');
                overlay.classList.add('active');
            }
        }

        // Close modal
        function closeModal() {
            bookingSummary.classList.remove('active');
            overlay.classList.remove('active');
        }

        closeModalBtn.addEventListener('click', closeModal);
        overlay.addEventListener('click', closeModal);

        // Confirm button
        document.querySelector('.confirm-btn').addEventListener('click', () => {
            if (bookingState.date && bookingState.time && bookingState.service) {
                alert('Appointment confirmed!'); // Replace with your confirmation logic
                closeModal();
            } else {
                alert('Please select all required fields');
            }
        });
    </script>
    <script>
        class Calendar {
            constructor() {
                this.currentDate = new Date();
                this.selectedDate = null;
                this.calendarBody = document.querySelector('.calendar tbody');
                this.calendarHeader = document.querySelector('.calendar th[colspan="7"]');
                this.initializeCalendar();
                this.addNavigationButtons();
            }

            addNavigationButtons() {
                const header = document.querySelector('.calendar thead tr:first-child th');
                header.style.position = 'relative';
                
                // Create navigation buttons container
                const navContainer = document.createElement('div');
                navContainer.style.position = 'absolute';
                navContainer.style.right = '10px';
                navContainer.style.top = '50%';
                navContainer.style.transform = 'translateY(-50%)';
                navContainer.style.display = 'flex';
                navContainer.style.gap = '10px';

                // Previous month button
                const prevBtn = document.createElement('button');
                prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
                prevBtn.style.border = 'none';
                prevBtn.style.background = 'none';
                prevBtn.style.cursor = 'pointer';
                prevBtn.style.padding = '5px';
                prevBtn.addEventListener('click', () => this.previousMonth());

                // Next month button
                const nextBtn = document.createElement('button');
                nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
                nextBtn.style.border = 'none';
                nextBtn.style.background = 'none';
                nextBtn.style.cursor = 'pointer';
                nextBtn.style.padding = '5px';
                nextBtn.addEventListener('click', () => this.nextMonth());

                navContainer.appendChild(prevBtn);
                navContainer.appendChild(nextBtn);
                header.appendChild(navContainer);
            }

            initializeCalendar() {
                this.renderCalendar();
                this.attachEventListeners();
            }

            isAvailableDay(date) {
                const day = date.getDay();
                // 2 = Tuesday, 4 = Thursday, 6 = Saturday
                return day === 2 || day === 4 || day === 6;
            }

            isPastDate(date) {
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                return date < today;
            }

            renderCalendar() {
                const year = this.currentDate.getFullYear();
                const month = this.currentDate.getMonth();

                // Update header
                const monthName = new Date(year, month).toLocaleString('default', { month: 'long' });
                this.calendarHeader.textContent = `${monthName} ${year}`;

                // Get first day of month
                const firstDay = new Date(year, month, 1);
                const lastDay = new Date(year, month + 1, 0);
                
                // Get last day of previous month
                const prevMonthLastDay = new Date(year, month, 0);
                
                let html = '';
                let date = new Date(firstDay);
                date.setDate(date.getDate() - firstDay.getDay()); // Start from last month's relevant date

                // Create calendar grid
                for (let i = 0; i < 6; i++) { // 6 rows
                    html += '<tr>';
                    for (let j = 0; j < 7; j++) { // 7 days
                        const currentDate = new Date(date);
                        const isToday = this.isSameDay(currentDate, new Date());
                        const isSelected = this.selectedDate && this.isSameDay(currentDate, this.selectedDate);
                        const isPast = this.isPastDate(currentDate);
                        const isAvailable = this.isAvailableDay(currentDate) && !isPast;
                        const isCurrentMonth = currentDate.getMonth() === month;

                        let className = isAvailable ? 'available' : 'unavailable';
                        if (isSelected) className += ' selected';
                        if (!isCurrentMonth) className += ' text-gray-400';

                        html += `
                            <td class="${className}" 
                                data-date="${currentDate.toISOString()}"
                                style="${!isCurrentMonth ? 'opacity: 0.5;' : ''}
                                    ${isToday ? 'border: 2px solid var(--primary-color);' : ''}">
                                ${currentDate.getDate()}
                            </td>`;
                        
                        date.setDate(date.getDate() + 1);
                    }
                    html += '</tr>';
                }

                this.calendarBody.innerHTML = html;
            }

            isSameDay(date1, date2) {
                return date1.getDate() === date2.getDate() &&
                    date1.getMonth() === date2.getMonth() &&
                    date1.getFullYear() === date2.getFullYear();
            }

            attachEventListeners() {
                this.calendarBody.addEventListener('click', (e) => {
                    const cell = e.target.closest('td');
                    if (!cell || !cell.classList.contains('available')) return;

                    // Remove previous selection
                    const previousSelected = document.querySelector('td.selected');
                    if (previousSelected) {
                        previousSelected.classList.remove('selected');
                    }

                    // Add new selection
                    cell.classList.add('selected');
                    this.selectedDate = new Date(cell.dataset.date);

                    // Update booking state
                    if (window.bookingState) {
                        window.bookingState.date = this.selectedDate.toLocaleDateString('en-US', {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });
                        document.getElementById('selected-date').textContent = `Date: ${window.bookingState.date}`;
                        window.updateBookingSummary();
                    }
                });
            }

            nextMonth() {
                this.currentDate.setMonth(this.currentDate.getMonth() + 1);
                this.renderCalendar();
            }

            previousMonth() {
                const proposedDate = new Date(this.currentDate);
                proposedDate.setMonth(proposedDate.getMonth() - 1);
                
                // Only allow going to previous month if it's not before current month
                const today = new Date();
                if (proposedDate.getFullYear() > today.getFullYear() || 
                    (proposedDate.getFullYear() === today.getFullYear() && 
                    proposedDate.getMonth() >= today.getMonth())) {
                    this.currentDate = proposedDate;
                    this.renderCalendar();
                }
            }
        }

        // Initialize calendar when the document is loaded
        document.addEventListener('DOMContentLoaded', () => {
            const calendar = new Calendar();
        });
    </script>
</body>
</html>