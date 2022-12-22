<html>
    <head>
        <?php include __DIR__."/head.php" ?>
    </head>
    <body>
        <img class = "login-logo" src="school1.png">
        <div class = "login-area">
            <h2>課程系統</h2>
            <div class="input-form">
                <button class="login-button" onclick="teacher()" id = "send" >教職員模式</button>
                <select id = "student_select" class = "student_select" onchange="select_student()">
                <option value = "" selected disabled>請選擇學生</option>
                <?php 
                    include (__DIR__."/data_object/student.php");
                    $student = new student();
                    $data = $student -> get_all();
                    foreach($data as $student_data){
                            echo "<option value = '".$student_data["id"]."'>$student_data[2] $student_data[1]</option>";
                    }
                ?>
            </select>
                <button id ="student" class="login-button" onclick="student()" id = "send" disabled>學生模式</button>
            </div>
        </div>
    </body>
    <script>
        function teacher(){
            window.location.href = window.location.origin + "/teacher/course_manage.php";
        }
        function student(){
            var id = $("#student_select").val();
            window.location.href = window.location.origin + "/student/reviewer_course.php?id=" + id;
        }
        function select_student(){
                $("#student").removeAttr("disabled");
        }
    </script>
</html>