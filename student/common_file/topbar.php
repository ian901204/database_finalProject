
<div class = "topbar">
    <a href="/index.php"><img src = "nkust.png"></a>    
    <select id = "student_select" class = "student_select" onchange="change_student()">
        <?php 
            require_once __DIR__."/../../data_object/student.php";
            $student = new student();
            $data = $student -> get_all();
            foreach($data as $var){
                if ($var["id"]  == $_GET["id"]){
                    echo "<option value = '".$var["id"]."' selected>$var[2] $var[1]</option>";
                }else{
                    echo "<option value = '".$var["id"]."'>$var[2] $var[1]</option>";
                }
            }
        ?>
    </select>
</div>
<div class="sidebar">
    <menu>
        <a id = "menu_1" class = "menu-option" href = "student/chose_course.php">加退選課程</a>
    </menu>
    <menu>
        <a id = "menu_2" class = "menu-option" href = "student/reviewer_course.php">檢視個人課表</a>
    </menu>
</div>
<script>
var menu_1 = $("#menu_1");
var menu_2 = $("#menu_2");
var path = window.location.pathname.split("/");
menu_1.attr("href", menu_1.attr("href") + "?id=" + id);
menu_2.attr("href", menu_2.attr("href") + "?id=" + id);
if (window.location.pathname.split("/")[2].indexOf("chose_course.php") >= 0){
    menu_1.addClass("active");
    menu_2.removeClass("active");
}else{
    menu_2.addClass("active");
    menu_1.removeClass("active");
}
</script>