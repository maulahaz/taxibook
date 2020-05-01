<?php

class Barengan extends CI_Controller {
	function __construct(){
		parent ::__construct();
	}

	function index(){
		redirect('barengan/manage','refresh');
	}

	function manage(){
		_isLoggedin();
		$login_id = _get_user_id();

		$this->load->model('Barengan_mdl', 'myModel');

		$data['title'] = 'Barengan - Taxibook';
        $data['page_title'] = 'List Barengan';
        // $data['getTimeOption'] = $this->getTimePlease();
		$data['getTimeOption'] = $this->getTimeOption2();
        // die($data['getTimeOption']);

		$data['isi'] = 'barengan/v_manage';
		$data['js_file'] = 'barengan/js_barengan';
		$this->load->view('t_admin/adminpage', $data, FALSE);
    }	
    
	function list(){
		$this->load->model('Barengan_mdl', 'myModel');

		$data['title'] = 'Barengan - Taxibook';
        $data['page_title'] = 'List Barengan';
		$data['getTimeOption'] = $this->getTimeOption2();

		$data['view_file'] = 'barengan/v_list'; 
		$data['js_file'] = 'barengan/js_list';
		$this->load->view('template/v_homepage', $data, FALSE);
	}    

	function fetchTableBarengan(){
		// _isLoggedin();
		$login_id = _get_user_id();

		$this->load->model('Barengan_mdl','myModel');

		$result = array('data' => array());
		$sn = 0;
    	$dataTable = $this->myModel->getAll('Flight_dt DESC');
    	foreach ($dataTable->result() as $key => $value) {
    		$sn = $sn + 1;
    		$origDesti = $value->Origin.' -- to -- '.$value->Destination;
            $barengID = $value->uid;
    		//Utk Button:
    		$buttons = '
				<div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action&nbsp;<i class="fa fa-caret-down"></i></button>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:;" onclick="edit('.$barengID.')">Edit</a></li>
                        <li><a href="javascript:;" onclick="del('.$barengID.')">Delete</a></li>
                    </ul>
                </div>
    		';
    		$result['data'][$key] = array(
    			$sn,
                get_nice_date($value->Flight_dt, 'mydate'),
    			get_nice_date($value->Flight_tm, 'time_only'),
    			$origDesti,
                $value->Flight_by,
                $value->Booker,
    			$value->Note,
    			$buttons
    		); 

    	}

    	echo json_encode($result);
	}

    function ajaxEdit($uid){
        _isLoggedin();

        $this->load->model('Barengan_mdl', 'myModel');

        $data = $this->myModel->getWhere($uid)->row();
        echo json_encode($data);
    }

    function ajaxDelete($uid){
        _isLoggedin();

        $this->load->model('Barengan_mdl', 'myModel');

        $execution = $this->myModel->_deleteTF($uid);
        if($execution == true){
            $ajaxValidator['isSuccess'] = true;
            $ajaxValidator['pesan'] = 'Data Successfully Deleted';
        }
        echo json_encode($ajaxValidator);
    }

    function action($param){
        if($param == "listview"){
            $this->load->model('Barengan_mdl','myModel');

            $result = array('data' => array());
            $sn = 0;
            $dataTable = $this->myModel->getAll('Flight_dt DESC');
            foreach ($dataTable->result() as $key => $value) {
                $sn = $sn + 1;
                $origDesti = $value->Origin.' -- to -- '.$value->Destination;
                $barengID = $value->uid;
                $result['data'][$key] = array(
                    $sn,
                    get_nice_date($value->Flight_dt, 'mydate'),
                    get_nice_date($value->Flight_tm, 'time_only'),
                    $origDesti,
                    $value->Flight_by,
                    $value->Booker,
                    $value->Note,
                ); 

            }

            echo json_encode($result);
        }
    }

    function ajaxAction($action){
        _isLoggedin();

        $this->load->model('Barengan_mdl', 'myModel');

        // $login_id = _get_user_id();

        $ajaxValidator = array('isSuccess' => false, 'pesan' => array());   

        $this->form_validation->set_rules('user_name','Name','required');
        $this->form_validation->set_rules('flight_dt','Tanggal','required');
        $this->form_validation->set_rules('flight_tm','Jam','required');
        $this->form_validation->set_rules('origin','Brangkat dari','required');
        $this->form_validation->set_rules('destination','Tujuan','required');
        $this->form_validation->set_rules('flight_by','Meskapai','required');

        $this->form_validation->set_error_delimiters('<div class="alert alert-warning text-danger" role="alert">','</div>');

        $postedData['Booker'] = $this->input->post('user_name', true);
        $f_date = $this->input->post('flight_dt', true);
        $f_time = $this->input->post('flight_tm', true);
        $f_TimeValue = $f_date." ".$f_time;
        $f_dtm = date('Y-m-d H:i:s', strtotime("$f_date $f_time"));
        $postedData['Flight_dt'] = make_unixtimestamp($f_dtm);
        $postedData['Flight_tm'] = make_unixtimestamp($f_TimeValue);
        $postedData['Origin'] = $this->input->post('origin', true);
        $postedData['Destination'] = $this->input->post('destination', true);
        $postedData['Flight_by'] = $this->input->post('flight_by', true);
        $postedData['Note'] = $this->input->post('note', true);
        $uid = $this->input->post('barengan_id', true);

        if($action == 'create'){

            if($this->form_validation->run() == TRUE){
                $execution = $this->myModel->_insertTF($postedData);
                if($execution == true){
                    $ajaxValidator['isSuccess'] = true;
                    $ajaxValidator['pesan'] = 'New Data Successfully Saved';
                }else{
                    $ajaxValidator['isSuccess'] = false;
                    $ajaxValidator['pesan'] = 'Error while uploading new data';
                }
            }else{
                $ajaxValidator['isSuccess'] = false;
                $err = $this->form_validation->error_array();
                // foreach ($_POST as $key => $value) {
                foreach ($err as $key => $value) {
                    $ajaxValidator['pesan'][$key] = form_error($key);
                }
            }
                
        }elseif ($action == 'update'){

            if($this->form_validation->run() == TRUE){
                $execution = $this->myModel->_updateTF($uid, $postedData);
                if($execution == true){
                    $ajaxValidator['isSuccess'] = true;
                    $ajaxValidator['pesan'] = 'Data Successfully Updated';
                }else{
                    $ajaxValidator['isSuccess'] = false;
                    $ajaxValidator['pesan'] = 'Error while updating new data';
                }
            }else{
                $ajaxValidator['isSuccess'] = false;
                $err = $this->form_validation->error_array();
                // foreach ($_POST as $key => $value) {
                foreach ($err as $key => $value) {
                    $ajaxValidator['pesan'][$key] = form_error($key);
                }
            }
        }   

        echo json_encode($ajaxValidator);
    }

    function getTimePlease(){
        $options = array(); 
        $min = array('00','05','10','15','20','25','30','35','40','45','50','55');
        // echo "<pre>";
        // print_r ($min);
        // echo "</pre>";die();
        // $loops = 24*(60/$steps);
        foreach (range(0,23) as $fullhour) {
           $parthour = $fullhour > 12 ? $fullhour - 12 : $fullhour;
            foreach($min as $int){
                $options[''] = '--Select--';
                if($fullhour > 11){
                    $options[$fullhour.":".$int]=$parthour.":".$int." PM";
                }else{
                    if($fullhour == 0){$parthour='12';}
                    $options[$fullhour.":".$int]=$parthour.":".$int." AM" ;
                }
            }
        }
        return $options;

        // $options = array(); 
        // $steps   = $steps; // only edit the minutes value
        // $current = 0;
        // $loops   = 24*(60/$steps);

        // for ($i = 0; $i < $loops; $i++) {
        //     $time = sprintf('%02d:%02d', $i/(60/$steps), $current%60);
        //     $options[''] = '--Select--';
        //     $options[$time] = $time;
        //     // echo '<option value="'.$time.'">'.$time.'</option>';
        //     $current += $steps;
        // }
        // return $options;
    }

    function create_time_range($start, $end, $interval = '30 mins', $format = '12') {
        $startTime = strtotime($start); 
        $endTime   = strtotime($end);
        $returnTimeFormat = ($format == '12')?'g:i:s A':'G:i:s';

        $current   = time(); 
        $addTime   = strtotime('+'.$interval, $current); 
        $diff      = $addTime - $current;

        $times = array(); 
        while ($startTime < $endTime) { 
            $times[] = date($returnTimeFormat, $startTime); 
            $startTime += $diff; 
        } 
        $times[] = date($returnTimeFormat, $startTime); 
        return $times; 
    }

    function getTimeOption($format, $every_x_minute){
        //format in 12hrs AM or PM
        if($format == 12){
            $steps   = $every_x_minute; // only edit the minutes value
            $current = 0;
            $loops   = 24*(60/$steps);

            for ($i = 0; $i < $loops; $i++) {
                $time24 = sprintf('%02d:%02d', $i/(60/$steps), $current%60);
                $hour = $i/(60/$steps);
                $time = sprintf('%02d:%02d %s', $hour, $current%60, intval($hour/12) == 0 ? ' AM' : ' PM');
                echo '<option>'.$time.'</option>';
                $current += $steps;
            }
        //format in 12hrs AM or PM          
        } elseif($format == 24){
            $steps   = $every_x_minute; // only edit the minutes value
            $current = 0;
            $loops   = 24*(60/$steps);

            for ($i = 0; $i < $loops; $i++) {
                $time = sprintf('%02d:%02d', $i/(60/$steps), $current%60);
                echo '<option>'.$time.'</option>';
                $current += $steps;
            }
        }
    }

    function getTimeOption2(){
        $options = array(); 
        $min30 = array('00','30');
        foreach (range(0,23) as $fullhour) {
           $parthour = $fullhour > 12 ? $fullhour - 12 : $fullhour;
            foreach($min30 as $int){
                $options[''] = '--Select--';
                if($fullhour > 11){
                    $options[$fullhour.":".$int]=$parthour.":".$int." PM";
                }else{
                    if($fullhour == 0){$parthour='12';}
                    $options[$fullhour.":".$int]=$parthour.":".$int." AM" ;
                }
            }
        }
        return $options;
    }

}