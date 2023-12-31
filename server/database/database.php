<?php

function query ($sql,$data = [],$check = 'false') {
    global $connect;
    $status = false;
     //echo $sql;
     //die();


    try {
        $statements = $connect -> prepare($sql);
       
        if(!empty($data)) {
            $status = $statements->execute($data);
            
        }
        else {
            $status = $statements->execute();
            
        }
    }
    catch(Exception $e) {
        echo "Failed: ". $e->getMessage();
        echo "line:" . $e ->getLine();  
        die();
    }
    if($check) {
        return $statements;
    }
    return $status;
}

//hàm insert
function insert ($table,$data) {
    $keys = array_keys($data);
    $truong = implode(",",$keys);
    $value = ':'.implode(",:",$keys);

    $sql = 'INSERT INTO '.$table.'('.$truong.') VALUES ('. $value.')';

    $kq = query($sql,$data);
    return $kq;
}

//hàm update
function update ($table,$data, $condition='') {
    $update = '';
    foreach ($data as $key => $value) {
        $update .= $key.' = :'.$key.',';
    }
    $update = trim($update,',');
    if(!empty($condition)) {
        $sql = 'UPDATE '.$table.' SET '.$update. ' WHERE '.$condition;
    }
    else {
        $sql = 'UPDATE '.$table.' SET '.$update;
    }
    $kq = query($sql,$data);
    return $kq;
}

//hàm delete 
function delete ($table, $condition ='') {
    if(empty($condition)){
        $sql = 'DELETE FROM ' .$table;
    }
    else {
        $sql = 'DELETE FROM ' .$table .' WHERE '. $condition;
    }
    $kq = query($sql);
    return $kq;
}

// hàm select
//lấy nhiều user
function select_users ($sql) {
    $kq = query($sql,'',true);
    if(is_object($kq)) {
        $dataFetch = $kq ->fetchAll(PDO::FETCH_ASSOC);
    }
    return $dataFetch;
}

//lấy 1 user
function select_user ($sql) {
    $kq = query($sql,'',true);
    if(is_object($kq)) {
        $dataFetch = $kq ->fetch(PDO::FETCH_ASSOC);
    }
    return $dataFetch;
}

function count_user ($sql) {
    $kq = query($sql,'',true);
    if(!empty($kq)) {
        return $kq -> rowCount();
    }
    
}
?>