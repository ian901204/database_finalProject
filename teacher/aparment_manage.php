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
        function check_id (id){
            var defer = $.Deferred();    
            var id_regex = /^[A-Z]\d{3}$/;
            if (!id_regex.test($("#add_id").val())){
                $("#add_id").css("border", "2px solid red");
                $("#add_label").css("color", "red");
                $("#add_label").text("系所編號不符合規定(長度為4 ex:DXXX)");
                return false;
            }else{
                $.ajax({
                    type: "POST",
                    url: "/api/apartment/check_id.php",
                    data: JSON.stringify({
                        id: $("#add_id").val()
                    }),
                    dataType: "json",
                    success: function (response) {
                        $("input#add_id").css("border", "1px solid gray");
                        $("#add_label").css("color", "black");
                        $("#add_label").text("新增系所");
                        console.log("trye");
                        return true;
                    },
                    error: function(xhr){
                        $("#add_label").css("color", "red");
                        $("#add_label").text("此編號已有系所使用");
                        $("input#add_id").css("border", "2px solid red");
                        return false;
                    }
                });
            }
        }
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
        function add_apartment(){
            if ($("#add_id").val() == ""){
                $("#add_id").css("border", "2px solid red");
                $("#add_label").css("color", "red");
                $("#add_label").text("系所編號不得為空");
                return false;
            }
            if ($("#add_name").val() == ""){
                $("#add_name").css("border", "2px solid red");
                $("#add_label").css("color", "red");
                $("#add_label").text("系所名稱不得為空");
                return false;
            }
            $("#add_label").css("color", "black");
            $("#add_label").text("新增學生");
            $("#add_name").css("border", "1px solid grey");
            $.when(check_id($("#add_id").val())).done(function(data){
                if(!data){
                    return false;
                }
            })
            $.ajax({
                url:"/api/student/add.php",
                type: 'POST',
                dataType: 'json',
                contentType: "application/json",
                data: JSON.stringify({ 
                    id: $("#add_id").val(),
                    name: $("#add_name").val(),
                    director: $("#director").val()
                }),
                success: function(data){
                    var append_html = "<tr id = "+$("#add_id").val()+"><td id = 'name'>"+$("#add_name").val()+"</td><td id = 'director'>"+$("#add_director").val()+"</td><td id = 'id'>"+$("#add_id").val()+"</td><td><button class='course success' onclick = \"edit('"+$("#add_id").val()+"')\">編輯</button><button class = 'course danger' onclick = 'delete_apartment(\""+$("#add_id").val()+"\")'>刪除</button></td></tr>"
                    console.log($('tbody tr').length - 1)
                    $("tbody").prepend(append_html);
                    $("#add_apartment input.data_input").each(function(){
                        $(this).val("")
                    })
                    closeNav('add_apartment')
                },
                error: function(jqXhr, textStatus, errorMessage){
                    alert("新增失敗 請稍後再重試一遍")
                }
            });
        }
        function delete_apartment(id){
            $.ajax({
                url:"/api/apartment/remove_id.php",
                type: 'POST',
                dataType: 'json',
                contentType: "application/json",
                data: JSON.stringify({ 
                    id: id,
                }),
                success: function(data){
                    $("tr#" + id).remove();
                },
                error: function(jqXhr, textStatus, errorMessage){
                    alert("刪除失敗 請稍後在試一次")
                }
            });
        }
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
                    closeNav('edit_apartment')
                },
                error: function(jqXhr, textStatus, errorMessage){
                    alert("編輯失敗 請稍後在試一次")
                }
            });
        }
        function edit(id){
            openNav("edit_student");
            $("#apartment_name").val($("#" + id).find("#name").text());
            $("#apartment_director").val($("#" + id).find("#director").text());
            $("#edit_button").attr("onclick","edit_apartment('"+ id +"')");
        }
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