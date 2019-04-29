$(function () {
    $('#adddokter').click(function (event) {
        event.preventDefault();
        $.post('include/processdokter.php?action=adddokter', $('#add-dokter-form').serialize(), function (resp) {
            if (resp['status'] == true) {
                $("#success-msg").html(resp['msg']);
                $("#success-msg").show();
                setTimeout(function () {
                    location.href = "dokter.php";
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


    $('#editdokter').click(function (event) {
        event.preventDefault();
        $.post('include/processdokter.php?action=editdokter', $('#edit-dokter-form').serialize(), function (resp) {
            if (resp['status'] == true) {
                $("#success-msg").html(resp['msg']);
                $("#success-msg").show();
                setTimeout(function () {
                    location.href = "dokter.php";
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


    $.post("paginationdokter.php?page=1", function (data) {
        var htm = "";
        var resp = jQuery.parseJSON(data);
        if (resp['rec'].length > 0) {
            for (var i = 0; i < resp['rec'].length; i++) {
                var sid = resp['rec'][i]['dokter_id'];
                htm += '<tr id="row_num_' + sid + '">';
                htm += '<td>' + resp['rec'][i]['dokter_id'] + '</td>';
                htm += '<td>' + resp['rec'][i]['nama'] + '</td>';
                htm += '<td>' + resp['rec'][i]['alamat'] + '</td>';
                htm += '<td>' + resp['rec'][i]['nohp'] + '</td>';
                htm += '<td class="td-actions"><a class="btn btn-small btn-success" href="editdokter.php?dokter_id=' + sid + '"><i class="icon-large icon-edit"> </i></a><a class="btn btn-danger btn-small" onClick="getdokterId(' + sid + ')"   href="javascript:void(0)"><i class="btn-icon-only icon-remove"> </i></a></td>';
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

        $.post("paginationdokter.php?page=" + pageNum, function (data) {
            var htm = "";
            var resp = jQuery.parseJSON(data);
            if (resp['rec'].length > 0) {
                for (var i = 0; i < resp['rec'].length; i++) {
                    var sid = resp['rec'][i]['dokter_id'];
                    htm += ' <tr id="row_num_' + sid + '">';
                    htm += '<td>' + resp['rec'][i]['dokter_id'] + '</td>';
                    htm += '<td>' + resp['rec'][i]['nama'] + '</td>';
                    htm += '<td>' + resp['rec'][i]['alamat'] + '</td>';
                    htm += '<td>' + resp['rec'][i]['nohp'] + '</td>';
                    htm += '<td class="td-actions"><a class="btn btn-small btn-success" href="editdokter.php?dokter_id=' + sid + '"><i class="icon-large icon-edit"> </i></a><a class="btn btn-danger btn-small" onClick="getdokterId(' + sid + ')"   href="javascript:void(0)"><i class="btn-icon-only icon-remove"> </i></a></td>';
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


function getdokterId(dokter_id) {
    var result = confirm("Data akan dihapus , benar ?");
    var dokter_id = "dokter_id=" + dokter_id;
    if (result) {

        $.post('include/processdokter.php?action=deletedokter', dokter_id, function (resp) {
            if (resp['status'] == true) {
                $("#row_num_" + dokter_id).html('');
                $("#success-msg").html(resp['msg']);
                $("#success-msg").show();
            } else {
                $("#error-msg").html(htm);
                $("#error-msg").show();
            }
        }, 'json');
    }
}

