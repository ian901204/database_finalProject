
<div class = "topbar">
    <a href="/index.php"><img src = "nkust.png"></a>    
</div>
<div class="sidebar">
    <a id = "menu_1" class = "menu-option" href = "teacher/aparment_manage.php">科系管理</a>
    <a id = "menu_2" class = "menu-option" href = "teacher/course_manage.php">課程管理</a>
    <a id = "menu_3" class = "menu-option" href = "teacher/student_manage.php">學生管理</a>
    <a id = "menu_4" class = "menu-option" href = "teacher/select_course_manage.php">選課作業</a>
</div>
<script>
var menu_1 = $("#menu_1");
var menu_2 = $("#menu_2");
var menu_3 = $("#menu_3");
var menu_4 = $("#menu_4");
var path = window.location.pathname.split("/");
if (path[2].indexOf("aparment_manage.php") >= 0){
    menu_1.addClass("active");
    menu_2.removeClass("active");
    menu_3.removeClass("active");
    menu_4.removeClass("active");
}else if(path[2].indexOf("select_course_manage.php") >= 0){
    menu_1.removeClass("active");
    menu_2.removeClass("active");
    menu_3.removeClass("active");
    menu_4.addClass("active");
}else if(path[2].indexOf("student_manage.php") >= 0){
    menu_1.removeClass("active");
    menu_2.removeClass("active");
    menu_3.addClass("active");
    menu_4.removeClass("active");
}else{
    menu_1.removeClass("active");
    menu_2.addClass("active");
    menu_3.removeClass("active");
    menu_4.removeClass("active");
}
</script>