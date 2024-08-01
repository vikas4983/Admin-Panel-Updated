

document.getElementById("submitButton").addEventListener("click", function (event) {
        event.preventDefault();
        var bannerInput = document.getElementById("input");
        var bannerNull = document.getElementById("bannerNull");
        var bannerFill = document.getElementById("bannerFill");
        var extension = [".jpg", ".png", ".jpeg", ".gif"]; // Array of valid extensions

        if (
            bannerInput.value !== "" &&
            isValidExtension(bannerInput.value, extension)
        ) {

            inputFill(bannerInput, bannerFill);
            document.getElementById("bannerModalForm").submit();
        } else {
            inputNull(bannerInput, bannerNull, extension);
        }
    });

function isValidExtension(filename, validExtensions) {
    var ext = filename.split(".").pop(); // Get the file extension
    return validExtensions.includes("." + ext.toLowerCase()); // Check if it's in the list of valid extensions
}

function inputNull(bannerInput, bannerNull) {
    bannerNull.innerText = "Please select a field with a valid extension.";
    bannerInput.classList.add("is-invalid");
}

function inputFill(bannerInput, bannerFill) {
    bannerFill.innerText = "Looks Good.";
    bannerInput.classList.add("is-valid");
    bannerInput.classList.remove("is-invalid");
}

function DeleteFunction() {
    var result = confirm("Are you sure want to delete.");
    if (result) {
        // If user clicked "OK", proceed with deletion
        console.log("Item deleted successfully.");
        // Add your deletion logic here
    } else {
        // If user clicked "Cancel", do nothing
        console.log("Deletion canceled.");
        event.preventDefault();
        return; // Exit the function without further execution
    }
}
