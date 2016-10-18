$(document).ready(function() {
	$('#search_type').val(0);
        $('.dropdown-menu li a').click(function(event) {
            $('#search_type').val($(this).data('id'));
            var name = $(this).text();
            $('#btnSelectType').html(name + ' <span class="caret"></span>');
        });
    });