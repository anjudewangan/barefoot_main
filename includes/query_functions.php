<?php
class Query_Functions extends sqlConnection
{


	//------------------Admin Login--------------------
	public function AdminLogin($data)
	{

		$user = $this->getRequest($data['user']);
		$password = $this->getRequest($data['password']);
		$sql_adminlog = $this->query("select id, username from admins where username='" . $user . "' AND password = '" . md5($password) . "' AND isactive=1 limit 0,1");
		return $sql_adminlog->rows;
	}

	//------------------Admin Current Password--------------------
	public function CurrentPassword($cpass)
	{
		$cpassword = $this->getRequest($cpass);
		$sql_passs = $this->query("select id from admins where id=1 AND password='" . md5($cpassword) . "' limit 0,1");

		return $sql_passs->num_rows;
	}

	//----------------Admin Password Edit-------------------
	public function AdminPasswordEdit($data)
	{
		$npass = $this->getRequest($data["npass"]);
		$this->query("Update admins set password='" . md5($npass) . "' where id=1");
	}

	//------------------Excute Product Shopping Listing--------------------
	public function QueryExecuteList($sql_execute)
	{
		$rs_productlist = $this->query($sql_execute);
		return $rs_productlist->rows;
	}

	//------------------Excute Num Rows--------------------
	public function numRows($rowquery)
	{
		$sql_rows = $this->query($rowquery);
		return $sql_rows->num_rows;
	}


	//------------------Delete Records--------------------
	public function DeleteRecords($tablname, $id)
	{
		$this->query("Delete from " . $tablname . " where id='" . $id . "'");
		return 1;
	}


	//------------------Contact Listed--------------------
	public function Contact_List()
	{
		$sql_data = $this->query("select * from contacts order by id desc");
		return $sql_data->rows;
	}

	//------------------Registration Transaction Listed--------------------
	public function Transaction_List()
	{
		$sql_data = $this->query("select * from register_transactions order by id desc");
		return $sql_data->rows;
	}

	//------------------Contact Create--------------------
	public function contact_Create($data)
	{
		$this->query("Insert into contacts set name='" . input_fields($data['conatct_name']) . "', email='" . input_fields($data['conatct_email']) . "', message='" . input_fields($data['conatct_message']) . "', created_at='" . date('Y-m-d H:i:s') . "'");
	}

	//------------------Transaction Create--------------------
	public function transaction_Create($data)
	{
		$this->query("Insert into register_transactions set name='" . input_fields($data['name']) . "', age='" . input_fields($data['age']) . "', email='" . input_fields($data['email']) . "', phone_no='" . input_fields($data['phone_no']) . "', gender='" . input_fields($data['gender']) . "', location='" . input_fields($data['location']) . "', attended_classes='" . input_fields($data['attended_classes']) . "', hear_about='" . input_fields($data['hear_about']) . "', course='" . input_fields($data['course']) . "', course_plan='" . input_fields($data['coursePlan']) . "', payment_method='" . input_fields($data['payment_method']) . "', payment_id='" . input_fields($data['payment_id']) . "', order_id='" . input_fields($data['order_id']) . "', amount='" . input_fields($data['amount']) . "', status='" . input_fields($data['status']) . "', created_at='" . date('Y-m-d H:i:s') . "'");
	}
}
