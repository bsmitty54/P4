function showfilters() {
    $('.filters').show();
}

function hidefilters() {
    $('.filters').hide();
}

function setSalesDropDowns(objName,objValue) {
    //Get select object
    var objSelect = document.getElementById(objName);
    //Set selected
    objSelect.value = objValue;
}

function updateDiscount() {
    var discount = $("#product").find(':selected').attr('disc');
    // first update the message, then update the min attribute for discount
    $(".discount").html("Max discount is " + discount + "%");
    $("#discount").attr("max",discount);
    // alert(discount);
}
