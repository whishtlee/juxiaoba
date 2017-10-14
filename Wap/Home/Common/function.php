<?php
function review($id){
	$obj=D('user_review');
	$review=$obj->where('joke_id='.$id.' and status=2')->count();
	return $review;
}

function level($username){
	$obj=D('user');
	$level=$obj->where('username="'.trim($username).'"')->find();
	return $level['level'];
}

function levelname($username){
	$obj=D('user');
	$level=$obj->where('username="'.trim($username).'"')->find();
	$level=(int)$level['level'];
	if($level>=1 && $level<10){
		$level='初入虾囧';
	}elseif ($level>=10 && $level<20) {
		$level='虾囧弟子';
	}elseif ($level>=20 && $level<30) {
		$level='虾囧新秀';
	}elseif ($level>=30 && $level<40) {
		$level='虾囧少侠';
	}elseif ($level>=40 && $level<50) {
		$level='虾囧大侠';
	}elseif ($level>=50 && $level<60) {
		$level='虾囧豪侠';
	}elseif ($level>=60 && $level<70) {
		$level='虾囧掌门';
	}elseif ($level>=70 && $level<80) {
		$level='初入宗师';
	}elseif ($level>=80 && $level<90) {
		$level='初入盟主';
	}else{
		$level='独孤求败';
	}
	return $level;
}

//检查是否关注
function check_follow($uid,$tuid) {
    $fans = D('user_fans')->where('uid='.$uid)->find();
    if($fans && trim($fans['follow_uids']) != '') {
        $uids = explode('|', $fans['follow_uids']);
        array_shift($uids);
        array_pop($uids);
        /*if(in_array($tuid, $uids)) {
            return 1;
        }*/
        foreach ($uids as $key => $value) {
        	if($value == $tuid) {
        		return 1;
        	}
        }
    }
    return 0;
}