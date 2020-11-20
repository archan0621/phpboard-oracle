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
  $query ="select * from (select A.*, ROWNUM RNUM FROM (SELECT info.IN_ID,  d.D_ENERGY, d.D_WH, d.D_PT,d.D_DEGREE ,info.IN_NAME FROM d, info WHERE d.D_SEQ = info.IN_SEQ order by d_date)A WHERE ROWNUM <=1000) WHERE RNUM>=809";
  $result = oci_parse($conn,$query);
  oci_execute($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .highcharts-figure, .highcharts-data-table table {
  min-width: 360px; 
  max-width: 1000px;
  margin: 1em auto;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	max-width: 500px;
}
.highcharts-data-table caption {
  padding: 1em 0;
  font-size: 1.2em;
  color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
  padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
  padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
  background: #f8f8f8;
}
.highcharts-data-table tr:hover {
  background: #f1f7ff;
}
    </style>
</head>
<body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<figure class="highcharts-figure">
  <div id="container"></div>
  <p class="highcharts-description">
    Basic line chart showing trends in a dataset. This chart includes the
    <code>series-label</code> module, which adds a label to each line for
    enhanced readability.
  </p>
</figure>
<?php
while ($row = oci_fetch_array($result)) {
       $energy[] = $row['D_ENERGY'];
       $pt[] = $row['D_PT'];
       $wh[] = $row['D_WH'];
       $degree[] = $row['D_DEGREE'];
}
?>
<script>
    Highcharts.chart('container', {

title: {
  text: 'Solar Employment Growth by Sector, 2010-2016'
},

subtitle: {
  text: 'Source: thesolarfoundation.com'
},

yAxis: {
  title: {
    text: 'Number of Employees'
  }
},

xAxis: {
  accessibility: {
    rangeDescription: 'Range: 2010 to 2017'
  }
},

legend: {
  layout: 'vertical',
  align: 'right',
  verticalAlign: 'middle'
},

plotOptions: {
  series: {
    label: {
      connectorAllowed: false
    },
    pointStart: 2010
  }
},

series: [{
  name: 'WH',
  data: [<?php echo join($energy, ',') ?>]
 } ,{
  name: 'PT',
  data: [<?php echo join($pt,',')?>]
 }, {
   name: 'Sales & Distribution',
   data: [<?php echo join($wh,',')?>]
 }, {
   name: 'Project Development',
   data: [<?php echo join($degree,',')?>]
// }, {
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
// },{
//   name: 'Other',
//   data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
  }],

responsive: {
  rules: [{
    condition: {
      maxWidth: 1000
    },
    chartOptions: {
      legend: {
        layout: 'horizontal',
        align: 'center',
        verticalAlign: 'bottom'
      }
    }
  }]
}

});
</script>
</body>
</html>

