/**
 * CountThis - A simple jQuery textarea counter and limiter
 *
 * @author  Steve Macey <smacey83@gmail.com>
 * @link    http://github.com/sjmaceyful/CountThis
 * @license GPL (http://www.gnu.org/licenses/gpl-3.0.html)
 * @version 1.0.1
 */

(function ($) {
	$.fn.countThis = function (options) {
		
		var input = $(this);
	
		// Set Options
		var defaults = {
			limit: 50,
			alert: true,
        	color: 'red'
		};
		var options = $.extend(defaults, options);
		var maxWords = options.limit;
		
		// Counter		
		input.after('<div id="counter"></div>');
		function count() {
			var val = $.trim(input.val()),
				words = val.replace(/\s+/gi, ' ').split(' ').length,
				chars = val.length;
			if (!chars) words = 0;

			$('#counter').html(''+ words + ' words. (Max. '+maxWords+')').css({
				'font-size' : '12px',
	  			'font-style' : 'italic'
			});
		}
		
		// Limit
		function limit() {
			input.keyup(function () {

				var wordArray = this.value.split(/[\s\.\?]+/); //Split based on regular expression for spaces
				var total_words = wordArray.length; //current total of words
				var newString = "";	//Reset content
				
				if (total_words > maxWords) {
					wordArray.splice(maxWords);
					input.val(wordArray.join(" "));
					$('#counter').css({
						'color' : options.color
					});
					if (options.alert == true) {
						alert('Sorry, maximum allowed words is '+maxWords+'.');
					}
				} else {
					$('#counter').css({
						'color' : 'inherit'
					});
				}

			});
		}
		
		count();
		limit();
		input.on('input', count);
	}

})(jQuery);