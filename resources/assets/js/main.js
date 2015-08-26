function Main(opts) {
	this.opts = opts == null ?  opts : {};
}

Main.prototype.objectToArray = function(obj) {
	return $.map(obj, function(value, index) {
		return [value];
	});
};

Main.prototype.spliceSlice = function(str, index, count, add) {
  return str.slice(0, index) + (add || "") + str.slice(index + count);
}

var main = new Main();

$(function(){
	$('#popover_link_aboutdi').popover({
		placement: 'auto',
		html: true,
	})

	$('#popover_link_methodology').popover({
		placement: 'auto',
		html: true,
	})

});

