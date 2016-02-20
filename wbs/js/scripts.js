;(function($) {
	  
	  
   // Animated gauge charts
  /*var g1, g2;
  window.onload = function(){
    var g1 = new JustGage({
      id: "g1", 
      value:77, 
      min: 0,
      max: 100,
      title: "Right Now",
      label: "Users"
    });
    var g2 = new JustGage({
      id: "g2", 
      value: 115, 
      min: 0,
      max: 180,
      title: "CPU Usage",
      label: "RAM",
    });
    setInterval(function() {
      g1.refresh(getRandomInt(60, 80));
      g2.refresh(getRandomInt(120, 160));          
    }, 2500);
  };
*/
  // Real time update chart from sidebar



    $(function() {
    	$('#sidebar_menu a.accordion-toggle').on('click',function(){
    		var $current = $(this);
    		var hasClassOpened = $current.closest('li').hasClass('opened');
    		$current.closest('ul').find('li.opened').removeClass('opened');
    		if(!hasClassOpened) {
    			$current.closest('li').addClass('opened');
    		}
    	});
    	
    	   $('#github').Touchdown();
		
		$('select1').each(function(i,e) {

			if ( !($(e).data('convert') == 'no') ) {

				var select = $(e).hide(),
					label = select.children('option:selected').text(),
					color = select.children('option:selected').data('icon-color'),
					options = select.children('option'),
					labeled = select.data('labeled'),
					className = select.attr('class'),
					labelIcon = null;

				var dropdown = $('<div class="btn-group" id="select-group-' + i + '">').insertAfter(select),
					current = select.val() ? select.val() : '&nbsp;',
					li = null;

				labelIcon = (labeled) ? '<i class="icon-sign-blank ' + color + '"></i>' : '';

				$('<a class="btn dropdown-toggle ' + className + '" data-toggle="dropdown" href="#">' +	labelIcon + label + '<span class="icon-sort"></span></a>' +	'<ul class="dropdown-menu"></ul>')
					.appendTo(dropdown);

				options.each(function(o,q) {
					var iconColor = $(q).data('icon-color');

					if (typeof iconColor === 'undefined') {
						iconColor = ' color' + (o+1);
					} else {
						iconColor = ' ' + iconColor;
					}

					if (labeled) {
						labelIcon = '<i class="icon-sign-blank '+ iconColor+'"></i>';
					} else {
						labelIcon = '';
					}

					li = $('<li><a tabindex="-1" href="#" " data-value="' + $(q).attr('value') + '">'+ labelIcon + q.text +'</a></li>');

					dropdown
						.find('.dropdown-menu')
						.append(li);

					if ( $(q).attr('selected') ) {
						dropdown.find('.dropdown-menu li:eq(' + o + ')').click();
					}
				});

		        dropdown.find('.dropdown-menu a').click(function(e) {
		        	var self = $(this);
		        	e.preventDefault();
		            dropdown.find('.btn:eq(0)').html(self.html() + '<span class="icon-sort"></span>');
		            select.find('[selected]').removeAttr('selected');
		            select.find('[value="'+self.data('value')+'"]').attr('selected', 'selected');
		            select.change();
		        });
			}
		});

		// Change Dropdown expanding on hover for navbar and set links back
		$('.navbar').on('hover', ' .dropdown', function() {
			$(this).children('.dropdown-toggle').click();
		});

		// File Input
		$('.fileinput').customFileInput({
	        button_position : 'right'
	    });
	    
	    // Datepicker
		$( ".datepicker" ).datepicker();

		// Toggle

		var off = false;

		var toggle = $('.toggle');

		toggle.siblings().hide();
		toggle.show();

		if (toggle.siblings().find(':checked').val() == "on") {
			toggle.removeClass('off').addClass('on');
		} else {
			toggle.removeClass('on').addClass('off');
		};

		$('.content').on('click', '.toggle', function() {
			var self = $(this);

			if (self.hasClass('on')) {
				self.siblings('.off').click();
				self.removeClass('on').addClass('off');
			} else {
				self.siblings('.on').click();
				self.removeClass('off').addClass('on');
			}
		});

	});

})(jQuery);