
function validateForm() {
    var name = document.forms["inputValidate"]["person"].value;
    var phone = document.forms["inputValidate"]["number"].value;
    var marka = document.forms["inputValidate"]["vehicleType"].value;
    var model = document.forms["inputValidate"]["vehicleModel"].value;
    var god = document.forms["inputValidate"]["vehicleYear"].value;
    var vin = document.forms["inputValidate"]["vehicleVin"].value;
    var km = document.forms["inputValidate"]["vehicleOdo"].value;
    if (name == "" || phone == "" || marka == "" 
        || model == "" || god == "" || vin == "" || km == "") {
        alert("Everything must be filled out");
        return false;
    }
}

