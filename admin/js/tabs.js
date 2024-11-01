jQuery(document).ready(function($) {
	var tabs = $('.twgm-tabs');
	tabs.each(function() {
		var tab = $(this),
			tabItems = tab.find('ul.twgm-tabs-navigation'),
			tabContentWrapper = tab.children('ul.twgm-tabs-content'),
			tabNavigation = tab.find('nav');
			tabItems.on('click', 'a', function(event) {
				event.preventDefault();
				var selectedItem = $(this);
				if (!selectedItem.hasClass('selected')) {
					var selectedTab = selectedItem.data('content'),
						selectedContent = tabContentWrapper.find('li[data-content="'+selectedTab+'"]'),
						slectedContentHeight = selectedContent.innerHeight();		
					tabItems.find('a.selected').removeClass('selected');
					selectedItem.addClass('selected');
					selectedContent.addClass('selected').siblings('li').removeClass('selected');
					//animate tabContentWrapper height when content changes 
					tabContentWrapper.animate({
						'height': 'auto'//slectedContentHeight
					}, 200);
				}
				$.fn.dataTable.tables({visible: true, api: true}).columns.adjust();
			});
		//hide the .cd-tabs::after element when tabbed navigation has scrolled to the end (mobile version)
		checkScrolling(tabNavigation);
		tabNavigation.on('scroll', function(){ 
			checkScrolling($(this));
		});
	});
	
	$(window).on('resize', function() {
		tabs.each(function() {
			var tab = $(this);
			checkScrolling(tab.find('nav'));
			tab.find('.twgm-tabs-content').css('height', 'auto');
		});
	});

	function checkScrolling(tabs) {
		var totalTabWidth = parseInt(tabs.children('.twgm-tabs-navigation').width()),
		 	tabsViewport = parseInt(tabs.width());
		if (tabs.scrollLeft() >= totalTabWidth - tabsViewport) {
			tabs.parent('.twgm-tabs').addClass('is-ended');
		} else {
			tabs.parent('.twgm-tabs').removeClass('is-ended');
		}
	}
});