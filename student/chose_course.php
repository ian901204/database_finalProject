<?php
include ("data_object/student.php");
$student = new student();
?>
<html>
    <head>
        <?php
            include "../head.php" 
        ?>  
    </head>
    <body>
        <div class = "topbar">
            <img src = "nkust.png">
                <select >
                    <?php 
                        $data = $student -> get_all();
                        
                    ?>
                    <option value = ""></option>
                </select>
        </div>
        <div class="sidebar">
            <a class = "menu-option active" href = "student/chose_course.php">加退選課程</a>
            <a class = "menu-option" href = "student/reviewer_course.php">檢視個人課表</a>
        </div>
        <div>
        </div>
    </body>
    <script>
        
    </script>
</html>