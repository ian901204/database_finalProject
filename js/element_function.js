function change_student(){
    window.location.href = window.location.origin + window.location.pathname + "?id=" + $("#student_select").val(); 
}
function add_course_log(student_id, course_id){
    $.ajax({
        url:"/api/course_log/add.php",
        type: 'POST',
        dataType: 'json',
        contentType: "application/json",
        data: JSON.stringify({ 
            student_id: student_id,
            course_id: course_id
        }),
        success: function(data){
            location.reload(true);
        },
        error: function(jqXhr, textStatus){
            console.log("error function active");
        }
    });
}
function delete_course_log(student_id, course_id){
    $.ajax("/api/course_log/delete.php",{
        type: 'POST',
        dataType: 'json',
        contentType: "application/json",
        data: JSON.stringify({ 
            student_id: student_id,
            course_id: course_id
        }),
        success: function(data){
            location.reload(true);
        },
        error: function(jqXhr, textStatus, errorMessage){
            console.log("error function active");
        }
    });
}
function closeNav(id) {
    $("#" + id).css("height", "0%");
}
function openNav(id){
    $(".overlay").each(function(){
        $(this).css("height", "0%");
    });
    $("#" + id).css("height", "100%");
}
var id = window.location.search.replace("?", "").split("&")[0].split("=")[1]
