function Home(opts) {
	this.opts = opts == null ?  opts : {};
}

Home.prototype.onQuestionLinkClick = function() {
	var me = this;
	$(document).on('click', '.questions_link', function(ev){
		ev.preventDefault();
		$.get(this.href, me.makeList);
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
		$.get(this.href, me.drawChart);
	});
};

Home.prototype.drawChart = function(response) {
	$('#chart').empty();
	graphcore.drawChart(response);
};

var home = new Home();
$(function(){
	home.onQuestionLinkClick();
	home.onQuestionsListClick();
});

