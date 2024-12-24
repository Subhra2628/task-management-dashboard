<?php   
include 'Task_database.php';
if($_SERVER['REQUEST_METHOD']==='POST')
{
    $name=$_POST['name'];
    $password=$_POST['password'];
    $sql="SELECT * FROM admin_db WHERE name=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("s",$name);
    $stmt->execute();
    $result=$stmt->get_result()->fetch_assoc();
   
    if($result)
    {
        $stored=$result['password'];

        if(password_verify($password,$stored))
        {
           header("Location: admin_dashboard.php");
            exit;
        }
    
        else
        {
            echo"<br><div style='color: red; display: flex; height: 
        100vh; justify-content: center; align-items: center;'>
        <p>Your Entered Password Not Match</p></div>";
        }
    }
    $stmt->close();
}