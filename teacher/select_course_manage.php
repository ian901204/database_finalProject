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
            <div class = "chose_student">
                <select id = "student_select" class = "student_select" onchange="change_student()">
                    <?php 
                        echo "<option value = '0' ".(($_GET["id"] == "0")?"selected":"").">請選擇學生</option>";
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
            <table class = "course_info" style = "margin-top: 0px">
                <thead>
                    <tr>
                        <th>可選課程名稱</th>
                        <th>課程編號</th>
                        <th>學分數</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include_once __DIR__."/../data_object/course.php";
                        include_once __DIR__."/../data_object/course_log.php";
                        if ($_GET["id"] == '0'){
                            echo "<tr>";
                            echo "<td>請先選擇學生</td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "</tr>";
                        }else{
                            $course = new course();
                            $course_log = new course_log();
                            $selected_course = $course_log -> get_by_student_id($_GET["id"]);
                            $selected_id = [];
                            foreach($selected_course as $data){
                                array_push($selected_id, $data["course_id"]);
                            }
                            $unselect_course = $course -> get_unselect($selected_id);
                            if ($unselect_course == []){
                                echo "<tr>";
                                echo "<td>已無可選課程</td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "</tr>";
                            }else{
                                foreach($unselect_course as $course_data){
                                    echo "<tr>";
                                    echo "<td>".$course_data['name']."</td>";
                                    echo "<td>".$course_data['id']."</td>";
                                    echo "<td>".$course_data['credits']."</td>";
                                    echo "<td><button class = 'course success' onclick=\"add_course_log('".$_GET["id"]."', '".str_replace(' ', '', $course_data["id"])."')\">加入課程</button></td>";
                                    echo "</tr>";
                                }
                            }
                        }
                    ?>
                    <tr style = "display: table-row;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <table class = "course_info">
                <thead>
                    <tr>
                        <th>已選課程名稱</th>
                        <th>課程編號</th>
                        <th>學分數</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        if ($_GET["id"] == '0'){
                            echo "<tr>";
                            echo "<td>請先選擇學生</td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "</tr>";
                        }else{
                            $data = $course_log -> get_by_student_id($_GET["id"]);
                            if ($data == []){
                                echo "<tr>";
                                echo "<td>無選課資料</td>";
                                echo "<td></td>";
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
                                        echo "<td><button class = 'course danger' onclick=\"delete_course_log('".$_GET["id"]."', '".str_replace(' ', '', $course_data["id"])."')\">移除課程</button></td>";
                                        echo "</tr>";
                                    }
                                }
                            }
                        }
                    ?>
                    <tr style = "display: table-row;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>