<?php

$sessionList = '
SELECT loc_name,tra_name, `ses_id`, `ses_start_date`, `ses_end_date`, `ses_number`
	FROM session
	inner join location on location.loc_id = session.location_loc_id
    inner join training on training.tra_id = session.training_tra_id
	group by location.loc_name,ses_number
';


$pagination = 5;
// print_r($_GET['page']);
if (!empty($_GET['page']) && ctype_digit($_GET['page'])) {
	$pageSkip = $_GET['page'] - 1; 
} else
{
	$pageSkip = 0;
}

$studentsList = '
	SELECT stu_id, stu_lastname, stu_firstname, stu_email, stu_birthdate
	FROM student
	ORDER BY stu_lastname ASC
	limit '.$pagination.' offset '.$pageSkip * $pagination.'
	';

$studentsListSessionId = '
	SELECT stu_id, stu_lastname, stu_firstname, stu_email, stu_birthdate, session_ses_id,tra_name,loc_name
	FROM student
	inner join session on session.ses_id = student.session_ses_id
	inner join location on location.loc_id = session.location_loc_id
	inner join training on training.tra_id = session.training_tra_id
    where student.session_ses_id = :param
	ORDER BY stu_lastname ASC
	limit '.$pagination.' offset '.$pageSkip * $pagination.'
	';

$student = '
	SELECT stu_id, stu_lastname, stu_firstname, stu_email, stu_birthdate,
	(DATEDIFF(now(),stu_birthdate) /(365*60*60*24)) as age,
	stu_friendliness, session_ses_id, city.cit_name,training.tra_name

	FROM student
	inner join city on city.cit_id = student.city_cit_id
	inner join session on session.ses_id = student.session_ses_id
	inner join training on training.tra_id= session.training_tra_id
	

	where stu_id = :param

	ORDER BY stu_lastname ASC
';

$cityTrain = '
	SELECT loc_id 
		,loc_name 		
		,cou_id 
		,cou_name 		
		,cit_id 
		,cit_name 				
	from location
	inner join country on country.cou_id = location.country_cou_id
	inner join city on city.country_cou_id = country.cou_id
	where city.cit_name in("Luxembourg","Metz")
	group by location.loc_name
';
$cityStudent = '
	SELECT cit_id, `cit_name`, `cit_inserted`, country_cou_id		
	from city
';


function sqlSearch($sqlReq,$param=0) {
	global $pdo;
	$pdoStatement = $pdo->prepare($sqlReq);

	if ($param == 1) {		
		$pdoStatement->bindValue(':param', $_GET['studentId'], PDO::PARAM_INT);
	}

	if ($param == 2) {		
		$pdoStatement->bindValue(':param', $_GET['idSession'], PDO::PARAM_INT);
	}

	if ($pdoStatement->execute() === false) {
		print_r($pdo->errorInfo());
	}
	else {

		return($pdoStatement->fetchAll(PDO::FETCH_ASSOC));			
	}
}

$sqlInsert = '
	INSERT INTO student (`stu_lastname`, `stu_firstname`, `stu_birthdate`, `stu_email`, `stu_friendliness`,`session_ses_id`, `city_cit_id`) 
	VALUES (:nom
			,:prenom
			,:birth
			,:email
			,:friendOpt
			,:sessionOpt
			,:villeOpt
	)
';

function addStudent($sqlInsert,$nom,$prenom,$email,$birth,$friendOpt,$sessionOpt,$villeOpt) {
	global $pdo;
	$pdoStatement = $pdo->prepare($sqlInsert);
	// print_r($_POST);
	// echo $birth;
	$values = array(':nom' => $nom,
		 ':prenom' => $prenom,	
		 ':birth' => $birth,	
		 ':email' => $email,	
		 ':friendOpt' => $friendOpt,	
		 ':sessionOpt' => $sessionOpt,	
		 ':villeOpt' => $villeOpt);
	
	if ($pdoStatement->execute($values) === false) {
		print_r($pdo->errorInfo());
	}
	else {
		return($pdo->lastInsertID());	
	}
}

function searchStudent($inputSearch) {
	global $pdo;
	// echo 'searchStudent '.$inputSearch;

	$studenSearch = '
	SELECT stu_id, stu_lastname, stu_firstname, stu_email, stu_birthdate
	FROM student
	left outer join city on city.cit_id = student.city_cit_id
	where stu_lastname 	like :search
	  or  stu_firstname like :search
	  or  stu_email 	like :search
	  or  city.cit_name	like :search	
	';

	$pdoStatement = $pdo->prepare($studenSearch);

	// print_r($pdoStatement);

	$pdoStatement->bindValue(':search', '%'.$inputSearch.'%');
	

	if ($pdoStatement->execute() === false) {
		print_r($pdo->errorInfo());
	}
	else {

		return($pdoStatement->fetchAll(PDO::FETCH_ASSOC));			
	}
}

function student_city() {
	global $pdo;
	global $nb_student_city;

	$sql_search = '
	SELECT city.cit_name,count(*) as nbStudent
	FROM student
	left outer join city on city.cit_id = student.city_cit_id
	-- where city.cit_name  like :search	
	group by student.city_cit_id
	';

	$pdoStatement = $pdo->prepare($sql_search);

	// print_r($pdoStatement);

	// $pdoStatement->bindValue(':search', '%'.$input_city.'%');
	

	if ($pdoStatement->execute() === false) {
		print_r($pdo->errorInfo());
	}
	else {
		$nb_student_city = $pdoStatement->rowCount();
		return($pdoStatement->fetchAll(PDO::FETCH_ASSOC));			
	}
}