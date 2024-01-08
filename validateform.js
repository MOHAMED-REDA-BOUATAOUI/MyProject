function validateForm() {
    var permisInput = document.getElementsByName('Permis');
    var permisValue = permisInput.value;

    // Check if "permis" contains only numbers
    if (!/^\d+$/.test(permisValue)) {
        alert("Error: Permis must contain only numbers.");
        return false;
    }

    // Other form validation logic can be added here if needed

    return true;  // Allow form submission
}