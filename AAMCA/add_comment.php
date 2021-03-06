<?php
$connect = new PDO('mysql:host=localhost;dbname=testing', 'root', '');

$error = '';
$comment_name = '';
$comment_content = '';

if(empty($_post["comment_name"]))
{
    $error = '<p class="text-danger>Name is required</p>';
}
else
{
    $comment_name = $_post["comment_name"];
}

if(empty($_post["comment_content"]))
{
    $error = '<p class="text-danger>Comment is required</p>';   
}
else
{
    $comment_content = $_post["comment_content"];
}

if($error == '')
{
    $query = "
    INSERT INTO tbl_comment
    (parent_comment_id, comment, comment_sender_name)
    VALUES (:parent_comment_id, :comment, :comment_sender_name)
    ";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':parent_comment_id'    =>  '0',
            ':comment'              =>  $comment_content,
            'comment_sender_name'   =>  $comment_name
        )
    );
    $error = '<label class="text-success">Comment Added</label>';
}

$data = array(
    'error'     => $error
);

echo json_encode($data);
?>