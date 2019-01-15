<?php
/**
 * Created by PhpStorm.
 * User: Jeremiah
 * Date: 09/05/2018
 * Time: 2:46 PM
 */

if(isset($_POST["text1"])){
    if(!empty($_POST["text1"])){
        $text1 = array();
        foreach ($_POST["text1"] as $text){
            if(empty($text)){
               continue;
            }
            else {
               array_push($text1,$text);
            }
        }
        for($i=0;$i<$text1;$i++){
            echo $text1[$i];
        }
    }
}
?>
<br>
<script>
    function showBullshits(){
        var x = document.getElementById("selectContent");
        var val = parseInt(x.options[x.selectedIndex].value);
        var table = document.getElementById("myTable");
        var x = document.getElementById("zxc");
        alert(val);
        for(var i=0; i<table.rows;i++){
            table.insertRow(x);
        }
    }
</script>
<select id="selectContent">
    <option value="10">10</option>
    <option value="100">100</option>
    <option value="1000">1000</option>
</select>
<button onclick="showBullshits()">Go</button>
<form action="sample.php" method="post">
<table id="myTable">
    <tr id="zxc">
        <td><input type="text" name="text1[]"></td>
        <td><input type="text" name="text2[]"></td>
        <td><input type="text" name="text3[]"></td>
        <td>
            <select name="option[]">
                <option value="a">a</option>
                <option value="b">b</option>
            </select>
        </td>
    </tr>
    <tr id="zxc">
        <td><input type="text" name="text1[]"></td>
        <td><input type="text" name="text2[]"></td>
        <td><input type="text" name="text3[]"></td>
        <td>
            <select name="option[]">
                <option value="a">a</option>
                <option value="b">b</option>
            </select>
        </td>
    </tr>
</table>
<input type="submit" value="test">
</form>