"use strict";

// Class definition
var KTWizard4 = function () {
	// Base elements
	var wizardEl;
	var formEl;
	var validator;
	var wizard;

	// Private functions
	var initWizard = function () {
		// Initialize form wizard
		wizard = new KTWizard('kt_wizard_v4', {
			startStep: 1, // initial active step number
			clickableSteps: true  // allow step clicking
		});

		// Validation before going to next page
		wizard.on('beforeNext', function(wizardObj) {
			if (validator.form() !== true) {
				wizardObj.stop();  // don't go to the next step
			}
		});

		wizard.on('beforePrev', function(wizardObj) {
			if (validator.form() !== true) {
				wizardObj.stop();  // don't go to the next step
			}
		});

		// Change event
		wizard.on('change', function(wizard) {
			KTUtil.scrollTop();
		});
	}

	var initValidation = function() {
		validator = formEl.validate({
			// Validate only visible fields
			ignore: ":hidden",

			// Validation rules
			rules: {
                "product_information[name]":{
                    required:true
                },
                "product_information[category_id]":{
                    required:true
                },
                "product_information[reference_number]":{
                    required:true
                },
                "product_information[brand]":{
                    required:true
                },
                "product_information[manufacturer]":{
                    required:true
                },
                "product_information[supplier_id]":{
                    required:true
                },
                "product_quantity[max_container]":{
                    required:true
                },
                "product_quantity[max_package]":{
                    required:true
                },
                "product_quantity[max_unit]":{
                    required:true
                },
                "product_cost[cost_of_one_container]":{
                    required:true
                },
                "product_cost[price_of_one_container]":{
                    required:true
                },
                // "product_cost[cost_of_one_package]":{
                //     required:true
                // },
                // "product_cost[price_of_one_package]":{
                //     required:true
                // },
                // "product_cost[cost_of_one_unit]":{
                //     required:true
                // },
                // "product_cost[price_of_one_unit]":{
                //     required:true
                // },
                "product_cost[container_barcode]":{
                    required:true
                },
                // "product_cost[package_barcode]":{
                //     required:true
                // },
                // "product_cost[unit_barcode]":{
                //     required:true
                // },

            },

			// Display error
			invalidHandler: function(event, validator) {
				KTUtil.scrollTop();

				swal.fire({
					"title": "",
					"text": "هنالك بعض الأخطاء ، يرجى اصلاحها",
					"type": "error",
					"confirmButtonClass": "btn btn-secondary",
					"confirmButtonText": "تم"
				});
			},

		});
	}


	return {
		// public functions
		init: function() {
			wizardEl = KTUtil.get('kt_wizard_v4');
			formEl = $('#kt_form');
			initWizard();
			initValidation();
		}
	};
}();

jQuery(document).ready(function() {
	KTWizard4.init();
});
