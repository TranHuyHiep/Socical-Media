<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');

    include_once('../../config/DataBase.php');
    include_once('../../model/Comments.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $db = new DataBase();
        $connect = $db->connect();
    
        $comments = new Comments($connect);
    
        $data = json_decode(file_get_contents("php://input"));
    
        $read = $comments->addNewComments($data->user_id, $data->post_id,$data->content);
    
        $list = [];
        if($read) {
            $list['message'] = "New Comment Post";
        } else {
            $list['message'] = "Failed ";
        }
        echo json_encode($list);
    }
   
?>