$(function () {
    $('#addpasien').click(function (event) {
        event.preventDefault();
        $.post('include/processpasien.php?action=addpasien', $('#add-pasien-form').serialize(), function (resp) {
            if (resp['status'] == true) {
                $("#success-msg").html(resp['msg']);
                $("#success-msg").show();
                setTimeout(function () {
                    location.href = "pasien.php";
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


    $('#editpasien').click(function (event) {
        event.preventDefault();
        $.post('include/processpasien.php?action=editpasien', $('#edit-pasien-form').serialize(), function (resp) {
            if (resp['status'] == true) {
                $("#success-msg").html(resp['msg']);
                $("#success-msg").show();
                setTimeout(function () {
                    location.href = "pasien.php";
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


    $.post("paginationpasien.php?page=1", function (data) {
        var htm = "";
        var resp = jQuery.parseJSON(data);
        if (resp['rec'].length > 0) {
            for (var i = 0; i < resp['rec'].length; i++) {
                var sid = resp['rec'][i]['pasien_id'];
                htm += '<tr id="row_num_' + sid + '">';
                htm += '<td>' + resp['rec'][i]['pasien_id'] + '</td>';
                htm += '<td>' + resp['rec'][i]['nama'] + '</td>';
                htm += '<td>' + resp['rec'][i]['alamat'] + '</td>';
                htm += '<td>' + resp['rec'][i]['nohp'] + '</td>';
                htm += '<td>' + resp['rec'][i]['umur'] + '</td>';
                htm += '<td class="td-actions"><a class="btn btn-small btn-success" href="editpasien.php?pasien_id=' + sid + '"><i class="icon-large icon-edit"> </i></a><a class="btn btn-danger btn-small" onClick="getpasienId(' + sid + ')"   href="javascript:void(0)"><i class="btn-icon-only icon-remove"> </i></a></td>';
            }

        } else {
            htm += '<td></td>';
            htm += '<td colspan="3"> Tidak ada data</td>';
            htm += '<td></td>';

        }
        jQuery("#target-content").html(htm);
        jQuery("#append-pagination").html(resp['paginationpasien']);

    });

    // jQuery("#pagination li").live('click',function(e){
    $("#append-pagination").on("click", ".pagination a", function (e) {
        e.preventDefault();
        jQuery("#target-content").html('loading...');
        jQuery("#pagination li").removeClass('active');
        jQuery(this).addClass('active');
        // var pageNum = this.id;
        var pageNum = $(this).attr("data-page");

        $.post("paginationpasien.php?page=" + pageNum, function (data) {
            var htm = "";
            var resp = jQuery.parseJSON(data);
            if (resp['rec'].length > 0) {
                for (var i = 0; i < resp['rec'].length; i++) {
                    var sid = resp['rec'][i]['pasien_id'];
                    htm += ' <tr id="row_num_' + sid + '">';
                    htm += '<td>' + resp['rec'][i]['pasien_id'] + '</td>';
                    htm += '<td>' + resp['rec'][i]['nama'] + '</td>';
                    htm += '<td>' + resp['rec'][i]['alamat'] + '</td>';
                    htm += '<td>' + resp['rec'][i]['nohp'] + '</td>';
                    htm += '<td>' + resp['rec'][i]['umur'] + '</td>';
                    htm += '<td class="td-actions"><a class="btn btn-small btn-success" href="editpasien.php?pasien_id=' + sid + '"><i class="icon-large icon-edit"> </i></a><a class="btn btn-danger btn-small" onClick="getpasienId(' + sid + ')"   href="javascript:void(0)"><i class="btn-icon-only icon-remove"> </i></a></td>';
                }

            } else {
                htm += '<td></td>';
                htm += '<td colspan="3"> Tidak ada data</td>';
                htm += '<td></td>';

            }
            jQuery("#target-content").html(htm);
            jQuery("#append-pagination").html(resp['paginationpasien']);

        });


    });
});


function getpasienId(pasien_id) {
    var result = confirm("Data akan dihapus , benar ?");
    var pasien_id = "pasien_id=" + pasien_id;
    if (result) {

        $.post('include/processpasien.php?action=deletepasien', pasien_id, function (resp) {
            if (resp['status'] == true) {
                $("#row_num_" + pasien_id).html('');
                $("#success-msg").html(resp['msg']);
                $("#success-msg").show();
            } else {
                $("#error-msg").html(htm);
                $("#error-msg").show();
            }
        }, 'json');
    }
}

