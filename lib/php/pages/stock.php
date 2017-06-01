<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Склад</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/icon.png" type="image/png">
    <script src="js/jquery-1.9.1.js"></script>
</head>
<body>
<?php
include_once("./lib/php/pages/menu.php");
?>
<div class="container pt-100 center">
    <?php
    echo "<table id='stock_table'><tr id='main_tr_stock'><td>Модель</td><td>Материал</td><td>Длина</td><td>Количество</td></tr>";
    foreach($output_data as $row) {
        echo "<tr>";
        echo "
            <td>".$row["dmname"]."</td>
            <td>".$row["mname"]."</td>
            <td>".$row["dlength"]."</td>
            <td>".$row["count"]."</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>

    
</div>
<div class="container pt-100 center">
    <div class="misc stock-new">
        <select id="smodel">
        <?php
        foreach($models as $row) {
            echo '<option value="'.$row['dmid'].'">'.$row['dmname'].'</option>';
        }?>
        </select>
        <select id="smaterial">
        <?php
        foreach($materials as $row) {
            echo '<option value="'.$row['mid'].'">'.$row['mname'].'</option>';
        }?>
        </select>
        <input type="number" step="0.01" min="0" placeholder="Длина" id="dlen">
        <input type="number" step="1" placeholder="Количество" id="dcount">
        <input id="ssave" type="button" value="Сохранить">
    </div>
</div>
    <script src="js/scripts.js"></script>
    <script>
        $("#ssave").click(function(){
            var a = $("#smodel").val();
            var b = $("#smaterial").val();
            var c = parseFloat($("#dlen").val()).toFixed(2);
            var d = parseInt($("#dcount").val());
            if (c > 0 && d != 0){
                var oReq = new XMLHttpRequest();
                oReq.onload = function(){
                    if (d > 0)
                        alert("Деталь \""+$("#smodel > option[value='"+a+"']").html()+"\" ("+
                            $("#smaterial > option[value='"+b+"']").html()+" - "+c+" м. - "+Math.abs(d)+" шт.) добавлена на склад");
                    else {
                        alert("Деталь \""+$("#smodel > option[value='"+a+"']").html()+"\" ("+
                        $("#smaterial > option[value='"+b+"']").html()+" - "+c+" м. - "+Math.abs(d)+" шт.) списана со склада");
                    }
                    location.reload();
                };
                oReq.open("get", "./lib/php/pages/xmlhttp.php?q=updatedetail&dlength="+c+"&material="+b+"&dmodel="+a+"&count="+d, true);
                oReq.send();
            }

        });
    </script>
</body>
</html>