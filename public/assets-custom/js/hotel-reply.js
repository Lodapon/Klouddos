$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$("#replyButton").on("click", function () {

    $.post({
        url: "/reply/hotel",
        data: {"reqId":$("#reqId").val(), "replyText": $("#replyText").val()},
        success: function(res) {
            $('div.postreply-container').html(res);
        }
    });
});

function showModal(replyid){
    $("#myModal").modal("show");
    $("#repId").val(replyid);
  };
  
  function report (replyid){
      $.post({
          url: "/report",
          data: { "reqId":$("#reqId").val(),"msg":$("#msg").val(),"repId": $("#repId").val() },
          success: function(res) {
              window.location.assign("/landing");
          }
        });
  };


$("#sendQuotation").on("click", function() {
    window.location.assign("/quotation?id="+$("#reqId").val());
});