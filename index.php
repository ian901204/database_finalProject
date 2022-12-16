<html>
    <head>
        <?php include "head.php" ?>
    </head>
    <body>
        <img class = "login-logo" src="school1.png">
        <div class = "login-area">
            <h2>課程系統</h2>
            <div class="input-form">
                <button class="login-button" onclick="teacher()" id = "send" >教職員模式</button>
                <button class="login-button" onclick="student()" id = "send" >學生模式</button>
            </div>
        </div>
    </body>
    <script>
        function teacher(){
            window.location.href = window.location.origin + "/teacher/teacher.html";
        }
        function student(){
            window.location.href = window.location.origin + "/student/reviewer_course.php";
        }
    </script>
</html>