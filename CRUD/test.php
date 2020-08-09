<?php
   function test(){
    require_once './DAL/dbContext.php';

   
    $stmt = $conn->query("CALL GetALL()");
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
    $stmt->nextRowset();
    var_dump($data);
   }

   test();