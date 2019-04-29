$(function () {
    $('#addpembayaran').click(function (event) {
        event.preventDefault();
        $.post('include/processpembayaran.php?action=addpembayaran', $('#add-pembayaran-form').serialize(), function (resp) {
            if (resp['status'] == true) {
                $("#success-msg").html(resp['msg']);
                $("#success-msg").show();
                setTimeout(function () {
                    location.href = "pembayaran.php";
                }, 1000);
            } else {
                var htm = '<button data-dismiss="alert" class="close" type="button">×</button>';
                $.each(resp['msg'], function (index, val) {
                    htm += val + " <br>";
                });
                $("#error-msg").html(htm);
                $("#error-msg").show();
                $(this).prop('disabled', false);
            }
        }, 'json');
    });


    $('#editpembayaran').click(function (event) {
        event.preventDefault();
        $.post('include/processpembayaran.php?action=editpembayaran', $('#edit-pembayaran-form').serialize(), function (resp) {
            if (resp['status'] == true) {
                $("#success-msg").html(resp['msg']);
                $("#success-msg").show();
                setTimeout(function () {
                    location.href = "pembayaran.php";
                }, 1000);
            } else {
                var htm = '<button data-dismiss="alert" class="close" type="button">×</button>';
                $.each(resp['msg'], function (index, val) {
                    htm += val + " <br>";
                });
                $("#error-msg").html(htm);
                $("#error-msg").show();
                $(this).prop('disabled', false);
            }
        }, 'json');
    });


    $.post("paginationpembayaran.php?page=1", function (data) {
        var htm = "";
        var resp = jQuery.parseJSON(data);
        if (resp['rec'].length > 0) {
            for (var i = 0; i < resp['rec'].length; i++) {
                var sid = resp['rec'][i]['pembayaran_id'];
                htm += '<tr id="row_num_' + sid + '">';
                htm += '<td>' + resp['rec'][i]['pembayaran_id'] + '</td>';
                htm += '<td>' + resp['rec'][i]['biaya'] + '</td>';
                htm += '<td>' + resp['rec'][i]['tanggal'] + '</td>';
                htm += '<td class="td-actions"><a class="btn btn-small btn-success" href="editpembayaran.php?pembayaran_id=' + sid + '"><i class="icon-large icon-edit"> </i></a><a class="btn btn-danger btn-small" onClick="getpembayaranId(' + sid + ')"   href="javascript:void(0)"><i class="btn-icon-only icon-remove"> </i></a></td>';
            }

        } else {
            htm += '<td></td>';
            htm += '<td colspan="3"> Tidak ada data</td>';
            htm += '<td></td>';

        }
        jQuery("#target-content").html(htm);
        jQuery("#append-pagination").html(resp['pagination']);

    });

    // jQuery("#pagination li").live('click',function(e){
    $("#append-pagination").on("click", ".pagination a", function (e) {
        e.preventDefault();
        jQuery("#target-content").html('loading...');
        jQuery("#pagination li").removeClass('active');
        jQuery(this).addClass('active');
        // var pageNum = this.id;
        var pageNum = $(this).attr("data-page");

        $.post("paginationpembayaran.php?page=" + pageNum, function (data) {
            var htm = "";
            var resp = jQuery.parseJSON(data);
            if (resp['rec'].length > 0) {
                for (var i = 0; i < resp['rec'].length; i++) {
                    var sid = resp['rec'][i]['pembayaran_id'];
                    htm += ' <tr id="row_num_' + sid + '">';
                    htm += '<td>' + resp['rec'][i]['pembayaran_id'] + '</td>';
                    htm += '<td>' + resp['rec'][i]['biaya'] + '</td>';
                    htm += '<td>' + resp['rec'][i]['tanggal'] + '</td>';
                    htm += '<td class="td-actions"><a class="btn btn-small btn-success" href="editpembayaran.php?pembayaran_id=' + sid + '"><i class="icon-large icon-edit"> </i></a><a class="btn btn-danger btn-small" onClick="getpembayaranId(' + sid + ')"   href="javascript:void(0)"><i class="btn-icon-only icon-remove"> </i></a></td>';
                }

            } else {
                htm += '<td></td>';
                htm += '<td colspan="3"> Tidak ada data</td>';
                htm += '<td></td>';

            }
            jQuery("#target-content").html(htm);
            jQuery("#append-pagination").html(resp['pagination']);

        });


    });
});


function getpembayaranId(pembayaran_id) {
    var result = confirm("Data akan dihapus , benar ?");
    var pembayaran_id = "pembayaran_id=" + pembayaran_id;
    if (result) {

        $.post('include/processpembayaran.php?action=deletepembayaran', pembayaran_id, function (resp) {
            if (resp['status'] == true) {
                $("#row_num_" + pembayaran_id).html('');
                $("#success-msg").html(resp['msg']);
                $("#success-msg").show();
            } else {
                $("#error-msg").html(htm);
                $("#error-msg").show();
            }
        }, 'json');
    }
}

