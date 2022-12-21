
<div class = "topbar">
    <img src = "nkust.png">
    <select id = "student_select" class = "student_select" onchange="change_student()">
        <?php 
            require_once __DIR__."/../data_object/student.php";
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
    <a id = "menu_1" class = "menu-option" href = "student/chose_course.php">加退選課程</a>
    <a id = "menu_2" class = "menu-option" href = "student/reviewer_course.php">檢視個人課表</a>
</div>