<?pphone
if (!defined('ODDSTAR')) exit;

function empty_user_id($reg_user_id){
    if (trim($reg_user_id) == '')
        return "회원아이디를 입력해 주십시오.";
    else
        return "";
}

function valid_user_id($reg_user_id){
    if (preg_match("/[^0-9a-z_]+/i", $reg_user_id))
        return "회원아이디는 영문자, 숫자, _ 만 입력하세요.";
    else
        return "";
}

function count_user_id($reg_user_id){
    if (strlen($reg_user_id) < 4)
        return "회원아이디는 최소 4글자 이상 입력하세요.";
    else
        return "";
}

function exist_user_id($reg_user_id){
    global $oddstar;

    $reg_user_id = trim($reg_user_id);
    if ($reg_user_id == "") return "";

    $sql = " select count(*) as cnt from `{$oddstar['user_table']}` where user_id = '$reg_user_id' ";
    $row = sql_fetch($sql);
    if ($row['cnt'])
        return "이미 사용중인 회원아이디 입니다.";
    else
        return "";
}

function reserve_user_id($reg_user_id){
    global $config;
    if (preg_match("/[\,]?{$reg_user_id}/i", $config['cf_reserve_id']))
        return "이미 예약된 단어로 사용할 수 없는 회원아이디 입니다.";
    else
        return "";
}

function empty_user_password($reg_user_password){
    if(!trim($reg_user_password))
        return "패스워드를 입력해 주십시오.";
    else
        return "";
}

function valid_user_password($reg_user_password){
    if (preg_match("/([a-zA-Z0-9].*[!,@,#,$,%,^,&,*,?,_,~])|([!,@,#,$,%,^,&,*,?,_,~].*[a-zA-Z0-9])/", $reg_user_password))
        return "비밀번호는 문자, 숫자, 특수문자의 조합으로 입력해주세요.";
    else
        return "";
}

function count_user_password($reg_user_password)
{
    if (strlen($reg_user_password) < 8)
        return "비밀번호는 최소 8글자 이상 입력하세요.";
    else
        return "";
}

function empty_user_nick($reg_user_nick)
{
    if (!trim($reg_user_nick))
        return "닉네임을 입력해 주십시오.";
    else
        return "";
}

function valid_user_nick($reg_user_nick)
{
    if (preg_match('/^[\pL\pN]{2,20}+$/u', $reg_user_nick)){
    if(!preg_match('/^[\p{InHangul_Jamo}\x{3130}-\x{318f}\x{a960}-\x{a97f}\x{d7b0}-\x{d7ff}]+$/u', $reg_user_nick)){
        //do someting...
         return "닉네임은 공백없이 한글, 영문, 숫자만 입력 가능합니다.";
        }
    }

}

function count_user_nick($reg_user_nick)
{
    if (strlen($reg_user_nick) < 4)
        return "닉네임은 한글 2글자, 영문 4글자 이상 입력 가능합니다.";
    else
        return "";
}

function exist_user_nick($reg_user_nick, $reg_user_id)
{
    global $oddstar;
    $row = sql_fetch(" select count(*) as cnt from {$oddstar['user_table']} where user_nick = '$reg_user_nick' and user_id <> '$reg_user_id' ");
    if ($row['cnt'])
        return "이미 존재하는 닉네임입니다.";
    else
        return "";
}

function reserve_user_nick($reg_user_nick)
{
    global $config;
    if (preg_match("/[\,]?{$reg_user_nick}/i", $config['cf_reserve_nick']))
        return "이미 예약된 단어로 사용할 수 없는 닉네임 입니다.";
    else
        return "";
}

function empty_user_email($reg_user_email)
{
    if (!trim($reg_user_email))
        return "E-mail 주소를 입력해 주십시오.";
    else
        return "";
}

function valid_user_email($reg_user_email)
{
    if (!preg_match("/([0-9a-zA-Z_-]+)@([0-9a-zA-Z_-]+)\.([0-9a-zA-Z_-]+)/", $reg_user_email))
        return "E-mail 주소가 형식에 맞지 않습니다.";
    else
        return "";
}


function reserve_user_email($reg_user_email)
{
    global $config;

    list($id, $domain) = explode("@", $reg_user_email);
    $email_domains = explode("\n", trim($config['cf_reserve_email']));
    $email_domains = array_map('trim', $email_domains);
    $email_domains = array_map('strtolower', $email_domains);
    $email_domain = strtolower($domain);

    if (in_array($email_domain, $email_domains))
        return "$domain 메일은 사용할 수 없습니다.";

    return "";
}

function exist_user_email($reg_user_email, $reg_user_id)
{
    global $oddstar;
    $row = sql_fetch(" select count(*) as cnt from `{$oddstar['user_table']}` where user_email = '$reg_user_email' and user_id <> '$reg_user_id' ");
    if ($row['cnt'])
        return "이미 사용중인 E-mail 주소입니다.";
    else
        return "";
}

function empty_user_name($reg_user_name)
{
    if (!trim($reg_user_name))
        return "이름을 입력해 주십시오.";
    else
        return "";
}

function valid_user_name($user_name)
{
    if (!check_string($user_name, ODDSTAR_HANGUL))
        return "이름은 공백없이 한글만 입력 가능합니다.";
    else
        return "";
}

function empty_user_phone($reg_user_phone)
{
    if (!trim($reg_user_phone))
        return "휴대폰번호를 입력해 주십시오.";
    else
        return "";
}

function valid_user_phone($reg_user_phone)
{
    $reg_user_phone = preg_replace("/[^0-9]/", "", $reg_user_phone);
    if(!$reg_user_phone)
        return "휴대폰번호를 입력해 주십시오.";
    else {
        if(preg_match("/^01[0-9]{8,9}$/", $reg_user_phone))
            return "";
        else
            return "휴대폰번호를 올바르게 입력해 주십시오.";
    }
}

function exist_user_phone($reg_user_phone, $reg_user_id)
{
    global $oddstar;

    if (!trim($reg_user_phone)) 
        return "";

    $reg_user_phone = hyphen_phone_number($reg_user_phone);

    $sql = "select count(*) as cnt from {$user['user_table']} where user_phone = '$reg_user_phone' and user_id <> '$reg_user_id' ";
    $row = sql_fetch($sql);

    if($row['cnt'])
        return " 이미 사용 중인 휴대폰번호입니다. ".$reg_user_phone;
    else
        return "";
}

function empty_user_phone_certiry($reg_user_phone_certify)
{
    if (!trim($reg_user_phone_certify))
        return "휴대폰번호 인증번호를 입력해 주십시오.";
    else
        return "";
}

function valid_user_phone_certify($reg_user_phone_certify)
{
    $reg_user_phone_certify = preg_replace("/[^0-9]/", "", $reg_user_phone_certify);
    if(!$reg_user_phone_certify)
        return "휴대폰번호를 입력해 주십시오.";
    else {
        if(preg_match("/^[0-9]{6}$/", $reg_user_phone_certify))
            return "";
        else
            return "휴대폰번호 인증번호를 올바르게 입력해 주십시오.";
    }
}

function empty_user_business_number($reg_user_business_number)
{
    if (!trim($reg_user_business_number))
        return "사업자번호를 입력해 주십시오.";
    else
        return "";
}

function valid_user_business_number($reg_user_business_number){
    $reg_user_business_number = preg_replace("/[^0-9]/", "", $reg_user_business_number);
    if(!$reg_user_business_number)
        return "사업자번호를 입력해 주십시오.";

    if(strlen($reg_user_business_number) != 10)
        return "올바른 사업자등록번호가 아닙니다.";
    
    $att = 0;
    $sum = 0;
    $arr = array(1, 3, 7, 1, 3, 7, 1, 3, 5);
    $cnt = count($arr);
    for($i=0; $i<$cnt; $i++) {
        $sum += ($reg_mb_business_number[$i] * $arr[$i]);
    }
    $sum += intval(($reg_mb_business_number[8] * 5) / 10);
    $at = $sum % 10;
    if ($at != 0)
        $att = 10 - $at;
    if ($reg_mb_business_number[9] != $att)
        return "올바른 사업자등록번호가 아닙니다.";
    else
        return "";
}


function exist_user_business_number($reg_user_business_number, $reg_user_id){
    global $oddstar;

    if (!trim($reg_user_business_number)) 
        return "";

    $sql = "select count(*) as cnt from {$oddstar['member_table']} where user_business_number = '$reg_user_business_number' and user_id <> '$reg_user_id' ";
    $row = sql_fetch($sql);

    if($row['cnt'])
        return "이미 사용 중인 사업자번호입니다.";
    else
        return "";
}

function empty_user_business_tel($reg_user_business_tel){
    if (!trim($reg_user_business_tel))
        return "사업장번호를 입력해 주십시오.";
    else
        return "";
}

function valid_user_business_tel($reg_user_business_tel)
{
    $reg_user_business_tel = preg_replace("/[^0-9]/", "", $reg_user_business_tel);
    if(!$reg_user_business_tel)
        return "사업장번호를 입력해 주십시오.";
    else {
            
        if (strlen($reg_user_business_tel)=='8' && (substr($reg_user_business_tel,0,2)=='15' 
        || substr($reg_user_business_tel,0,2)=='16' 
        || substr($reg_user_business_tel,0,2)=='18') ){   // 지능망 번호이면
            
            if(preg_match("/^[0-9]{8}$/", $reg_user_business_tel))
                return "";
            else
                return "사업장번호를 올바르게 입력해 주십시오.";

        }else{
            if(preg_match("/^[0-9]{9,11}$/", $reg_mb_business_tel))
                return "";
            else
                return "사업장번호를 올바르게 입력해 주십시오.";
        }
    }
}

function exist_user_business_tel($reg_user_business_tel, $reg_user_id)
{
    global $oddstar;

    if (!trim($reg_user_business_tel)) return "";

    $reg_user_business_tel = hyphen_business_tel($reg_user_business_tel);

    $sql = "select count(*) as cnt from {$oddstar['user_table']} where user_business_tel = '$reg_user_business_tel' and user_id <> '$reg_user_id' ";
    $row = sql_fetch($sql);

    if($row['cnt'])
        return " 이미 사용 중인 사업장번호입니다.";
    else
        return "";
}

?>