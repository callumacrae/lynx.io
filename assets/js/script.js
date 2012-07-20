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
			error = false;

		$this.find('.error').hide();

		if (!this.name.value) {
			$this.find('#nameerror')
				.text('Please specify a name')
				.show();
			error = true;
		}
		if (!this.email.value) {
			$this.find('#emailerror')
				.text('Please specify an email address')
				.show();
			error = true;
		}
		if (!this.text.value) {
			$this.find('#texterror')
				.text('Please enter a message')
				.show();
			error = true;
		}

		if (!error) {
			$.post(url, $this.serialize(), function (body) {
				callback.call($this, body);
			});
		}

		return false;
	};
}

// Handle contact form submit
$('#contact').submit(genericFormHandler('contact', function (body) {
	"use strict";

	this.find('#texterror').text(body).show();
}));

// Handle comment form submit
(function () {
	"use strict";

	var comment_post = $('#comment_post')[0],
		newComment, url;

	if (!comment_post) {
		return;
	}

	url = comment_post.action + 'comment/' + comment_post.slug.value;
	$('#comment_post').submit(genericFormHandler(url, function (body) {
		if (typeof body === 'object') {
			newComment = $('#newcomment');
			newComment.find('.author strong').text(body.author);
			newComment.find('time').text(body.date);
			newComment.find('.body').html(body.text);
			newComment.show();
			this.hide();
			$('.nocomments').hide();
		} else {
			this.find('#texterror').text('Error: ' + body).show();
		}
	}));
})();


// Tabs in textarea
$('textarea').keydown(function (e) {
	"use strict";

	var start, end, nl, value,
		tabs = 0;

	if (e.keyCode === 9) {
		e.preventDefault();
		start = this.selectionStart;
		nl = end = this.selectionEnd;
		if (e.shiftKey) {
			// If shift key pressed, remove tabs from beginning of lines
			while (true) {
				value = this.value;
				nl = value.lastIndexOf('\n', nl - 2) + 1;
				if (value.slice(nl, nl + 1) === '\t') {
					tabs += 1;
					this.value = value.slice(0, nl) + value.slice(nl + 1);
				}
				if (nl <= start) {
					this.selectionStart = start - 1;
					this.selectionEnd = end - tabs;
					break;
				}
			}
		} else if (start === end) {
			// If no selection, insert tab
			value = this.value;
			this.value = value.slice(0, start) + '\t' + value.slice(start);
			this.selectionStart = this.selectionEnd = end + 1;
		} else {
			// If selection, insert tab at beginning of every line
			while (true) {
				value = this.value;
				tabs += 1;
				nl = value.lastIndexOf('\n', nl - 2) + 1;
				this.value = value.slice(0, nl) + '\t' + value.slice(nl);
				if (nl <= start) {
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

var tags = {};
$('.tags, .more').on('mouseover', 'a', function () {
	"use strict";

	var $this = $(this);

	if ($this.data('titled')) {
		$this.tipsy('show');
	} else if (tags[$this.text()]) {
		$this.attr('title', tags[$this.text()])
			.data('titled', true)
			.tipsy('show');
	} else {
		$.get($(this).attr('href'), function (title) {
			title += ' article' + (title === 1 ? '' : 's');
			tags[$this.text()] = title;
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


// Check for and handle new articles
(function () {
	"use strict";

	if (!$('.articles').length) {
		return; // Not on a listing
	}

	var articles = [],
		time = Date.now(),
		link = $('.newarticle'),
		refreshInterval = 30000;

	// Check for new articles (every 30 seconds, by default)
	setInterval(function () {
		var url = location.origin + location.pathname,

		// Timestamp needs / 1000 as it is in ns, while server wants ms
			data = {timestamp: Math.round(time / 1000)};

		$.get(url, data, function (newArticles) {
			// newArticles can equal "Invalid time", check for that
			if ($.isArray(newArticles) && newArticles.length) {
				articles = articles.concat(newArticles);

				link.find('p')
					.text(articles.length + ' new articles available');

				if (link.is(':hidden')) {
					link.slideDown();
				}
			}

			time = Date.now();
		});
	}, refreshInterval);

	// Handle "x new articles available" thingy being clicked
	link.click(function () {
		var i, footer, header, newArticle, tag;
		for (i = 0; i < articles.length; i++) {
			// Generate new article
			newArticle = $('<article class="articles"></article>');

			header = $('<header></header>').appendTo(newArticle);
			var a = $('<a></a>').appendTo(header)
				.attr('href', articles[i].href)
				.html('<h2>' + articles[i].title + '</h2>');

			$('<time></time>').appendTo(header)
				.addClass('articletime')
				.attr('datetime', articles[i].date[0])
				.text(articles[i].date[1]);

			$('<div></div>').appendTo(newArticle)
				.addClass('body')
				.html(articles[i].summary + ' ')
				.append('<a>Read more</a>')
				.children('a:last-child')
					.addClass('readmore')
					.attr('href', articles[i].href);

			footer = $('<footer></footer>').appendTo(newArticle);
			$('<a></a>').appendTo(footer)
				.addClass('comments')
				.attr('href', articles[i].href + '#comments')
				.text('0 comments'); // Assume zero comments, posted in last 20s

			tags = $('<div></div>').appendTo(footer)
				.addClass('tags index')
				.text('Tags:');

			for (tag in articles[i].tags) {
				if (articles[i].tags.hasOwnProperty(tag)) {
					tags.append(' <a></a>')
						.children('a:last-child')
							.attr('href', articles[i].tags[tag])
							.text(tag);
				}
			}

			newArticle.insertAfter(link);
		}

		articles = [];
		link.slideUp();
	});
})();


// Check for new comments
(function () {
	"use strict";

	if (!$('section.comments').length) {
		return; // No comments
	}

	var time = Date.now(),
		url = location.origin + location.pathname;

	setInterval(function () {
		var newComment,
			data = {timestamp: Math.round(time / 1000)};
		$.get(url, data, function (comments) {
			if ($.isArray(comments) && comments.length) {
				for (var i = 0; i < comments.length; i++) {
					newComment = $('#newcomment').clone()
						.insertBefore('#comment_post')
						.slideDown();

					if (comments[i].website) {
						newComment.find('.author strong')
							.html('<a></a>')
							.find('a')
								.attr('href', comments[i].website)
								.text(comments[i].author);
					} else {
						newComment.find('.author strong')
							.text(comments[i].author);
					}

					newComment.find('time').text(comments[i].date);
					newComment.find('.body').html(comments[i].text);
				}

				$('.nocomments').hide();
			}

			time = Date.now();
		});
	}, 15000);
})();