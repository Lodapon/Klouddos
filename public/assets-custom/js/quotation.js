$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var counter = 0;

    $("#addrow").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";

        ++counter;

        cols += '<td><input type="text" class="form-control" name="roomType' + counter + '"/></td>';
        cols += '<td style="background-color:#e8eaea;"><input type="number" class="form-control form-amount" style="background-color:#e8eaea;" name="amount' + counter + '"/></td>';
        cols += '<td><input type="number" class="form-control form-price" name="price' + counter + '"/></td>';
        cols += '<td style="background-color:#e8eaea;"><input type="text" class="form-control" style="background-color:#e8eaea;" name="remark' + counter + '"/></td>';
        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list").append(newRow);

    });

    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
    });

    $(document).on("change",".form-amount, .form-price", calculateGrandTotal);
    $(document).on("click",".ibtnDel", calculateGrandTotal);
    $(document).on("keyup", "#quotRemark", remarkCounter)


    $("#submitQuotation").on("click", function() {

        if($("input[name='roomType0']").val() === ""
            && $("input[name='amount0']").val() === ""
            && $("input[name='price0']").val() === "") {

            alert("Please input quotation form or upload your document.");
        }


        var list = [];
        for(var i=0; i<=counter; ++i) {
            var detail = {
                "roomType": $("input[name='roomType"+i+"']").val(),
                "amount": $("input[name='amount"+i+"']").val(),
                "price": $("input[name='price"+i+"']").val()
            };
            list.push(detail);
        }

        console.log(list);
        $.post({
            url: "/quotation",
            data: {
                "reqId": $("input[name='reqId']").val(),
                "dealWith": $("input[name='dealWith']").val(),
                "quotTopic":$("#quotTopic").val(),
                "quotList": list,
                "quotRemark": $("#quotRemark").val(),
                "quotTotal": $("#total").val(),
                "voteScore": $("input[name='voteScore']").val()
            },
            success: function(res) {

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


    $("#submitQuotationFile").on("click", function() {
        $("#upForm").submit();
        Swal.fire({
            title: 'Quotation in review.',
            html: "<a href='javascript:window.close()'>close</a>.",
            icon: 'success',
            showConfirmButton: false,
            allowOutsideClick: false
        });

    });
});
function calculateGrandTotal() {
    var total = 0;
    $(".form-amount").each( (index, elm) => {
        total += (elm.value * $(".form-price")[index].value);
    });

    $("#total").val(total.toFixed(2));
}

function remarkCounter() {

    var remarkCharCount = $("#quotRemark").val().length;
    if (remarkCharCount > 3000) {
        $("#remarkCounter").css("color","red").text(remarkCharCount);
    } else {
        $("#remarkCounter").css("color","").text(remarkCharCount);
    }

}

