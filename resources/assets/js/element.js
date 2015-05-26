function createElement (opt) {

	var el = document.createElement(opt.el);

	if (opt.text != undefined) {
		if (typeof(opt.text) == "object") {
			$(el).append(opt.text);
		} else {
			$(el).text(opt.text);
		}
	}

	if (opt.cl != undefined) {
		$(el).addClass(opt.cl);
	}

	if (opt.id != undefined) {
		el.id = opt.id;
	}

	if (opt.elmlist != undefined) {
		for (var ci in opt.elmlist) {
			var ce = createElement(opt.elmlist[ci]);
			$(el).append(ce);
		}
	}

	for (attr in opt.attr) {
		$(el).attr(attr, opt.attr[attr]);
	}

	for (prop in opt.prop) {
		$(el).prop(prop, opt.prop[prop]);
	}

	return el;
}
