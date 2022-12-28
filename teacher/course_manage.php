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
            <div id="add_course" class="overlay">
                <div class = "overlay_action" style = "height: 250px">
                    <div class = "input_area">
                        <label class = "overlay_label" id = "add_label">新增課程</label>
                        <input class = "data_input" id = "add_id" placeholder = "請輸入課程編號"></input>
                        <input class = "data_input" id = "add_name" placeholder = "請輸入名稱"></input>
                        <input class = "data_input" id = "add_credits" placeholder = "請輸入學分"></input>
                    </div>
                    <div class = "button_area">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav('add_course')">&times;</a>
                        <button class = "add_button" onclick="add_course()">新增課程</button>
                    </div>
                </div>
            </div>

            <div id="edit_course" class="overlay">
                <div class = "overlay_action">
                    <div class = "input_area">
                        <label class = "overlay_label">編輯課程</label>
                        <input class = "data_input" id = 'course_name' placeholder = "請輸入名稱"></input>
                        <input class = "data_input" id = 'course_credits' placeholder = "請輸入學分"></input>
                    </div>
                    <div class = "button_area">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav('edit_course')">&times;</a>
                        <button class = "add_button" id = "edit_button" onclick="edit_course()">完成編輯</button>
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
                            echo "<tr id = \"".$data["id"]."\">";
                            echo "<td id = 'name'>".$data["name"]."</td>";
                            echo "<td id = 'id'>".$data["id"]."</td>";
                            echo "<td id = 'credits'>".$data["credits"]."</td>";
                            echo "<td><button class='course success' onclick = \"edit('".$data["id"]."')\">編輯</button><button class = 'course danger' onclick = \"delete_course('".$data["id"]."')\">刪除</button></td>";
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
    <script src="js/course_manage.js"></script>
    <script>
        $("input#add_id").focusout(function(){
            if ($(this).val() == ""){
                return false;
            }
            check_id($(this).val());
        });
        $("input#add_name").focusout(function(){
            if ($(this).val() != ""){
                $("#add_label").css("color", "black");
                $("#add_label").text("新增課程");
                $("#add_name").css("border", "1px solid grey");
            }
        });

    </script>
</html>