<?php
$connect = mysqli_connect("localhost", "root","", "kotha");

$output = '';

$sq = "SELECT COUNT(*) FROM allbook";
$count = 0;
if ($re = mysqli_query($connect, $sq)) {
    $r = mysqli_fetch_row($re);
    $count = $r[0];
}
echo "<B>TOTAL NUMBER OF BOOKS:</B>";
echo $count;
echo "<br>";

if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);

$query = "
  SELECT * FROM allbook
  WHERE 
 category LIKE '%".$search."%' 
  OR book_no LIKE '%".$search."%' 
  OR author LIKE '%".$search."%' 
  OR rack_no LIKE '%".$search."%'
 ";

}

else
{
 $query = "
  SELECT * FROM  allbook  ORDER BY book_no ASC";

}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)


{
 $output .= '

   <table class="table table bordered" cellpadding="30" border="1">
    
<tr>

<th><big>BOOK NUMBER</th>
     
<th><big>TITLE</th>

     <th><big>CATEGORY</th>
     

    
 <th><big>AUTHOR</th>
   
  <th><big>RACK</th>

<th><big>AVALIBLE</th>
    </pr>
 ';
 
while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>

   <td>'.$row["book_no"].'</td>
  
  <td>'.$row["title"].'</td>
 
   <td>'.$row["category"].'</td>
 
  
  
  <td>'.$row["author"].'</td>
   
 <td>'.$row["rack_no"].'</td>

<td>'.$row["available"].'</td>
   </pr>
  ';

 }

 echo ".$output.";

}
else

{
 
echo 'Data Not Found';

}
?>