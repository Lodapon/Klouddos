$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#confirmQuotation").on("click", function () {

        $.post({
            url: "/quotation/preview",
            data: {
                "quoId": $("#quoId").val(),
                "voteScore": $("input[name='voteScore']").val()
            },
            success: function (res) {
                Swal.fire({
                    title: res.message,
                    html: "<a href='javascript:window.close()'>close</a>.",
                    icon: 'success',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
            }
        });
    });

});


function showModal(assetId) {
    $("#modalbody").empty();
    $.get({
        url: "/getAsset/"+assetId,
        success: function (res) {
            $("#modalbody").append(
                // < src="path_of_your_pdf/your_pdf_file.pdf" type="application/pdf"   height="700px" width="500"></embed>
                $('<embed></embed>')
                    .attr("src", "/storage/" + res.asset_url).attr("type", "application/pdf").attr("width", "100%").attr("height", "700px")
                    .html("" + res.asset_url)
            );
        }
    });
    // open the other modal
    $("#myModal").modal("show");
}