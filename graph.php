<?php
include "start.php";
include "counter.php";



    
?> 
<!DOCTYPE html>
<html>
    

<head>
    <script src= "zingchart.min.js"></script>

    <script>
        // start of first graph
        <?php $data1=mysqli_query($db,"SELECT date, Count(*) As 'Count' FROM `people` Group By date ORDER BY date DESC"); ?>
        // sql 
           var myData1=[<?php 
while($info1=mysqli_fetch_array($data1))
    echo $info1['Count'].','; /* We use the concatenation operator '.' to add comma delimiters after each data value. */
?>];
           
           
           
           <?php
$data1=mysqli_query($db,"SELECT distinct(date) as distinctD FROM people ORDER BY date DESC");
?>

var myLabels=[<?php 
while($info1=mysqli_fetch_array($data1))
    echo '"'.$info1['distinctD'].'",'; /* The concatenation operator '.' is used here to create string values from our database names. */
?>];






// chart 2 data 


<?php $data2=mysqli_query($db,"SELECT distinct(count(comment)) AS countDate,date FROM `people` WHERE comment!='' group by date ORDER BY date DESC"); ?>
        // sql 
           var myData2=[<?php while($info2=mysqli_fetch_array($data2)) echo $info2['countDate'].','; ?>];

           
           <?php
$data2=mysqli_query($db,"SELECT distinct(date) as distinctD FROM people ORDER BY date DESC");
?>

var myLabels2=[<?php 
while($info2=mysqli_fetch_array($data2))
    echo '"'.$info2['distinctD'].'",'; /* The concatenation operator '.' is used here to create string values from our database names. */
?>];


// chart 3


<?php $data3=mysqli_query($db,"SELECT date, Count(*) As 'Count' FROM `people` WHERE date >= current_date - 7 Group By date ORDER BY date DESC"); ?>
        // sql 
           var myData3=[<?php 
while($info3=mysqli_fetch_array($data3))
    echo $info3['Count'].','; /* We use the concatenation operator '.' to add comma delimiters after each data value. */
?>];
           
           <?php
$data3=mysqli_query($db,"SELECT distinct(date) as distinctD FROM people ORDER BY date DESC");
?>

var myLabels3=[<?php 
while($info3=mysqli_fetch_array($data3))
    echo '"'.$info3['distinctD'].'",';
    echo '"'.$info3['id'].'",';/* The concatenation operator '.' is used here to create string values from our database names. */
?>];


    </script>
    <script>
    
    window.onload=function(){
    
    zingchart.render({ 
	id : "myChart1",
    
    
	 data:{
    "type":"bar",
    "title":{
        "text":"Number of Purchases each day"
    },
    "scale-x":{
        "labels":myLabels
    },
    "series":[
        {
            "values":myData1, 

        }
        ]

    ,
    "plot":{
        "exact":1,
        "shadow":1,
        "alpha":1,
        "shadow-distance":1,
        "stacked":0,
        "line-width":2,
        "slice-start":15,
        "value-box":{
            "visible":0
        },
        "animation":{
          "effect":"3",
          "speed":"1000",
          "method":"5",
          "sequence":"1"
        },
    }
    
    }});
    
    zingchart.render({ 
	id : "myChart2",
    
	 data:{
    "type":"area",
    "title":{
        "text":"Number of Comments per day"
    },
    "scale-x":{
        "labels":myLabels2
    },
    "series":[
        {
            "values":myData2
        }
        ]

    }});
    
    zingchart.render({ 
	id : "myChart3",

    
	 data:{
    "type":"bar",
    "title":{
        "text":"Number of Purchases in the past week"
    },
    "scale-x":{
        "labels":myLabels3
    },
    "series":[
        {
            "values":myData3
        }
        ]

    }});
    };
    
    
    </script>
    
 
</head>    
<body>
    
    <button style="background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;" onclick="goBack()"> ← Go Back</button>
    
    <script>
function goBack() {
    window.history.back();
}
</script>
    
  
    <div id='visitCount' style="text-align:center; font-size: 2em;">
    <?php
    echo "Number of Page Visits: " ;
    ?>
    <p></p>
    <?php
    echo "\n" ;
echo "$count" ;
echo "\n" ;
    
    ?>
    </div>
    <div id='myChart1' style="text-align:center; width:600px; height: 500px; float: left;"></div>
    <div id='myChart2' style="text-align:center; width:600px; height: 500px; float:right; margin-right: 100px;"></div>
    <div id='myChart3' style="text-align:center;width:600px; height: 500px; float:left;"></div>
		
		<div style= "float:right; margin-right: 200px; font-size: 1.5em;">
			<b>What people are commenting..</b>
			<p></p>
			<?php
			
			$sql1 = "SELECT * FROM people WHERE comment != '' Order By id Desc LIMIT 10";
			$result = mysqli_query($db, $sql1);
			
			if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo $row["comment"]. "<br>";
    }
		} else {
    echo "0 results";
}
			
			?>
			
			
			
			
		</div>
    
</body>

</html>