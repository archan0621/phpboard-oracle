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
$conn = oci_connect($dbuser, $dbpass, $dbsid, 'AL32UTF8');

header( "Content-type: application/vnd.ms-excel; charset=utf-8");

header( "Content-Disposition: attachment; filename = data.xls" );     

header( "Content-Description: PHP4 Generated Data" );

$EXCEL_FILE = "

<table border='1'>

    <tr>

       <td>number</td>

       <td>time</td>

       <td>value</td>

       <td>degree</td>

       <td>conver</td>

    </tr>

";

$qry = "select * from d";

$result = oci_parse($conn,$qry);
oci_execute($result);

while ($row = $result->fetch_object()) {

$EXCEL_FILE .= "
    <tr>
       <td>".$row->D_SEQ."</td>
       <td>".$row->D_DATEA."</td>
       <td>".$row->D_ENERGY."</td>
       <td>".$row->D_WH."</td>
       <td>".$row->D_PT."</td>
    </tr>
";

}

$EXCEL_FILE .= "</table>";

echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";

echo $EXCEL_FILE;

?>