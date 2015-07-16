<?php
$mysqli = new mysqli('localhost', 'root', '','pakblood');
//$db = mysql_select_db('pakblood', $resource1)
//or die ("Couldn't select database.");
//$sql = "INSERT INTO pb_admin (id, login, password, role) SELECT admin_id,login,password,role FROM blood_admin";
//$sql = "INSERT INTO pb_cities (id, name, sef, status) SELECT city_id,city_name,city_sef,city_status FROM blood_city";
//$sql = "INSERT INTO pb_news (id, title, material, postedby, date) SELECT news_id,news_title,news_material,news_postedby,news_date FROM blood_news";
//$sql = "INSERT INTO pb_user_reports (id, reported_user_id, reporter_user_id, reporter_name, reporter_email,reporter_message,type)SELECT report_id,report_donor,report_by_id,report_by_name,report_by_email,report_message,report_type FROM blood_user_report";
//$sql = "INSERT INTO pb_wish_reply (id, user_id, name, email, message,created_at)SELECT id,reply_id,reply_name,reply_email,reply_detail,reply_date FROM blood_wish_reply";
//$sql = "INSERT INTO pb_wish (id, title, postedby, email, message,contact,created_at)SELECT wish_id,wish_title,wish_postedby,wish_email,wish_material,wish_contact,wish_date FROM blood_wish";
//$sql = "INSERT INTO pb_org (id, username, password, name, address,phone,mobile,city_id,image,admin_name,program,email)SELECT institute_id,institute_login,institute_pass,institute_name,institute_address,institute_phone,institute_mobile,institute_cityid,institute_image,institute_admin_name,institute_programe,institute_email FROM blood_institute";
//$sql = "INSERT INTO pb_dir (id, name, type, phone, city_id)SELECT phone_id,phone_name,phone_ttype,phone_phone,phone_city_id FROM blood_phone";
//$sql = "INSERT INTO pb_users (id, username, email, password, name,gender,dob,phone,address,city_id,blood_group,last_bleed,org_id,status,fb_id,created_at)SELECT user_id,user_login,user_email,user_pass,user_name,user_sex,user_dob,user_phone,user_address,user_cityid,user_grp,user_lastbleed,user_eduid,user_status,fb_id,user_pdate FROM blood_user";
//$sql = "INSERT INTO pb_org_join_requests (id, user_id, org_id, reason,created_at)SELECT id,user_id,edu_id,reason,date FROM blood_inst_request";

$query = $mysqli->query($sql);

print_r($sql);


?>