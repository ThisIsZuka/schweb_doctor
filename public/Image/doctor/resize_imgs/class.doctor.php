<?php

require_once "class.main.php";
class doctor extends main
{  
	function __construct()
    {
		parent::__construct();
		$this->target_dir = "../gallery/doctor/resize_imgs/";
		global $db_prefix,$language,$db_connectiontu;
            $this->db = $db_connectiontu;
            $this->db_prefix = $db_prefix;
            $this->language = $language; 
	}
	

	public function AddItem($value,$image)
	{
		
		
		$data = new stdClass;
		$data->message = "";
		$data->success = false;
		try
		{	
			$upload_result = '';
			if($image['size']!=0){
				$upload_result = main::ImageUploadOriginal($this->target_dir,$image);
			}
			
			$doctor_img =$upload_result;
			$forename=$value->nameTH;
			$surname=$value->lastnameTH;
			$ms_title_uid=$value->pnameTH;
			$forename_en=$value->nameEN;
			$surname_en=$value->lastnameEN;
			$medical_id=$value->doctorexternalid;
			$education=$value->educateTH;
			$education_en=$value->educateEN;
			$doctor_description=$value->experinceTH;
			$doctor_description_en=$value->specialtyTH;
			$Speciality_Name=$value->specialtyTH;
			$speciality_name_en=$value->specialtyEN;
			$doctor_status=$value->doctorstatus;
			
			$sql ="insert into ms_care(doctor_img,forename,surname,ms_title_uid,forename_en,surname_en,medical_id,education,education_en,doctor_description,doctor_description_en,Speciality_Name,speciality_name_en,doctor_status)
			values                    (:doctor_img,:forename,:surname,:ms_title_uid,:forename_en,:surname_en,:medical_id,:education,:education_en,:doctor_description,:doctor_description_en,:Speciality_Name,:speciality_name_en,:doctor_status)";
			
			$stmt = $this->db->prepare($sql);
		 	$stmt->bindParam(':doctor_img', $doctor_img);
			$stmt->bindParam(':ms_title_uid', $ms_title_uid);
			$stmt->bindParam(':forename', $forename);
			$stmt->bindParam(':surname', $surname);
			//$stmt->bindParam(':ms_title_uid', $value->pnameEN);
			$stmt->bindParam(':forename_en', $forename_en);
			$stmt->bindParam(':surname_en', $surname_en);
			$stmt->bindParam(':medical_id', $medical_id);
			$stmt->bindParam(':education', $education);
			$stmt->bindParam(':education_en', $education_en);
			$stmt->bindParam(':doctor_description', $doctor_description);
			$stmt->bindParam(':doctor_description_en', $doctor_description_en);
			$stmt->bindParam(':Speciality_Name', $Speciality_Name);
			$stmt->bindParam(':speciality_name_en', $speciality_name_en);
			$stmt->bindParam(':doctor_status', $doctor_status);
			$stmt->execute();
			

		
			$data->success = true;
       	}
       	catch(PDOException $e)
       	{
			$data->success = false;
			$data->message = $e->getMessage();
       	}
		return $data;
	}
	
	public function ListItem($limit = 10,$page = 1)
	{

	
		$data = new stdClass;
		try
       	{	$row_count = doctor::sqlcount4('tb_doctors','Active<>3');
			$page_count = ceil($row_count/$limit);
			$start = ($page*$limit)-$limit;
			if($page==0 or $page==1)
			{
				$start = 0;
			}
			$sql ="select a.UID,a.PNameTH,a.FNameTH,a.LNameTH,a.PNameEN,a.FNameEN,a.LNameEN,a.SpecialtyTH,a.SpecialtyEN,a.EducationTH,a.EducationEN,a.Photo,a.Active,d.Name from tb_doctors a left join doctordepartment b on (b.DoctorUID=a.UID) left join tb_medical_center c on(c.MedID = a.DepartmentUID) WHERE a.Active <> 3 and b.LanguageUID = 1 order by a.CWhen DESC limit ".$start.",".$limit;
           	$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$ll = 'th';
			if($stmt->rowCount() > 0)
			{
				$count = 0;
				while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
					$t_data[] = new stdClass;
					$t_data[$count]->doctor_id = $result['UID'];
					$t_data[$count]->doctor_pname = $result['PName'.strtoupper($ll)];
					$t_data[$count]->doctor_name = $result['FName'.strtoupper($ll)];
					$t_data[$count]->doctor_lastname = $result['LName'.strtoupper($ll)];
					$t_data[$count]->doctor_spacial = $result['Specialty'.strtoupper($ll)];
					$t_data[$count]->doctor_education = $result['Education'.strtoupper($ll)];
					$t_data[$count]->doctor_photo = $result['Photo'];
					$t_data[$count]->doctor_department = $result['Name'];
					$t_data[$count]->doctor_status = $result['Active'];
					$count++;
				}
				$data->success = "true";
				$data->item = $count;
				$data->data = $t_data;
				$data->c_page = $page;
				$data->pageCount = $page_count;
			}else{
				$data->success = false;
			}
       	}
       	catch(PDOException $e)
       	{
			$data->success = false;
			$data->message = $e->getMessage();
       	}
		return $data;
	}


	// ลบวีดีโอแพทย์
	public function delvideodoctor($youtube,$iddoctor){
		
		$url=$youtube;
		$id=$iddoctor;
		$data = new stdClass;
		try
       	{	
			$sqlnew="DELETE FROM ms_doctor_youtube WHERE medical_uid=$id AND youtube_url='$url'";
			$stmt = $this->db->prepare($sqlnew);
			$stmt->execute();
			
			if($stmt->rowCount() > 0)
			{
				$data->success = "ลบวีดีโอ $url";
				
			}else{
				$data->success = false;
			}
       	}
       	catch(PDOException $e)
       	{
			$data->success = false;
			$data->message = $e->getMessage();
       	}
		return $data;
		
	}
	// ลบวีดีโอแพทย์

	public function listspecialty(){
		$data = new stdClass;
		try
       	{	
			$sqlnew="select * from ms_specialist ";
			
			$stmt = $this->db->prepare($sqlnew);
			$stmt->execute();
			$ll = 'th';
			if($stmt->rowCount() > 0)
			{
				$count = 0;
				while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
					$t_data[] = new stdClass;
					
					$t_data[$count]->uid = $result['uid'];
					$t_data[$count]->description = $result['description'];
					
					
					$count++;
				}
			
				$data->success = "true";
				$data->item = $count;
				$data->data = $t_data;
				
				
			}else{
				$data->success = false;
			}
       	}
       	catch(PDOException $e)
       	{
			$data->success = false;
			$data->message = $e->getMessage();
       	}
		return $data;
		
	}

	public function listlocationmedical(){
		$data = new stdClass;
		try
       	{	
			$sqlnew="select * from ms_service_location";
			$stmt = $this->db->prepare($sqlnew);
			$stmt->execute();
			$ll = 'th';
			if($stmt->rowCount() > 0)
			{
				$count = 0;
				while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
					$t_data[] = new stdClass;
					$t_data[$count]->uid = $result['uid'];
	
					$t_data[$count]->description = $result['description'];
					$count++;
				}
			
				$data->success = "true";
				$data->item = $count;
				$data->data = $t_data;
				
				
			}else{
				$data->success = false;
			}
       	}
       	catch(PDOException $e)
       	{
			$data->success = false;
			$data->message = $e->getMessage();
       	}
		return $data;
		
	}
	public function list_title_name(){
		$data = new stdClass;
		try
       	{	
			$sqlnew="select uid,titlename from ms_title where pre_for=1";
			$stmt = $this->db->prepare($sqlnew);
			$stmt->execute();
			
			if($stmt->rowCount() > 0)
			{
				
				$count = 0;
				while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
			
					$t_data[] = new stdClass;
					$t_data[$count]->uid=$result['uid'];
					$t_data[$count]->titlename=$result['titlename'];
					$count++;
				}
			
				$data->success = "true";
				$data->item = $count;
				$data->data = $t_data;
			// 			var_dump($data);
			// exit();
				
			}else{
				$data->success = false;
			}
       	}
       	catch(PDOException $e)
       	{
			$data->success = false;
			$data->message = $e->getMessage();
       	}
		return $data;


	}

	public function youtube_list($id){
		
		$data = new stdClass;
		try
       	{	
			$sqlnew="select * from ms_doctor_youtube where medical_uid=$id ";
			
			$stmt = $this->db->prepare($sqlnew);
			$stmt->execute();
			$ll = 'th';
			if($stmt->rowCount() > 0)
			{


		
				$count = 0;
				while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
					$t_data[] = new stdClass;
					$t_data[$count]->iddoctor_youtube = $result['medical_uid'];
					$t_data[$count]->youtube = $result['youtube_url'];
					$count++;					
				}
			
				$data->success = "true";
				$data->item = $count;
				$data->data = $t_data;
				
				
			}else{
				$data->success = false;
			}
       	}
       	catch(PDOException $e)
       	{
			$data->success = false;
			$data->message = $e->getMessage();
       	}
		return $data;
	}

	public function listspecialty_list(){
		$data = new stdClass;
		try
       	{	
			$sqlnew="select * from ms_specialty ";
			
			$stmt = $this->db->prepare($sqlnew);
			$stmt->execute();
			$ll = 'th';
			if($stmt->rowCount() > 0)
			{
				$count = 0;
				while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
					$t_data[] = new stdClass;
					$t_data[$count]->uid = $result['uid'];
					$t_data[$count]->description = $result['description'];
					$count++;
				}
			
				$data->success = "true";
				$data->item = $count;
				$data->data = $t_data;
				
				
			}else{
				$data->success = false;
			}
       	}
       	catch(PDOException $e)
       	{
			$data->success = false;
			$data->message = $e->getMessage();
       	}
		return $data;
	}

	public function ListItemAll()
	{
		
		$data = new stdClass;
		try
       	{	
			$sql ="select a.UID as doctor_id,a.PNameTH,a.FNameTH,a.LNameTH,a.PNameEN,a.FNameEN,a.LNameEN,a.SpecialtyTH,a.SpecialtyEN,a.EducationTH,a.EducationEN,a.Photo,a.Active,b.DepartmentUID,c.MedName from tb_doctors a left join doctordepartment b on (b.DoctorUID=a.UID) left join tb_medical_master c on(c.MedDepartment = b.DepartmentUID) WHERE a.Active <> 3  order by a.CWhen DESC";
			$sqlnew="select * from ms_care 
			left outer join ms_title_doctor on ms_care.ms_title_uid = ms_title_doctor.ms_title_code ORDER BY uid DESC";
			
			$stmt = $this->db->prepare($sqlnew);
			$stmt->execute();

			$ll = 'th';
			if($stmt->rowCount() > 0)
			{
				$count = 0;
				while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
					$t_data[] = new stdClass;
					$t_data[$count]->uid = $result['uid'];
					$t_data[$count]->doctor_id = $result['medical_id'];
					$t_data[$count]->doctor_pname = $result['title'];
					$t_data[$count]->doctor_name = $result['forename'];
					$t_data[$count]->doctor_lastname = $result['surname'];
					$t_data[$count]->doctor_spacial = $result['Speciality_Name'];
					$t_data[$count]->doctor_education = $result['education'];
					$t_data[$count]->doctor_photo = $result['doctor_img'];
					$t_data[$count]->doctor_status = $result['status'];
					$count++;
				}
			
				$data->success = "true";
				$data->item = $count;
				$data->data = $t_data;
				
				
			}else{
				$data->success = false;
			}
       	}
       	catch(PDOException $e)
       	{
			$data->success = false;
			$data->message = $e->getMessage();
       	}
		return $data;


		
	}
	public function ListItemAppointment($limit = 10,$page = 1)
	{
		$data = new stdClass;
		try
       	{	$row_count = doctor::sqlcount2('doctorappointment','Active','1');
			$page_count = ceil($row_count/$limit);
			$start = ($page*$limit)-$limit;
			if($page==0 or $page==1)
			{
				$start = 0;
			}
			$sql ="select * from doctorappointment where Active<>'3' order by CWhen DESC limit ".$start.",".$limit;
           	$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$ll = 'th';
			if($stmt->rowCount() > 0)
			{
				$count = 0;
				while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
					$t_data[] = new stdClass;
					$t_data[$count]->id = $result['UID'];
					$t_data[$count]->name = $result['PName']." ".$result['FName']." ".$result['LName'];
					$t_data[$count]->doctorName = $result['DoctorName'];
					$t_data[$count]->departmentName = $result['DepartmentName'];
					$t_data[$count]->appointmentDate = $result['AppointmentDate'];
					$t_data[$count]->timestamp = $result['CWhen'];
					$t_data[$count]->status = $result['Active'];
					$t_data[$count]->stamp = $result['appoint_stamp'];
					$count++;
				}
				$data->success = "true";
				$data->item = $count;
				$data->data = $t_data;
				$data->c_page = $page;
				$data->pageCount = $page_count;
			}else{
				$data->success = false;
			}
       	}
       	catch(PDOException $e)
       	{
			$data->success = false;
			$data->message = $e->getMessage();
       	}
		return $data;
	}


	public function ViewItem($id,$uid)
	{	
		
		
		$data = new stdClass;
		$data->message = "";
		$data->success = false;
		try
		{
			//$sql = "select a.*,b.DepartmentUID,a.MedID as MedCC,c.MedID as MedDD from tb_doctors a left join doctordepartment b on(b.DoctorUID=a.UID) left join tb_medical_master c on (c.MedDepartment = b.DepartmentUID) where UID=:id";

			$sqlnew='select * from ms_care
			inner join ms_title_doctor on ms_care.ms_title_uid=ms_title_doctor.ms_title_code 
			left join ms_specialist on ms_care.special1=ms_specialist.uid 
			left join ms_careprovider on ms_care.uid=ms_careprovider.ms_doctor_uid 
			left join ms_doctor_specialty on ms_care.medical_id=ms_doctor_specialty.id_doctor
			where medical_id='.$id.' ';
			
			$stmt = $this->db->prepare($sqlnew);
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			
			if($stmt->rowCount()>0){
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
				$data->uid=$uid;
				$data->id = $result['medical_id'];
				$data->titleid=$result['ms_title_uid'];
				$data->pnameth = $result['title'];	
				$data->nameth = $result['forename'];
				$data->lastnameth = $result['surname'];
				$data->educateth1 = $result['education'];
				$data->educateth2 = $result['education2'];
				$data->educateth3 = $result['education3'];
				$data->educateth4 = $result['education4'];
				$data->specialth = $result['Speciality_Name'];
				$data->id_specialty=$result['id_specialty'];
				$data->special1=$result['special1'];
				$data->special2=$result['special2'];
				$data->special3=$result['special3'];
				$data->special4=$result['special4'];
				$data->location=$result['description'];
				$data->careprovider=$result['ms_location_id'];
				//$data->typeth = $result['TypeTH'];
				// $data->doctortype = $result['DoctorType'];
				$data->medid=$result['medical_id'];
				$data->gender=$result['gender'];
				$data->pnameen = $result['titlename'];
				$data->nameen = $result['forename_en'];
				$data->lastnameen = $result['surname_en'];
				$data->educateen = $result['education_en'];
				//$data->expen = $result['ExperianceEN'];
				//if($result['TypeEN']=="Fulltime"){
					$data->typeee = 1;
				//}else{
					$data->typeee = 2;
				//}
				//$data->typeen = $result['TypeEN'];
				//$data->specialen = $result['SpecialtyEN'];
				
				//$data->seq_all = $result['seq_all'];
				//$data->seq_medical = $result['seq_medical'];
				//$data->set_new = $result['set_new'];
				//$data->seq_new = $result['seq_new'];
				//$data->department = $result['MedDD'];
				//$data->email = $result['EMail'];
				//$data->tel = $result['Phone'];
				//$data->medid = $result['MedCC'];
				//$data->status = $result['Active'];
				$data->image = $result['doctor_img']; 
				//$data->success = true;
				// echo "<pre>";
				// var_dump($data);
				// exit();
			}
			
			else{
				$data->success = false;
			}
       	}
       	catch(PDOException $e)
       	{
			$data->success = false;
			$data->message = $e->getMessage();
       	}
		return $data;
	}
	public function UpdateItem($value,$image)
	{
		
		for($i=0; $i<count($value->youtube); $i++){
			$youtube_url=$value->youtube[$i];
			if($youtube_url!=""){
				$youtube="INSERT INTO ms_doctor_youtube  (medical_uid,youtube_url) 
				VALUES ('$value->iddoctor','$youtube_url')";
				$inser = $this->db->prepare($youtube);
				$inser->execute();
			}
			
		}
				$education="update ms_care set  education='$value->education1',education2='$value->education2',education3='$value->education3',education4='$value->education4' where uid=$value->iddoctor";
				$inser = $this->db->prepare($education);
				$inser->execute();
			

				$selectspecialty="select * from ms_doctor_specialty where id_doctor=$value->id";
				$selectspecialtydb = $this->db->prepare($selectspecialty);
				$selectspecialtydb->execute();
				if($selectspecialtydb->rowCount()>0){
					$specialty="update ms_doctor_specialty set id_specialty='$value->specialty1' where id_doctor=$value->id";
					$specialtydata = $this->db->prepare($specialty);
					$specialtydata->execute();
				}else{
					$specialty="INSERT INTO ms_doctor_specialty (id_doctor,id_specialty) 
					VALUES 
					('$value->id','$value->specialty1')";
					$specialtydata = $this->db->prepare($specialty);
					$specialtydata->execute();
				}
					
					$careproviderselect="select ms_doctor_uid from ms_careprovider where $value->iddoctor";
					$careproviderdb = $this->db->prepare($careproviderselect);
					$careproviderdb->execute();
					if($careproviderdb->rowCount()>0){
						
						$careprovider="update ms_careprovider set ms_location_id='$value->careprovider' where ms_doctor_uid=$value->iddoctor";
						$careproviderdata = $this->db->prepare($careprovider);
						$careproviderdata->execute();
					}else{
						$careprovider="INSERT INTO ms_careprovider (ms_doctor_uid,ms_location_id) 
						VALUES 
						('$value->iddoctor','$value->careprovider')";
						$careproviderdata = $this->db->prepare($careprovider);
						$careproviderdata->execute();
					}
				
				

		
		$data = new stdClass;
		$data->message = "";
		$data->success = false;
		


			echo"<pre>";
	
			if($image['name']==""){
					
			try
			{
			$str = "ms_title_uid=:pnameth,
			forename=:fnameth,
			surname=:lnameth,
			ms_titleen_uid=:pnameen,
			forename_en=:fnameen,
			surname_en=:lnameen,
			medical_id=:meditd,
			education_en=:eduen,
			Speciality_Name=:specth,
			doctor_status=:active";

				$sql = "update ms_care set special1='$value->specialist1',special2='$value->specialist2',special3='$value->specialist3',special4='$value->specialist4',status=1 where medical_id=$value->id";
				$stmt = $this->db->prepare($sql);
					
				
				$stmt->bindParam(':doctor_id', $value->id);
				$stmt->bindParam(':pnameth', $value->pnameTH);
				$stmt->bindParam(':fnameth', $value->nameTH);
				$stmt->bindParam(':lnameth', $value->lastnameTH);
				$stmt->bindParam(':pnameen', $value->pnameEN);
				$stmt->bindParam(':fnameen', $value->nameEN);
				$stmt->bindParam(':lnameen', $value->lastnameEN);
				$stmt->bindParam(':meditd', $value->doctorexternalid);
				// $stmt->bindParam(':eduen', $value->educateEN);
				// $stmt->bindParam(':expth', $value->experinceTH);
				// $stmt->bindParam(':expen', $value->experinceEN);
				$stmt->bindParam(':typeth', $value->typeTH);
				$stmt->bindParam(':typeen', $value->typeEN);
				$stmt->bindParam(':doctortype', $value->doctortype);
				$stmt->bindParam(':specth', $value->specialtyTH);
				$stmt->bindParam(':specen', $value->specialtyEN);
				$stmt->bindParam(':department', $value->doctordepartment);
				$stmt->bindParam(':active', $value->doctorstatus);
				$stmt->execute();
				
				if($stmt){
					$data->success = true;
				}
				else{
					$data->success = false;
				}
			}
			   catch(PDOException $e)
			   {
				$data->success = false;
				$data->message = $e->getMessage();
			   }
			   
		
			return $data;


			}else{
				// // echo$image['name'];
				// // exit();
				// $upload_result = main::ImageUploadOriginal($this->target_dir,$image['name']);
				// // var_dump($upload_result);
				// // 	exit();

				// $picture=$image['name'];
					
				// 	$str .=",Photo='".$upload_result."'";
				// 	$photo="update  ms_care set doctor_img='$picture' where medical_id=$value->iddoctor";
				// 	$photo = $this->db->prepare($photo);
				// 	$photo->execute();
					$upload_result = main::ImageUploadOriginal($this->target_dir,$image);
				// var_dump($upload_result);
				// 	exit();
					$str .=",Photo='".$upload_result."'";
					// $photo="update  ms_care set doctor_img='$upload_result' where medical_id=$value->iddoctor";
					// $photo = $this->db->prepare($photo);
					// $photo->execute();
			
					try
			{
			$str = "ms_title_uid=:pnameth,
			forename=:fnameth,
			surname=:lnameth,
			ms_titleen_uid=:pnameen,
			forename_en=:fnameen,
			surname_en=:lnameen,
			medical_id=:meditd,
			education_en=:eduen,
			Speciality_Name=:specth,
			doctor_status=:active";

				$sql = "update ms_care set doctor_img='$upload_result',special1='$value->specialist1',special2='$value->specialist2',special3='$value->specialist3',special4='$value->specialist4',status=1 where medical_id=$value->id";
				$stmt = $this->db->prepare($sql);
					
				
				$stmt->bindParam(':doctor_id', $value->id);
				$stmt->bindParam(':pnameth', $value->pnameTH);
				$stmt->bindParam(':fnameth', $value->nameTH);
				$stmt->bindParam(':lnameth', $value->lastnameTH);
				$stmt->bindParam(':pnameen', $value->pnameEN);
				$stmt->bindParam(':fnameen', $value->nameEN);
				$stmt->bindParam(':lnameen', $value->lastnameEN);
				$stmt->bindParam(':meditd', $value->doctorexternalid);
				// $stmt->bindParam(':eduen', $value->educateEN);
				// $stmt->bindParam(':expth', $value->experinceTH);
				// $stmt->bindParam(':expen', $value->experinceEN);
				$stmt->bindParam(':typeth', $value->typeTH);
				$stmt->bindParam(':typeen', $value->typeEN);
				$stmt->bindParam(':doctortype', $value->doctortype);
				$stmt->bindParam(':specth', $value->specialtyTH);
				$stmt->bindParam(':specen', $value->specialtyEN);
				$stmt->bindParam(':department', $value->doctordepartment);
				$stmt->bindParam(':active', $value->doctorstatus);
				$stmt->execute();
				
				if($stmt){
					$data->success = true;
				}
				else{
					$data->success = false;
				}
			}
			catch(PDOException $e){
				$data->success = false;
				$data->message = $e->getMessage();
			   }
			   
			return $data;

		}
		
	}
	public function DeleteItem($id)
	{
	
		$data = new stdClass;
		$data->message = "";
		$data->success = false;
		try
		{
			$sql = "update ms_care set doctor_status='3' where medical_id=$id";
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam(':user_id', $id);
			$stmt->execute();
			if($stmt){
				$data->success = true;
			}
			else{
				$data->success = false;
			}
       	}
       	catch(PDOException $e)
       	{
			$data->success = false;
			$data->message = $e->getMessage();
       	}
		return $data;
	}
	public function DeleteItemAppointment($id)
	{
		$data = new stdClass;
		$data->message = "";
		$data->success = false;
		try
		{
			
			$sql = "update doctorappointment set Active='3' where UID=:user_id";
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam(':user_id', $id);
			$stmt->execute();
			if($stmt){
				$data->success = true;
			}
			else{
				$data->success = false;
			}
       	}
       	catch(PDOException $e)
       	{
			$data->success = false;
			$data->message = $e->getMessage();
       	}
		return $data;
	}
	public function AppointmentUpdateStatus($id,$value)
	{
		$data = new stdClass;
		$data->message = "";
		$data->success = false;
		try
		{
			$sql = "update doctorappointment set appoint_stamp=:value where UID=:user_id";
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam(':value', $value);
			$stmt->bindParam(':user_id', $id);
			$stmt->execute();
			if($stmt){
				$data->success = true;
			}
			else{
				$data->success = false;
			}
       	}
       	catch(PDOException $e)
       	{
			$data->success = false;
			$data->message = $e->getMessage();
       	}
		return $data;
	}
		public function GetMedList()
	{
		$data = new stdClass;
		$data->message = "";
		$data->success = false;
		try
		{
			$sql = "select * from tb_medical_master where MedStatus='1'";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			if($stmt->rowCount()>0){
				$count = 0;
				while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
					$t_data[] = new stdClass;
					$t_data[$count]->id = $result['MedID'];
					$t_data[$count]->name = $result['MedName'];
					$count++;
				}
				$data->success = true;
				$data->data = $t_data;
			}
			else{
				$data->success = false;
			}
       	}
       	catch(PDOException $e)
       	{
			$data->success = false;
			$data->message = $e->getMessage();
       	}
		return $data;
	}
	
}
?>