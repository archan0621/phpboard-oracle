<?php
  header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
 
<html>
<head>
        <meta charset = 'utf-8'>
</head>
<style>
        table{
                border-top: 1px solid #444444;
                border-collapse: collapse;
        }
        tr{
                border-bottom: 1px solid #444444;
                padding: 10px;
        }
        td{
                border-bottom: 1px solid #efefef;
                padding: 10px;
        }
        table .even{
                background: #efefef;
        }
        .text{
                text-align:center;
                padding-top:20px;
                color:#000000
        }
        .text:hover{
                text-decoration: underline;
        }
        a:link {color : #57A0EE; text-decoration:none;}
        a:hover { text-decoration : underline;}
</style>
<body>
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
             
             // $connect = mysqli_connect('localhost', 'root', 'root', 'board') or die ("connect fail");
                $conn = oci_connect($dbuser, $dbpass, $dbsid, 'AL32UTF8');
                //$query ="select * from (select A.*, ROWNUM RNUM FROM (SELECT info.IN_ID, TO_CHAR(d.D_DATE, 'YYYY-MM-DD HH24:MI:SS') AS d_date, info.IN_NAME FROM d, info WHERE d.D_SEQ = info.IN_SEQ order by d_date)A WHERE ROWNUM <=1000) WHERE RNUM>=617";
/*view all data*/ $query = "SELECT info.IN_ID, TO_CHAR(d.D_DATE, 'YYYY-MM-DD HH24:MI:SS') AS d_date, info.IN_NAME FROM d, info WHERE d.D_SEQ = info.IN_SEQ order by d_date";
                $result = oci_parse($conn,$query);
                oci_execute($result);

                $total = oci_num_rows($result);
 
                session_start();
                
                if(isset($_SESSION['userid'])) {
                        echo $_SESSION['userid'];?>님이(가) 접속중입니다.
                        <br/>
                <button onclick="location.href='./logout.php'" style="margin-left:200px; vertical-align=top;">로그아웃</button>
        <?php
                }
                else {
        ?>              <button onclick="location.href='./login.php'">로그인</button>
                        <br />
        <?php   }
        ?>
        <h1>php+xammp+oracle</h1>
        <h2 align=center>계량기</h2>
        <table align = center>
        <thead align = "center">
        <tr>
        <!-- <td width ="80" align="center">고유번호</td> -->
        <td width = "50" align="center">계량기 번호</td>
        <td width = "500" align = "center">데이터 입력시간</td>
        <td width = "100" align = "center">지역</td>
        </tr>

        </thead>
 
        <tbody>
        <?php
        
                while ($rows = oci_fetch_assoc($result)) { //DB에 저장된 데이터 수 (열 기준)
                        
                        if ($total % 2 == 0) {
                                ?>
                                <tr class = "even">
                                <?php
                        } else {
                                ?>
                                <tr>
                                <?php
                        }
                ?>
                <!-- <td width = "50" align = "center"><?php echo $total?></td> -->
                <td width = "500" align = "center">
                <a href = "view.php?number=<?php echo $rows['numbers']?>">
                <?php echo $rows['IN_ID']?></td>
                  <td width = "100" align = "center"><?php echo $rows['D_DATE']?></td>
                <td width = "200" align = "center"><?php echo $rows['IN_NAME']?></td>
                </tr>
        <?php
                $total--;
                }
        ?>
        </tbody>
        </table>
        <div class = text>
        <button><font style="cursor: hand"onClick="location.href='./write.php'">글쓰기</font></butoon>
        </div>
</body>
</html>