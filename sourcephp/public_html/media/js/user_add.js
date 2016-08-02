$(document).ready(function() {
    $('#btnAddTeacher').click(function () {
        $('#myform').submit();
//        window.location.href = "/quan-ly-giao-vien.html";

    });
    $('#btnTeacherExit').click(function () {
        window.location.href = "/quan-ly-giao-vien.html";

    });
    $('#btnSearchTeacher').click(function(){
        $('#searchTeacherForm').submit();
//        if($('#teacher_name_search').val() != ''){
//            
//        }
    });
    $(".splashy-remove").on("click", function() {
        $('#teacheredt_id').val($(this).attr('rel'));
        $('#editTeacherForm').submit();
    });
});