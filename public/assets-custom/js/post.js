//ready
$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on("click", "#postForum", function() {


        if(isValidTopic()
            && isValidAttraction()
            && isValidHotelRating()
            && isValidRoomAmount()
            && isValidDateRange()) {

            $.post({
                url: "/agent/post/submit",
                data: {
                    "topic":$("input[name='topic']").val(),
                    "roomAmount":$("input[name='roomAmount']").val(),
                    "hotelRating":$("input[name='hotelRating']").val(),
                    "checkInDate":$("input[name='checkInDate']").val(),
                    "checkOutDate":$("input[name='checkOutDate']").val(),
                    "budget":$("input[name='budget']").val(),
                    "attraction":$("input[name='attraction']").val(),
                    "facilities":$("input[name='facilities']").val(),
                    "isPublic":$("input[name='isPublic']").is(":checked") ? "1" : "0",
                    "allowQuot":$("input[name='allowQuot']").is(":checked") ? "1" : "0",
                    "ratingRequired":$("input[name='ratingRequired']").is(":checked") ? "1" : "0"
                },
                success: function(isOk) {
                    if (isOk) {
                        Swal.fire({
                            title: "Your new topic was posted",
                            icon: 'success',
                            showConfirmButton: true,
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "/landing"
                            }
                        });
                    }
                }
            });
        }
    });


    function isValidTopic() {
        if($("#topic").val() === "") {
            showPleaseFillIn();
            return false;
        }
        return true;
    }

    function isValidAttraction() {
        if($("#attraction").val() === "") {
            showPleaseFillIn();
            return false;
        }
        return true;
    }

    function isValidHotelRating() {
        if($("#ratingRequired").is(":checked") && $("[name='hotelRating']").val() === "0") {
            showPleaseFillIn();
            return false;
        }
        return true;
    }

    function isValidRoomAmount() {
        if($("#roomAmount").val() === "") {
            showPleaseFillIn();
            return false;
        }
        return true;
    }


    function isValidDateRange() {

        var checkIn = $("#checkInDate").val()
        var checkOut = $("#checkOutDate").val()

        if (checkIn === "" || checkOut === "") {
            showPleaseFillIn();
            return false;
        }

        var checkInDate = new Date(checkIn);
        var checkOutDate = new Date(checkOut);

        if (checkInDate > checkOutDate) {
            Swal.fire({
                title: "Invalid Date range",
                icon: 'error',
                allowOutsideClick: true
            });
            return false;
        }

        return true;
    }

    function showPleaseFillIn() {
        Swal.fire({
            title: "Please fill in the form.",
            icon: 'error',
            allowOutsideClick: true
        });
    }




});

