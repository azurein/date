$(document).ready(function() {

	$("#addButton").click(function(){
		$("#addEditModal").modal("show");
	});

	$(".showImage").click(function(){
		$("#imageModal").modal("show");
	});

	$(".showWinner").click(function(){
		$("#winnerModal").modal("show");
	});

	$(".showSetting").click(function(){
		$("#settingModal").modal("show");
	});

	$(".editButton").click(function(){
		$("#addEditModal").modal("show");
	});

	$(".deleteButton").click(function(){
		$("#deleteModal").modal("show");
	});
});