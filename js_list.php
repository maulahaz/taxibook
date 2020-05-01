<script>
	const myBaseURL = '<?php echo base_url(); ?>';
	let tblBarengan;
	let saveMethod;

	$('.mydate').datepicker({format: 'dd-M-yyyy',});

	tblBarengan = $('#dtbl_barengan').DataTable({
		'ajax': myBaseURL + 'barengan/action/listview'
	});

	// getDataTable();

	function getDataTable(){
		let actionURL;
		actionURL = myBaseURL + 'barengan/action/' + listview;

		if($('table#dtbl_barengan').length > 0){
			$.ajax({
				url: actionURL,
				type: 'post',
				dataType: 'json',
				success: function(data){

				},
				error: function(jqXHR, textStatus, errorThrown){
					alert('Error getting data, please contact Administrator');
				}
			});
		} else{
			alert('Tidak Ada tablenya');
		}
	}

	$('#my_form').parsley();

	$('#my_form').on('submit', function(ev){
		ev.preventDefault();
		if($('#my_form').parsley().isValid()){
			save();
		}
	});

	$('#btn_add').on('click', function(ev){
		ev.preventDefault();
		saveMethod = "create";

		$('#my_form')[0].reset();
		$('#my_form').parsley().reset();
		$('#my_modal .modal-header .modal-title').text('Add New Data');
		$('#my_modal').modal('show');
	});

	function edit(uid){
		saveMethod = "update";
		$('#my_form')[0].reset();
		
		action_url = myBaseURL + 'barengan/ajaxEdit/' + uid;
		$.ajax({
			url: action_url,
			type: 'post',
			dataType: 'json',
			success: function(res){
				dateDB = unixDate_to_myDate(res.Flight_dt);
				timeDB = unixDateTime_to_myTime(res.Flight_tm);
				$('[name="barengan_id"]').val(uid);
				$('[name="user_name"]').val(res.Booker);
				$('[name="flight_dt"]').val(dateDB);
				$('[name="flight_tm"]').val(timeDB);
				$('[name="origin"]').val(res.Origin);
				$('[name="destination"]').val(res.Destination);
				$('[name="flight_by"]').val(res.Flight_by);
				$('[name="note"]').val(res.Note);
				$('#my_modal .modal-header .modal-title').text('Edit Data');
				$('#my_modal').modal('show');
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error getting data, please contact Administrator');
			}
		});
	}

	function save(){
		let actionURL;
		actionURL = myBaseURL + 'barengan/ajaxAction/' + saveMethod;

		$.ajax({
			url: actionURL,
			type: 'post',
			data: $('#my_form').serialize(),
			dataType: 'json',
			success: function(res){
				$(".msgbox").empty();
				$('#my_modal').modal('hide');
				if(res.isSuccess === true){
					$('.msgbox').html(
						'<div class="alert alert-success" role="alert"> '+
						res.pesan +
						'</div>'
					);
				}else{
					if(res.pesan instanceof Object){
						$.each(res.pesan, function(index, value){
							$('.msgbox').append(value);
						});
					}
				}
				tblBarengan.ajax.reload(null, false);
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error during save execution, please contact Administrator');
			}
		});
	}

	function del(id){
		if(confirm('Are you sure delete this data ?')){
			$.ajax({
			url: myBaseURL + 'barengan/ajaxDelete/' + id,
			type: 'post',
			dataType: 'json',
			success: function(res){
				$('.msgbox').html(
					'<div class="alert alert-success" role="alert"> '+
					res.pesan +
					'</div>'
				);

				tblBarengan.ajax.reload(null, false);
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error during delete execution, please contact Administrator');
			}
		});
		}
	}

	function unixDate_to_myDate(UNIX_timestamp_date){
	  var a = new Date(UNIX_timestamp_date * 1000);
	  var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
	  var year = a.getFullYear();
	  var month = months[a.getMonth()];
	  var date = a.getDate();
	  // var hour = a.getHours();
	  // var min = a.getMinutes();
	  // var sec = a.getSeconds();
	  var time = date + '-' + month + '-' + year;// + ' ' + hour + ':' + min + ':' + sec ;
	  return time;
	}

	function unixDateTime_to_myTime(UNIX_timestamp_DateTime){
	  var a = new Date(UNIX_timestamp_DateTime * 1000);
	  var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
	  var year = a.getFullYear();
	  var month = months[a.getMonth()];
	  var date = a.getDate();
	  var hour = "0" + a.getHours() - 2;
	  var min = "0" + a.getMinutes();
	  var sec = a.getSeconds();
	  // var time = hour + ':' + min;
	  var time = hour + ':' + min.substr(-2);
	  return time;
	}


</script>