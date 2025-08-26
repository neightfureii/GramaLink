function toggleRescheduleForm() {
    const rescheduleContainer = document.getElementById("rescheduleform");
    const triggerbutton = document.getElementById("triggerbutton");

    if (rescheduleContainer.style.display === "none" || !rescheduleContainer.style.display) {
        rescheduleContainer.style.display = "block";
        triggerbutton.innerHTML = "Close Form";
    } else {
        rescheduleContainer.style.display = "none";
        triggerbutton.innerHTML = "Request Reschedule";
    }
}


function toggleReason(el) {
    el.classList.toggle('expanded');
}

