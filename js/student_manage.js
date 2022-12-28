function check_id (id){
    var defer = $.Deferred();    
    var id_regex = /^[A-Z]\d{4}$/;
    if (!id_regex.test($("#add_id").val())){
        $("#add_id").css("border", "2px solid red");
        $("#add_label").css("color", "red");
        $("#add_label").text("學生編號不符合規定(長度為5 ex:SXXXX)");
        return false;
    }else{
        $.ajax({
            type: "POST",
            url: "/api/student/check_id.php",
            data: JSON.stringify({
                id: $("#add_id").val()
            }),
            dataType: "json",
            success: function (response) {
                $("input#add_id").css("border", "1px solid gray");
                $("#add_label").css("color", "black");
                $("#add_label").text("新增學生");
                return true;
            },
            error: function(xhr){
                $("#add_label").css("color", "red");
                $("#add_label").text("此編號已有學生使用");
                $("input#add_id").css("border", "2px solid red");
                return false;
            }
        });
    }
}
function add_student(){
    if ($("#add_id").val() == ""){
        $("#add_id").css("border", "2px solid red");
        $("#add_label").css("color", "red");
        $("#add_label").text("學生編號不得為空");
        return false;
    }
    if ($("#add_name").val() == ""){
        $("#add_name").css("border", "2px solid red");
        $("#add_label").css("color", "red");
        $("#add_label").text("學生名稱不得為空");
        return false;
    }
    $("#add_label").css("color", "black");
    $("#add_label").text("新增學生");
    $("#add_name").css("border", "1px solid grey");
    $.when(check_id($("#add_id").val())).done(function(data){
        console.log(data);
        if (data){
            $.ajax({
                url:"/api/student/add.php",
                type: 'POST',
                dataType: 'json',
                contentType: "application/json",
                data: JSON.stringify({ 
                    id: $("#add_id").val(),
                    name: $("#add_name").val(),
                    apartment_id: $("#add_apartment_id").val()
                }),
                success: function(data){
                    var append_html = "<tr id = "+$("#add_id").val()+"><td id = 'name'>"+$("#add_name").val()+"</td><td id = 'id'>"+$("#add_id").val()+"</td><td id = 'apartment_id'>"+$("#add_apartment_id").val()+"</td><td><button class='course success' onclick = \"edit('"+$("#add_id").val()+"')\">編輯</button><button class = 'course danger' onclick = 'delete_student(\""+$("#add_id").val()+"\")'>刪除</button></td></tr>"
                    console.log($('tbody tr').length - 1)
                    $("tbody").prepend(append_html);
                    $("#add_student input.data_input").each(function(){
                        $(this).val("")
                    })
                    closeNav('add_student')
                },
                error: function(jqXhr, textStatus, errorMessage){
                    alert("新增失敗 請稍後再重試一遍")
                }
            });
        }
    });
}
function delete_student(id){
    $.ajax({
        url:"/api/student/remove_id.php",
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