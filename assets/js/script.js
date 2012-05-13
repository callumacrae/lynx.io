// Unescape automatically escaped data in code samples. It's better
// to do this client-side to avoid parsing the DOM server-side.
$('article.comment .body pre code').each(function () {
	this.innerHTML = this.innerHTML.replace(/&quot;/g, "'")
		.replace(/&lt;/g, '<')
		.replace(/&gt;/g, '>')
		.replace(/&amp;/g, '&');
});

// Handle comment form submit
$('#comment_post').submit(function () {
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
