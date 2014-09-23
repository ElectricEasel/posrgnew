window.addEvent('domready', function() {
	var colorEnablers = $(document.body).getElements('.color-enabler input[type=radio]');
	var colorEnablersChecked = $(document.body).getElements('.color-enabler input[type=radio]:checked');

	colorEnablersChecked.each(function(item){
		reviewStatus(item);
	});

	$(document.body).getElements('.radio.btn-group.color-enabler label').addEvent('click', function(e) {
		var input = $(document.body).getElement('#' + this.getAttribute('for'));
		var label = $(this);

		this.getParent().getChildren('input[type=radio]').each(function(item) {
			item.checked = false;
			item.removeAttribute('checked');
			reviewStatus(item);
		});

		reviewStatus(input);

	});

	function reviewStatus(field) {
		var fieldName = field.name;
		var colorNumber = fieldName.replace('jform[params][color', '').replace('_enabled]', '');
		var colorName = 'color' + colorNumber;
		var codeField = $(document.body).getElement('#jform_params_' +  colorName + '_code');
		var selectorField = $(document.body).getElement('#jform_params_' +  colorName + '_selector');
		var propertyField = $(document.body).getElement('#jform_params_' +  colorName + '_property');

		if (field.value === '1') {
			codeField.getParent('div.control-group').show();
			selectorField.getParent('div.control-group').show();
			propertyField.getParent('div.control-group').show();
        } else {
			codeField.getParent('div.control-group').hide();
			selectorField.getParent('div.control-group').hide();
			propertyField.getParent('div.control-group').hide();
        }
	}

	colorEnablers.addEvent('change',function(e) {
		reviewStatus(this);
	});
});
