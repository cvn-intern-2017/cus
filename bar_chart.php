<?php
//include('db.php');

//$sql = "select * from courses";
//$conn = mysqli_connect("localhost","root","","graphs");
//$query = mysqli_query($conn,$sql);
//while($result = mysqli_fetch_array($query))
//{
//$data[] = array($result['subject'],(int)$result['number']);
//
//}

$data[] = array('Browsers','Click Times');
if(isset($_POST['action'])) {
    switch($_POST['action']) {
        case 'all_time':
            $data[] = array('Firefox', 1);
            break;
        default:
            $data[] = array('Chrome', 2);
    }
}

//	$data = array($data);
echo json_encode($data);
?>
