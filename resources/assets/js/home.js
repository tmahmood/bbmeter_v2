function Home(opts) {
	this.opts = opts == null ?  opts : {};
	this.current_response = null;
}

Home.prototype.onQuestionLinkClick = function() {
	var me = this;
	$(document).on('click', '.questions_link', function(ev){
		ev.preventDefault();
		$('.questions_link').removeClass('active');
		$(this).addClass('active');
		$.get(this.href, me.makeList);
	});
};

Home.prototype.onChartDisplayClick = function() {
	var me = this;
	$(document).on('click', '.chartToDisplay', function(ev){
		ev.preventDefault();

		$('.btn-primary').addClass('btn-default').removeClass('btn-primary');
		$(this).addClass('btn-primary');
		$('#chart').empty();

		var indx = this.href.split('#')[1];

		if (indx == 'main') {
			graphcore.drawChart(me.current_response[0]);
		} else {
			graphcore.drawChart(me.current_response[1][indx * 1]);
		}
	});
};


Home.prototype.makeList = function(response) {

	var ul = { el: 'ul', cl: 'questions_list', elmlist: [] };

	for (var i in response) {
		var row = response[i];

		var li = { el: 'li', elmlist: [] };
		var a  = { el: 'a', attr: [], cl: 'question_link' };

		a.attr.href = 'question/' + row.id;
		a.text = row.key;

		li.elmlist.push(a);
		ul.elmlist.push(li);
	}

	$('#questions_list').empty().append(createElement(ul));
};

Home.prototype.onQuestionsListClick = function() {
	var me = this;
	$(document).on('click', '.question_link', function(ev){
		ev.preventDefault();
		$('.question_link').parent().parent().find('li').removeClass('active');
		$(this).parent().addClass('active');
		$.get(this.href, function(response) {
			me.current_response = response;
			me.drawChart(response, me);
		});
	});
};

Home.prototype.drawChart = function(response, me) {
	$('#chart').empty();
	if (response.length != undefined) {
		if (response[0].type == 'GroupedMultiBar') {
			graphcore.drawChart(response[1][0]);
			$('#page-header').empty().append(response[1]['key']);
			$('#optionGroups').empty();
			if (response[1].length > 1) {
				var nav = me.makeDropDownList(response[2], true);
				$('#optionGroups').empty().append(createElement(nav));
			}
		} else {
			graphcore.drawChart(response[0]);
			$('#page-header').empty().append(response[0]['key']);
			var nav = me.makeDropDownList(response[2]);
			$('#optionGroups').empty().append(createElement(nav));
		}
	} else {
		$('#page-header').empty().append(response['key']);
		graphcore.drawChart(response);
		$('#optionGroups').empty();
	}
};

Home.prototype.makeDropDownList = function(option_groups, nomain) {
	if (nomain == true) {
		var ul = {
				el: 'div', cl: "btn-group", attr: { role: "group", "aria-label": "..." },
				elmlist : []
		}

	} else {
		var ul = {
				el: 'div', cl: "btn-group", attr: { role: "group", "aria-label": "..." },
				elmlist: [
					{ el: 'a', cl:"btn btn-primary chartToDisplay", text: 'National', attr: { href: "#main" } }
				]
			}
	}

	for (var r in option_groups) {
		var option_group = option_groups[r];
		ul.elmlist.push( { el: 'a', cl:"btn btn-default chartToDisplay", text: option_group, attr: { href: "#" + r } } );
	}

	return ul;
};


var home = new Home();
$(function(){
	home.onQuestionLinkClick();
	home.onQuestionsListClick();
	home.onChartDisplayClick();
});

