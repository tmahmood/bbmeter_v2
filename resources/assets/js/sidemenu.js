function SideMenu(menuid) {
	this.menuid = menuid;
}

SideMenu.prototype.init = function() {
	this.hideSubMenues();
	this.onSubmenuClick();
};


SideMenu.prototype.hideSubMenues = function() {
	$(this.menuid + ' .submenu').each(function(indx, elm) {
		$(elm).next().hide();
	});
};


SideMenu.prototype.onSubmenuClick = function() {
	$(document).on('click', '.submenu', function(ev){
		ev.preventDefault();
		$(this).next().toggle();
	});
};

