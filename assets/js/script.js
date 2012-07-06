// Unescape automatically escaped data in code samples. It's better
// to do this client-side to avoid parsing the DOM server-side.
$('article.comment .body pre code').each(function () {
	"use strict";

	this.innerHTML = this.innerHTML.replace(/&quot;/g, "'")
		.replace(/&lt;/g, '<')
		.replace(/&gt;/g, '>')
		.replace(/&amp;/g, '&');
});

// Handle comment form submit
$('#comment_post').submit(function () {
	"use strict";

	var $this = $(this);
	$this.find('.error').hide();

	var url = this.action + '/comment/' + this.slug.value;
	var data = $this.serialize();
	var error = false;

	if (!this.name.value) {
		$this.find('#nameerror').text('Please specify a name').show();
		error = true;
	}
	if (!this.email.value) {
		$this.find('#emailerror').text('Please specify an email address').show();
		error = true;
	}
	if (!this.text.value) {
		$this.find('#texterror').text('Please write a comment').show();
		error = true;
	}

	if (!error) {
		$.post(url, data, function (body) {
			if (typeof body === 'object') {
				var newComment = $('#newcomment');
				newComment.find('.author strong').text(body.author);
				newComment.find('time').text(body.date);
				newComment.find('.body').html(body.text);
				newComment.show();
				$this.hide();
				$('.nocomments').hide();
			} else {
				$this.find('#texterror').text('Error: ' + body).show();
			}
		});
	}
	return false;
});


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
					tabs++;
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
			this.selectionStart = end + 1;
			this.selectionEnd = end + 1;
		} else {
			// If selection, insert tab at beginning of every line
			while (true) {
				tabs++;
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
});
$('#markdowncheat div').click(function (e) {
	"use strict";

	e.stopPropagation();
});

$('.tags a, .more a').on({
	mouseover: function () {
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
	}, mouseout: function () {
		"use strict";

		$(this).tipsy('hide');
	}
}).tipsy({
	fade: true,
	gravity: 's',
	trigger: 'manual'
});

$('input[name="email"]').tipsy({
	fade: true,
	gravity: 'w',
	trigger: 'focus'
});