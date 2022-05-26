<?php 

$connect=new PDO("mysql:host=localhost;dbname=vue-php;charset=utf8","root","");

#รับค่าที่ส่งมา
$request_data=json_decode(file_get_contents("php://input"));
//var_dump($request_data);
$data=array();

if($request_data->action=="insert"){
    $data=array(":fname"=>$request_data->fname , ":lname"=>$request_data->lname);
    $query= "INSERT INTO users (fname,lname) VALUES(:fname,:lname)";
    $statement=$connect->prepare($query);
    $statement->execute($data);
    $output=array("message"=>"Insert Complete");
    echo json_encode($output);
}
if($request_data->action=="getAll"){
    
    $query= "SELECT * FROM users";
    $statement=$connect->prepare($query);
    $statement->execute();
    
    while($row=$statement->fetch(PDO::FETCH_ASSOC)){
        $data[]=$row;
    }
    //var_dump($data); 
    echo json_encode($data);
}
if($request_data->action=="getEditUser"){
    
    $query= "SELECT * FROM users WHERE id = $request_data->id ";
    $statement=$connect->prepare($query);
    $statement->execute();
    
    while($row=$statement->fetch(PDO::FETCH_ASSOC)){
        $data['id']=$row['id'];
        $data['fname']=$row['fname'];
        $data['lname']=$row['lname'];
    }
    //var_dump($data); 
    echo json_encode($data);
}
if($request_data->action=="update"){
    
    $data=array(":fname"=>$request_data->fname , ":lname"=>$request_data->lname,":id"=>$request_data->id);
    $query= "UPDATE users SET fname=:fname ,lname=:lname WHERE id=:id";
    $statement=$connect->prepare($query);
    $statement->execute($data);
    $output=array("message"=>"Update data Complete");
    echo json_encode($output);
}
if($request_data->action=="deleteUser"){
    
    $query= "DELETE FROM users WHERE id = $request_data->id ";
    $statement=$connect->prepare($query);
    $statement->execute();
    $output=array("message"=>"DELETE Complete");
    //var_dump($data); 
    echo json_encode($output);
}
?>