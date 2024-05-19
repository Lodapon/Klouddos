$(document).ready(function() {

    var password = document.getElementById("password")
    , confirm_password = document.getElementById("confirm_password");

    function validatePassword(){
    if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
    } else {
        confirm_password.setCustomValidity('');
    }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
    
    var passworda = document.getElementById("passworda")
    , confirm_passworda = document.getElementById("confirm_passworda");

    function validatePasswordA(){
    if(passworda.value != confirm_passworda.value) {
        confirm_passworda.setCustomValidity("Passwords Don't Match");
    } else {
        confirm_passworda.setCustomValidity('');
    }
    }

    passworda.onchange = validatePasswordA;
    confirm_passworda.onkeyup = validatePasswordA;

    showProvinces();
    // showAgProvinces();

});	//ready

function showProvinces(){
    //PARAMETERS
    var url = "/api/province";
    var callback = function(result){
        $("#input_province").empty();
        for(var i=0; i<result.length; i++){
            $("#input_province").append(
                $('<option></option>')
                    .attr("value", ""+result[i].ch_id)
                    .html(""+result[i].changwat_e)
            );
        }
       
        showAmphoes();
    };
    //CALL AJAX
    ajax(url,callback);
}

function showAmphoes(){
    //INPUT
    var province_code = $("#input_province").val();
    //PARAMETERS
    var url = "/api/province/"+province_code+"/amphoe";
    var callback = function(result){
        //console.log(result);
        $("#input_amphoe").empty();
        for(var i=0; i<result.length; i++){
            $("#input_amphoe").append(
                $('<option></option>')
                    .attr("value", ""+result[i].am_id)
                    .html(""+result[i].amphoe_e)
            );
        }
        showDistricts();
    };
    //CALL AJAX
    ajax(url,callback);
}

function showDistricts(){
    //INPUT
    var province_code = $("#input_province").val();
    var amphoe_code = $("#input_amphoe").val();
    //PARAMETERS
    var url = "/api/province/"+province_code+"/amphoe/"+amphoe_code+"/district";
    var callback = function(result){
        //console.log(result);
        $("#input_district").empty();
        for(var i=0; i<result.length; i++){
            $("#input_district").append(
                $('<option></option>')
                    .attr("value", ""+result[i].ta_id)
                    .html(""+result[i].tambon_e)
            );
        }
        // showZipcode();
        hotelAddr();
    };
    //CALL AJAX
    ajax(url,callback);
}

function hotelAddr(){
    var hotelAddr =  $("#hotelname").val() 
    + ' ' + $("#input_district option:selected").text().trim()
    + ' ' + $("#input_amphoe option:selected").text().trim()
    + ' ' + $("#input_province option:selected").text().trim()
    + ' ' + $("#input_zipcode" ).val();
    $("#hoteladdress").val(hotelAddr);

}
function agentAddr(){
    var agentAddr =  $("#companyname").val() 
    + ' ' + $("#ag_district option:selected").text().trim()
    + ' ' + $("#ag_amphoe option:selected").text().trim()
    + ' ' + $("#ag_province option:selected").text().trim()
    + ' ' + $("#ag_zipcode" ).val();
    $("#agentaddress").val(agentAddr);

}
function showAgProvinces(){
    //PARAMETERS
    var url = "/api/province";
    var callback = function(result){
        $("#ag_province").empty();
        for(var i=0; i<result.length; i++){
            $("#ag_province").append(
                $('<option></option>')
                    .attr("value", ""+result[i].ch_id)
                    .html(""+result[i].changwat_e)
            );
        }
        showAgAmphoes();
    };
    //CALL AJAX
    ajax(url,callback);
}

function showAgAmphoes(){
    //INPUT
    var province_code = $("#ag_province").val();
    //PARAMETERS
    var url = "/api/province/"+province_code+"/amphoe";
    var callback = function(result){
        //console.log(result);
        $("#ag_amphoe").empty();
        for(var i=0; i<result.length; i++){
            $("#ag_amphoe").append(
                $('<option></option>')
                    .attr("value", ""+result[i].am_id)
                    .html(""+result[i].amphoe_e)
            );
        }
        showAgDistricts();
    };
    //CALL AJAX
    ajax(url,callback);
}

function showAgDistricts(){
    //INPUT
    var province_code = $("#ag_province").val();
    var amphoe_code = $("#ag_amphoe").val();
    //PARAMETERS
    var url = "/api/province/"+province_code+"/amphoe/"+amphoe_code+"/district";
    var callback = function(result){
        //console.log(result);
        $("#ag_district").empty();
        for(var i=0; i<result.length; i++){
            $("#ag_district").append(
                $('<option></option>')
                    .attr("value", ""+result[i].ta_id)
                    .html(""+result[i].tambon_e)
            );
        }
        // showZipcode();
    };
    //CALL AJAX
    ajax(url,callback);
}
function ajax(url, callback){
    $.ajax({
        "url" : url,
        "type" : "GET",
        "dataType" : "json",
    })
        .done(callback); //END AJAX
}
