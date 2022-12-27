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
                            echo "<td id = 'credits'>".$data["major_id"]."</td>";
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
</html>