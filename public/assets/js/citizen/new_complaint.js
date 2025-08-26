document.getElementById("newComplaintForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const title = document.getElementById("title").value;
    const description = document.getElementById("description").value;
    const category = document.getElementById("category").value;
    const attachment = document.getElementById("attachment").files[0];

    const complaint = {
        title,
        description,
        category,
        attachment: attachment ? attachment.name : null,
    };

    // backend code for saving the complaint

    window.alert("New Complaint Submitted:", complaint);

    document.getElementById("newComplaintForm").reset();
});
