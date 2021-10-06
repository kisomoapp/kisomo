<?php
include 'linker.php';
include 'logsRecorder.php';
if($conn)
{
    $username=$_POST['username'];
    $password=md5($_POST['password']);
     $sql="SELECT ss.student_id,ss.user_id,u.fullname,ss.school_login_id,u.password,ss.school_id,s.school_code FROM school_students ss,
     users u,schools s WHERE ss.user_id=u.user_id and ss.school_id=s.school_id and ss.school_login_id=? and u.password=?";
     $stmt=$conn->prepare($sql);
     $stmt->bind_param('ss',$username,$password);     
     $stmt->execute();
     $res=$stmt->get_result();
     $stmt -> close();
     if(mysqli_num_rows($res) > 0)
     {
       $row=$res->fetch_assoc();
       $_SESSION['isLoggedIn']=true;
       $_SESSION['userId']=$row['user_id'];
       $_SESSION['school_id']=$row['school_id'];
       $_SESSION['school_code']=$row['school_code'];
       $_SESSION['studentName']=$row['fullname'];
       $userId=(int)$_SESSION['userId'];

      //commit unsaved data
      
      $res = mysqli_query($conn ,"UPDATE student_logs SET commited='T' WHERE user_id=$userId");

      // end
       $action="logged in";
       recordSigninLog($action);


       echo 'success';
     }
     else
     {
       echo 'error';
     }
 
 }
else{
    echo "connectionProblem";
}
?>