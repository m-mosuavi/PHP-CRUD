<?php 
    if(isset($_POST['btn'])) {
        include_once 'simplexlsx.class.php';
        $xlsx = new SimpleXLSX($_FILES['file']['tmp_name']);
        list($cols,) = $xlsx->dimension();
        echo $cols;
        foreach( $xlsx->rows() as $k => $r) {
            if ($k == 0) continue; // skip first row
            for( $i = 1; $i <= $cols; $i++) {
                if ($r[1] != "" && $i<=4) {
                    $array[$k] = $r;
                }
            }
        }

        foreach($array as $item) {
            // mysqli_query($DB,"INSERT INTO `place` (`col1`,`col2`)
            //         VALUES('{$item[0]}','{$item[1]}')");

           
        }
    }
?>
<form method="post" action="" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" value="send" name="btn">
</form>
