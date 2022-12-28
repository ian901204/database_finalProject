function check_id (){ 
    var id_regex = /^[A-Z]\d{3}$/;
    if (!id_regex.test($("#add_id").val())){
        $("#add_id").css("border", "2px solid red");
        $("#add_label").css("color", "red");
        $("#add_label").text("課程編號不符合規定(長度為4 ex:CXXXX)");
        return false;
    }else{
        return $.ajax({
            type: "POST",
            url: "/api/course/check_id.php",
            data: JSON.stringify({
                id: $("#add_id").val()
            }),
            dataType: "json",
            success: function (response) {
                $("input#add_id").css("border", "1px solid gray");
                $("#add_label").css("color", "black");
                $("#add_label").text("新增課程");
                return true;
            },
            error: function(xhr){
                $("#add_label").css("color", "red");
                $("#add_label").text("此編號已有課程使用");
                $("input#add_id").css("border", "2px solid red");
                return false;
            }
        });
    }
}
function add_course(){
    if ($("#add_id").val() == ""){
        $("#add_id").css("border", "2px solid red");
        $("#add_label").css("color", "red");
        $("#add_label").text("課程編號不得為空");
        return false;
    }
    if ($("#add_name").val() == ""){
        $("#add_name").css("border", "2px solid red");
        $("#add_label").css("color", "red");
        $("#add_label").text("課程名稱不得為空");
        return false;
    }
    $("#add_label").css("color", "black");
    $("#add_label").text("新增課程");
    $("#add_name").css("border", "1px solid grey");
    $(".add_button").text("新增中....");
    $.when(check_id($("#add_id").val())).done(function(data){
        if (data["status"] == "success"){
            $.ajax({
                url:"/api/course/add.php",
                type: 'POST',
                dataType: 'json',
                contentType: "application/json",
                data: JSON.stringify({ 
                    id: $("#add_id").val(),
                    name: $("#add_name").val(),
                    credits: $("#add_credits").val()
                }),
                success: function(data){
                    console.log(data)
                    var append_html = "<tr id = "+$("#add_id").val()+"><td id = 'name'>"+$("#add_name").val()+"</td><td id = 'id'>"+$("#add_id").val()+"</td><td id = 'credits'>"+$("#add_credits").val()+"</td><td><button class='course success' onclick = \"edit('"+$("#add_id").val()+"')\">編輯</button><button class = 'course danger' onclick = 'delete_course(\""+$("#add_id").val()+"\")'>刪除</button></td></tr>"
                    $("tbody").prepend(append_html);
                    $("#add_course input.data_input").each(function(){
                        $(this).val("")
                    })
                    closeNav('add_course')
                },
                error: function(jqXhr, textStatus, errorMessage){
                    alert("新增失敗 請稍後再重試一遍")
                }
            });
        }
    });
}
function delete_course(id){
    $.ajax({
        url:"/api/course/remove_id.php",
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
            $("#edit_course").css("height", "0%");
        },
        error: function(jqXhr, textStatus, errorMessage){
            alert("編輯失敗 請稍後在試一次")
        }
    });
}
function edit(id){
    openNav("edit_course");
    $("#course_name").val($("#" + id).find("#name").text());
    $("#course_credits").val($("#" + id).find("#credits").text());
    $("#edit_button").attr("onclick","edit_course('"+ id +"')");
}