<?php

    $dbuser="system";
    $dbpass="root";
    
    $dbsid = "(
      DESCRIPTION =
      (ADDRESS_LIST = 
       (ADDRESS = 
        (PROTOCOL = TCP)
        (HOST = localhost)
        (PORT = 1521)
       )
      )
      
      (CONNECT_DATA =
       (SERVER = DEDICATED)
       (SERVICE_NAME = XE)
      )
    ) ";
    
    $conn = @oci_connect($dbuser,$dbpass,$dbsid);
    
    if(!$conn) {
      echo "No Connection ".oci_error();
      exit;
    } else {
     echo "Connect Success!";
    }
    
    $query = 'select * from dual';
    
    $stmt = oci_parse($conn,$query);
    oci_execute($stmt);
    
    
    while($row = oci_fetch_assoc($stmt))
    {
        print_r($row);
    }
    
    
    // 오라클 접속 닫기 
    oci_free_statement($stmt);
    // 오라클에서 로그아웃 
    oci_close($conn); 
    ?>