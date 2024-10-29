$(function () {
	$.ajaxSetup({
		cache: false,
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
		}
	});
	
	setTimeout(function(){
		$('.alert-dismissible').remove();
	}, 2000);

$('.delete_record').on('click', function(e){
    e.preventDefault();
    var rid = $(this).attr('rid');
    let url = $(this).attr('href');
    swal({
        title: "Are you sure?",
        text: "Want to delete this record",
        icon: "warning",
        buttons: ["Cancel", "Yes, Delete!"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {id: rid},
                success: function(res){
                    location.reload();
                }
            })
        }
    });
})

$('.publish_status').on('change', function(){
    var rid = $(this).attr('rid');
    let url = $(this).attr('url');
    let status = $(this).val();

        $.ajax({
                url: url,
                type: 'POST',
                data: {id: rid, status: status},
                success: function(res){
                    location.reload();
                }
            });
})

});
// $('.fancybox').fancybox({
//     clickContent: 'close',
//     buttons: ['close']
//   })


 setInterval(() => {
        $("#alert_msg").addClass('d-none');    
    }, 3000);