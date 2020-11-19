$(function(){

	$('#basVacancyModal').on('shown.bs.modal', function (event) {

		var this_title = $(event.relatedTarget).data('title');

		$('#actionTitle').val(this_title)
	});
});