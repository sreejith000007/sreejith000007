var page_cnt;

$(function() {
    $(".modalAddProject").click(function() {
        $('.name').val('');
        $('.description').val('');
        var subject = $(this).data('id');
        $('#hiddenOp').val(subject);
        $("#modalAddProject").modal("show");
    });
    $("#projectAddForm").submit(function(event) {
        submitForm();
        return false;
    });
});

function submitForm() {
    var name = $('.name').val();
    $.ajax({
        type: "POST",
        url: "../admin/crudProject.php",
        cache: false,
        data: $('form#projectAddForm').serialize(),
        success: function(response) {
            $("#modalAddProject").modal('hide');
            $(".appendProject").append('<li class="cst_nav_item" data-tag="eid_' + parseFloat(response) + '" data-id="remove' + parseFloat(response) + '" ><span class="child_nav_link cst_nav_link d-flex align-items-center">' +
                '<i class="nav-icon fas fa-clipboard-list"></i><p><a href="javascript:void(0)" onclick=getCMS(' + parseFloat(response) + ',"pageList")>' + name + '</a></p>' +
                '<div class="ml-auto cst_icns"><a href="javascript:void(0)" onclick=getCMS(' + parseFloat(response) + ',"addPage")><i class="fas fa-plus"></i></a>' +
                "<a href='#' id='abc_" + parseFloat(response) + "' onclick='editProject(" + parseFloat(response) + ")'>" +
                "<i class='fas fa-pencil-alt'></i></a><a href='#' onclick='removeProject(" + parseFloat(response) + ")' ><i class='fas fa-trash-alt'></i></a></div></span></li>");
            toastr.success('Project Added');
        },
        error: function() {
            alert("Error");
        }
    });
}


$(".expand_menu").click(function() {
    $("#cst_nav_tree").slideToggle();
    $(this).toggleClass('cst_active');
})

function editProject(id) {

    $('#edit_id').val(id);
    $.ajax({
        type: "GET",
        url: "../admin/crudProject.php",
        cache: false,
        data: {
            id: id
        },
        success: function(data) {

            var name = data[0]['name'];
            var description = data[0]['description'];
            $('.edit_name').val(name);
            $('.edit_description').val(description);
            $("#modalEditProject").modal("show");

        },
        error: function() {
            alert("Error");
        }
    });
}

$("#projectEditForm").submit(function(event) {
    var id = $('#edit_id').val();
    var li_id = $('#abc_' + id).closest('li').find('span').find('p > a');
    submitEditForm(li_id);
    return false;
});

function submitEditForm(li_id) {
    var name = $('.edit_name').val();

    $.ajax({
        type: "POST",
        url: "../admin/crudProject.php",
        cache: false,
        data: $('form#projectEditForm').serialize(),
        success: function(response) {
            number_of_files = parseInt(response);
            $("#modalEditProject").modal("hide");
            li_id.text(name);
            toastr.success('Edited');
        },
        error: function() {
            alert("Error");
        }
    });
}

function removeProject(id) {
    $("#removeid").val("");
    $("#modalRemoveProject").modal("show");
    $("#removeid").val(id);
}

$("#projectRemoveForm").submit(function(event) {
    removesubmit();
    return false;
});

function removesubmit() {
    var id = $("#removeid").val();
    $.ajax({
        type: "GET",
        url: "../admin/crudProject.php",
        cache: false,
        data: { removeid: id },
        async: false,
        success: function(data) {
            $("#modalRemoveProject").modal("hide");
            $("#cst_nav_tree li[data-id=remove" + id + "]").hide();
            toastr.error('Deleted');
            $('#cst_page_cnt').html(page_cnt);
        },
        error: function() {
            alert("Error");
        }
    });
}


function getCMS(id, page) {
    $("#cst_nav_tree .cst_nav_item").removeClass('nav_active');
    $("#cst_nav_tree li[data-id=remove" + id + "]").addClass('nav_active');

    $.ajax({
        type: "GET",
        url: "../views/" + page + ".php",
        data: { cms: page, project_id: id },
        success: function(data) {
            //console.log(data);
            $('#cst_page_cnt').html(data);
        }
    });

}



$(".pinfetch").change(function() {
    var email_id = $(this).val();
    $.ajax({
        type: "POST",
        url: "../admin/crudProject.php",
        data: { email_id: email_id },
        success: function(data) {
            console.log(data);
            $('.PIN_feched').val(parseFloat(data));
        }
    });
});

function dashboard() {
    $('#cst_page_cnt').html(page_cnt);
}

$(document).ready(function() {
    page_cnt = $('#cst_page_cnt').html();
});