document.getElementById("requestForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    const farmerName = document.getElementById("farmerName").value;
    const workDetails = document.getElementById("workDetails").value;
    const workHours = document.getElementById("workHours").value;
    const address = document.getElementById("address").value;
    const payment = document.getElementById("payment").value;
    
    const queryString = `?farmerName=${encodeURIComponent(farmerName)}&workDetails=${encodeURIComponent(workDetails)}&workHours=${encodeURIComponent(workHours)}&address=${encodeURIComponent(address)}&payment=${encodeURIComponent(payment)}`;
    window.location.href = "view_request.html" + queryString;
});
