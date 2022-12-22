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
            <div id="myNav" class="overlay">
                
                <div class = "course_action">
                    <div class = "input-area">
                        <label class = "course-label">新增課程</label>
                        <input placeholder = "請輸入名稱"></input>
                        <input placeholder = "請輸入學分"></input>
                    </div>
                    <div class = "button-area">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <button onclick="openNav()">新增課程</button>
                    </div>
                </div>
            </div>
            <table class = "course_info">
                <thead>
                    <tr>
                        <th>課程名稱</th>
                        <th>課程編號</th>
                        <th>學分數</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include __DIR__."/../data_object/course.php";
                        $course = new course();
                        $course_data = $course -> get_all();
                        foreach($course_data as $data){
                            echo "<tr>";
                            echo "<td>".$data["name"]."</td>";
                            echo "<td>".$data["id"]."</td>";
                            echo "<td>".$data["credits"]."</td>";
                            echo "<td><button class='course success'>編輯</button><button class = 'course danger'>刪除</button></td>";
                            echo "</tr>";
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
    <script>
        function openNav() {
            document.getElementById("myNav").style.height = "100%";
        }

        function closeNav() {
            document.getElementById("myNav").style.height = "0%";
        }
    </script>
</html>