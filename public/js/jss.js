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

function updateDates() {
    var period = document.querySelector('input[name = "period"]:checked').value;
    //var period = document.getElementById("period").value;
    
    if (period == 'Month To Date') {
        var now = new Date();
        var tdate = now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate();
        var fdate = now.getFullYear() + '-' + (now.getMonth() + 1) + '-01';
        $("#thruDate").val(tdate);
        $("#fromDate").val(fdate);
    }
    if (period == 'Year To Date') {
        //alert(document.getElementById("thruDate").value);
        var now = new Date();
        var tdate = now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate();
        var fdate = now.getFullYear() + '-01-01';
        $("#thruDate").val(tdate);
        $("#fromDate").val(fdate);
    }
    if (period == 'Last 30 Days') {
        var now = new Date();
        var pdt = new Date();
        pdt.setDate(pdt.getDate() - 30);
        var tdate = now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate();
        var fdate = pdt.getFullYear() + '-' + (pdt.getMonth() + 1) + '-' + pdt.getDate();
        $("#thruDate").val(tdate);
        $("#fromDate").val(fdate);
    }
    if (period == 'Last 60 Days') {
        var now = new Date();
        var pdt = new Date();
        pdt.setDate(pdt.getDate() - 60);
        var tdate = now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate();
        var fdate = pdt.getFullYear() + '-' + (pdt.getMonth() + 1) + '-' + pdt.getDate();
        $("#thruDate").val(tdate);
        $("#fromDate").val(fdate);
    }
}
