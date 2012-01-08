$(document).ready(function(){
    
    $('.jqueryuiButton').button();
    $("#TeacherDob , #TeacherDojp ,#TeacherDojs , #StudentDob,#txtAddTeacherAttendanceDate").datepicker({
        dateFormat:"dd-mm-yy",
        changeMonth:true,
        changeYear:true
    });
    $.ajaxSetup({
        complete:function(){
            $('.jqueryuiButton').button();
            $("#TeacherDob , #TeacherDojp ,#TeacherDojs ,#StudentDob,#txtAddTeacherAttendanceDate").datepicker({
                dateFormat:"dd-mm-yy",
                changeMonth:true,
                changeYear:true
            });
        }
    });
});