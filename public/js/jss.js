function showfilters() {
    $('.filters').fadeIn(600);
}

function hidefilters() {
    $('.filters').fadeOut(300);
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

function updateMaxDate() {
    var tdate = $("#salesperson").find(':selected').attr('tdate');
    // first update the message, then update the min attribute for discount
    $("#transactionDate").attr("max",tdate);

    // alert(discount);
}
