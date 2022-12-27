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
                <div class = "course_action">
                    <div class = "input-area">
                        <label class = "course-label">新增課程</label>
                        <input class = "data_input" placeholder = "請輸入名稱"></input>
                        <input class = "data_input" placeholder = "請輸入學分"></input>
                    </div>
                    <div class = "button-area">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav('add_course')">&times;</a>
                        <button class = "add-course" onclick="openNav()">新增課程</button>
                    </div>
                </div>
            </div>

            <div id="edit_course" class="overlay">
                <div class = "course_action">
                    <div class = "input-area">
                        <label class = "course-label">編輯課程</label>
                        <input class = "data_input" id = 'course_name' placeholder = "請輸入名稱"></input>
                        <input class = "data_input" id = 'course_credits' placeholder = "請輸入學分"></input>
                    </div>
                    <div class = "button-area">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav('edit_course')">&times;</a>
                        <button class = "add-course" id = "edit_button" onclick="edit_course()">完成編輯</button>
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
        function edit_course(id){
            $.ajax({
                url:"/api/course/edit_id.php",
                type: 'POST',
                dataType: 'json',
                contentType: "application/json",
                data: JSON.stringify({ 
                    id: id,
                    name: $("#course_name").val(),
                    credits: $("#course_credits").val()
                }),
                success: function(data){
                    $("#" + id).find("#name").text($("#course_name").val())
                    $("#" + id).find("#credits").text($("#course_credits").val())
                    document.getElementById("edit_course").style.height = "0%";
                },
                error: function(jqXhr, textStatus, errorMessage){
                    console.log("error");
                }
            });
        }
        function edit(id){
            document.getElementById("add_course").style.height = "0%";
            document.getElementById("edit_course").style.height = "100%";
            $("#course_name").val($("#" + id).find("#name").text());
            $("#course_credits").val($("#" + id).find("#credits").text());
            $("#edit_button").attr("onclick","edit_course('"+ id +"')");
        }
        function openNav() {
            document.getElementById("edit_course").style.height = "0%";
            document.getElementById("add_course").style.height = "100%";
        }

        function closeNav(id) {
            document.getElementById(id).style.height = "0%";
        }
    </script>
</html>