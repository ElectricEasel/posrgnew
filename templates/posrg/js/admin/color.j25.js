window.addEvent('domready', function() {
	var colorEnablers = $(document.body).getElements('.color-enabler input[type=radio]');
	var colorEnablersChecked = $(document.body).getElements('.color-enabler input[type=radio]:checked');

	colorEnablersChecked.each(function(item){
		reviewStatus(item);
	});

	function reviewStatus(field) {
		var fieldName = field.name;
		var colorNumber = fieldName.replace('jform[params][color', '').replace('_enabled]', '');
		var colorName = 'color' + colorNumber;
		var codeField = $(document.body).getElement('#jform_params_' +  colorName + '_code');
		var selectorField = $(document.body).getElement('#jform_params_' +  colorName + '_selector');
		var propertyField = $(document.body).getElement('#jform_params_' +  colorName + '_property');

		if (field.value === '1') {
			codeField.getParent().show();
			selectorField.getParent().show();
			propertyField.getParent().show();
        } else {
			codeField.getParent().hide();
			selectorField.getParent().hide();
			propertyField.getParent().hide();
        }
	}

	colorEnablers.addEvent('change',function(e) {
		reviewStatus(this);
	});
});
