$(document).ready(function () {
	$("#sidebar").mCustomScrollbar({
		theme: "minimal"
	});

	$('#sidebarCollapse').on('click', function () {
		$('#sidebar, #content').toggleClass('active');
		$('.collapse.in').toggleClass('in');
		$('a[aria-expanded=true]').attr('aria-expanded', 'false');
	});
});

$("#sidebarCollapse").on("click", function() {
			var el = $(this);
			if (el.text() == el.data("text-swap")) {
				el.text(el.data("text-original"));
			} else {
				el.data("text-original", el.text());
				el.text(el.data("text-swap"));

			}
		});