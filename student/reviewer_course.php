<html>
    <head>
        <?php
            include (__DIR__."/../common_file/head.php");
        ?> 
    </head>
    <body>
        <?php
            include (__DIR__."/../common_file/topbar.php");
        ?>
        <div class = "content">
            <table class = "course_info">
                <thead>
                    <tr>
                        <th>課程名稱</th>
                        <th>課程編號</th>
                        <th>課程講師</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include __DIR__."/../data_object/course_log.php";
                        include __DIR__."/../data_object/course.php";
                        $course_log = new course_log();
                        $course = new course();
                        $data = $course_log -> get_by_student_id($_GET["id"]);
                        $course_data = [];
                        foreach($data as $col){
                            array_push($course_data, $course->get_by_id($col["student_id"]));
                        }
                        var_dump($course_data);
                    ?>
                    <tr>
                        <td>名稱</td>
                        <td>名稱</td>
                        <td>名稱</td>
                    </tr>
                    <tr>
                        <td>名稱</td>
                        <td>名稱</td>
                        <td>名稱</td>
                    </tr>

                    <tr style = "display: table-row;">
                        <td></td>
                        <td style = "text-align: center"><a class="course_page" oncllick = "last_page()"><</a>  1  <a class = "course_page" onclick="next_page()">></a></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>