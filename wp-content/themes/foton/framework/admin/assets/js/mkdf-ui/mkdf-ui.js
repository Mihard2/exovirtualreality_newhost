(function($){
	window.mkdfUIAdmin = {};
	
	mkdfUIAdmin.mkdfInitDatePicker = mkdfInitDatePicker;
	mkdfUIAdmin.mkdfSelect2 = mkdfSelect2;
	mkdfUIAdmin.mkdfInitSwitch = mkdfInitSwitch;
	mkdfUIAdmin.mkdfInitMediaUploader = mkdfInitMediaUploader;
	mkdfUIAdmin.mkdfInitColorpicker = mkdfInitColorpicker;
	
	$(document).ready(function () {
		mkdfInitTooltips();
		mkdfInitColorpicker();
		mkdfInitRangeSlider();
		mkdfInitMediaUploader();
		mkdfInitGalleryUploader();
        mkdfInitSelectSwitcherChange();
        mkdfInitSwitch();
        mkdfInitSaveCheckBoxesValue();
        mkdfCheckBoxMultiSelectInitState();
        mkdfInitCheckBoxMultiSelectChange();
        mkdfCheckVisibilityOfAnchorSelectOptions();
        mkdfCheckOptionAnchorsOnDependencyChange();
		
		if ($('.mkdf-page-form').length > 0) {
			mkdfInitAjaxForm();
			mkdfInitSelectPicker();
		}
		
		mkdfInitDatePicker();
		mkdfInitSortable();
		mkdfSelect2();
		mkdfInitGeocomplete();
		mkdfShowHidePostFormats();
		mkdfImportOptions();
		mkdfImportCustomSidebars();
		mkdfImportWidgets();
	});

    $(window).load(function () {
        mkdfShowHidePostFormatsGutenberg();
    });

	function mkdfInitTooltips() {
		var holder = $('.mkdf-tooltip');
		
		if (holder.length) {
			holder.tooltip();
		}
	}

    function mkdfShowHidePostFormatsGutenberg() {
	    var gutenbergEditor = $('.block-editor__container');

        if(gutenbergEditor.length) {
            var gPostFormatField = gutenbergEditor.find('.editor-post-format');

            gPostFormatField.find('select option').each(function () {
                $('#mkdf-meta-box-post_format_' + $(this).val() + '_meta').hide();
            });

            if (gPostFormatField.find('select option:selected')) {
                $('#mkdf-meta-box-post_format_' + gPostFormatField.find('select option:selected').val() + '_meta').fadeIn();
            }

            gPostFormatField.find('select').change(function(){
                mkdfShowHidePostFormatsGutenberg();
            })
        }
    }
	
	function mkdfInitColorpicker() {
		var holder = $('.mkdf-page .my-color-field');
		
		if (holder.length) {
			holder.wpColorPicker({
				change: function (event, ui) {
					$('.mkdf-input-change').addClass('yes');
				}
			});
		}
	}
	
	function mkdfInitMediaUploaderAdded(addButton) {
		addButton.siblings('.mkdf-portfolio-media:last').find('.mkdf-media-uploader').each(function(){
			var thisItem = $(this),
				fileFrame,
				uploadUrl,
				uploadHeight,
				uploadWidth,
				uploadImageHolder,
				attachment,
				removeButton;
			
			//set variables values
			uploadUrl           = thisItem.find('.mkdf-media-upload-url');
			uploadHeight        = thisItem.find('.mkdf-media-upload-height');
			uploadWidth        = thisItem.find('.mkdf-media-upload-width');
			uploadImageHolder   = thisItem.find('.mkdf-media-image-holder');
			removeButton        = thisItem.find('.mkdf-media-remove-btn');
			
			if (uploadImageHolder.find('img').attr('src') !== '') {
				removeButton.show();
				mkdfInitMediaRemoveBtn(removeButton);
			}
			
			thisItem.on('click', '.mkdf-media-upload-btn', function() {
				//if the media frame already exists, reopen it.
				if (fileFrame) {
					fileFrame.open();
					return;
				}
				
				var clickedItem = $(this);
				
				//create the media frame
				fileFrame = wp.media.frames.fileFrame = wp.media({
					title: clickedItem.data('frame-title'),
					button: {
						text: clickedItem.data('frame-button-text')
					},
					multiple: false
				});
				
				//when an image is selected, run a callback
				fileFrame.on( 'select', function() {
					attachment = fileFrame.state().get('selection').first().toJSON();
					removeButton.show();
					mkdfInitMediaRemoveBtn(removeButton);
					
					//write to url field and img tag
					if(attachment.hasOwnProperty('url') && attachment.hasOwnProperty('sizes')) {
						uploadUrl.val(attachment.url);
						
						if (attachment.sizes.thumbnail) {
							uploadImageHolder.find('img').attr('src', attachment.sizes.thumbnail.url);
						} else {
							uploadImageHolder.find('img').attr('src', attachment.url);
						}
						
						uploadImageHolder.show();
					} else if (attachment.hasOwnProperty('url')) {
						uploadUrl.val(attachment.url);
						uploadImageHolder.find('img').attr('src', attachment.url);
						uploadImageHolder.show();
					}
					
					//write to hidden meta fields
					if(attachment.hasOwnProperty('height')) {
						uploadHeight.val(attachment.height);
					}
					
					if(attachment.hasOwnProperty('width')) {
						uploadWidth.val(attachment.width);
					}
					
					$('.mkdf-input-change').addClass('yes');
				});
				
				//open media frame
				fileFrame.open();
			});
		});
		
		function mkdfInitMediaRemoveBtn(btn) {
			btn.on('click', function() {
				//remove image src and hide it's holder
				btn.siblings('.mkdf-media-image-holder').hide();
				btn.siblings('.mkdf-media-image-holder').find('img').attr('src', '');
				
				//reset meta fields
				btn.siblings('.mkdf-media-meta-fields').find('input[type="hidden"]').each(function(e) {
					$(this).val('');
				});
				
				btn.hide();
			});
		}
	}
	
	function mkdfInitDatePicker() {
		var holder = $('.mkdf-input.datepicker');
		
		if (holder.length) {
			holder.datepicker({dateFormat: "yy-mm-dd"});
		}
	}
	
	function mkdfInitSelectPicker() {
		var holder = $('.mkdf-selectpicker');
		
		if (holder.length) {
			holder.selectpicker();
		}
	}
	
	function mkdfInitRangeSlider() {
		var holder = $('.mkdf-slider-range');
		
		if (holder.length) {
			holder.each(function () {
				var thisItem = $(this),
					Link = $.noUiSlider.Link;
				
				var start = 0;            //starting position of slider
				var min = 0;            //minimal value
				var max = 100;          //maximal value of slider
				var step = 1;            //number of steps to snap to
				var orientation = 'horizontal';   //orientation. Could be vertical or horizontal
				var prefix = '';           //prefix to the serialized value that is written field
				var postfix = '';           //postfix to the serialized value that is written to field
				var thousand = '';           //separator for thousand
				var decimals = 2;            //number of decimals
				var mark = '.';          //decimal separator
				
				//is data-start attribute set for current instance?
				if (thisItem.data('start') !== null && thisItem.data('start') !== "" && thisItem.data('start') !== "0.00") {
					start = thisItem.data('start');
					if (start === "1.00") start = 1;
					
					if (parseInt(start) === start) {
						start = parseInt(start);
					}
				}
				
				//is data-min attribute set for current instance?
				if (thisItem.data('min') !== null && thisItem.data('min') !== "") {
					min = thisItem.data('min');
				}
				
				//is data-max attribute set for current instance?
				if (thisItem.data('max') !== null && thisItem.data('max') !== "") {
					max = thisItem.data('max');
				}
				
				//is data-step attribute set for current instance?
				if (thisItem.data('step') !== null && thisItem.data('step') !== "") {
					step = thisItem.data('step');
				}
				
				//is data-orientation attribute set for current instance?
				if (thisItem.data('orientation') !== null && thisItem.data('orientation') !== "") {
					//define available orientations
					var availableOrientations = ['horizontal', 'vertical'];
					
					//is data-orientation value in array of available orientations?
					if (availableOrientations.indexOf(thisItem.data('orientation'))) {
						orientation = thisItem.data('orientation');
					}
				}
				
				//is data-prefix attribute set for current instance?
				if (thisItem.data('prefix') !== null && thisItem.data('prefix') !== "") {
					prefix = thisItem.data('prefix');
				}
				
				//is data-postfix attribute set for current instance?
				if (thisItem.data('postfix') !== null && thisItem.data('postfix') !== "") {
					postfix = thisItem.data('postfix');
				}
				
				//is data-thousand attribute set for current instance?
				if (thisItem.data('thousand') !== null && thisItem.data('thousand') !== "") {
					thousand = thisItem.data('thousand');
				}
				
				//is data-decimals attribute set for current instance?
				if (thisItem.data('decimals') !== null && thisItem.data('decimals') !== "") {
					decimals = thisItem.data('decimals');
				}
				
				//is data-mark attribute set for current instance?
				if (thisItem.data('mark') !== null && thisItem.data('mark') !== "") {
					mark = thisItem.data('mark');
				}
				
				thisItem.noUiSlider({
					start: start,
					step: step,
					orientation: orientation,
					range: {
						'min': min,
						'max': max
					},
					serialization: {
						lower: [
							new Link({
								target: thisItem.prev('.mkdf-slider-range-value')
							})
						],
						format: {
							// Set formatting
							thousand: thousand,
							postfix: postfix,
							prefix: prefix,
							decimals: decimals,
							mark: mark
						}
					}
				}).on({
					change: function () {
						$('.mkdf-input-change').addClass('yes');
					}
				});
			});
		}
	}
	
	function mkdfInitMediaUploader() {
		var holder = $('.mkdf-media-uploader');
		
		if (holder.length) {
			holder.each(function () {
				var thisItem = $(this);
				var fileFrame;
				var uploadUrl;
				var uploadHeight;
				var uploadWidth;
				var uploadImageHolder;
				var attachment;
				var removeButton;
				
				//set variables values
				uploadUrl = thisItem.find('.mkdf-media-upload-url');
				uploadHeight = thisItem.find('.mkdf-media-upload-height');
				uploadWidth = thisItem.find('.mkdf-media-upload-width');
				uploadImageHolder = thisItem.find('.mkdf-media-image-holder');
				removeButton = thisItem.find('.mkdf-media-remove-btn');
				
				if (uploadImageHolder.find('img').attr('src') !== "") {
					removeButton.show();
					mkdfInitMediaRemoveBtn(removeButton);
				}
				
				thisItem.on('click', '.mkdf-media-upload-btn', function () {
					//if the media frame already exists, reopen it.
					if (fileFrame) {
						fileFrame.open();
						return;
					}
					
					//create the media frame
					fileFrame = wp.media.frames.fileFrame = wp.media({
						title: $(this).data('frame-title'),
						button: {
							text: $(this).data('frame-button-text')
						},
						multiple: false
					});
					
					//when an image is selected, run a callback
					fileFrame.on('select', function () {
						attachment = fileFrame.state().get('selection').first().toJSON();
						removeButton.show();
						mkdfInitMediaRemoveBtn(removeButton);
						
						//write to url field and img tag
						if (attachment.hasOwnProperty('url') && attachment.hasOwnProperty('sizes')) {
							uploadUrl.val(attachment.url);
							
							if (attachment.sizes.thumbnail) {
								uploadImageHolder.find('img').attr('src', attachment.sizes.thumbnail.url);
							} else {
								uploadImageHolder.find('img').attr('src', attachment.url);
							}
							
							uploadImageHolder.show();
						} else if (attachment.hasOwnProperty('url')) {
							uploadUrl.val(attachment.url);
							uploadImageHolder.find('img').attr('src', attachment.url);
							uploadImageHolder.show();
						}
						
						//write to hidden meta fields
						if (attachment.hasOwnProperty('height')) {
							uploadHeight.val(attachment.height);
						}
						
						if (attachment.hasOwnProperty('width')) {
							uploadWidth.val(attachment.width);
						}
						
						$('.mkdf-input-change').addClass('yes');
					});
					
					//open media frame
					fileFrame.open();
				});
			});
		}
		
		function mkdfInitMediaRemoveBtn(btn) {
			btn.on('click', function () {
				//remove image src and hide it's holder
				btn.siblings('.mkdf-media-image-holder').hide();
				btn.siblings('.mkdf-media-image-holder').find('img').attr('src', '');
				
				//reset meta fields
				btn.siblings('.mkdf-media-meta-fields').find('input[type="hidden"]').each(function (e) {
					$(this).val('');
				});
				
				btn.hide();
			});
		}
	}
	
	function mkdfInitGalleryUploader() {
		var $mkdf_upload_button = jQuery('.mkdf-gallery-upload-btn'),
			$mkdf_clear_button = jQuery('.mkdf-gallery-clear-btn');
		
		wp.media.customlibEditGallery1 = {
			frame: function () {
				
				if (this._frame)
					return this._frame;
				
				var selection = this.select();
				
				this._frame = wp.media({
					id: 'mkdf-portfolio-image-gallery',
					frame: 'post',
					state: 'gallery-edit',
					title: wp.media.view.l10n.editGalleryTitle,
					editing: true,
					multiple: true,
					selection: selection
				});
				
				this._frame.on('update', function () {
					var controller = wp.media.customlibEditGallery1._frame.states.get('gallery-edit');
					var library = controller.get('library');
					// Need to get all the attachment ids for gallery
					var ids = library.pluck('id');
					
					$input_gallery_items.val(ids);
					
					jQuery.ajax({
						type: "post",
						url: ajaxurl,
						data: "action=foton_mikado_gallery_upload_get_images&ids=" + ids,
						success: function (data) {
							$thumbs_wrap.empty().html(data);
						}
					});
				});
				
				return this._frame;
			},
			
			init: function () {
				$mkdf_upload_button.on('click', function (event) {
					$thumbs_wrap = $(this).parent().prev().prev();
					$input_gallery_items = $thumbs_wrap.next();
					
					event.preventDefault();
					wp.media.customlibEditGallery1.frame().open();
				});
				
				$mkdf_clear_button.on('click', function (event) {
					$thumbs_wrap = $mkdf_upload_button.parent().prev().prev();
					$input_gallery_items = $thumbs_wrap.next();
					
					event.preventDefault();
					$thumbs_wrap.empty();
					$input_gallery_items.val("");
				});
			},
			
			// Gets initial gallery-edit images. Function modified from wp.media.gallery.edit
			// in wp-includes/js/media-editor.js.source.html
			select: function () {
				
				var shortcode = wp.shortcode.next('gallery', '[gallery ids="' + $input_gallery_items.val() + '"]'),
					defaultPostId = wp.media.gallery.defaults.id,
					attachments, selection;
				
				// Bail if we didn't match the shortcode or all of the content.
				if (!shortcode)
					return;
				
				// Ignore the rest of the match object.
				shortcode = shortcode.shortcode;
				
				if (_.isUndefined(shortcode.get('id')) && !_.isUndefined(defaultPostId))
					shortcode.set('id', defaultPostId);
				
				attachments = wp.media.gallery.attachments(shortcode);
				selection = new wp.media.model.Selection(attachments.models, {
					props: attachments.props.toJSON(),
					multiple: true
				});
				
				selection.gallery = attachments.gallery;
				
				// Fetch the query's attachments, and then break ties from the
				// query to allow for sorting.
				selection.more().done(function () {
					// Break ties with the query.
					selection.props.set({
						query: false
					});
					selection.unmirror();
					selection.props.unset('orderby');
				});
				
				return selection;
			}
		};
		
		$(wp.media.customlibEditGallery1.init);
	}
	
	function mkdfInitSortable() {
		var sortingHolder = $('.mkdf-sortable-holder'),
			enableParentChild = sortingHolder.hasClass('mkdf-enable-pc');
		
		if (sortingHolder.length) {
			sortingHolder.sortable({
				handle: '.mkdf-repeater-sort',
				cursor: 'move',
				placeholder: "placeholder",
				start: function (event, ui) {
					ui.placeholder.height(ui.item.height());
					if (enableParentChild) {
						if (ui.helper.hasClass('second-level')) {
							ui.placeholder.removeClass('placeholder');
							ui.placeholder.addClass('placeholder-sub');
						}
						else {
							ui.placeholder.removeClass('placeholder-sub');
							ui.placeholder.addClass('placeholder');
						}
					}
				},
				sort: function (event, ui) {
					if (enableParentChild) {
						var pos;
						if (ui.helper.hasClass('second-level')) {
							pos = ui.position.left + 50;
						}
						else {
							pos = ui.position.left;
						}
						if (pos >= 75 && !ui.helper.hasClass('second-level') && !ui.helper.hasClass('mkdf-sort-parent')) {
							ui.placeholder.removeClass('placeholder');
							ui.placeholder.addClass('placeholder-sub');
							ui.helper.addClass('second-level');
						}
						else if (pos < 30 && ui.helper.hasClass('second-level') && !ui.helper.hasClass('mkdf-sort-child')) {
							ui.placeholder.removeClass('placeholder-sub');
							ui.placeholder.addClass('placeholder');
							ui.helper.removeClass('second-level');
						}
					}
				}
			});
		}
	}
	
	function mkdfSelect2() {
		var holder = $('select.mkdf-select2');
		
		if (holder.length) {
			holder.select2({
				allowClear: true
			});
		}
	}
	
	function mkdfInitGeocomplete() {
		var geo_inputs = $(".mkdf-address-field");
		
		if (geo_inputs.length && !$('body').hasClass('mkdf-empty-google-api')) {
			geo_inputs.each(function () {
				var geo_input = $(this),
					reset = geo_input.find("#reset"),
					inputField = geo_input.find('input'),
					mapField = geo_input.find('.map_canvas'),
					countryLimit = geo_input.data('country'),
					latFieldName = geo_input.data('lat-field'),
					latField = $("input[name=" + latFieldName + "]"),
					longFieldName = geo_input.data('long-field'),
					longField = $("input[name=" + longFieldName + "]"),
					initialAddress = inputField.val(),
					initialLat = latField.val(),
					initialLong = longField.val();
				
				inputField.geocomplete({
					map: mapField,
					details: ".mkdf-address-elements",
					detailsAttribute: "data-geo",
					types: ["geocode", "establishment"],
					country: countryLimit,
					markerOptions: {
						draggable: true
					}
				});
				
				inputField.on('bind', 'geocode:dragged', function (event, latLng) {
					latField.val(latLng.lat());
					longField.val(latLng.lng());
					$("#reset").show();
					var map = inputField.geocomplete("map");
					map.panTo(latLng);
					var geocoder = new google.maps.Geocoder();
					
					geocoder.geocode({'latLng': latLng}, function (results, status) {
						if (status === google.maps.GeocoderStatus.OK) {
							if (results[0]) {
								var road = results[0].address_components[1].short_name;
								var town = results[0].address_components[2].short_name;
								var county = results[0].address_components[3].short_name;
								var country = results[0].address_components[4].short_name;
								inputField.val(road + ' ' + town + ' ' + county + ' ' + country);
							}
						}
					});
				});
				
				inputField.on('focus', function () {
					var map = inputField.geocomplete("map");
					google.maps.event.trigger(map, 'resize')
				});
				reset.on("click", function () {
					inputField.geocomplete("resetMarker");
					inputField.val(initialAddress);
					latField.val(initialLat);
					longField.val(initialLong);
					$("#reset").hide();
					return false;
				});
				
				$(window).on("load", function () {
					inputField.trigger("geocode");
				})
			});
		}
	}
	
	function mkdfShowHidePostFormats() {
		$('input[name="post_format"]').each(function () {
			var id = $(this).attr('id');
			
			if (id !== '' && id !== undefined) {
				var metaboxName = id.replace(/-/g, '_');
				
				$('#mkdf-meta-box-' + metaboxName + '_meta').hide();
			}
		});
		
		var selectedId = $("input[name='post_format']:checked").attr("id");
		
		if (selectedId !== '' && selectedId !== undefined) {
			var selected = selectedId.replace(/-/g, '_');
			$('#mkdf-meta-box-' + selected + '_meta').fadeIn();
		}
		
		$("input[name='post_format']").change(function () {
			mkdfShowHidePostFormats();
		});
	}
	
	function mkdfInitAjaxForm() {
		$('#mkdf_top_save_button').on('click', function () {
			$('.mkdf_ajax_form').submit();
			
			var inputChangeClass = $('.mkdf-input-change.yes'),
				changesClass = $('.mkdf-changes-saved');
			
			if (inputChangeClass.length) {
				inputChangeClass.removeClass('yes');
			}
			
			changesClass.addClass('yes');
			setTimeout(function () {
				changesClass.removeClass('yes');
			}, 3000);
			
			return false;
		});
		
		$(document).delegate(".mkdf_ajax_form", "submit", function (a) {
			var b = $(this),
				c = {
					action: "foton_mikado_save_options"
				};
			
			jQuery.ajax({
				url: ajaxurl,
				cache: !1,
				type: "POST",
				data: jQuery.param(c, !0) + "&" + b.serialize()
			}), a.preventDefault(), a.stopPropagation()
		})
	}
	
	function mkdfImportOptions() {
		var holder = $('.mkdf-backup-options-page-holder');
		
		if (holder.length) {
			var mkdfImportBtn = $('#mkdf-import-theme-options-btn');
			
			mkdfImportBtn.on('click', function (e) {
				e.preventDefault();
				
				if (confirm('Are you sure, you want to import Options now?')) {
					mkdfImportBtn.blur();
					mkdfImportBtn.text('Please wait');
					
					var importValue = $('#import_theme_options').val(),
						importNonce = $('#mkdf_import_theme_options_secret').val();
					
					var data = {
						action: 'foton_core_import_theme_options',
						content: importValue,
						nonce: importNonce
					};
					
					$.ajax({
						type: "POST",
						url: ajaxurl,
						data: data,
						success: function (data) {
							var response = JSON.parse(data);
							
							if (response.status === 'error') {
								alert(response.message);
							} else {
								mkdfImportBtn.text('Import');
								$('.mkdf-bckp-message').text(response.message);
							}
						}
					});
				}
			});
		}
	}
	
	function mkdfImportCustomSidebars() {
		var holder = $('.mkdf-backup-options-page-holder');
		
		if (holder.length) {
			var mkdfImportBtn = $('#mkdf-import-custom-sidebars-btn');
			
			mkdfImportBtn.on('click', function (e) {
				e.preventDefault();
				
				if (confirm('Are you sure, you want to import Custom Sidebars now?')) {
					mkdfImportBtn.blur();
					mkdfImportBtn.text('Please wait');
					
					var importValue = $('#import_custom_sidebars').val(),
						importNonce = $('#mkdf_import_custom_sidebars_secret').val();
					
					var data = {
						action: 'foton_core_import_custom_sidebars',
						content: importValue,
						nonce: importNonce
					};
					
					$.ajax({
						type: "POST",
						url: ajaxurl,
						data: data,
						success: function (data) {
							var response = JSON.parse(data);
							
							if (response.status === 'error') {
								alert(response.message);
							} else {
								mkdfImportBtn.text('Import');
								$('.mkdf-bckp-message').text(response.message);
							}
						}
					});
				}
			});
		}
	}
	
	function mkdfImportWidgets() {
		var holder = $('.mkdf-backup-options-page-holder');
		
		if (holder.length) {
			var mkdfImportBtn = $('#mkdf-import-widgets-btn');
			
			mkdfImportBtn.on('click', function (e) {
				e.preventDefault();
				
				if (confirm('Are you sure, you want to import Widgets now?')) {
					mkdfImportBtn.blur();
					mkdfImportBtn.text('Please wait');
					
					var importValue = $('#import_widgets').val(),
						importNonce = $('#mkdf_import_widgets_secret').val();
					
					var data = {
						action: 'foton_core_import_widgets',
						content: importValue,
						nonce: importNonce
					};
					
					$.ajax({
						type: "POST",
						url: ajaxurl,
						data: data,
						success: function (data) {
							var response = JSON.parse(data);
							
							if (response.status === 'error') {
								alert(response.message);
							} else {
								mkdfImportBtn.text('Import');
								$('.mkdf-bckp-message').text(response.message);
							}
						}
					});
				}
			});
		}
	}

    function mkdfInitSelectSwitcherChange() { //used in lms plugin
        var switchers = $('select.mkdf-switcher');
        switchers.each(function() {
            changeActions($(this), $(this).val(), true);
        });

        switchers.on('change', function (e) {
            var valueSelected = this.value.replace(/ /g, '');
            changeActions($(this), valueSelected, false);
        });

        function changeActions(selectField, valueSelected, initialCall) {
            var switchType = selectField.data('switch-type');
            var switchProperty = selectField.data('switch-property');
            var switchEnabled = selectField.data('switch-enabled');

            if (switchType === 'single_yesno') {
                var switchers = $('.switch-' + switchProperty);
                if (switchEnabled === valueSelected) {
                    switchers.addClass('mkdf-switch-single-mode');
                    switchers.attr('data-switch-selector', switchProperty);
                } else {
                    switchers.removeClass('mkdf-switch-single-mode');
                    switchers.removeAttr('data-switch-selector');
                }

                //On property change leave only one switcher enabled
                if(!initialCall) {
                    var oneSwitcherEnabled = false;
                    switchers.removeClass('switcher-auto-enabled');
                    switchers.each(function () {
                        var switcher = $(this);
                        var enabled = $(this).find('.cb-enable');
                        if (!oneSwitcherEnabled && enabled.hasClass('selected')) {
                            oneSwitcherEnabled = true;
                            $(this).addClass('switcher-auto-enabled');
                        }
                        if (!switcher.hasClass('switcher-auto-enabled')) {
                            switcher.find('.cb-disable').addClass('selected');
                            switcher.find('.cb-enable').removeClass('selected');
                            switcher.find('.checkbox').attr('checked', false);
                            switcher.find('.checkboxhidden_yesno').val("no");
                        }
                    });
                }
            }
        }
    }

    function mkdfInitSwitch() {
        //Logic for setting element initial to be no
        var yesNoElements = $(".switch");
        yesNoElements.each(function () {
            var element = $(this);
            if (element.parents('.mkdf-repeater-field') && !element.find('input[type="hidden"]').val()) {
                element.find('.cb-enable').removeClass('selected');
                element.find('.cb-disable').addClass('selected');
            }
        });
        $(".cb-enable").on('click', function(){
            var parent = $(this).parents('.switch');
            //This condition is if only one element can be active, developed for repeater purposes
            //First disable all yes/no elements...
            if(parent.hasClass('mkdf-switch-single-mode')) {
                var selector = '.switch-'+ parent.data('switch-selector');
                var switchers = $(selector);
                switchers.each(function() {
                    var switcher = $(this);
                    switcher.find('.cb-disable').addClass('selected');
                    switcher.find('.cb-enable').removeClass('selected');
                    switcher.find('.checkbox').attr('checked', false);
                    switcher.find('.checkboxhidden_yesno').val("no");
                });
                //Then enable the one that is clicked
                $('.cb-disable', parent).removeClass('selected');
                $(this).addClass('selected');
                $('.checkbox',parent).attr('checked', true);
                $('.checkboxhidden_yesno',parent).val("yes");
            } else {
                $('.cb-disable', parent).removeClass('selected');
                $(this).addClass('selected');
                $('.checkbox', parent).attr('checked', true);
                $('.checkboxhidden_yesno', parent).val("yes");
                $('.checkboxhidden_portfoliofollow', parent).val("portfolio_single_follow");
                $('.checkboxhidden_zeroone', parent).val("1");
                $('.checkboxhidden_imagevideo', parent).val("image");
                $('.checkboxhidden_yesempty', parent).val("yes");
                $('.checkboxhidden_flagpost', parent).val("post");
                $('.checkboxhidden_flagpage', parent).val("page");
                $('.checkboxhidden_flagmedia', parent).val("attachment");
                $('.checkboxhidden_flagportfolio', parent).val("portfolio_page");
                $('.checkboxhidden_flagproduct', parent).val("product");
            }
        });
        $(".cb-disable").on('click', function(){
            var parent = $(this).parents('.switch');
            //If only one element can be active, than no value shouldn't be clickable
            if(!parent.hasClass('mkdf-switch-single-mode')) {
                $('.cb-enable', parent).removeClass('selected');
                $(this).addClass('selected');
                $('.checkbox', parent).attr('checked', false);
                $('.checkboxhidden_yesno', parent).val("no");
                $('.checkboxhidden_portfoliofollow', parent).val("portfolio_single_no_follow");
                $('.checkboxhidden_zeroone', parent).val("0");
                $('.checkboxhidden_imagevideo', parent).val("video");
                $('.checkboxhidden_yesempty', parent).val("");
                $('.checkboxhidden_flagpost', parent).val("");
                $('.checkboxhidden_flagpage', parent).val("");
                $('.checkboxhidden_flagmedia', parent).val("");
                $('.checkboxhidden_flagportfolio', parent).val("");
                $('.checkboxhidden_flagproduct', parent).val("");
            }
        });
    }

    function mkdfInitSaveCheckBoxesValue(){
        var checkboxes = $('.mkdf-single-checkbox-field');
        checkboxes.change(function(){
            mkdfDisableHidden($(this));
        });
        checkboxes.each(function(){
            mkdfDisableHidden($(this));
        });
        function mkdfDisableHidden(thisBox){
            if(thisBox.is(':checked')){
                thisBox.siblings('.mkdf-checkbox-single-hidden').prop('disabled', true);
            }else{
                thisBox.siblings('.mkdf-checkbox-single-hidden').prop('disabled', false);
            }
        }
    }

    function mkdfCheckBoxMultiSelectInitState() {
        var element = $('input[type="checkbox"].dependence.multiselect');

        if (element.length) {
            element.each(function () {
                var thisItem = $(this);
                mkdfInitCheckBox(thisItem);
            });
        }
    }

    function mkdfInitCheckBoxMultiSelectChange() {
        var element = $('input[type="checkbox"].dependence.multiselect');

        element.on('change', function () {
            var thisItem = $(this);
            mkdfInitCheckBox(thisItem);
        });
    }

    function mkdfInitCheckBox(checkBox) {
        var thisItem = checkBox;
        var checked = thisItem.attr('checked');
        var dataShow = thisItem.data('show');

        if (checked === 'checked') {
            if (typeof(dataShow) !== 'undefined' && dataShow !== '') {
                var elementsToShow = dataShow.split(',');

                $.each(elementsToShow, function (index, value) {
                    $(value).fadeIn();
                });
            }
        } else {
            if (typeof(dataShow) !== 'undefined' && dataShow !== '') {
                var elementsToShow = dataShow.split(',');

                $.each(elementsToShow, function (index, value) {
                    $(value).fadeOut();
                });
            }
        }
    }

    function mkdfCheckVisibilityOfAnchorSelectOptions() {
        var holder = $('.mkdf-page-form > div:hidden');

        if (holder.length) {
            holder.each(function () {
                var thisHolder = $(this),
                    $panelID = thisHolder.attr('id');

                $('#mkdf-select-anchor option').each(function () {
                    var thisItem = $(this);

                    if (thisItem.data('anchor') === '#' + $panelID) {
                        thisItem.hide();
                    }
                });
            });
        }
    }

    function mkdfShowHideContainersAndAnchorsSelectOptions(){
        setTimeout(function(){
            $('#mkdf-select-anchor option').show();
            $('.mkdf-page-form-section-holder.mkdf-dependency-holder').each(function(){
                var $this = $(this);
                var $id = $this.attr('id');
                
                if(!$this.is(':visible')){
                    $('#mkdf-select-anchor option').each ( function() {
                        var $thisOption = $(this);
                        var $option = $thisOption.data('anchor') !== undefined ? $(this).data('anchor').substr(1) : '';

                        if ($option === $id) {
                            $thisOption.hide();
                        }
                    });
                }
            });
            
            $('#mkdf-select-anchor').selectpicker('refresh');
        },300); //after show/hide animation is finished
    }

    function mkdfCheckOptionAnchorsOnDependencyChange() {
        $(document).on('click','.mkdf-dependency-option .cb-enable, .mkdf-dependency-option .cb-disable',function(){
            mkdfShowHideContainersAndAnchorsSelectOptions();
        });

        $(document).on('change','.mkdf-dependency-option input[type=radio]',function(){
            mkdfShowHideContainersAndAnchorsSelectOptions()
        });

        $(document).on('change','.mkdf-form-element.mkdf-dependency-option',function(){
            mkdfShowHideContainersAndAnchorsSelectOptions();
        });
    }

})(jQuery);