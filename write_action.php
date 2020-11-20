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
                // $connect = mysqli_connect("localhost", "root", "root", "board") or die("fail");
                $conn = oci_connect($dbuser, $dbpass, $dbsid);
                $id = $_GET['name'];                      //Writer
                $pw = $_GET['pw'];                        //Password
                $title = $_GET['title'];                  //Title
                $content = $_GET['content'];              //Content
                $date = date('Y-m-d H:i:s');            //Date
 
                $URL = './index.php';                   //return URL
 
 
                $query = "insert into board (BOARD_NUMBER,BOARD_TITLE, BOARD_CONTENT, BOARD_ID, BOARD_PASSWORD, BOARD_DATE, BOARD_HIT) 
                        values(null,'$title', '$content', '$id','$pw', '$date', 0)";
 
 
                $result = oci_parse($conn,$query);
                if($result){
?>                  <script>
                        // alert("<?php echo "글이 등록되었습니다."?>");
                        // location.replace("<?php echo $URL?>");
                    </script>
<?php
                }
                else{
                        echo "FAIL";
                }
 
                oci_close($conn);
?>