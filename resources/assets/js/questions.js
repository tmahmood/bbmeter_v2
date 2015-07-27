function QuestionsMod() {
	this.setupEvents();
	this.selectCurrentQuestions();
}

QuestionsMod.prototype.setupEvents = function() {
	$(document).on('click', '.btn_fp', function(ev){
		ev.preventDefault();

		var thisid = this.id.split('_').pop();
		var qids = $('#frontpage_questions').val().split(',');
		var pos = qids.indexOf(thisid);
		if (pos == -1) {
			qids.push(thisid);
		} else {
			qids.splice(pos, 1);
		}
		$('#frontpage_questions').val(qids.join(','));
	});
};


QuestionsMod.prototype.selectCurrentQuestions = function() {
	var qids = $('#frontpage_questions').val().split(',');
	for (var i in qids) {
		var q = qids[i];
		var btnid = '#q_' + q;
		$(btnid).prop('checked', "true");
		$(btnid).prop('aria-pressed', "true");
		$(btnid).addClass('active');
	}
};



var questions = new QuestionsMod();

$(function(){
});
