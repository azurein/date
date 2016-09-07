$(document).ready(function() {

	$(".addButton").click(function(){
		$("#addEditModal").modal("show");
	});

	$(".editButton").click(function(){
		$("#addEditModal").modal("show");
	});

	$(".participantFacilityButton").click(function(){
		$("#participantFacilityModal").modal("show");
	});

	$(".deleteCanvasButton").click(function(){
		$("#deleteCanvasModal").modal("show");
	});

	$(".deleteFacilityButton").click(function(){
		$("#deleteFacilityModal").modal("show");
	});
});