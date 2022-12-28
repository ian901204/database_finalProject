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
            <div id="add_student" class="overlay">
                <div class = "overlay_action"  style = "height: 250px">
                    <div class = "input_area">
                        <label class = "overlay_label" id = "add_label">新增學生</label>
                        <input class = "data_input" id = "add_id" placeholder = "請輸入學生編號"></input>
                        <input class = "data_input" id = "add_name" placeholder = "請輸入名稱"></input>
                        <input class = "data_input" id = "add_apartment_id" placeholder = "請輸入所屬系編號"></input>
                    </div>
                    <div class = "button_area">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav('add_student')">&times;</a>
                        <button class = "add_button" onclick="add_student()">新增學生</button>
                    </div>
                </div>
            </div>

            <div id="edit_student" class="overlay">
                <div class = "overlay_action">
                    <div class = "input_area">
                        <label class = "overlay_label">編輯科系</label>
                        <input class = "data_input" id = 'student_name' placeholder = "請輸入名稱"></input>
                        <input class = "data_input" id = 'apartment_id' placeholder = "請輸入所屬系編號"></input>
                    </div>
                    <div class = "button_area">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav('edit_student')">&times;</a>
                        <button class = "add_button" id = "edit_button" onclick="edit_student()">完成編輯</button>
                    </div>
                </div>
            </div>
            <table class = "course_info">
                <thead>
                    <tr>
                        <th>學生名稱</th>
                        <th>學生編號</th>
                        <th>所屬系編號</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include __DIR__."/../data_object/student.php";
                        $student = new student();
                        $student = $student -> get_all();
                        foreach($student as $data){
                            if ($data["id"] == ""){
                                continue;
                            }
                            echo "<tr id = \"".$data["id"]."\">";
                            echo "<td id = 'name'>".$data["name"]."</td>";
                            echo "<td id = 'id'>".$data["id"]."</td>";
                            echo "<td id = 'apartment_id'>".$data["apartment_id"]."</td>";
                            echo "<td><button class='course success' onclick = \"edit('".$data["id"]."')\">編輯</button><button class = 'course danger' onclick = \"delete_student('".$data["id"]."')\">刪除</button></td>";
                            echo "</tr>";
                        }
                    ?>
                    <tr style = "display: table-row;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style = 'text-align: center;'><a href = "javascript:void(0)" onclick = 'next_page()'>下一頁</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
    <script src="js/student_manage.js"></script>
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
                $("#add_label").text("新增學生");
                $("#add_name").css("border", "1px solid grey");
            }
        });
        function next_page(){
            console.log("next page call")
            $("tr:nth-child(n + 12)").css("display", "table-row;")
        }
    </script>
</html>