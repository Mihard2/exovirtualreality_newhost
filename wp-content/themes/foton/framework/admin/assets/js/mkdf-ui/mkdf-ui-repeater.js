(function($){
    $(document).ready(function() {
 	    mkdfRepeater.rowRepeater.init();
 	    mkdfRepeater.rowInnerRepeater.init();
	    mkdfInitSortable();
    });

	var mkdfRepeater = function() {
		var repeaterHolder = $('.mkdf-repeater-wrapper'),
			numberOfRows;

		var rowRepeater = function() {

			var addNewRow = function(holder) {
				var $addButton = holder.find('.mkdf-repeater-add a');
				var templateName = holder.find('.mkdf-repeater-wrapper-inner').data('template');
				var $repeaterContent = holder.find('.mkdf-repeater-wrapper-inner');
				var repeaterTemplate = wp.template('mkdf-repeater-template-' + templateName);

				$addButton.on('click', function(e) {
					e.preventDefault();
					e.stopPropagation();

					var $row = $(repeaterTemplate({
						rowIndex: getLastRowIndex(holder) || 0
					}));

					$repeaterContent.append($row);
					var new_holder = $row.find('.mkdf-repeater-inner-wrapper');
					mkdfRepeater.rowInnerRepeater.addNewRowInner(new_holder);
					mkdfRepeater.rowInnerRepeater.removeRowInner(new_holder);
					mkdfInitSortable();
					mkdfUIAdmin.mkdfInitSwitch();
					mkdfUIAdmin.mkdfInitMediaUploader();
					mkdfUIAdmin.mkdfInitColorpicker();
					mkdfUIAdmin.mkdfInitDatePicker();
					mkdfUIAdmin.mkdfSelect2();
					mkdfDependencyAdmin.mkdfReInitOptionsDependency();
					mkdfTinyMCE($row, numberOfRows);
					numberOfRows += 1;
				});
			};

			var removeRow = function(holder) {

				var repeaterContent = holder.find('.mkdf-repeater-wrapper-inner');
				repeaterContent.on('click', '.mkdf-clone-remove', function(e) {
					e.preventDefault();
					e.stopPropagation();

					if(!window.confirm('Are you sure you want to remove this section?')) {
						return;
					}

					var $rowParent = $(this).parents('.mkdf-repeater-fields-holder');
					$rowParent.remove();

					decrementNumberOfRows();

				});
			};

			var getLastRowIndex = function(holder) {
				var $repeaterContent = holder.find('.mkdf-repeater-wrapper-inner');
				var fieldsCount = $repeaterContent.find('.mkdf-repeater-fields-holder').length;

				return fieldsCount;
			};

			var decrementNumberOfRows = function() {
				if(numberOfRows <= 0) {
					return;
				}

				numberOfRows -= 1;
			}
			var setNumberOfRows = function(holder) {
				numberOfRows =  holder.find('.mkdf-repeater-fields-holder').length;

			}
			var getNumberOfRows = function() {
				return numberOfRows;
			}

			return {
				init: function() {
					var repeaterHolder = $('.mkdf-repeater-wrapper');

					repeaterHolder.each(function(){
						setNumberOfRows($(this));
						addNewRow($(this));
						removeRow($(this));
					});
				},
				numberOfRows: getNumberOfRows
			}
		}();

		var rowInnerRepeater = function() {
			var repeaterInnerHolder = $('.mkdf-repeater-inner-wrapper');


			var addNewRowInner = function(holder) {

				//var repeaterInnerContent = holder.find('.mkdf-repeater-inner-wrapper-inner');
				var templateInnerName = holder.find('.mkdf-repeater-inner-wrapper-inner').data('template');
				var rowInnerTemplate = wp.template('mkdf-repeater-inner-template-' + templateInnerName);
				holder.on('click', '.mkdf-inner-clone', function(e) {

					e.preventDefault();
					e.stopPropagation();

					var $clickedButton = $(this);
					var $parentRow = $clickedButton.parents('.mkdf-repeater-fields-holder').first();

					var parentIndex = $parentRow.data('index');

					var $rowInnerContent = $clickedButton.parent().prev();

					var lastRowInnerIndex = $parentRow.find('.mkdf-repeater-inner-fields-holder').length;

					var $repeaterInnerRow = $(rowInnerTemplate({
						rowIndex: parentIndex,
						rowInnerIndex: lastRowInnerIndex
					}));

					$rowInnerContent.append($repeaterInnerRow);
					mkdfInitSortable();
					mkdfUIAdmin.mkdfInitSwitch();
					mkdfUIAdmin.mkdfInitMediaUploader();
					mkdfUIAdmin.mkdfInitColorpicker();
					mkdfUIAdmin.mkdfInitDatePicker();
					mkdfUIAdmin.mkdfSelect2();
					mkdfDependencyAdmin.mkdfReInitOptionsDependency();
					//not calling tinyMCE for inner repeater for now
					// mkdfTinyMCE($repeaterInnerRow, lastRowInnerIndex);
				});
			};

			var removeRowInner = function(holder) {
				var repeaterInnerContent = holder.find('.mkdf-repeater-inner-wrapper-inner');
				repeaterInnerContent.on('click', '.mkdf-clone-inner-remove', function(e) {
					e.preventDefault();
					e.stopPropagation();

					if(!confirm('Are you sure you want to remove section?')) {
						return;
					}

					var $removeButton = $(this);
					var $parent = $removeButton.parents('.mkdf-repeater-inner-fields-holder');

					$parent.remove();
				});
			};

			return {
				init: function() {
					var repeaterInnerHolder = $('.mkdf-repeater-inner-wrapper');
					repeaterInnerHolder.each(function(){
						addNewRowInner($(this));
						removeRowInner($(this));
					});

				},
				addNewRowInner:addNewRowInner,
				removeRowInner:removeRowInner
			}
		}();

		return {
			rowRepeater: rowRepeater,
			rowInnerRepeater: rowInnerRepeater
		}
	}();

	function mkdfInitSortable() {
		$('.mkdf-repeater-wrapper-inner.sortable').sortable();
		$('.mkdf-repeater-inner-wrapper-inner.sortable').sortable();
	}


	function mkdfTinyMCE(row, numberOfRows){
		var newTextAreaHtml = row.find('.wp-editor-area');
		var contentTinyMce = $('#wp-content-wrap .wp-editor-area');

		if (newTextAreaHtml.length){

			//old row variables
			var oldID = contentTinyMce.attr('id'),
				oldContainer = contentTinyMce.parents('.wp-editor-wrap'),
				oldIframeHeight = oldContainer.find('iframe').height(),
				oldSwitcherButtons = oldContainer.find('button.wp-switch-editor');

			//new row variables
			var textareaID = newTextAreaHtml.attr('id').replace('textarea_index','textarea_index_'+numberOfRows),
			    textareaClasses = newTextAreaHtml.attr('class'),
			    textareaName = newTextAreaHtml.attr('name'),
			    textareaHolder = newTextAreaHtml.parents('.mkdf-page-form-section').first(),
			    children = textareaHolder.find('[id*=textarea_index]'),
			    thisEditorContainer = newTextAreaHtml.parents(".wp-editor-container"),
			    editorTools;

			//trigger click on tinymc button so cloned row can catch properties
			if (oldContainer.hasClass('html-active')) {
			    oldSwitcherButtons.first().trigger('click');
			}

			//change all children indexes for clone row
			children.each(function (e){
				var thisChild = $(this),
					thisButtons = thisChild.find('button');

				thisChild.attr('id', thisChild.attr('id').replace('textarea_index','textarea_index_'+numberOfRows)); // change id - first row will have 0 as the last char
			});

			//empty container to enable new tinymc code to add
			thisEditorContainer.empty();

			//add new textarea
			$('<textarea/>', {
			    id: textareaID,
			    class: textareaClasses,
			    name: textareaName
			}).appendTo(thisEditorContainer);

			setTimeout(function () {
				//add tinymce
			    tinymce.execCommand( 'mceAddEditor', true, textareaID );

				//change attributes for editor tools (add media and switcher)
			    editorTools = thisEditorContainer.siblings('.wp-editor-tools');

			    if (editorTools.length){
			    	var mediaButton = editorTools.find('button.insert-media'),
			    		switchButton = editorTools.find('button.wp-switch-editor');

			    	mediaButton.attr('data-editor',mediaButton.data('editor').replace('textarea_index','textarea_index_'+numberOfRows)); //change html attribute
			    	mediaButton.data('editor',mediaButton.data('editor').replace('textarea_index','textarea_index_'+numberOfRows)); //this works for media but not for switch buttons

			    	switchButton.each(function () {
			    		var thisSwitch = $(this);
			    		
						thisSwitch.attr('data-wp-editor-id',thisSwitch.data('wp-editor-id').replace('textarea_index','textarea_index_'+numberOfRows));
			    	});
			    }

			    //add QuickTags
			    tinyMCEPreInit.qtInit[textareaID] =JSON.parse(JSON.stringify(tinyMCEPreInit.qtInit[oldID]));
			    tinyMCEPreInit.qtInit[textareaID].id = textareaID;

			    // make the editor area visible
			    newTextAreaHtml.addClass('wp-editor-area').show();

			    // initialize quicktags
			    new QTags(textareaID);
			    QTags._buttonsInit();

			    // force the editor to start at its defined mode.
			    switchEditors.go(textareaID, tinyMCEPreInit.mceInit[oldID].mode);
			}, 300);
		}
	}

})(jQuery);
