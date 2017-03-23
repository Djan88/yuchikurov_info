var RTOOLBAR = {
	bold: {
		title: RLANG.bold,
		exec: 'bold'
	},
	italic: {
		title: RLANG.italic,
		exec: 'italic'
	},
	deleted: {
		title: RLANG.deleted,
		exec: 'strikethrough',
	 	param: null,
		separator: true
	},
	link: {
		title: RLANG.link,
		func: 'show',
		dropdown:
		{
			link: 	{name: 'link', title: RLANG.link_insert, func: 'showLink'},
			unlink: {exec: 'unlink', name: 'unlink', title: RLANG.unlink}
		},
		separator: true
	},
	html: {
		title: RLANG.html,
		func: 'toggle'
	}
};