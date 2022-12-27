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
                        <th>系所名稱</th>
                        <th>系所主任</th>
                        <th>系所編號</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include __DIR__."/../data_object/aparment.php";
                        $student = new student();
                        $student = $student -> get_all();
                        foreach($student as $data){
                            echo "<tr id = \"".$data["name"]."\">";
                            echo "<td id = 'name'>".$data["director"]."</td>";
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
</html>