$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

function reply(to) {
    $.post({
        url: "/reply/agent",
        data: {"reqId":$("#reqId").val(), "replyText": $("#replyText"+to).val(), "replyTo": to},
        success: function(res) {
            $('div.postreply-container').html(res);
        }
    });
}

function deal(to) {
    Swal.fire({
        title: 'Confirm The Deal!\n"' + $("#replier" + to).val() + '"',
        text: "The hotel that you deal will receive quotation form link via email.",
        icon: 'warning',
        confirmButtonText: 'Deal',
        showCancelButton: true
    }).then( result => {
        if(result.isConfirmed) {
            console.info("deal!!");

            $.post({
                url: "/reply/agent/deal",
                data: {"reqId":$("#reqId").val(), "dealWith": to},
                success: function(res) {
                    // $('div.postreply-container').html(res);
                    Swal.fire({
                        title: "Requested quotation",
                        text: "You can preview the quotation after hotel send.",
                        icon: 'success',
                        showConfirmButton: true,
                        allowOutsideClick: false
                    });
                }
            });


        } else {
            console.warn("not deal");
        }
    });
}

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
