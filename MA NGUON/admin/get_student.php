<?php 
require_once("includes/config.php");
if(!empty($_POST["studentid"])) {
  $studentid= strtoupper($_POST["studentid"]);
 
    $sql ="SELECT FullName,Status FROM tblstudents WHERE StudentId=:studentid";
$query= $dbh -> prepare($sql);
$query-> bindParam(':studentid', $studentid, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
foreach ($results as $result) {
if($result->Status==0)
{
echo "<span style='color:red'> ID học sinh bị khóa </span>"."<br />";
echo "<b>Student Name-</b>" .$result->FullName;
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else {
?>


<?php  
echo htmlentities($result->FullName);
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
}
 else{
  
  echo "<span style='color:red'> Id sinh viên không hợp lệ. Vui lòng nhập id sinh viên hợp lệ.</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
}



?>
