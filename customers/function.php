<?php
require '../inc/dbcon.php';
function getCustomerList(){

    global $conn;
    $query="SELECT * FROM customers";
    $query_run=mysqli_query($conn,$query);
    if($query_run){
       if(mysqli_num_rows($query_run)>0){
         $res=mysqli_fetch_all($query_run,MYSQLI_ASSOC);
         $data=[
            'status'=>200,
            'message'=>'Customer List Fetched Succeffuly',
            'data'=>$res
        ];
        header("HTTP/1.0 200 OK");
        return json_encode($data);
       }
       else{
        $data=[
            'status'=>404,
            'message'=>'No customer found'
        ];
        header("HTTP/1.0 404 No customer found");
        return json_encode($data);
       }
    }
    else{
        $data=[
            'status'=>500,
            'message'=>'Internal Server Error '
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}
function error422($message){
    $data=[
        'status'=>422,
        'message'=>$message
    ];
    header("HTTP/1.0 422 Unprocess Entity");
    echo json_encode($data);
    exit();
}
function storeCustomer($customerInput){

    global $conn;
    $name=mysqli_real_escape_string($conn,$customerInput['name']);
    $email=mysqli_real_escape_string($conn,$customerInput['email']);
    $phone=mysqli_real_escape_string($conn,$customerInput['phone']);
   if(empty(trim($name))){
   return error422('Enter your name');
   }else if(empty(trim($email))){
    return error422('Enter your email');
   }
   else if(empty(trim($phone))){
    return error422('Enter your phone');
   }
   else{
    $query="INSERT INTO customers(name,email,phone) VALUES('$name','$email','$phone')";
    $result=mysqli_query($conn,$query);
    if($result){
        $data=[
            'status'=>201,
            'message'=>'Customer created Succeffuly',
        ];
        header("HTTP/1.0 201 OK");
        return json_encode($data);
    }
    else{
        $data=[
            'status'=>500,
            'message'=>'Internal Server Error '
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
   }
}
?>