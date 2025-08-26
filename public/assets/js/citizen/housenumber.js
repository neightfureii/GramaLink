function showHouseNumber(event){
    event.preventDefault();

    const houseNumber = "A465";

    const notice = document.getElementById("notice");
    notice.classList.remove("hidden");
    notice.innerHTML = `House Number is ${houseNumber}`;

    event.target.reset();
    

}