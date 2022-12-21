
if (window.location.pathname.split("/")[2] == "chose_course.php"){
    $("#menu_1").addClass("active");
    $("#menu_2").removeClass("active");
}else{
    $("#menu_2").addClass("active");
    $("#menu_1").removeClass("active");
}

function change_student(){
    window.location.href = window.location.origin + window.location.pathname + "?id=" + $("#student_select").val(); 
}
