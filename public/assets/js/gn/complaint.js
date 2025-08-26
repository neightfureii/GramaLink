function confirmAction(actionType, id) {
    const modal = document.getElementById("popup-modal");
    const title = document.getElementById("popup-title");
    const message = document.getElementById("popup-message");
    const confirmBtn = document.getElementById("confirm-btn");
    const additionalInfoContainer = document.getElementById("additional-info-container");
  
    title.innerText = `Confirm ${actionType.replace("_", " ")}`;
    message.innerText = `Are you sure you want to ${actionType.replace("_", " ")} this complaint?`;
  
    if (actionType === "request_info") {
      additionalInfoContainer.style.display = "block";
    } else {
      additionalInfoContainer.style.display = "none";
    }
  
    confirmBtn.onclick = function() {
      modal.style.display = "none";
      handleAction(actionType, id);
    };
  
    modal.style.display = "flex";
  }
  
  function handleAction(actionType, id) {
    if (actionType === "resolve") {
      alert("Complaint ID " + id + " marked as resolved!");
    } else if (actionType === "request_info") {
      const additionalInfo = document.getElementById("additional-info").value;
      alert("Requested more information for Complaint ID " + id + ": " + additionalInfo);
    } else if (actionType === "prioritize") {
      alert("Complaint ID " + id + " prioritized!");
    }
  }
  
  function closePopup() {
    document.getElementById("popup-modal").style.display = "none";
  }
  
  