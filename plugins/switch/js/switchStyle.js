 $(function() {
        $('.options-view a').on('click', function(e) {
            e.preventDefault();

            if ($(this).hasClass('active')) {
                // do nothing if the clicked link is already active
                return;
            }

            $('.options-view  a').removeClass('active');
            $(this).addClass('active');

            var clickid = $(this).attr('id');

            $('#listdisplay').fadeOut(240, function() {
                if (clickid == 'thumbnails-list') {
                    
                	$(".t-text-list").addClass('t-text');
                	$(".t-text").removeClass('t-text-list');
                	
                	$(this).addClass('thumbview');
                    
                } else {
                	
                	$(".t-text").addClass('t-text-list');
                	$(".t-text-list").removeClass('t-text');
                	
                    $(this).removeClass('thumbview');
                }

                $('#listdisplay').fadeIn(200);
            });
        });
    });