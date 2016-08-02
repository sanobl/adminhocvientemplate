$(document).ready(function() {
    $('#btnAddUser').click(function () {
        $('#myform').submit();
//        window.location.href = "/quan-ly-giao-vien.html";

    });
    $('#btnExitUser').click(function () {
        window.location.href = "/quan-ly-nguoi-dung.html";

    });
    $('#btnSearchUser').click(function(){
        $('#searchUserForm').submit();
//        if($('#user_name_search').val() != ''){
//            
//        }
    });
    $(".splashy-remove").on("click", function() {
        $('#useredt_id').val($(this).attr('rel'));
        $('#editUserForm').submit();
    });
});