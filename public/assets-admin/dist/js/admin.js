$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(":checkbox").on("change", function() {
        var chx = $(this).is(':checked');
        $(this).closest('tr').find('input:text').prop("disabled", !chx).val("");
    });
    //get noti
    $.get({
        url: "/admin/getnoti",
        success: function(res) {
            $("#uaappr").html(res.uaappr==0?'':res.uaappr); 
            $("#frappr").html(res.frappr==0?'':res.frappr);
        }
    });
});	//ready

function approve(){
    $('#userAppr').attr('action', "approveuser").submit();
}

function reject(){
    $('#userAppr').attr('action', "rejectuser").submit();
}

function dismissrp(){
    $('#reportform').attr('action', "dismissreport").submit();
}

function deleterp(){
    $('#reportform').attr('action', "deletereport").submit();
}

function showModal(userId){
  $.post({
    url: "viewDoc",
    data: { "userId":userId },
    success: function(res) {
        // add content from another url
        // console.log(res)
       // $("#myModal .modal-body").load(data.body.remoteUrl);
       $("#modalbody").empty(); 
       $("#modallogo").empty(); 
       $("#textimgs").hide();
       for(var i=0; i<res.length; i++){
            if(res[i].asset_type==1){
                $("#modallogo").append(
                    $('<img></img>')
                        .attr("src", "/storage/"+res[i].asset_url).attr("style","width: 128px; height: 128px;border-radius: 50%; display: block;margin-left: auto;margin-right: auto;")
                        // .html(""+res[i].asset_url)
                    );
            }else if(res[i].asset_type==2){
                $("#textimgs").show();
                $("#modalbody").append(
                    $('<img></img>')
                        .attr("src", "/storage/"+res[i].asset_url).attr("style","width: 150px; height: 150px;")
                        // .html(""+res[i].asset_url)
                    );
            }else{
                $("#modalbody").append("<br>")
                if(res[i].asset_type==4){
                    $("#modalbody").append($('<p></p>').html("Company Document"));
                }else if(res[i].asset_type==5){
                    $("#modalbody").append($('<p></p>').html("Thailand Hotel Association Document"));
                }
                $("#modalbody").append(
                    // < src="path_of_your_pdf/your_pdf_file.pdf" type="application/pdf"   height="700px" width="500"></embed>
                    $('<embed></embed>')
                        .attr("src", "/storage/"+res[i].asset_url).attr("type","application/pdf").attr("width","780px").attr("height","700px")
                        .html(""+res[i].asset_url)
                    );
            }
        }
        // open the other modal
        $("#myModal").modal("show");
    }
 });
}