<html>
    <head>
        <?php
            include (__DIR__."/../head.php");
        ?> 
    </head>
    <body>
        <?php
            include (__DIR__."/common_file/topbar.php");
        ?>
        <div class = "content">
            <table class = "course_info">
                <thead>
                    <tr>
                        <th>課程名稱</th>
                        <th>課程編號</th>
                        <th>學分數</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include_once __DIR__."/../data_object/course_log.php";
                        include_once __DIR__."/../data_object/course.php";
                        $course_log = new course_log();
                        $course = new course();
                        $data = $course_log -> get_by_student_id($_GET["id"]);
                        if ($data == []){
                            echo "<tr>";
                            echo "<td>無選課資料</td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "</tr>";
                        }else{
                            foreach($data as $col){
                                foreach($course->get_by_id($col["course_id"]) as $course_data){
                                    echo "<tr>";
                                    echo "<td>".$course_data['name']."</td>";
                                    echo "<td>".$course_data['id']."</td>";
                                    echo "<td>".$course_data['credits']."</td>";
                                    echo "</tr>";
                                }
                            }
                        }
                    ?>
                    <tr style = "display: table-row;">
                        <td></td>
                        <td ></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>