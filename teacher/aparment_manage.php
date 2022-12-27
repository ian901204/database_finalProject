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
            <div id="add_apartment" class="overlay">
                <div class = "overlay_action"  style = "height: 250px">
                    <div class = "input_area">
                        <label class = "overlay_label">新增科系</label>
                        <input class = "data_input" placeholder = "請輸入科系編號"></input>
                        <input class = "data_input" placeholder = "請輸入名稱"></input>
                        <input class = "data_input" placeholder = "請輸入系主任名稱"></input>
                    </div>
                    <div class = "button_area">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav('add_apartment')">&times;</a>
                        <button class = "add_button" onclick="openNav()">新增課程</button>
                    </div>
                </div>
            </div>

            <div id="edit_apartment" class="overlay">
                <div class = "overlay_action">
                    <div class = "input_area">
                        <label class = "overlay_label">編輯科系</label>
                        <input class = "data_input" id = 'apartment_name' placeholder = "請輸入名稱"></input>
                        <input class = "data_input" id = 'apartment_director' placeholder = "請輸入系主任名稱"></input>
                    </div>
                    <div class = "button_area">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav('edit_apartment')">&times;</a>
                        <button class = "add_button" id = "edit_button" onclick="edit_course()">完成編輯</button>
                    </div>
                </div>
            </div>
            <table class = "course_info">
                <thead>
                    <tr>
                        <th>系所名稱</th>
                        <th>系所主任</th>
                        <th>系所編號</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include __DIR__."/../data_object/apartment.php";
                        $apartment = new apartment();
                        $apartment = $apartment -> get_all();
                        foreach($apartment as $data){
                            echo "<tr id = \"".$data["id"]."\">";
                            echo "<td id = 'name'>".$data["name"]."</td>";
                            echo "<td id = 'director'>".$data["director"]."</td>";
                            echo "<td id = 'id'>".$data["id"]."</td>";
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
        function edit_apartment(id){
            $.ajax({
                url:"/api/apartment/edit_id.php",
                type: 'POST',
                dataType: 'json',
                contentType: "application/json",
                data: JSON.stringify({ 
                    id: id,
                    name: $("#apartment_name").val(),
                    director: $("#apartment_director").val()
                }),
                success: function(data){
                    $("#" + id).find("#name").text($("#apartment_name").val())
                    $("#" + id).find("#director").text($("#apartment_director").val())
                    $("#edit_apartment").css("height", "0%");
                },
                error: function(jqXhr, textStatus, errorMessage){
                    alert("編輯失敗 請稍後在試一次")
                }
            });
        }
        function edit(id){
            openNav("edit_apartment");
            $("#apartment_name").val($("#" + id).find("#name").text());
            $("#apartment_director").val($("#" + id).find("#director").text());
            $("#edit_button").attr("onclick","edit_apartment('"+ id +"')");
        }
    </script>
</html>