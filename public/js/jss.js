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
    var now = new Date();
    var mnth = now.getMonth() + 1;
    mnth = mnth.toString();
    if (mnth.length == 1) {
      mnth = "0" + mnth;
    }
    var tday = now.getDate();
    tday = tday.toString();
    if (tday.length == 1) {
      tday = "0" + tday;
    }
    //alert(tday);
    if (period == 'Month To Date') {
        var now = new Date();
        var tdate = now.getFullYear() + '-' + (mnth) + '-' + (tday);
        var fdate = now.getFullYear() + '-' + (mnth) + '-01';
        $("#thruDate").val(tdate);
        $("#fromDate").val(fdate);
    }
    if (period == 'Year To Date') {
        //alert(document.getElementById("thruDate").value);
        var now = new Date();
        var tdate = now.getFullYear() + '-' + (mnth) + '-' + (tday);
        var fdate = now.getFullYear() + '-01-01';
        $("#thruDate").val(tdate);
        $("#fromDate").val(fdate);
    }
    if (period == 'Last 30 Days') {
        var now = new Date();
        var pdt = new Date();
        pdt.setDate(pdt.getDate() - 30);
        var pmnth = pdt.getMonth() + 1;
        pmnth = pmnth.toString();
        if (pmnth.length == 1) {
          pmnth = "0" + pmnth;
        }
        var pday = pdt.getDate();
        pday = pday.toString();
        if (pday.length == 1) {
          pday = "0" + pday;
        }
        //alert(pdt + ' ' + pmnth);
        var tdate = now.getFullYear() + '-' + (mnth) + '-' + (tday);
        var fdate = pdt.getFullYear() + '-' + (pmnth) + '-' + (pday);
        $("#thruDate").val(tdate);
        $("#fromDate").val(fdate);
    }
    if (period == 'Last 60 Days') {
        var now = new Date();
        var pdt = new Date();
        pdt.setDate(pdt.getDate() - 60);
        pdt.setDate(pdt.getDate() - 30);
        var pmnth = pdt.getMonth() + 1;
        pmnth = pmnth.toString();
        if (pmnth.length == 1) {
          pmnth = "0" + pmnth;
        }
        var pday = pdt.getDate();
        pday = pday.toString();
        if (pday.length == 1) {
          pday = "0" + pday;
        }
        var tdate = now.getFullYear() + '-' + (mnth) + '-' + (tday);
        var fdate = pdt.getFullYear() + '-' + (pmnth) + '-' + (pday);
        $("#thruDate").val(tdate);
        $("#fromDate").val(fdate);
    }
}
