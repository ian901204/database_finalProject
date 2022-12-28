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
                        <label class = "overlay_label" id = "add_label">新增科系</label>
                        <input class = "data_input" id = "add_id" placeholder = "請輸入科系編號"></input>
                        <input class = "data_input" id = "add_name" placeholder = "請輸入名稱"></input>
                        <input class = "data_input" id = "add_director" placeholder = "請輸入系主任名稱"></input>
                    </div>
                    <div class = "button_area">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav('add_apartment')">&times;</a>
                        <button class = "add_button" onclick="add_apartment()">新增科系</button>
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
                        <button class = "add_button" id = "edit_button" onclick="edit_apartment()">完成編輯</button>
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
                            echo "<td><button class='course success' onclick = \"edit('".$data["id"]."')\">編輯</button><button class = 'course danger' onclick = \"delete_apartment('".$data["id"]."')\">刪除</button></td>";
                            echo "</tr>";
                        }
                    ?>
                    <tr style = "display: table-row;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style = "text-align: right;">></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
    <script src="js/apartment_manage.js"></script>
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
                $("#add_label").text("新增系所");
                $("#add_name").css("border", "1px solid grey");
            }
        });
    </script>
</html>