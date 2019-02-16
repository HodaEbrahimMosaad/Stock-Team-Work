'use strict';
$(document).ready(function () {

    function succFun() {
        $("#exampleModal").modal('hide');
        $("#exampleModal").removeClass('fade');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        $('#freshItems').load(window.location.href + " #freshItems", function () {
            $('.test .test').removeClass('col-md-10').addClass('col-md-12');
        });
        $("body ").css('padding-right' , '0px');
    }
    var deletedId;
    $(document).on("click", ".delete",function () {
        deletedId = $(this).data("id");
    });

    $(document).on("click", "#delete", function () {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "DELETE",
            url: "pairs/"+deletedId,
            data: {
                "_method": 'DELETE',
                deletedId: deletedId,
            },
            success: function (data) {
                succFun()
            },
            error:function(data){
                succFun()
            },
        })

    });
    $(document).on("click", "#force_delete",function () {
        var deletedId = $(this).data("id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            method: "POST",
            url: "pairs/per_destroy",
            data: {
                deletedId: deletedId,
                'force_delete': 'force_delete'
            },
            success: function (data) {
                alert('h');
                $('#freshItems').load(window.location.href + " #freshItems", function () {
                    $('.test .test').removeClass('col-md-10').addClass('col-md-12');
                });
                $("body ").css('padding-right' , '0px');
            },
            error:function(data){
                $('#freshItems').load(window.location.href + " #freshItems", function () {
                    $('.test .test').removeClass('col-md-10').addClass('col-md-12');
                });
                $("body ").css('padding-right' , '0px');
            },
        })

    });


    $(document).on("click", "#restore", function () {
        var deletedId = $(this).data("id");
        if (!deletedId)
        {
            alert('You did not choose any record');
            return false;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            method: "POST",
            url: "pairs/restore",
            data: {
                deletedId: deletedId,
            },
            success: function (data) {
                $('#freshItems').load(window.location.href + " #freshItems", function () {
                    $('.test .test').removeClass('col-md-10').addClass('col-md-12');
                });
                $("body ").css('padding-right' , '0px');
            },
            error:function(data){


            },
        })

    });

});