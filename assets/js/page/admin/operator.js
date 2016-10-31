var string = [];
var map = {};

$(document).ready(function() {
    $('title').html("D.A.T.E - Operator");
	getOperator();

	$("#addButton").click(function(){
		loadAddEditModal('Tambah Operator');
	});

	$(".fa-refresh").click(function(){
		getOperator();
	});

});

function getOperator(){
	$(".fa-refresh").addClass('fa-spin');
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'Operator/getOperator',
		dataType : 'json',
		success : function(data){
			populateTableOperator(data);
			$(".fa-refresh").removeClass('fa-spin');
		}
	});
}

function loadAddEditModal(param , operatorData=''){
	var curr_username = "";
	$("#addEditTitle").text(param);

	$("#nameTxt").val('');
	$("#usernameTxt").val('');
	$("#passwordTxt").val('');

	$("#nameTxt").val(operatorData.operator_name);

	if(operatorData.privilege) {
		$("#privilegeDdl").val(operatorData.privilege);
		curr_username = operatorData.username;
	}

	$("#usernameTxt").val(operatorData.username);
	$("#passwordTxt").val(operatorData.password);
	id = operatorData.user_id;

	$("#saveButton").unbind('click');
	$("#saveButton").click(function(){
		checkUsername($("#usernameTxt").val(), curr_username, id);
	});
	$("#addEditModal").modal("show");
}

function saveOperator(id){
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'Operator/saveOperator',
		dataType : 'json',
		data : {
			'id'		: id,
			'name'		: $("#nameTxt").val(),
			'privilege' : $("#privilegeDdl").val(),
			'username'	: $("#usernameTxt").val(),
			'password'	: $("#passwordTxt").val()
		},
		success : function(data){
			getOperator();
			$("#addEditModal").modal("hide");
		}
	});
}

function populateTableOperator(data){
	$('#operatorDataTable').DataTable().destroy();
	$('#contentTable').empty();

	for(var i = 0 ; i < data.length ; i++)
	{
		var privilege = "";
		if (data[i].privilege == 1) {
			privilege = "Admin";
		} else if (data[i].privilege == 2) {
			privilege = "Operator";
		}
		$('#contentTable').append('<tr value="'+data[i].user_id+'"><td>'+ data[i].operator_name +'</td><td>'+ data[i].username +'</td><td>'+ data[i].password +'</td><td>'+ privilege +'</td><td> <i class="editButton glyphicon glyphicon-pencil"></i><i class="deleteButton glyphicon glyphicon-trash"></i></td></tr>');
	}

	$(".deleteButton").click(function(){
		deleteOperator($(this).parent().parent().attr("value"),$(this).parent().siblings(".name").text());
	});

	$(".editButton").click(function(){
		getOperatorByID($(this).parent().parent().attr("value"));
	});

	$('#operatorDataTable').DataTable();
}

function deleteOperator(id,name){
	$("#deleteName").text('Anda yakin menghapus operator '+ name +' ?');
	$("#deleteModal").modal("show");
	$("#deleteButton").unbind('click').click(function(){
		$.ajax({
			type : 'POST',
			url : BASE_URL + 'Operator/deleteOperatorByID',
			dataType : 'json',
			data : {
				'id' : id
			},
			success : function(data){
				getOperator();
			}
		});
	});
}

function getOperatorByID(id){
	$.ajax({
		type : 'POST',
		url : BASE_URL + 'Operator/getOperatorByID',
		dataType : 'json',
		data : {
			'id' : id
		},
		success : function(data){
			loadAddEditModal('Ubah Operator',data[0]);
		}
	});
}

function checkUsername(username, curr_username, id){
    $.ajax({
        type : 'POST',
        url : BASE_URL + 'Operator/checkUsername',
        dataType : 'json',
        data : {
            'username' : username,
			'curr_username' : curr_username
        },
        success : function(data){
            if(data[0].checkUsername == 0)
                saveOperator(id);
            else
                alert("Username sudah terdaftar.");
        }
    });
}
