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
                        <label class = "overlay_label">新增學生</label>
                        <input class = "data_input" placeholder = "請輸入學生編號"></input>
                        <input class = "data_input" placeholder = "請輸入名稱"></input>
                        <input class = "data_input" id = "add_apartment_id" placeholder = "請輸入所屬系編號"></input>
                    </div>
                    <div class = "button_area">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav('add_student')">&times;</a>
                        <button class = "add_button" onclick="openNav()">新增課程</button>
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
                        <button class = "add_button" id = "edit_button" onclick="edit_course()">完成編輯</button>
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
                            echo "<tr id = \"".$data["id"]."\">";
                            echo "<td id = 'name'>".$data["name"]."</td>";
                            echo "<td id = 'id'>".$data["id"]."</td>";
                            echo "<td id = 'apartment_id'>".$data["apartment_id"]."</td>";
                            echo "<td><button class='course success' onclick = \"edit('".$data["id"]."')\">編輯</button><button class = 'course danger' onclick = 'delete(".$data["id"].")'>刪除</button></td>";
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
        $("input#add_apartment_id").focusout(function(){
            $.ajax({
                type: "POST",
                url: "/api/apartment/check_id.php",
                data: JSON.stringify({
                    id: $(this).val()
                }),
                dataType: "json",
                success: function (response) {
                    $("input#input#add_apartment_id").css("border", "1px solid gray");
                },
                error: function(xhr){
                    $("input#apartment_id").css("border", "2px solid red");
                }
            });
        });
        function edit_student(id){
            $.ajax({
                url:"/api/student/edit_id.php",
                type: 'POST',
                dataType: 'json',
                contentType: "application/json",
                data: JSON.stringify({ 
                    id: id,
                    name: $("#student_name").val(),
                    apartment_id: $("#apartment_id").val()
                }),
                success: function(data){
                    $("#" + id).find("#name").text($("#student_name").val())
                    $("#" + id).find("#apartment_id").text($("#apartment_id").val())
                    $("#edit_student").css("height", "0%");
                },
                error: function(jqXhr, textStatus, errorMessage){
                    alert("編輯失敗 請稍後在試一次")
                }
            });
        }
        function edit(id){
            openNav("edit_student");
            $("#student_name").val($("#" + id).find("#name").text());
            $("#apartment_id").val($("#" + id).find("#apartment_id").text());
            $("#edit_button").attr("onclick","edit_student('"+ id +"')");
        }
    </script>
</html>