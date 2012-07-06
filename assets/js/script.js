// Unescape automatically escaped data in code samples. It's better
// to do this client-side to avoid parsing the DOM server-side.
$('article.comment .body pre code').each(function () {
	"use strict";

	this.innerHTML = this.innerHTML.replace(/&quot;/g, "'")
		.replace(/&lt;/g, '<')
		.replace(/&gt;/g, '>')
		.replace(/&amp;/g, '&');
});

$('input[name="email"]').tipsy({
	fade: true,
	gravity: 'w',
	trigger: 'focus'
});

/**
 * Handles the contact and comment post forms, both of which are
 * extremely similar - this is DRYer.
 *
 * @param string url The URL to send the data to.
 * @param function callback Well... a callback to be called.
 */
function genericFormHandler(url, callback) {
	"use strict";

	return function () {
		var $this = $(this),
			that = this,
			data = $this.serialize(),
			error = false;

		$this.find('.error').hide();

		if (!this.name.value) {
			$this.find('#nameerror').text('Please specify a name').show();
			error = true;
		}
		if (!this.email.value) {
			$this.find('#emailerror').text('Please specify an email address').show();
			error = true;
		}
		if (!this.text.value) {
			$this.find('#texterror').text('Please enter a message').show();
			error = true;
		}

		if (!error) {
			$.post(url, $this.serialize(), function (body) {
				callback.call(that, body)
				$this.find('#texterror').text('Error: ' + body).show();
			});
		}

		return false;
	};
}

// Handle contact form submit
$('#contact').submit(genericFormHandler('contact', function (body) {
	"use strict";

	$(this).find('#texterror').text(body).show();
}));

// Handle comment form submit
(function (comment_post) {
	"use strict";

	if (comment_post) {
		var url = comment_post.action + '/comment/' + comment_post.slug.value;
		$('#comment_post').submit(genericFormHandler(url, function (body) {
			if (typeof body === 'object') {
				var newComment = $('#newcomment');
				newComment.find('.author strong').text(body.author);
				newComment.find('time').text(body.date);
				newComment.find('.body').html(body.text);
				newComment.show();
				$(this).hide();
				$('.nocomments').hide();
			} else {
				$(this).find('#texterror').text('Error: ' + body).show();
			}
		}));
	}
})($('#comment_post')[0]);=


// Tabs in textarea
$('textarea').keydown(function (e) {
	"use strict";

	var start, end, nl,
		tabs = 0;

	if (e.keyCode === 9) {
		e.preventDefault();
		start = this.selectionStart;
		nl = end = this.selectionEnd;
		if (e.shiftKey) {
			// If shift key pressed, remove tabs from beginning of lines
			while (true) {
				nl = this.value.lastIndexOf('\n', nl - 1);
				if (this.value.slice(nl + 1, nl + 2) === '\t') {
					tabs += 1;
					this.value = this.value.slice(0, nl + 1) + this.value.slice(nl + 2);
				}
				if (nl < start) {
					this.selectionStart = start;
					this.selectionEnd = end - tabs;
					break;
				}
			}
		} else if (start === end) {
			// If no selection, insert tab
			this.value = this.value.slice(0, start) + '\t' + this.value.slice(start);
			this.selectionStart = this.selectionEnd = end + 1;
		} else {
			// If selection, insert tab at beginning of every line
			while (true) {
				tabs += 1;
				nl = this.value.lastIndexOf('\n', nl - 1);
				this.value = this.value.slice(0, nl + 1) + '\t' + this.value.slice(nl + 1);
				if (nl < start) {
					this.selectionStart = start + 1;
					this.selectionEnd = end + tabs;
					break;
				}
			}
		}
	}
});


// MD cheatsheet
$(document).keydown(function (e) {
	"use strict";

	var cheatsheet = $('#markdowncheat');
	if (e.keyCode === 77 && !$(':focus').length) {
		if (cheatsheet.is(':hidden')) {
			cheatsheet.fadeIn(200);
		} else {
			cheatsheet.click();
		}
		e.preventDefault();
	} else if (e.keyCode === 27 && cheatsheet.is(':visible')) {
		cheatsheet.click();
	}
});

$('#markdowncheat, #markdowncheat .close').click(function () {
	"use strict";

	$('#markdowncheat').fadeOut(200);
	return false;
}).children('div').click(function (e) {
	"use strict";

	e.stopPropagation();
});

$('.tags').on('mouseover', 'a', function () {
	"use strict";

	var $this = $(this);

	if ($this.data('titled')) {
		$this.tipsy('show');
	} else {
		$.get($(this).attr('href'), function (title) {
			title += ' article' + (title === 1 ? '' : 's');
			$this.attr('title', title)
				.data('titled', true)
				.tipsy('show');
		});
	}
}).on('mouseout', 'a', function () {
	"use strict";

	$(this).tipsy('hide');
}).children('a').tipsy({
	fade: true,
	gravity: 's',
	trigger: 'manual'
});