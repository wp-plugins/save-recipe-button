function doSaveRecipe() {var BO_HOST = 'http://www.bigoven.com'; var x = document.createElement('script'); var parentUrl = document.URL; x.type = 'text/javascript'; x.src = BO_HOST + '/assets/noexpire/js/getrecipe.js?' + (new Date().getTime() / 100000); document.getElementsByTagName('head')[0].appendChild(x); } 

jQuery(document).ready(function($) {
	$(document).on('click', '.bo-integration-save-recipe', function(event) {
		event.preventDefault();
		event.stopImmediatePropagation();
        
        doSaveRecipe();
		//alert('save recipe');
	});

	$(document).on('click', '.bo-integration-grocery-list', function(event) {
		event.preventDefault();
		event.stopImmediatePropagation();

		alert('add to grocery list');
	});
});
