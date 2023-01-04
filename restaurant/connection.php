<?php 
	$connection = mysqli_connect("localhost", "root", "", "restaurant") or die(mysqli_error($connection));;
	if(!$connection)
	{
		die("Database connection failed: ".mysqli_connect_error());
	}

	//customer_reservation.php
	function addreservationcustomer($isonline,$date,$time,$table_id,$c_first_name,$c_last_name,$c_phone_num,$c_address,$c_birthday)
	{
		global $connection;
		$date_time="{$date} {$time}";
		$sql=mysqli_query($connection,"SELECT * FROM `customer` WHERE `c_first_name`='{$c_first_name}' AND `c_last_name`='{$c_last_name}' AND `c_phone_num`='{$c_phone_num}' AND `c_address`='{$c_address}' AND `c_birthday`='{$c_birthday}'") or die(mysqli_error());
		$count = mysqli_num_rows($sql);
		if($count == 0)
		{
			$date_time="{$date} {$time}";
			$sql="INSERT INTO `customer` (`c_first_name`, `c_last_name`, `c_phone_num`, `c_address`, `c_birthday`) VALUES ('{$c_first_name}', '{$c_last_name}', '{$c_phone_num}', '{$c_address}', '{$c_birthday}');";
			mysqli_query($connection, $sql);
			$sql="INSERT INTO `reservation`(`isonline`, `customer_id`, `date_time`, `table_id`, `reference`) VALUES ('{$isonline}',(SELECT `customer_id` FROM `customer` WHERE `c_first_name`='{$c_first_name}' AND `c_last_name`='{$c_last_name}' AND `c_phone_num`='{$c_phone_num}' AND `c_address`='{$c_address}' AND `c_birthday`='{$c_birthday}'),'$date_time','{$table_id}',0);";
		}
		else
		{
			$sql="INSERT INTO `reservation`(`isonline`, `customer_id`, `date_time`, `table_id`, `reference`) VALUES ('{$isonline}',(SELECT `customer_id` FROM `customer` WHERE `c_first_name`='{$c_first_name}' AND `c_last_name`='{$c_last_name}' AND `c_phone_num`='{$c_phone_num}' AND `c_address`='{$c_address}' AND `c_birthday`='{$c_birthday}'),'$date_time','{$table_id}',0);";
		}
		mysqli_query($connection, $sql);
		header('Location:'.' customer_reservation_finish.php');
	}

	//customer_reservation_employee.php
	function addreservationemployee($isonline,$date,$time,$table_id,$c_first_name,$c_last_name,$c_phone_num,$c_address,$c_birthday,$employee_id)
	{
		global $connection;
		$date_time="{$date} {$time}";
		$sql=mysqli_query($connection,"SELECT * FROM `customer` WHERE `c_first_name`='{$c_first_name}' AND `c_last_name`='{$c_last_name}' AND `c_phone_num`='{$c_phone_num}' AND `c_address`='{$c_address}' AND `c_birthday`='{$c_birthday}'") or die(mysql_error());
		$count = mysqli_num_rows($sql);
		if($count == 0)
		{
			$date_time="{$date} {$time}";
			$sql="INSERT INTO `customer` (`c_first_name`, `c_last_name`, `c_phone_num`, `c_address`, `c_birthday`) VALUES ('{$c_first_name}', '{$c_last_name}', '{$c_phone_num}', '{$c_address}', '{$c_birthday}');";
			mysqli_query($connection, $sql);
			$sql="INSERT INTO `reservation`(`employee_id`,`isonline`, `customer_id`, `date_time`, `table_id`, `reference`) VALUES ('{$employee_id}','{$isonline}',(SELECT `customer_id` FROM `customer` WHERE `c_first_name`='{$c_first_name}' AND `c_last_name`='{$c_last_name}' AND `c_phone_num`='{$c_phone_num}' AND `c_address`='{$c_address}' AND `c_birthday`='{$c_birthday}'),'$date_time','{$table_id}',0);";
		}
		else
		{
			global $connection;
			$sql="INSERT INTO `reservation`(`employee_id`,`isonline`, `customer_id`, `date_time`, `table_id`, `reference`) VALUES ('{$employee_id}','{$isonline}',(SELECT `customer_id` FROM `customer` WHERE `c_first_name`='{$c_first_name}' AND `c_last_name`='{$c_last_name}' AND `c_phone_num`='{$c_phone_num}' AND `c_address`='{$c_address}' AND `c_birthday`='{$c_birthday}'),'$date_time','{$table_id}',0);";
		}
		mysqli_query($connection, $sql);
		?><div class="alert alert-success"><center>Customer's Reservation has been inserted. Add another one!</center></div><?php

	}

	//customer_reservation.php
	//table_waiting_list.php
	function seetable()
	{
		global $connection;
		$sql= "SELECT * FROM `tables` ORDER BY table_id;";
		$results = mysqli_query($connection, $sql);
		
		$result_array = array();
		while ($result = mysqli_fetch_assoc($results))
		{
			$result_array[] = $result;
		}
		//print_r($result_array);
		return $result_array;
	}

	//customer_reservation.php
	function availabilitycheck($date,$time,$table_id)
	{
		global $connection;
		$date_time="{$date} {$time}";
		$sql ="SELECT  reservation.date_time, tables.table_id FROM `reservation` INNER JOIN tables ON reservation.table_id=tables.table_id WHERE reservation.date_time='$date_time' AND tables.table_id={$table_id};";
		$results = mysqli_query($connection, $sql);
		
		$result_array = array();
		while ($result = mysqli_fetch_assoc($results))
		{
			$result_array[] = $result;
		}
		//print_r($result_array);
		return $result_array;
	}

	//customer_waiting_list.php
	function tablecall($id)
	{
		global $connection;
		$sql="SELECT reservation.table_id, reservation.reservation_id, reservation.customer_id ,customer.c_first_name, customer.c_last_name, customer.c_phone_num, customer.c_address ,reservation.date_time FROM reservation INNER JOIN customer ON reservation.customer_id=customer.customer_id WHERE reference=0 AND table_id={$id} ORDER BY reservation.date_time;";
		$results = mysqli_query($connection, $sql);
		
		$result_array = array();
		while ($result = mysqli_fetch_assoc($results))
		{
			$result_array[] = $result;
		}
		//print_r($result_array);
		return $result_array;
	}

	//customer_waiting_list.php
	function cancelreservation($reservation_id)
	{
		global $connection;
		$sql="UPDATE `reservation` SET `reference`=1 WHERE reservation_id={$reservation_id}";
		//echo $sql;
		mysqli_query($connection, $sql);
		?>
		<script type="text/javascript">
			window.location.href=window.location.href;
		</script><?php
	}

	//customer_waiting_list.php//error
	function tablereserved($reservation_id)
	{
		global $connection;
		$id="{$reservation_id}";
		$separate=preg_split("/,/", "$id");
		$reservationid=$separate[0];
		$customerid=$separate[1];
		$tableid=$separate[2];
		$sql=mysqli_query($connection,"SELECT `table_availability` FROM `tables` WHERE `table_id`=$tableid") or die(mysql_error());
		$row=mysqli_fetch_array($sql);
		$tableavail=$row['table_availability'];
		if ($tableavail==0)
		{
			$sql=mysqli_query($connection,"UPDATE `reservation` SET `reference`=2 WHERE reservation_id=$reservationid") or die(mysql_error());
			$sql=mysqli_query($connection,"UPDATE `tables` SET `table_availability`=1 WHERE `table_id`=$tableid") or die(mysql_error());
			$sql=mysqli_query($connection,"SELECT `date_time` FROM `reservation` WHERE `reservation_id`=$reservationid") or die(mysql_error());
			$row=mysqli_fetch_array($sql);
			$time=substr($row['date_time'], 11, 20);
			if ($time=="10:00:00" or $time=="11:00:00" or $time=="12:00:00" or $time=="13:00:00")
			{	$day='LUNCH';}
			else
			{	$day='DINNER';}
			$sql=mysqli_query($connection,"SELECT employee_id FROM `employee` WHERE `reference`=0 AND `job_id`=10 AND schedule='$day' LIMIT 1") or die(mysql_error());
			$row=mysqli_fetch_array($sql);
			$employeeid=$row['employee_id'];
			$sql=mysqli_query($connection,"UPDATE `employee` SET `reference`=1 WHERE `employee_id`=$employeeid") or die(mysql_error());
			$sql=mysqli_query($connection,"INSERT INTO `orders`(`customer_id`, `total_price`, `employee_id`) VALUES ($customerid,0,$employeeid)") or die(mysql_error());
			$sql=mysqli_query($connection,"INSERT INTO `payment`(`order_id`, `method`, `reference`) VALUES ((SELECT orders.order_id FROM `orders` INNER JOIN reservation ON orders.customer_id=reservation.customer_id WHERE reservation.reservation_id=$reservationid),NULL,0)") or die(mysql_error());
			$sql=mysqli_query($connection,"SELECT orders.order_id FROM orders INNER JOIN reservation ON orders.customer_id=reservation.customer_id WHERE reservation.reservation_id=$reservationid") or die(mysql_error());
			$row=mysqli_fetch_array($sql);
			$orderid=$row['order_id'];
			header('Location:'.'orderform.php?id='.$orderid);
		}
		else
		{
			?><div class="alert alert-info"><center>There is already a customer in Table <?php echo "$tableid"?></center></div><?php
		}
	}
	
	//customer_order_payment.php
	function seecustomertableorderpayment($table_id)
	{
		global $connection;
		if(mysqli_query($connection,"SELECT orders.order_id FROM orders INNER JOIN reservation ON orders.customer_id=reservation.customer_id WHERE reservation.table_id={$table_id} AND reservation.reference=2;")==TRUE)
		{
			global $connection;
			$sql="SELECT orders.order_id FROM orders INNER JOIN reservation ON orders.customer_id=reservation.customer_id WHERE reservation.table_id={$table_id} AND reservation.reference=2;";
			$results = mysqli_query($connection, $sql);
		
			$result_array = array();
			while ($result = mysqli_fetch_assoc($results))
			{
				$result_array[] = $result;
			}
			//print_r($result_array);
			return $result_array;
		}
		else{}
	}

	//customer_index.php
	function checkexistingcustomer($c_first_name,$c_last_name,$c_phone_num,$c_address,$c_birthday)
	{
		global $connection;
		$sql=mysqli_query($connection,"SELECT `c_first_name`, `c_last_name`, `c_phone_num`, `c_address`, `c_birthday` FROM `customer` WHERE `c_first_name`='{$c_first_name}' AND `c_last_name`='{$c_last_name}' AND `c_phone_num`='{$c_phone_num}' AND `c_address`='{$c_address}' AND`c_birthday`='{$c_birthday}';") or die(mysql_error());
		$count = mysqli_num_rows($sql);
		if($count == 0)
		{
			global $connection;
			$sql="INSERT INTO customer VALUES(NULL,'{$c_first_name}','{$c_last_name}','{$c_phone_num}','{$c_address}','{$c_birthday}')";
			mysqli_query($connection, $sql);
		}
		else{}
		?>
		<script type="text/javascript">
			window.location.href=window.location.href;
		</script><?php
	}

	//menu_index.php
	function checkexistingmenu($name,$type,$category,$description,$price,$menu_availability)
	{
		global $connection;
		$sql=mysqli_query($connection,"SELECT `name`, `type`, `category` FROM `menu` WHERE `name`='{$name}' AND `type`='{$type}' AND `category`='{$category}';") or die(mysql_error());
		$count = mysqli_num_rows($sql);
		if($count == 0)
		{
			global $connection;
			$sql="INSERT INTO menu VALUES(NULL,'{$name}','{$type}','{$category}','{$description}','{$price}','{$menu_availability}')";
			mysqli_query($connection, $sql);
		}
		else{}
		?>
		<script type="text/javascript">
			window.location.href=window.location.href;
		</script><?php
	}
	
	//job_index.php
	function checkexistingjob($title,$min_salary,$max_salary,$pt_salary)
	{
		global $connection;
		$sql=mysqli_query($connection,"SELECT `title` FROM `job` WHERE `title`='{$title}';") or die(mysql_error());
		$count = mysqli_num_rows($sql);
		if($count == 0)
		{
			global $connection;
			$sql="INSERT INTO job VALUES(NULL,'{$title}','{$min_salary}','{$max_salary}','{$pt_salary}')";
			mysqli_query($connection, $sql);
		}
		else{}
		?>
		<script type="text/javascript">
			window.location.href=window.location.href;
		</script><?php
	}

	//table_index.php
	function checkexistingtable()
	{
		global $connection;
		$sql=mysqli_query($connection,"SELECT `title` FROM `job` WHERE `title`='{$title}';") or die(mysql_error());
		$count = mysqli_num_rows($sql);
		if($count == 0 AND $pt_salary==TRUE)
		{
			global $connection;
			$sql="INSERT INTO job VALUES(NULL,'{$title}','{$min_salary}','{$max_salary}','{$pt_salary}')";
			mysqli_query($connection, $sql);
		}
		elseif ($count == 0 AND $pt_salary==NULL) {
			global $connection;
			$sql="INSERT INTO job VALUES(NULL,'{$title}','{$min_salary}','{$max_salary}',NULL)";
			echo $sql;
			mysqli_query($connection, $sql);
		}
		else{}
		?>
		<script type="text/javascript">
			window.location.href=window.location.href;
		</script><?php
	}

	//employee_index.php
	function seejob()
	{
		global $connection;
		$sql = "SELECT job_id,title FROM `job` ";

		$results = mysqli_query($connection, $sql);
		
		$result_array = array();
		while ($result = mysqli_fetch_assoc($results))
		{
			$result_array[] = $result;
		}
		//print_r($result_array);
		return $result_array;

	}

	//employee_index.php
	function insertemployee ($e_first_name,$e_last_name,$e_phone_num,$e_address,$e_birthday,$schedule,$job_id,$hire_date,$full_part_time)
	{
		global $connection;
		$sql=mysqli_query($connection,"SELECT * FROM `employee` WHERE `e_first_name`='{$e_first_name}' AND `e_last_name`='{$e_last_name}' AND `e_birthday`='{$e_birthday}';") or die(mysql_error());
		$count = mysqli_num_rows($sql);
		if($count == 0)
		{
			global $connection;
			$sql="insert into employee values(NULL,'{$e_first_name}','{$e_last_name}','{$e_phone_num}','{$e_address}','{$e_birthday}','{$schedule}','{$job_id}','{$hire_date}','{$full_part_time}',0)";
			mysqli_query($connection, $sql);
		}
		else{}
		?>
		<script type="text/javascript">
			window.location.href=window.location.href;
		</script><?php
	}

	//employee_edit.php
	function seejob1($employee_id)
	{
		global $connection;
		$sql = "SELECT job.title, employee.job_id FROM employee INNER JOIN job ON employee.job_id=job.job_id WHERE employee.employee_id='{$employee_id}'";

		$results = mysqli_query($connection, $sql);
		
		$result_array = array();
		while ($result = mysqli_fetch_assoc($results))
		{
			$result_array[] = $result;
		}
		//print_r($result_array);
		return $result_array[0];
	}

	//employee_edit.php
	function seejob2($employee_id)
	{
		global $connection;
		$sql = "SELECT job_id, title FROM job WHERE job_id!=(SELECT job_id FROM employee WHERE employee_id={$employee_id})";

		$results = mysqli_query($connection, $sql);
		
		$result_array = array();
		while ($result = mysqli_fetch_assoc($results))
		{
			$result_array[] = $result;
		}
		//print_r($result_array);
		return $result_array;
	}

	//orderform.php
	//paymentform.php
	function customerorder($order_id)
	{
		global $connection;
		$sql ="SELECT order_detail.order_detail_id, menu.name, menu.price, order_detail.quantity, order_detail.style, order_detail.total_price FROM order_detail INNER JOIN orders ON order_detail.order_id=orders.order_id INNER JOIN menu ON order_detail.menu_id=menu.menu_id WHERE orders.order_id={$order_id} ORDER BY order_detail_id";

		$results = mysqli_query($connection, $sql);
		
		$result_array = array();
		while ($result = mysqli_fetch_assoc($results))
		{
			$result_array[] = $result;
		}
		//print_r($result_array);
		return $result_array;
	}

	//orderform.php
	function jointables ($order_id)
	{
		global $connection;
		$sql ="SELECT customer.c_last_name, customer.c_first_name, employee.e_last_name, employee.e_first_name, reservation.table_id FROM orders INNER JOIN customer ON customer.customer_id = orders.customer_id INNER JOIN employee ON employee.employee_id = orders.employee_id INNER JOIN reservation ON reservation.customer_id = customer.customer_id WHERE order_id ={$order_id}";

		$results = mysqli_query($connection, $sql);
		
		$result_array = array();
		while ($result = mysqli_fetch_assoc($results))
		{
			$result_array[] = $result;
		}
		//print_r($result_array);
		return $result_array[0];
	}

	//orderform.php
	function seeMenu ()
	{
		global $connection;
		$sql= "SELECT `menu_id`, `name`,`price` FROM `menu`"; 
		$results = mysqli_query($connection, $sql);
		
		$result_array = array();
		while ($result = mysqli_fetch_assoc($results))
		{
			$result_array[] = $result;
		}
		return $result_array;
	}

	//orderform.php
	function addorder($order_id,$menu_id,$quantity,$style)
	{
		global $connection;
		$menu="{$menu_id}";
		$separate=preg_split("/,/", "$menu");
		$menuid=$separate[0];
		$price=$separate[1];
		$total_price=$price*"{$quantity}";
		$quantity="{$quantity}";
		$sql=mysqli_query($connection,"SELECT `menu_availability` FROM menu WHERE `menu_id`=$menuid");
		$row=mysqli_fetch_array($sql);
		$counts=$row['menu_availability'];
		if($quantity <= $counts)
		{
			$sql=mysqli_query($connection,"SELECT menu_id FROM order_detail WHERE menu_id=$menuid AND order_id='{$order_id}'");
			$count = mysqli_num_rows($sql);
			if($count == 0)
			{
				$sql=mysqli_query($connection,"INSERT INTO `order_detail`(`order_id`, `menu_id`, `quantity`, `total_price`, `style`) VALUES ({$order_id},$menuid,{$quantity},$total_price,'{$style}');");
			}
			else
			{
				$sql=mysqli_query($connection,"SELECT `quantity`, `total_price`, `style` FROM `order_detail` WHERE menu_id=$menuid AND order_id={$order_id}");
				while ($row=mysqli_fetch_array($sql))
				{
					$int=((int)"{$quantity}");
					$allquantity=$row["quantity"]+$int;
					$alltotalprice=$row["total_price"]+$total_price;
					$allstyle=$row["style"]."."."{$style}";
				}
				$sql=mysqli_query($connection,"UPDATE `order_detail` SET `quantity`=$allquantity,`total_price`=$alltotalprice,`style`='$allstyle' WHERE order_id={$order_id} AND menu_id=$menuid;");
			}
			$sql=mysqli_query($connection,"SELECT menu_availability FROM menu WHERE menu_id=$menuid;");
			while ($row=mysqli_fetch_array($sql))
			{
				$int=((int)"{$quantity}");
				$deducted=$row["menu_availability"]-$int;
			}
			$sql=mysqli_query($connection,"UPDATE `menu` SET `menu_availability`=$deducted WHERE menu_id=$menuid;");
			$sql=mysqli_query($connection,"SELECT total_price FROM orders WHERE order_id={$order_id};");
			while ($row=mysqli_fetch_array($sql))
			{
				$total_total_price=$row["total_price"]+$total_price;
			}
			$sql=mysqli_query($connection,"UPDATE `orders` SET `total_price`=$total_total_price WHERE order_id={$order_id};");
			?>
			<script type="text/javascript">
				window.location.href=window.location.href;
			</script><?php
		}
		else
		{
			?><div class="alert alert-warning"><center>Not enough availability. Only <?php echo "$counts"?> is available. Add more availability</center></div><?php
		}

	}

	//order_delete.php
	function deleteorder($order_detail_id)
	{
		global $connection;
		$sql=mysqli_query($connection,"SELECT `order_id`, `menu_id`, `quantity`, `total_price` FROM `order_detail` WHERE order_detail_id={$order_detail_id}");
		$row=mysqli_fetch_array($sql);
		$menuid=$row['menu_id'];
		$quantity=$row['quantity'];
		$totalprice=$row['total_price'];
		$orderid=$row['order_id'];
		$sql=mysqli_query($connection,"SELECT `menu_availability` FROM `menu` WHERE `menu_id`=$menuid");
		$row=mysqli_fetch_array($sql);
		$menuavail=$row['menu_availability'];
		$totalavailability=$menuavail+$quantity;
		$sql=mysqli_query($connection,"SELECT `total_price`FROM `orders` WHERE order_id=$orderid");
		$row=mysqli_fetch_array($sql);
		$total_price=$row['total_price'];
		$total_total_price=$total_price-$totalprice;		
		$sql=mysqli_query($connection,"UPDATE `menu` SET `menu_availability`=$totalavailability WHERE menu_id=$menuid");
		$sql=mysqli_query($connection,"UPDATE `orders` SET `total_price`=$total_total_price WHERE `order_id`=$orderid");
		$sql=mysqli_query($connection,"DELETE FROM `order_detail` WHERE `order_detail_id`={$order_detail_id}");
		header('Location:'.'orderform.php?id='.$orderid);
	}

	//order_edit.php
	function seeorder($order_detail_id)
	{
		global $connection;
		$sql="SELECT * FROM `order_detail` WHERE order_detail_id = {$order_detail_id};";
		$results = mysqli_query($connection, $sql);
		
		$result_array = array();
		while ($result = mysqli_fetch_assoc($results))
		{
			$result_array[] = $result;
		}
		return $result_array[0];
	}

	//order_edit.php
	function menucheck($menu_id)
	{
		global $connection;
		$sql="SELECT menu_id, name, price FROM `menu` WHERE menu_id = {$menu_id};";
		$results = mysqli_query($connection, $sql);
		
		$result_array = array();
		while ($result = mysqli_fetch_assoc($results))
		{
			$result_array[] = $result;
		}
		return $result_array[0];
	}

	//order_edit.php
	function menunotcheck($menu_id)
	{
		global $connection;
		$sql="SELECT menu_id, name, price FROM `menu` WHERE menu_id != {$menu_id};";
		$results = mysqli_query($connection, $sql);
		
		$result_array = array();
		while ($result = mysqli_fetch_assoc($results))
		{
			$result_array[] = $result;
		}
		return $result_array;
	}

	//edit_order.php
	function editorder($order_detail_id,$menu_id,$price,$quantity,$style)
	{
		global $connection;
		$sql=mysqli_query($connection,"SELECT quantity, order_id FROM `order_detail` WHERE order_detail_id={$order_detail_id}");
		$row=mysqli_fetch_array($sql);
		$quan=$row['quantity'];
		$orderid=$row['order_id'];
		$quantity=((int)"{$quantity}");
		if ($quan==$quantity)
		{
			$sql=mysqli_query($connection,"UPDATE `order_detail` SET `style`='{$style}' WHERE order_detail_id={$order_detail_id}");
		}
		elseif($quan>$quantity)
		{
			$finalprice=$quantity*"{$price}";
			$addquantity=$quan-$quantity;
			$deductprice=$addquantity*"{$price}";
			$sql=mysqli_query($connection,"SELECT orders.order_id, orders.total_price FROM `orders` INNER JOIN order_detail ON orders.order_id=order_detail.order_id WHERE order_detail.order_detail_id={$order_detail_id}");
			$row=mysqli_fetch_array($sql);
			$total_price=$row['total_price'];
			$total_total_price=$total_price-$deductprice;
			$orderid=$row['order_id'];
			$sql=mysqli_query($connection,"SELECT `menu_availability` FROM `menu` WHERE menu_id={$menu_id}");
			$row=mysqli_fetch_array($sql);
			$totalavailability=$row['menu_availability'];
			$addavailability=$totalavailability+$addquantity;
			$sql=mysqli_query($connection,"UPDATE `orders` SET `total_price`=$total_total_price WHERE order_id=$orderid");
			$sql=mysqli_query($connection,"UPDATE `menu` SET `menu_availability`=$addavailability WHERE menu_id={$menu_id}");
			$sql=mysqli_query($connection,"UPDATE `order_detail` SET `quantity`={$quantity},`total_price`=$finalprice,`style`='{$style}' WHERE order_detail_id={$order_detail_id}");
		}
		else
		{
			$finalprice=$quantity*"{$price}";
			$deductquantity=$quantity-$quan;
			$addprice=$deductquantity*"{$price}";
			$sql=mysqli_query($connection,"SELECT orders.order_id, orders.total_price FROM `orders` INNER JOIN order_detail ON orders.order_id=order_detail.order_id WHERE order_detail.order_detail_id={$order_detail_id}");
			$row=mysqli_fetch_array($sql);
			$total_price=$row['total_price'];
			$total_total_price=$total_price+$addprice;
			$orderid=$row['order_id'];
			$sql=mysqli_query($connection,"SELECT `menu_availability` FROM `menu` WHERE menu_id={$menu_id}");
			$row=mysqli_fetch_array($sql);
			$totalavailability=$row['menu_availability'];
			$deductavailability=$totalavailability-$deductquantity;
			$sql=mysqli_query($connection,"UPDATE `orders` SET `total_price`=$total_total_price WHERE order_id=$orderid");
			$sql=mysqli_query($connection,"UPDATE `menu` SET `menu_availability`=$deductavailability WHERE menu_id={$menu_id}");
			$sql=mysqli_query($connection,"UPDATE `order_detail` SET `quantity`={$quantity},`total_price`=$finalprice,`style`='{$style}' WHERE order_detail_id={$order_detail_id}");
		}
		header('Location:'.'orderform.php?id='.$orderid);
	}

	//paymentform.php
	function customertable ($order_id)
	{
		global $connection;
		$sql ="SELECT customer.c_first_name, customer.c_last_name, payment.payment_id, reservation.table_id FROM orders INNER JOIN customer ON customer.customer_id=orders.customer_id INNER JOIN payment ON orders.order_id=payment.order_id INNER JOIN reservation ON reservation.customer_id=customer.customer_id WHERE orders.order_id={$order_id}";

		$results = mysqli_query($connection, $sql);
		
		$result_array = array();
		while ($result = mysqli_fetch_assoc($results))
		{
			$result_array[] = $result;
		}
		//print_r($result_array);
		return $result_array[0];
	}

	//?????
	function orderbill ($order_id)
	{
		global $connection;
		$sql ="SELECT `total_price` FROM `orders` WHERE `order_id`={$order_id}";

		$results = mysqli_query($connection, $sql);
		
		$result_array = array();
		while ($result = mysqli_fetch_assoc($results))
		{
			$result_array[] = $result;
		}
		//print_r($result_array);
		return $result_array;
	}

	//paymentform.php
	function payment($order_id,$method)
	{
		global $connection;
		$sql=mysqli_query($connection,"SELECT `employee_id` FROM `orders` WHERE `order_id`={$order_id}") or die(mysql_error());
		$row=mysqli_fetch_array($sql);
		$employeeid=$row['employee_id'];
		$sql=mysqli_query($connection,"SELECT reservation.customer_id, reservation.table_id FROM `orders` INNER JOIN reservation ON orders.customer_id=reservation.customer_id WHERE order_id={$order_id} AND reservation.reference=2") or die(mysql_error());
		$row=mysqli_fetch_array($sql);
		$customerid=$row['customer_id'];
		$tableid=$row['table_id'];
		$sql=mysqli_query($connection,"UPDATE `employee` SET `reference`=0 WHERE `employee_id`=$employeeid") or die(mysql_error());
		$sql=mysqli_query($connection,"UPDATE `reservation` SET `reference`=3 WHERE `customer_id`=$customerid AND `table_id`=$tableid AND `reference`=2") or die(mysql_error());
		$sql=mysqli_query($connection,"UPDATE `tables` SET `table_availability`=0 WHERE `table_id`=$tableid") or die(mysql_error());
		$sql=mysqli_query($connection,"UPDATE `payment` SET `method`='{$method}', `reference`=1 WHERE `order_id`='{$order_id}'") or die(mysql_error());
		header('Location:'.'main.php');
	}

	//customer_table.php
	function checkavailable($table_id)
	{
		global $connection;
		$tableid="{$table_id}";
		echo $tableid;
		$sql=mysqli_query($connection,"SELECT `table_availability` FROM `tables` WHERE `table_id`=$tableid");
		$row=mysqli_fetch_array($sql);
		$count=$row['table_availability'];
		$check=((int)"$count");
		echo "$check";
		if($check == 0)
		{
			header('Location:'.'customer_waiting_list.php?id='.$tableid);
		}
		else
		{
			header('Location:'.'customer_order_payment.php?id='.$tableid);
		}
	}

	//sales_page.php
	function sales()
	{
		global $connection;
		$sql=mysqli_query($connection,"SELECT payment.payment_id, payment.order_id, payment.method, orders.total_price FROM payment INNER JOIN orders ON payment.order_id=orders.order_id WHERE payment.reference=1");
		$results = $sql;
		
		$result_array = array();
		while ($result = mysqli_fetch_assoc($results))
		{
			$result_array[] = $result;
		}
		//print_r($result_array);
		return $result_array;
	}

	//sales_page.php
	function salestotal()
	{
		global $connection;
		$sql=mysqli_query($connection,"SELECT orders.total_price FROM payment INNER JOIN orders ON payment.order_id=orders.order_id WHERE payment.reference=1");
		$results = $sql;
		
		$result_array = array();
		while ($result = mysqli_fetch_assoc($results))
		{
			$result_array[] = $result;
		}
		//print_r($result_array);
		return $result_array;
	}

	function seeemployee()
	{
		global $connection;
		$sql=mysqli_query($connection,"SELECT employee_id, e_first_name, e_last_name FROM employee");
		$results = $sql;
		
		$result_array = array();
		while ($result = mysqli_fetch_assoc($results))
		{
			$result_array[] = $result;
		}
		//print_r($result_array);
		return $result_array;
	}
?>
