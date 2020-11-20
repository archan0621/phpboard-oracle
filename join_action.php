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
        // $connect = mysqli_connect('localhost', 'root', 'root', 'board') or die("fail");
        $conn = oci_connect($dbuser, $dbpass, $dbsid);
 
        $id = $_GET['id'];
        $pw = $_GET['pw'];
 
        //입력받은 데이터를 DB에 저장
        $query = "insert into member (MEMBER_ID, MEMBER_PW, MEMBER_DATE, PERMIT) values ('$id', '$pw', sysdate, 0)";
        
 
        $result = oci_parse($conn,$query);
        oci_execute($result);
                
        $total = oci_num_rows($result);
        //저장이 됬다면 (result = true) 가입 완료
        if($result) {
        ?>      <script>
                alert('가입 되었습니다.');
                location.replace("./login.php");
                </script>
 
<?php   }
        else{
?>              <script>
                        
                        alert("register fail");
                </script>
<?php   }
        oci_close($conn);
?>

