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
 
        session_start();
 
        // $connect = mysqli_connect("localhost", "root", "root", "board") or die("fail");
        $conn = oci_connect($dbuser,$dbpass,$dbsid);
 
        //입력 받은 id와 password
        @$id=$_GET['id'];
        @$pw=$_GET['pw'];
 
        //아이디 검사
        $query = "select * from member where member_id= '$id'";
        $result = oci_parse($conn,$query);
        oci_execute($result);
                
        //비밀번호 검사
        if (oci_fetch($result)) {
                //$row = oci_result($result, "member_pw");
                $pawd = oci_result($result, "MEMBER_PW");

                $idy = oci_result($result, "MEMBER_ID");

                //비밀번호일치 세션 생성
                if ($pawd== $pw) {
                        $_SESSION['userid']=$id;
                        if(isset($_SESSION['userid'])){       
                        ?>
                              <script>
                                        alert("로그인 되었습니다.");
                                        location.replace("./index.php");
                                </script>
                        <?php
                        
                        } else {
                                echo "session fail";
                        }
                } else {
                        
                        ?>
                        <script>
                                alert("비밀번호가 잘못되었습니다.");
                                history.back();
                        </script>
                        <?php
                        
                }
 
        } else {
                ?>              
                <script>
                        alert("아이디가 잘못되었습니다.");
                        history.back();
                </script>
                <?php
        }
?>