(function($) {

	var clicks = 0;
	function btnClick(btn){
		document.getElementById(btn).value = ++clicks;
	}

/* --------------------------------------------------------------------------------------- */
/* Image Upload form --------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------- */
	function image_upload(field_label, field_id, width) {
		if (clicks == 0) {clicks = ''}

		var add_image_form = {
			type: 'fieldset',
			name: 'upload_media'+clicks,
			id: 'upload_media'+clicks,
			label: ( field_label ? field_label : 'Image'),
			layout: 'grid',
			columns: '3',
			padding: '30 15 0 15',
			style: 'border-color: #ddd; background-color: #f7f7f7;',
			items: [
				{
					type: 'textbox',
					name: field_id+clicks,
					id: field_id+clicks,
					margin: '0 0 0 0',
					onChange: function(){
						checkUrl(this);
					}
				},
				{
					type: 'button',
					name: 'browse_btn'+clicks,
					id: 'browse_btn'+clicks,
					classes: 'widget btn primary',
					text: 'Add',
					margin: '0 0 0 0',
					onclick: function() {
						loadImg(this.getEl().id, this.parent().items()[0].getEl().id);
					}
				},
				{
					type: 'button',
					name: 'remove_btn'+clicks,
					id: 'remove_btn'+clicks,
					classes: 'widget btn secondary',
					text: 'Remove',
					margin: '0 0 0 0',
					onclick: function() {
						removeImg(this.getEl().id, this.parent().items()[0].getEl().id);
					}
				}
			]
		};

		return add_image_form;
	}

	function loadImg(button, field) {
		var win					= tinyMCE.activeEditor.windowManager.getWindows()[0];
		var field_id            = field,
			post_id             = button,
			fieldset			= win.find('#'+field_id).parent().getEl().id,
			save_attachment_id  = $('#'+field_id).hasClass('ot-upload-attachment-id'),
			imgPreview          = '';

		if ( window.wp && wp.media ) {
			window.media_frame = window.media_frame || new wp.media.view.MediaFrame.Select({
				title: 'Add image',
				button: { text: 'Insert'},
				library: {type: 'image'},
				multiple: false
			});
			window.media_frame.on('select', function() {
				var attachment = window.media_frame.state().get('selection').first(), 
				href = attachment.attributes.url,
				mime = attachment.attributes.mime,
				regex = /^image\/(?:jpe?g|png|gif|x-icon)$/i;

			if ( mime.match(regex) ) {
				imgPreview += '<img src="'+href+'" alt="" />';
			}
			$('#'+field_id).val( href );

			if (win.find('#'+fieldset+'_preview').length !== 0) {
				win.find('#'+fieldset+'_preview').remove();
				win.reflow();
			}

			win.find('#'+field_id).parent().append({
				type: 'container',
				name: fieldset+'_preview',
				id: fieldset+'_preview',
				classes: 'upload-media-preview',
				html: imgPreview
			}).reflow();

			window.media_frame.off('select');

			}).open();
		}
		return false;
	}

	function removeImg(button, field) {
		var win  				= tinyMCE.activeEditor.windowManager.getWindows()[0],
			field_id            = field,
			post_id             = button,
			fieldset			= win.find('#'+field_id).parent().getEl().id;

		win.find('#'+fieldset+'_preview').remove();
		$('#'+field_id).val('');
		win.find('#'+field_id).parent().reflow();
		win.reflow();

		return false;
	}

	function checkUrl (elem) {
		var win  				= tinyMCE.activeEditor.windowManager.getWindows()[0],
			fieldset			= elem.parent().getEl().id,
			value 				= elem.value(),
			imgPreview			= '';

			console.log(value);

		if (win.find('#'+fieldset+'_preview').length !== 0) {
			win.find('#'+fieldset+'_preview').remove();
			win.reflow();
		}

		if ( value.match(/\.(jpeg|jpg|gif|png)$/) != null ) {
			imgPreview += '<img src="'+value+'" alt="" />';
			win.find('#'+fieldset).append({
				type: 'container',
				name: fieldset+'_preview',
				id: fieldset+'_preview',
				classes: 'upload-media-preview',
				html: imgPreview
			}).reflow();
		} else {
			if (win.find('#'+fieldset+'_preview').length !== 0) {
				win.find('#'+fieldset+'_preview').remove();
				win.reflow();
			}
			win.find('#'+fieldset).reflow();
		}
	}


/* --------------------------------------------------------------------------------------- */
/* Tinymce button plugin ----------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------- */
	tinymce.PluginManager.add('shortcodes_mce_button', function( editor, url ) {
		editor.addButton('shortcodes_mce_button', {
			title: 'Add Shortcode',
			text: '',
			icon: 'icon dashicons-editor-code',
			type: 'menubutton',
			classes: 'widget btn menubtn shortcodes-btn',
			menu: [
				{
					text: 'Elements',
					menu: [
						{
							text: 'Icon',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Icons - Font Awesome',
									id: 'add_icons',
									buttons: [
										{
											text: 'Insert',
											classes: 'widget btn primary',
											onclick: 'submit'
										},
										{
											text: 'Close',
											onclick: 'close'
										}
									],
									body: [
										{
											type: 'container',
											html: '<div class="window-description" style="width:498px;"><p class="modal-paragraph">All these options are related to the Font Awesome icon collection. For Icon Type you need to use only the name of the icon without "fa-" prefix.<br>Example: for fa-desktop class, you will be using only desktop</p></div>'
										},
										{
											type: 'textbox',
											name: 'iconType',
											label: 'Icon Type',
											value: 'desktop'
										},
										{
											type: 'listbox',
											name: 'sizeList',
											label: 'Icon size',
											'values': [
												{text: 'normal', value: ''},
												{text: 'large', value: 'lg'},
												{text: '2x', value: '2x'},
												{text: '3x', value: '3x'},
												{text: '4x', value: '4x'},
												{text: '5x', value: '5x'}
											]
										},
										{
											type: 'listbox',
											name: 'rotateList',
											label: 'Icon rotate',
											'values': [
												{text: 'no rotate', value: ''},
												{text: '90 degrees', value: '90'},
												{text: '180 degrees', value: '180'},
												{text: '270 degrees', value: '270'}
											]
										},
										{
											type: 'listbox',
											name: 'flipList',
											label: 'Icon flip',
											'values': [
												{text: 'no flip', value: ''},
												{text: 'horizontal', value: 'horizontal'},
												{text: 'vertical', value: 'vertical'}
											]
										},
										{
											type: 'listbox',
											name: 'pullList',
											label: 'Icon pull',
											'values': [
												{text: 'no pull', value: ''},
												{text: 'right', value: 'right'},
												{text: 'left', value: 'left'}
											]
										},
										{
											type: 'listbox',
											name: 'spinList',
											label: 'Icon spin',
											'values': [
												{text: 'false', value: 'false'},
												{text: 'true', value: 'true'}
											],
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[icon type="' + e.data.iconType + '" size="' + e.data.sizeList + '" rotate="' + e.data.rotateList + '" flip="' + e.data.flipList + '" pull="' + e.data.pullList + '" spin="' + e.data.spinList + '"]' );
									}
								});
							}
						},
						{
							text: 'Social Icons',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add Social Icons',
									buttons: [
										{
											text: 'Insert',
											classes: 'widget btn primary',
											onclick: 'submit'
										},
										{
											text: 'Close',
											onclick: 'close'
										}
									],
									body: [
										{
											type: 'container',
											html: '<div class="window-description" style="width:498px;"><p class="modal-paragraph">You are going to add social icons to your content. In order to populate this shortcode with icons you need first to add your social profile links to Theme Options -> Social Links.</p></div>'
										},
										{
											type: 'listbox',
											name: 'socialLinksColor',
											label: 'Color',
											'values': [
												{text: 'Dark', value: 'dark'},
												{text: 'Light', value: 'light'}
											],
											onPostRender: function() {
												this.value('dark');
											}
										},
										{
											type: 'listbox',
											name: 'socialLinksStyle',
											label: 'Style',
											'values': [
												{text: 'Square', value: 'square'},
												{text: 'Round', value: 'round'}
											],
											onPostRender: function() {
												this.value('square');
											}
										},
									],
									onsubmit: function( e ) {
										editor.insertContent( '[social_icons color="'+e.data.socialLinksColor+'" style="'+e.data.socialLinksStyle+'"]' );
									}
								});
							}
						},
						{
							text: 'Button',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add Button',
									buttons: [
										{
											text: 'Insert',
											classes: 'widget btn primary',
											onclick: 'submit'
										},
										{
											text: 'Close',
											onclick: 'close'
										}
									],
									body: [
										{
											type: 'container',
											html: '<div class="window-description" style="width:498px;"><p class="modal-paragraph">Use this dialog to insert buttons.</p></div>'
										},
										{
											type: 'textbox',
											name: 'buttonText',
											label: 'Label',
											value: 'Button'
										},
										{
											type: 'textbox',
											name: 'buttonHref',
											label: 'Link',
											value: ''
										},
										{
											type: 'listbox',
											name: 'buttonSize',
											label: 'Size',
											'values': [
												{text: 'small', value: 'small'},
												{text: 'medium', value: 'medium'},
												{text: 'big', value: 'big'}
											],
											onPostRender: function() {
												this.value('small');
											}
										},
										{
											type: 'listbox',
											name: 'buttonOutlines',
											label: 'Outlined',
											'values': [
												{text: 'no', value: 'false'},
												{text: 'yes', value: 'true'}
											],
											onPostRender: function() {
												this.value('false');
											}
										},
										{
											type: 'listbox',
											name: 'buttonColor',
											label: 'Color',
											'values': [
												{text: 'Default', value: 'default'},
												{text: 'Gray', value: 'gray'},
												{text: 'Light gray', value: 'lightgray'},
												{text: 'Red', value: 'red'},
												{text: 'Blue', value: 'blue'},
												{text: 'Dark Blue', value: 'darkblue'},
												{text: 'Green', value: 'green'},
												{text: 'Orange', value: 'orange'},
												{text: 'White', value: 'white'}
											],
											onPostRender: function() {
												this.value('default');
											},
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[button text="' + e.data.buttonText + '" href="' + e.data.buttonHref + '" size="' + e.data.buttonSize + '" color="' + e.data.buttonColor + '" outlines="' + e.data.buttonOutlines + '"]' );
									}
								});
							}
						},
						{
							text: 'Iconbox',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add Iconbox',
									width: 540,
									height: 400,
									autoScroll: true,
									classes: 'scrollable-content',
									buttons: [
										{
											text: 'Insert',
											classes: 'widget btn primary',
											onclick: 'submit'
										},
										{
											text: 'Close',
											onclick: 'close'
										}
									],
									body: [
										{
											type: 'container',
											html: '<div class="window-description" style="width:498px;"><p class="modal-paragraph">By default, the Iconbox is full-width so you need to place it inside column or any other div if you want to limit its width.</p></div>'
										},
										{
											type: 'textbox',
											name: 'iconboxIcon',
											label: 'Icon',
											value: 'star'
										},
										{
											type: 'container',
											html: '<div class="field-description" style="width:498px;"><p class="modal-paragraph">You need to choose a Font Awesome icon from <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">here</a> and write only the name of choosen icon (e.g. for icon named "fa-desktop" you will write only "desktop").</p></div>'
										},
										{
											type: 'textbox',
											name: 'iconboxTitle',
											label: 'Title',
											value: ''
										},
										{
											type: 'textbox',
											name: 'iconboxUrl',
											label: 'Link URL',
											value: ''
										},
										{
											type: 'listbox',
											name: 'iconboxLinktarget',
											label: 'Link target',
											'values': [
												{text: 'Same page', value: 'self'},
												{text: 'Another page', value: 'blank'}
											],
											onPostRender: function() {
												this.value('self');
											},
										},
										{
											type: 'textbox',
											name: 'iconboxBtnlabel',
											label: 'Button label',
											value: ''
										},
										{
											type: 'textbox',
											multiline: 'true',
											'minHeight': 100,
											name: 'iconboxContent',
											label: 'Content',
											value: 'Here goes the content for your iconbox.'
										},
										{
											type: 'listbox',
											name: 'iconboxColor',
											label: 'Color',
											'values': [
												{text: 'Light', value: 'light'},
												{text: 'Dark', value: 'dark'}
											],
											onPostRender: function() {
												this.value('light');
											},
										},
										{
											type: 'listbox',
											name: 'iconboxStyle',
											label: 'Style',
											'values': [
												{text: 'Centered', value: 'center'},
												{text: 'Left-aligned', value: 'left'}
											],
											onPostRender: function() {
												this.value('center');
											},
										},
										{
											type: 'listbox',
											name: 'iconboxDisableBox',
											label: 'Disable box',
											'values': [
												{text: 'Yes', value: 'true'},
												{text: 'No', value: 'false'}
											],
											onPostRender: function() {
												this.value('false');
											},
										},
									],
									onsubmit: function( e ) {
										editor.insertContent( '[iconbox icon="'+e.data.iconboxIcon+'" title="'+e.data.iconboxTitle+'" url="'+e.data.iconboxUrl+'" link_target="'+e.data.iconboxLinktarget+'" button_label="'+e.data.iconboxBtnlabel+'" color="'+e.data.iconboxColor+'" style="'+e.data.iconboxStyle+'" disable_box="'+e.data.iconboxDisableBox+'"]'+e.data.iconboxContent+'[/iconbox]');
									}
								});
							}
						},
						{
							text: 'Promobox',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add Promobox',
									width: 540,
									height: 400,
									autoScroll: true,
									classes: 'scrollable-content',
									buttons: [
										{
											text: 'Insert',
											classes: 'widget btn primary',
											onclick: 'submit'
										},
										{
											text: 'Close',
											onclick: 'close'
										}
									],
									body: [
										{
											type: 'container',
											html: '<div class="window-description" style="width:498px;"><p class="modal-paragraph">This box can be both stand-alone section or in-page box so play nicely with the options bellow and the page options you intend to put in.</p></div>'
										},
										{
											type: 'textbox',
											name: 'promoboxTitle',
											label: 'Title',
											value: ''
										},
										{
											type: 'textbox',
											name: 'promoboxUrl',
											label: 'Link URL',
											value: ''
										},
										{
											type: 'listbox',
											name: 'promoboxLinktarget',
											label: 'Link target',
											'values': [
												{text: 'Same page', value: 'self'},
												{text: 'Another page', value: 'blank'}
											],
											onPostRender: function() {
												this.value('self');
											},
										},
										{
											type: 'textbox',
											name: 'promoboxBtnlabel',
											label: 'Button label',
											value: ''
										},
										{
											type: 'textbox',
											multiline: 'true',
											'minHeight': 100,
											name: 'promoboxContent',
											label: 'Content',
											value: 'Here goes the content for your promobox.'
										},
										{
											type: 'listbox',
											name: 'promoboxStyle',
											label: 'Style',
											'values': [
												{text: 'Horizontal', value: 'horizontal'},
												{text: 'Vertical', value: 'vertical'}
											],
											onPostRender: function() {
												this.value('horizontal');
											},
										},
										{
											type: 'textbox',
											name: 'promoboxFill',
											label: 'Fill color',
											value: ''
										},
										{
											type: 'textbox',
											name: 'promoboxBorder',
											label: 'Border color',
											value: ''
										},
										{
											type: 'listbox',
											name: 'promoboxContent',
											label: 'Content Color',
											'values': [
												{text: 'Light', value: 'light'},
												{text: 'Dark', value: 'dark'}
											],
											onPostRender: function() {
												this.value('dark');
											},
										},
										{
											type: 'listbox',
											name: 'promoboxDisplay',
											label: 'Display as',
											'values': [
												{text: 'In-page', value: 'in_page'},
												{text: 'Section (full width)', value: 'section'}
											],
											onPostRender: function() {
												this.value('in_page');
											},
										},
										{
											type: 'listbox',
											name: 'promoboxAnimate',
											label: 'Animated entrance',
											'values': [
												{text: 'Yes', value: 'yes'},
												{text: 'no', value: 'no'}
											],
											onPostRender: function() {
												this.value('yes');
											},
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[promobox animated="'+e.data.promoboxAnimate+'" title="'+e.data.promoboxTitle+'" url="'+e.data.promoboxUrl+'" link_target="'+e.data.promoboxLinktarget+'" button_label="'+e.data.promoboxBtnlabel+'" style="'+e.data.promoboxStyle+'" fill_color="'+e.data.promoboxFill+'" border_color="'+e.data.promoboxBorder+'" content_color="'+e.data.promoboxContent+'" display_as="'+e.data.promoboxDisplay+'"]'+e.data.promoboxContent+'[/promobox]');
									}
								});
							}
						},
						{
							text: 'Tabs',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add Tabs',
									width: 540,
									height: 400,
									autoScroll: true,
									classes: 'scrollable-content',
									buttons: [
										{
											text: 'Insert',
											classes: 'widget btn primary',
											onclick: 'submit'
										},
										{
											text: 'Close',
											onclick: 'close'
										}
									],
									body: [
										{
											type: 'container',
											html: '<div class="window-description" style="width:498px;"><p class="modal-paragraph">Please fill all fields acordingly.</p></div>'
										},
										{
											type: 'listbox',
											name: 'tabsStyle',
											label: 'Tabs type',
											'values': [
												{text: 'tabs', value: 'tabs'},
												{text: 'pills', value: 'pills'}
											],
											onPostRender: function() {
												this.value('tabs');
											},
										},
										{
											type: 'textbox',
											name: 'tabsXclass',
											label: 'Extra class',
											value: '',
										},
										{
											type: 'button',
											name: 'tabs',
											id: 'tabs',
											classes: 'widget btn primary',
											text: 'Add Tab',
											label: 'Tabs',
											onclick: function(){
												var win = editor.windowManager.getWindows()[0];
												var mainShortcode = win.find('#tabsXclass').parent();
												var btn = win.find('#tabs').parent();

												btnClick('tabs');

												btn.before({
													type: 'form',
													classes: 'form-insider',
													name: 'tab',
													id: 'tab'+clicks,
													items: [
														{
															type: 'container',
															html: '<h3 class="form-insider-title">Tab '+clicks+'</h3>',
														},
														{
															type: 'textbox',
															name: 'tabTitle'+clicks,
															label: 'Tab title',
															value: '',
														},
														{
															type: 'listbox',
															name: 'tabFade'+clicks,
															label: 'Fade tab',
															'values': [
																{text: 'Yes', value: 'true'},
																{text: 'No', value: 'false'}
															],
															onPostRender: function() {
																this.value('true');
															},
														},
														{
															type: 'listbox',
															name: 'tabActive'+clicks,
															label: 'Active tab',
															'values': [
																{text: 'Yes', value: 'true'},
																{text: 'No', value: 'false'}
															],
															onPostRender: function() {
																if (clicks == 1) {this.value('true');} else {this.value('false');};
															},
														},
														{
															type: 'textbox',
															name: 'tabXclass'+clicks,
															label: 'Extra class',
															value: '',
														},
														{
															type: 'textbox',
															multiline: 'true',
															'minHeight': 100,
															name: 'tabContent'+clicks,
															label: 'Tab content',
															value: 'Here goes your awesome content.'
														},
														{
															type: 'button',
															text: 'Remove Tab',
															classes: 'widget btn remove',
															name: 'tabRemove'+clicks,
															id: 'tabRemove'+clicks,
															onclick: function(){
																var removable = this.parent();
																removable.remove();
																mainShortcode.parent().reflow();
																win.reflow();
															}
														}
													]
												});
												mainShortcode.parent().reflow();
												win.reflow();
											}
										}
									],
									onclose: function() {
										clicks = 0;
									},
									onsubmit: function( e ) {
										var items = editor.windowManager.getWindows()[0].find('#tab');
										xclass = e.data.tabsXclass;
										tabs = '';
										for (var i = 1; i < items.length + 1; i++) {
											title = e.data['tabTitle'+i];
											content = e.data['tabContent'+i];

											// if ( e.data['tabFade'+i] == "true" ) { fade = " fade"; } else { fade = ""; };
											if (e.data['tabActive'+i] == "true" ) { active =  " active" } else { active = "" };
											
											xclass = e.data['tabXclass'+i];
											tabs += '[tab title="'+title+'" fade="'+e.data['tabFade'+i]+'" '+active+' xclass="'+xclass+'"]'+content+'[/tab]';
										};

										editor.insertContent('[tabs xclass="'+e.data.tabsXclass+'" style="'+e.data.tabsStyle+'"]'+tabs+'[/tabs]');

										clicks = 0;
									}
								});
							}
						},
						{
							text: 'Accordion',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add Accordion',
									width: 540,
									height: 400,
									autoScroll: true,
									classes: 'scrollable-content',
									buttons: [
										{
											text: 'Insert',
											classes: 'widget btn primary',
											onclick: 'submit'
										},
										{
											text: 'Close',
											onclick: 'close'
										}
									],
									body: [
										{
											type: 'container',
											html: '<div class="window-description" style="width:498px;"><p class="modal-paragraph">Please fill all fields acordingly.</p></div>'
										},
										{
											type: 'textbox',
											name: 'accXclass',
											label: 'Extra class',
											value: ''
										},
										{
											type: 'button',
											name: 'collapsibles',
											id: 'collapsibles',
											classes: 'widget btn primary',
											text: 'Add Collapsible',
											label: 'Collapsible',
											onclick: function(){
												var win = editor.windowManager.getWindows()[0];
												var mainShortcode = win.find('#accXclass').parent();
												var btn = win.find('#collapsibles').parent();

												btnClick('collapsibles');

												btn.before({
													type: 'form',
													classes: 'form-insider',
													name: 'collapse',
													id: 'collapse'+clicks,
													items: [
														{
															type: 'container',
															html: '<h3 class="form-insider-title">Collapse '+clicks+'</h3>',
														},
														{
															type: 'textbox',
															name: 'accTitle'+clicks,
															label: 'Title',
															value: ''
														},
														{
															type: 'textbox',
															multiline: 'true',
															'minHeight': 120,
															name: 'accContent'+clicks,
															label: 'Content',
															value: 'Here goes the content for your collapsible'
														},
														{
															type: 'listbox',
															name: 'accType'+clicks,
															label: 'Type',
															'values': [
																{text: 'default', value: 'default'},
																{text: 'primary', value: 'primary'},
																{text: 'success', value: 'success'},
																{text: 'info', value: 'info'},
																{text: 'warning', value: 'warning'},
																{text: 'danger', value: 'danger'}
															],
															onPostRender: function() {
																this.value('default');
															},
														},
														{
															type: 'listbox',
															name: 'accActive'+clicks,
															label: 'Active tab',
															'values': [
																{text: 'Yes', value: 'true'},
																{text: 'No', value: 'false'}
															],
															onPostRender: function() {
																if (clicks == 1) {this.value('true');} else {this.value('false');};
															},
														},
														{
															type: 'textbox',
															name: 'accXclass'+clicks,
															label: 'Extra class',
															value: '',
														},
														{
															type: 'button',
															text: 'Remove Collapsible',
															classes: 'widget btn remove',
															name: 'accRemove'+clicks,
															id: 'accRemove'+clicks,
															onclick: function(){
																var removable = this.parent();
																removable.remove();
																mainShortcode.parent().reflow();
																win.reflow();
															}
														}
													]
												});
												mainShortcode.parent().reflow();
												win.reflow();
											}
										}
									],
									onclose: function() {
										clicks = 0;
									},
									onsubmit: function( e ) {
										var items = editor.windowManager.getWindows()[0].find('#collapse');
										xclass = e.data.accXclass;
										collapsibles = '';
										for (var i = 1; i < items.length + 1; i++) {
											title = e.data['accTitle'+i];
											content = e.data['accContent'+i];
											type = e.data['accType'+i];
											if (e.data['accActive'+i] == "true" ) { active =  " active" } else { active = "" };
											xclass = e.data['accXclass'+i];

											collapsibles += '[collapse title="'+title+'"'+active+' type="'+type+'" xclass="'+xclass+'"]'+content+'[/collapse]';
										};

										editor.insertContent('[collapsibles xclass="'+e.data.accXclass+'"]'+collapsibles+'[/collapsibles]');

										clicks = 0;
									}
								});
							}
						},
						{
							text: 'Progress circle',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add Progress circle',
									width: 540,
									height: 400,
									autoScroll: true,
									classes: 'scrollable-content',
									buttons: [
										{
											text: 'Insert',
											classes: 'widget btn primary',
											onclick: 'submit'
										},
										{
											text: 'Close',
											onclick: 'close'
										}
									],
									body: [
										{
											type: 'container',
											html: '<div class="window-description" style="width:498px;"><p class="modal-paragraph">Add progress/counter circle to your page. The circle can be responsive (if you set the width to 100%) so you should use columns or containers to limit the width.</p></div>'
										},
										{
											type: 'textbox',
											name: 'progressTitle',
											label: 'Title',
											value: ''
										},
										{
											type: 'textbox',
											name: 'progressValue',
											label: 'Value',
											value: ''
										},
										{
											type: 'textbox',
											name: 'progressMin',
											label: 'Min value',
											value: '0'
										},
										{
											type: 'textbox',
											name: 'progressMax',
											label: 'Max value',
											value: '100'
										},
										{
											type: 'textbox',
											name: 'progressStep',
											label: 'Step',
											value: '1'
										},
										{
											type: 'radio',
											name: 'progressAnimated',
											label: 'Animated',
											checked: true,
										},
										{
											type: 'textbox',
											name: 'progressOffset',
											label: 'Offset angle',
											value: '0',
										},
										{
											type: 'textbox',
											name: 'progressArc',
											label: 'Arc angle',
											value: '360',
										},
										{
											type: 'listbox',
											name: 'progressRotation',
											label: 'Direction of rotation',
											'values': [
												{text: 'Clockwise', value: 'clockwise'},
												{text: 'Anticlockwise', value: 'anticlockwise'}
											],
											onPostRender: function() {
												this.value('clockwise');
											},
										},
										{
											type: 'listbox',
											name: 'progressCursor',
											label: 'Show progress as cursor',
											'values': [
												{text: 'Yes', value: 'true'},
												{text: 'No', value: 'false'}
											],
											onPostRender: function() {
												this.value('false');
											},
										},
										{
											type: 'listbox',
											name: 'progressThickness',
											label: 'Thickness',
											'values': [
												{text: '1', value: '.1'},
												{text: '2', value: '.2'},
												{text: '3', value: '.3'},
												{text: '4', value: '.4'},
												{text: '5', value: '.5'},
											],
											onPostRender: function() {
												this.value('.2');
											},
										},
										{
											type: 'listbox',
											name: 'progressLinecap',
											label: 'Line cap',
											'values': [
												{text: 'Round', value: 'round'},
												{text: 'Butt', value: 'butt'}
											],
											onPostRender: function() {
												this.value('butt');
											},
										},
										{
											type: 'textbox',
											name: 'progressWidth',
											label: 'Circle width',
											value: '',
										},
										{
											type: 'textbox',
											name: 'progressFg',
											label: 'Foreground color',
											value: '',
										},
										{
											type: 'textbox',
											name: 'progressBg',
											label: 'Background color',
											value: '',
										},
										{
											type: 'textbox',
											name: 'progressCounter',
											label: 'Counter color',
											value: '',
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[progress title="'+e.data.progressTitle+'" value="'+e.data.progressValue+'" min="'+e.data.progressMin+'" max="'+e.data.progressMax+'" step="'+e.data.progressStep+'" animated="'+e.data.progressAnimated+'" angle_offset="'+e.data.progressOffset+'" angle_arc="'+e.data.progressArc+'" rotation="'+e.data.progressRotation+'" cursor="'+e.data.progressCursor+'" thickness="'+e.data.progressThickness+'" line_cap="'+e.data.progressLinecap+'" width="'+e.data.progressWidth+'" fg_color="'+e.data.progressFg+'" bg_color="'+e.data.progressBg+'" counter_color="'+e.data.progressCounter+'"]' );
									}
								});
							}
						},
						{
							text: 'Separator',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add Separator',
									buttons: [
										{
											text: 'Insert',
											classes: 'widget btn primary',
											onclick: 'submit'
										},
										{
											text: 'Close',
											onclick: 'close'
										}
									],
									body: [
										{
											type: 'container',
											html: '<div class="window-description"><p class="modal-paragraph">Please fill all fields accordingly</p></div>',
										},
										{
											type: 'listbox',
											name: 'sepTop',
											label: 'Margin top',
											'values': [
												{text: '10px', value: '10'},
												{text: '20px', value: '20'},
												{text: '30px', value: '30'},
												{text: '40px', value: '40'},
												{text: '50px', value: '50'},
												{text: '60px', value: '60'},
												{text: '70px', value: '70'},
												{text: '80px', value: '80'},
												{text: '90px', value: '90'},
												{text: '100px', value: '100'}
											],
											onPostRender: function() {
												this.value('10');
											},
										},
										{

											type: 'listbox',
											name: 'sepBottom',
											label: 'Margin Bottom',
											'values': [
												{text: '10px', value: '10'},
												{text: '20px', value: '20'},
												{text: '30px', value: '30'},
												{text: '40px', value: '40'},
												{text: '50px', value: '50'},
												{text: '60px', value: '60'},
												{text: '70px', value: '70'},
												{text: '80px', value: '80'},
												{text: '90px', value: '90'},
												{text: '100px', value: '100'}
											],
											onPostRender: function() {
												this.value('10');
											},
										},
										{
											type: 'spacer',
											classes: 'window-head'
										},
										{
											type: 'listbox',
											name: 'sepLength',
											label: 'Length',
											'values': [
												{text: 'Full width', value: 'long'},
												{text: 'Short', value: 'short'}
											],
											onPostRender: function() {
												this.value('long');
											},
										},
										{
											type: 'listbox',
											name: 'sepOrnament',
											label: 'Show Ornament',
											'values': [
												{text: 'Yes', value: 'yes'},
												{text: 'No', value: 'no'}
											],
											onPostRender: function() {
												this.value('yes');
											},
										},
										{
											type: 'listbox',
											name: 'sepInvisible',
											label: 'Set to invisible',
											'values': [
												{text: 'Yes', value: 'yes'},
												{text: 'No', value: 'no'}
											],
											onPostRender: function() {
												this.value('no');
											},
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[separator top="'+e.data.sepTop+'" bottom="'+e.data.sepBottom+'" length="'+e.data.sepLength+'" ornament="'+e.data.sepOrnament+'" invisible="'+e.data.sepInvisible+'"]' );
									}
								});
							}
						},
					]
				},
				{
					text: 'Typography',
					menu: [
						{
							text: 'Special title',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Special title',
									buttons: [
										{
											text: 'Insert',
											classes: 'widget btn primary',
											onclick: 'submit'
										},
										{
											text: 'Close',
											onclick: 'close',
										}
									],
									body: [
										{
											type: 'container',
											html: '<div class="window-description" style="width:498px;"><p class="modal-paragraph">You can either select the text first in the editor or choose to insert the title text into the textarea bellow. If you already selected the text in the editor, the title field here will be ignored.</p></div>',
										},
										{
											type: 'textbox',
											multiline: 'true',
											'minHeight': 100,
											name: 'stTitle',
											label: 'The title',
											tooltip: 'Fill this field only if you did not selected any text in your editor',
											value: ''
										},
										{
											type: 'textbox',
											name: 'stColor',
											label: 'Color',
											value: ''
										},
										{
											type: 'listbox',
											name: 'stHeading',
											label: 'Heading',
											'values': [
												{text: 'H1', value: 'h1'},
												{text: 'H2', value: 'h2'},
												{text: 'H3', value: 'h3'},
												{text: 'H4', value: 'h4'},
												{text: 'H5', value: 'h5'},
												{text: 'H6', value: 'h6'}
											],
											onPostRender: function() {
												this.value('h1');
											},
										},
										{
											type: 'listbox',
											name: 'stAlign',
											label: 'Alignment',
											'values': [
												{text: 'left', value: 'left'},
												{text: 'center', value: 'center'},
												{text: 'right', value: 'right'}
											],
											onPostRender: function() {
												this.value('left');
											},
										},
										{
											type: 'textbox',
											name: 'stPT',
											label: 'Padding Top',
											tooltip: 'Only number without px',
											value: ''
										},
										{
											type: 'textbox',
											name: 'stPB',
											label: 'Padding Bottom',
											tooltip: 'Only number without px',
											value: ''
										}
									],
									onsubmit: function( e ) {
										editor.focus();
										var sel = editor.selection.getContent();
										if (sel !== '') {
											editor.selection.setContent('[special_title color="'+e.data.stColor+'" heading="'+e.data.stHeading+'" align="'+e.data.stAlign+'" padding_top="'+e.data.stPT+'" padding_bottom="'+e.data.stPB+'"]'+sel+'[/special_title]');
										} else{
											editor.selection.setContent('[special_title color="'+e.data.stColor+'" heading="'+e.data.stHeading+'" align="'+e.data.stAlign+'" padding_top="'+e.data.stPT+'" padding_bottom="'+e.data.stPB+'"]'+e.data.stTitle+'[/special_title]');
										};
										
									}
								});
							}
						},
						{
							text: 'Tagline',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Tagline',
									buttons: [
										{
											text: 'Insert',
											classes: 'widget btn primary',
											onclick: 'submit'
										},
										{
											text: 'Close',
											onclick: 'close',
										}
									],
									body: [
										{
											type: 'container',
											html: '<div class="window-description" style="width:498px;"><p class="modal-paragraph">You can either select the text first in the editor or choose to insert the content text into the textarea bellow. If you already selected the text in the editor, the Content field here will be ignored.</p></div>',
										},
										{
											type: 'textbox',
											multiline: 'true',
											'minHeight': 100,
											name: 'tlContent',
											label: 'The tagline',
											tooltip: 'Fill this field only if you did not selected any text in your editor',
											value: ''
										},
										{
											type: 'listbox',
											name: 'tlAlign',
											label: 'Align',
											'values': [
												{text: 'Left', value: 'left'},
												{text: 'Center', value: 'center'},
												{text: 'Right', value: 'right'},
											],
											onPostRender: function() {
												this.value('center');
											},
										},
										{
											type: 'textbox',
											name: 'tlMarginTop',
											label: 'Margin top',
											tooltip: 'Only number value without px',
											value: '',
										},
										{
											type: 'textbox',
											name: 'tlMarginBottom',
											label: 'Margin bottom',
											tooltip: 'Only number value without px',
											value: '',
										},
										{
											type: 'listbox',
											name: 'tlFontWeight',
											label: 'Font weight',
											tooltip: 'The font weight will depend on the font you are using',
											'values': [
												{text: '300', value: '300'},
												{text: '400', value: '400'},
												{text: '500', value: '500'},
												{text: '600', value: '600'},
												{text: '700', value: '700'},
												{text: '800', value: '800'}
											],
											onPostRender: function() {
												this.value('300');
											},
										}
									],
									onsubmit: function( e ) {
										editor.focus();
										var sel = editor.selection.getContent();
										if (sel !== '') {
											editor.selection.setContent('[tagline align="'+e.data.tlAlign+'" margin_top="'+e.data.tlMarginTop+'" margin_bottom="'+e.data.tlMarginBottom+'" font_weight="'+e.data.tlFontWeight+'"]'+sel+'[/tagline]');
										} else{
											editor.selection.setContent('[tagline align="'+e.data.tlAlign+'" margin_top="'+e.data.tlMarginTop+'" margin_bottom="'+e.data.tlMarginBottom+'" font_weight="'+e.data.tlFontWeight+'"]'+e.data.tlContent+'[/tagline]');
										};
										
									}
								});
							}
						},
						{
							text: 'Dropcap',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add Dropcap',
									buttons: [
										{
											text: 'Insert',
											classes: 'widget btn primary',
											onclick: 'submit'
										},
										{
											text: 'Close',
											onclick: 'close',
										}
									],
									body: [
										{
											type: 'container',
											html: '<div class="window-description" style="width:498px;"><p class="modal-paragraph">Please be aware that you need to select the letter that you want to make it dropcap.</p></div>',
										},
										{
											type: 'textbox',
											name: 'dropcapColor',
											label: 'Color',
											value: ''
										}
									],
									onsubmit: function( e ) {
										editor.focus(); 
										editor.selection.setContent('[dropcap color="'+e.data.dropcapColor+'"]'+editor.selection.getContent()+'[/dropcap]');
									}
								});
							}
						},
						{
							text: 'Emphasize',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Emphasize text',
									buttons: [
										{
											text: 'Insert',
											classes: 'widget btn primary',
											onclick: 'submit'
										},
										{
											text: 'Close',
											onclick: 'close',
										}
									],
									body: [
										{
											type: 'container',
											html: '<div class="window-description" style="width:498px;"><p class="modal-paragraph">Please be aware that you need first to select the text you want to emphasize.</p></div>',
										},
										{
											type: 'textbox',
											name: 'emColor',
											label: 'Color',
											value: ''
										},
										{
											type: 'checkbox',
											name: 'emBold',
											label: 'Bold',
											value: ''
										},
									],
									onsubmit: function( e ) {
										editor.focus();
										if (e.data.emBold == true) { var bold = "yes" } else { var bold = "no"};
										editor.selection.setContent('[emphasize color="'+e.data.emColor+'" bold="'+bold+'"]'+editor.selection.getContent()+'[/emphasize]');
									}
								});
							}
						}
					]
				},
				{
					text: 'Parts',
					menu: [
						{
							text: 'Columns',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add Columns',
									width: 540,
									height: 400,
									autoScroll: true,
									classes: 'scrollable-content',
									buttons: [
										{
											text: 'Insert',
											classes: 'widget btn primary',
											onclick: 'submit'
										},
										{
											text: 'Close',
											onclick: 'close',
										}
									],
									body: [
										{
											type: 'container',
											html: '<div class="window-description" style="width:498px;"><p class="modal-paragraph">The Grid is composed by 12 columns. E.g. If you need a "One Third" column, choose "4 columns".</p></div>',
										},
										{
											type: 'checkbox',
											name: 'colRowWrapper',
											label: 'Exclude "row" wrapper',
											value: ''
										},
										{
											type: 'container',
											html: '<div class="field-description" style="width:498px;"><p class="modal-paragraph">Check this only if you want to add stand-alone columns, without the "row" wrapper.</p></div>'
										},
										{
											type: 'textbox',
											name: 'rowXclass',
											label: 'Extra Class',
											value: ''
										},
										{
											type: 'container',
											html: '<div class="field-description" style="width:498px;"><p class="modal-paragraph">Insert a class name only if you want to add an extra class to your column.</p></div>'
										},
										{
											type: 'button',
											name: 'columns',
											id: 'columns',
											classes: 'widget btn primary',
											text: 'Add Column',
											label: 'Add Column',
											onclick: function(){
												var win = editor.windowManager.getWindows()[0];
												var mainShortcode = win.find('#rowXclass').parent();
												var btn = win.find('#columns').parent();

												btnClick('columns');

												btn.before({
													type: 'form',
													classes: 'form-insider',
													name: 'column',
													id: 'column'+clicks,
													items: [
														{
															type: 'container',
															html: '<h3 class="form-insider-title">Add Column '+clicks+'</h3>',
														},
														{
															type: 'listbox',
															name: 'colNumber'+clicks,
															id: 'colNumber'+clicks,
															label: 'Columns Number',
															'values': [
																{text: '1 column', value: '1'},
																{text: '2 columns', value: '2'},
																{text: '3 columns', value: '3'},
																{text: '4 columns', value: '4'},
																{text: '5 columns', value: '5'},
																{text: '6 columns', value: '6'},
																{text: '7 columns', value: '7'},
																{text: '8 columns', value: '8'},
																{text: '9 columns', value: '9'},
																{text: '10 columns', value: '10'},
																{text: '11 columns', value: '11'},
																{text: '12 columns', value: '12'}
															],
															onPostRender: function() {
																this.value('1');
															},
														},
														{
															type: 'listbox',
															name: 'colOffset'+clicks,
															id: 'colOffset'+clicks,
															label: 'Column Offset',
															'values': [
																{text: 'no offset', value: ''},
																{text: '1 column', value: '1'},
																{text: '2 columns', value: '2'},
																{text: '3 columns', value: '3'},
																{text: '4 columns', value: '4'},
																{text: '5 columns', value: '5'},
																{text: '6 columns', value: '6'},
																{text: '7 columns', value: '7'},
																{text: '8 columns', value: '8'},
																{text: '9 columns', value: '9'},
																{text: '10 columns', value: '10'},
																{text: '11 columns', value: '11'},
																{text: '12 columns', value: '12'}
															],
															onPostRender: function() {
																this.value('');
															},
														},
														{
															type: 'listbox',
															name: 'colBreakpoint'+clicks,
															id: 'colBreakpoint'+clicks,
															label: 'Column Breakpoint',
															'values': [
																{text: 'small', value: 'sm'},
																{text: 'medium', value: 'md'},
																{text: 'large', value: 'lg'}
															],
															onPostRender: function() {
																this.value('md');
															},
														},
														{
															type: 'textbox',
															multiline: 'true',
															'minHeight': 100,
															name: 'colContent'+clicks,
															id: 'colContent'+clicks,
															label: 'Column Content',
															value: 'Here goes the content for your awesome column. You can edit the content after.'
														},
														{
															type: 'button',
															text: 'Remove Column',
															classes: 'widget btn remove',
															name: 'colRemove'+clicks,
															id: 'colRemove'+clicks,
															onclick: function(){
																var removable = this.parent();
																removable.remove();
																mainShortcode.parent().reflow();
																win.reflow();
															}
														}
													]
												});
												mainShortcode.parent().reflow();
												win.reflow();
											}
										}
									],
									onclose: function() {
										clicks = 0;
									},
									onsubmit: function( e ) {
										var items = editor.windowManager.getWindows()[0].find('#column');
										xclass = e.data.carXclass;
										columns = '';
										for (var i = 1; i < items.length + 1; i++) {
											number = e.data['colNumber'+i];
											offset = e.data['colOffset'+i];
											breakpoint = e.data['colBreakpoint'+i];
											content = e.data['colContent'+i];
											columns += '[col columns="'+number+'" offset="'+offset+'" breakpoint="'+breakpoint+'"]'+content+'[/col]';
										};
										if (e.data.colRowWrapper == false) {
											editor.insertContent('[row extra_class="'+e.data['rowXclass']+'"]'+columns+'[/row]');
										} else {
											editor.insertContent(columns);
										};
										clicks = 0;
									}
								});
							}
						},
						{
							text: 'Pretty Columns',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add Pretty Columns',
									width: 540,
									height: 400,
									autoScroll: true,
									classes: 'scrollable-content',
									buttons: [
										{
											text: 'Insert',
											classes: 'widget btn primary',
											onclick: 'submit',
										},
										{
											text: 'Close',
											onclick: 'close'
										}
									],
									body: [
										{
											type: 'checkbox',
											name: 'prettyRowWrapper',
											label: 'Exclude "row" wrapper',
											value: ''
										},
										{
											type: 'container',
											html: '<div class="field-description" style="width:498px;"><p class="modal-paragraph">Check this only if you want to add stand-alone columns, without the "row" wrapper.</p></div>'
										},
										{
											type: 'listbox',
											name: 'prettyAnimate',
											label: 'Animated entrance',
											'values': [
												{text: 'Yes', value: 'yes'},
												{text: 'no', value: 'no'}
											],
											onPostRender: function() {
												this.value('yes');
											},
										},
										{
											type: 'textbox',
											name: 'prettyXclass',
											label: 'Extra Class',
											value: ''
										},
										{
											type: 'container',
											html: '<div class="field-description" style="width:498px;"><p class="modal-paragraph">Insert a class name only if you want to add an extra class to your Pretty Columns section.</p></div>'
										},
										{
											type: 'button',
											name: 'addPretty',
											id: 'addPretty',
											classes: 'widget btn primary',
											text: 'Add Pretty Column',
											label: 'Add Pretty Column',
											onclick: function() {
												var win = editor.windowManager.getWindows()[0];
												var mainShortcode = win.find('#prettyXclass').parent();
												var btn = win.find('#addPretty').parent();

												btnClick('addPretty');

												btn.before({
													type: 'form',
													classes: 'form-insider',
													name: 'prettyColumn',
													id: 'prettyColumn'+clicks,
													items: [
														{
															type: 'container',
															html: '<h3 class="form-insider-title">Pretty Column '+clicks+'</h3>',
														},
														{
															type: 'listbox',
															name: 'prettyWidth'+clicks,
															label: 'Column Width',
															'values': [
																{text: 'One third', value: '4'},
																{text: 'Two Thirds', value: '8'},
																{text: 'One fourth', value: '3'},
																{text: 'Two fourths', value: '6'},
																{text: 'Three fourths', value: '9'},
															]
														},
														{
															type: 'textbox',
															name: 'prettyIcon'+clicks,
															label: 'Icon',
															value: ''
														},
														{
															type: 'container',
															html: '<div class="field-description" style="width:456px;"><p class="modal-paragraph">You need to choose a Font Awesome icon from <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">here</a> and write only the name of choosen icon (e.g. for icon named "fa-desktop" you will write only "desktop").</p></div>'
														},
														{
															type: 'textbox',
															name: 'prettyTitle'+clicks,
															label: 'Title',
															value: ''
														},
														{
															type: 'textbox',
															name: 'prettyLink'+clicks,
															label: 'Link',
															value: ''
														},
														{
															type: 'textbox',
															multiline: 'true',
															'minHeight': 100,
															name: 'prettyDescription'+clicks,
															label: 'Description',
															value: ''
														},
														{
															type: 'button',
															text: 'Remove Column',
															classes: 'widget btn remove',
															name: 'prettytRemove'+clicks,
															id: 'prettytRemove'+clicks,
															onclick: function(){
																var removable = this.parent();
																removable.remove();
																mainShortcode.parent().reflow();
																win.reflow();
															}
														},
													]
												});
												mainShortcode.parent().reflow();
												win.reflow();
											}
												
										},
									],
									onclose: function() {
										clicks = 0;
									},
									onsubmit: function( e ) {
										var items = editor.windowManager.getWindows()[0].find('#prettyColumn');

										if (e.data['prettyAnimate'] == "yes") {
											animatedEl = ' animated="yes"';
										} else {
											animatedEl = ' animated="no"';
										};

										columns = '';
										for (var i = 1; i < items.length + 1; i++) {
											columns += '[prettycol title="'+e.data['prettyTitle'+i]+'" link="'+e.data['prettyLink'+i]+'" icon="'+e.data['prettyIcon'+i]+'" width="'+e.data['prettyWidth'+i]+'"'+animatedEl+']'+e.data['prettyDescription'+i]+'[/prettycol]';
										};
										if (e.data.prettyRowWrapper == false) {
											editor.insertContent('[row extra_class="pretty-row'+e.data.prettyXclass+'"]'+columns+'[/row]');
										} else {
											editor.insertContent(columns);
										};
										clicks = 0;
									}
								});
							}
						},
						{
							text: 'Features Columns',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add features columns',
									width: 560,
									height: 400,
									autoScroll: true,
									classes: 'scrollable-content',
									buttons: [
										{
											text: 'Insert',
											classes: 'widget btn primary',
											onclick: 'submit',
										},
										{
											text: 'Close',
											onclick: 'close'
										}
									],
									body: [
										{
											type: 'checkbox',
											name: 'featuresRowWrapper',
											label: 'Exclude "row" wrapper',
											value: ''
										},
										{
											type: 'container',
											html: '<div class="field-description" style="width:518px;"><p class="modal-paragraph">Check this only if you want to add stand-alone feature column, without the "row" wrapper.</p></div>'
										},
										{
											type: 'listbox',
											name: 'featuresStyle',
											label: 'Style',
											'values': [
												{text: 'horizontal', value: 'horizontal'},
												{text: 'vertical', value: 'vertical'}
											],
											onPostRender: function() {
												this.value('horizontal');
											},
										},
										{
											type: 'listbox',
											name: 'featuresBreakpoint',
											label: 'Breakpoint',
											'values': [
												{text: 'small', value: 'sm'},
												{text: 'medium', value: 'md'},
												{text: 'large', value: 'lg'}
											],
											onPostRender: function() {
												this.value('md');
											},
										},
										{
											type: 'listbox',
											name: 'featuresAnimate',
											label: 'Animated entrance',
											'values': [
												{text: 'Yes', value: 'yes'},
												{text: 'No', value: 'no'}
											],
											onPostRender: function() {
												this.value('yes');
											},
										},
										{
											type: 'textbox',
											name: 'featuresXclass',
											label: 'Extra Class',
											value: ''
										},
										{
											type: 'container',
											html: '<div class="field-description" style="width:518px;"><p class="modal-paragraph">Insert a class name only if you want to add an extra class to your Pretty Columns section.</p></div>'
										},
										{
											type: 'button',
											name: 'addFeature',
											id: 'addFeature',
											classes: 'widget btn primary',
											text: 'Add Feature Column',
											label: 'Feature columns',
											onclick: function() {
												var win = editor.windowManager.getWindows()[0];
												var mainShortcode = win.find('#featuresXclass').parent();
												var btn = win.find('#addFeature').parent();

												btnClick('addFeature');

												btn.before({
													type: 'form',
													classes: 'form-insider',
													name: 'featureColumn',
													id: 'featureColumn'+clicks,
													items: [
														{
															type: 'container',
															html: '<h3 class="form-insider-title">Feature column '+clicks+'</h3>',
														},
														{
															type: 'listbox',
															name: 'featureWidth'+clicks,
															label: 'Column Width',
															'values': [
																{text: 'One third', value: '4'},
																{text: 'Two Thirds', value: '8'},
																{text: 'One fourth', value: '3'},
																{text: 'Two fourths', value: '6'},
																{text: 'Three fourths', value: '9'},
															],
															onPostRender: function() {
																this.value('4');
															},
														},
														{
															type: 'listbox',
															name: 'featureOffset'+clicks,
															id: 'featureOffset'+clicks,
															label: 'Column Offset',
															'values': [
																{text: 'no offset', value: ''},
																{text: '1 column', value: '1'},
																{text: '2 columns', value: '2'},
																{text: '3 columns', value: '3'},
																{text: '4 columns', value: '4'},
																{text: '5 columns', value: '5'},
																{text: '6 columns', value: '6'},
																{text: '7 columns', value: '7'},
																{text: '8 columns', value: '8'},
																{text: '9 columns', value: '9'},
																{text: '10 columns', value: '10'},
																{text: '11 columns', value: '11'},
																{text: '12 columns', value: '12'}
															],
															onPostRender: function() {
																this.value('');
															},
														},
														{
															type: 'textbox',
															name: 'featureIcon'+clicks,
															label: 'Icon',
															value: ''
														},
														{
															type: 'container',
															html: '<div class="field-description" style="width:476px;"><p class="modal-paragraph">You need to choose a Font Awesome icon from <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">here</a> and write only the name of choosen icon (e.g. for icon named "fa-desktop" you will write only "desktop").</p></div>'
														},
														{
															type: 'textbox',
															name: 'featureIconColor'+clicks,
															label: 'Icon Color',
															value: ''
														},
														{
															type: 'textbox',
															multiline: 'true',
															'minHeight': 100,
															name: 'featureDescription'+clicks,
															label: 'Description',
															value: ''
														},
														{
															type: 'button',
															text: 'Remove Column',
															classes: 'widget btn remove',
															name: 'prettytRemove'+clicks,
															id: 'prettytRemove'+clicks,
															onclick: function(){
																var removable = this.parent();
																removable.remove();
																mainShortcode.parent().reflow();
																win.reflow();
															}
														},
													]
												});
												mainShortcode.parent().reflow();
												win.reflow();
											}
												
										},
									],
									onclose: function() {
										clicks = 0;
									},
									onsubmit: function( e ) {
										var items = editor.windowManager.getWindows()[0].find('#featureColumn');
										animated = (e.data.featuresAnimate == "yes") ? ' animated="yes"' : ' animated="no"';
										columns = '';

										for (var i = 1; i < items.length + 1; i++) {
											columns += '[feature'+animated+' icon="'+e.data['featureIcon'+i]+'" color="'+e.data['featureIconColor'+i]+'" description="'+e.data['featureDescription'+i]+'" width="'+e.data['featureWidth'+i]+'" breakpoint="'+e.data['featuresBreakpoint']+'" offset="'+e.data['featureOffset'+i]+'"]';
										};
										if (e.data.featuresRowWrapper == false) {
											editor.insertContent('[features extra_class="'+e.data.featuresXclass+'" style="'+e.data.featuresStyle+'"]'+columns+'[/features]');
										} else {
											editor.insertContent(columns);
										};
										clicks = 0;
									}
								});
							}
						},
						{
							text: 'Pricing Column',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add pricing column',
									width: 560,
									height: 400,
									autoScroll: true,
									classes: 'scrollable-content',
									buttons: [
										{
											text: 'Insert',
											classes: 'widget btn primary',
											onclick: 'submit',
										},
										{
											text: 'Close',
											onclick: 'close'
										}
									],
									body: [
										{
											type: 'container',
											html: '<div class="window-description" style="width: 518px;"><p class="modal-paragraph">IMPORTANT! You need to wrap the pricing columns with [row][/row] shortcode as they are based on columns layout.</p></div>'
										},
										{
											type: 'textbox',
											name: 'pricingPlan',
											label: 'Pricing plan',
											value: '',
										},
										{
											type: 'textbox',
											name: 'pricingColor',
											label: 'Plan color',
											value: '',
										},
										{
											type: 'textbox',
											name: 'pricingPrice',
											label: 'Plan Price',
											value: '',
										},
										{
											type: 'textbox',
											name: 'pricingCurrency',
											label: 'Currency',
											value: 'USD',
										},
										{
											type: 'textbox',
											name: 'pricingSymbol',
											label: 'Price symbol',
											value: '$',
										},
										{
											type: 'textbox',
											name: 'pricingFrequency',
											label: 'Payment frequency',
											value: 'per month',
										},
										{
											type: 'textbox',
											name: 'pricingUrl',
											label: 'Link URL',
											value: '',
										},
										{
											type: 'textbox',
											name: 'pricingLabel',
											label: 'Button label',
											value: '',
										},
										{
											type: 'listbox',
											name: 'pricingTarget',
											label: 'Link target',
											'values': [
												{text: 'Same window', value: 'self'},
												{text: 'Another window', value: 'blank'}
											]
										},
										{
											type: 'listbox',
											name: 'pricingBreakpoint',
											label: 'Breakpoint',
											'values': [
												{text: 'small', value: 'sm'},
												{text: 'medium', value: 'md'},
												{text: 'large', value: 'lg'}
											],
											onPostRender: function() {
												this.value('md');
											},
										},
										{
											type: 'listbox',
											name: 'pricingSize',
											label: 'Column Width',
											'values': [
												{text: 'One third', value: '4'},
												{text: 'Two thirds', value: '8'},
												{text: 'One fourth', value: '3'},
												{text: 'Two fourths', value: '6'},
												{text: 'Three fourths', value: '9'},
											],
											onPostRender: function() {
												this.value('4');
											},
										},
										{
											type: 'radio',
											name: 'pricingFeatured',
											label: 'Featured plan',
											checked: false,
										},
										{
											type: 'button',
											name: 'addPricingFeature',
											id: 'addPricingFeature',
											classes: 'widget btn primary',
											text: 'Add New Feature',
											label: 'Plan features',
											onclick: function() {
												var win = editor.windowManager.getWindows()[0];
												var mainShortcode = win.find('#pricingSize').parent();
												var btn = win.find('#addPricingFeature').parent();

												btnClick('addPricingFeature');

												btn.before({
													type: 'form',
													classes: 'form-insider',
													name: 'pricingColumn',
													id: 'pricingColumn'+clicks,
													items: [
														{
															type: 'textbox',
															name: 'pricingFeature'+clicks,
															label: 'Feature'+clicks,
															value: '',
														},
														{
															type: 'button',
															text: 'Remove this feature',
															classes: 'widget btn remove',
															name: 'featureRemove'+clicks,
															id: 'featureRemove'+clicks,
															onclick: function(){
																var removable = this.parent();
																removable.remove();
																mainShortcode.parent().reflow();
																win.reflow();
															}
														}
													]
												});
												mainShortcode.parent().reflow();
												win.reflow();
											}
												
										},
									],
									onclose: function() {
										clicks = 0;
									},
									onsubmit: function( e ) {
										var features = editor.windowManager.getWindows()[0].find('#pricingColumn');
										feat = '';

										for (var i = 1; i < features.length + 1; i++) {
											if (i == features.length) {
												feat += e.data['pricingFeature'+i];
											} else {
												feat += e.data['pricingFeature'+i]+'-/-';
											};
										};

										var featured = '';
										if (e.data.pricingFeatured == true) { featured = "yes" } else { featured = "no" };

										editor.insertContent('[pricing_col plan="'+e.data.pricingPlan+'" plan_color="'+e.data.pricingColor+'" price="'+e.data.pricingPrice+'" price_symbol="'+e.data.pricingSymbol+'" currency="'+e.data.pricingCurrency+'" frequency="'+e.data.pricingFrequency+'" url="'+e.data.pricingUrl+'" button_label="'+e.data.pricingLabel+'" link_target="'+e.data.pricingTarget+'" features="'+feat+'" breakpoint="'+e.data.pricingBreakpoint+'" size="'+e.data.pricingSize+'" featured="'+featured+'"]');
										clicks = 0;
									}
								});
							}
						},
						{
							text: 'Team',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add Team section',
									width: 620,
									height: 400,
									autoScroll: true,
									classes: 'scrollable-content',
									buttons: [
										{
											text: 'Insert',
											classes: 'widget btn primary',
											onclick: 'submit'
										},
										{
											text: 'Close',
											onclick: 'close',
										}
									],
									body: [
										{
											type: 'checkbox',
											name: 'teamRowWrapper',
											label: 'Exclude "row" wrapper',
											value: ''
										},
										{
											type: 'container',
											html: '<div class="field-description" style="width:578px;"><p class="modal-paragraph">Check this only if you want to add stand-alone Team member, without the "row" wrapper.</p></div>'
										},
										{
											type: 'listbox',
											name: 'teamAnimate',
											label: 'Animated entrance',
											'values': [
												{text: 'Yes', value: 'yes'},
												{text: 'No', value: 'no'}
											],
											onPostRender: function() {
												this.value('yes');
											},
										},
										{
											type: 'textbox',
											name: 'teamXclass',
											label: 'Extra Class',
											value: ''
										},
										{
											type: 'container',
											html: '<div class="field-description" style="width:578px;"><p class="modal-paragraph">Insert a class name only if you want to add an extra class to your Team section.</p></div>'
										},
										{
											type: 'button',
											name: 'addTeam',
											id: 'addTeam',
											classes: 'widget btn primary',
											text: 'Add Team Member',
											label: 'Add Team member',
											onclick: function(){
												var win = editor.windowManager.getWindows()[0];
												var mainShortcode = win.find('#teamXclass').parent();
												var btn = win.find('#addTeam').parent();

												btnClick('addTeam');

												btn.before({
													type: 'form',
													classes: 'form-insider',
													name: 'teamMember',
													id: 'teamMember'+clicks,
													items: [
														{
															type: 'container',
															html: '<h3 class="form-insider-title">Team Member '+clicks+'</h3>',
														},
														{
															type: 'textbox',
															name: 'teamName'+clicks,
															label: 'Name',
															value: ''
														},
														{
															type: 'textbox',
															name: 'teamLink'+clicks,
															label: 'Link on name',
															value: ''
														},
														{
															type: 'textbox',
															name: 'teamTitle'+clicks,
															label: 'Title',
															value: ''
														},
														// {
														// 	type: 'textbox',
														// 	name: 'teamPicture'+clicks,
														// 	label: 'Picture URL',
														// 	value: ''
														// },
														image_upload('Picture URL', 'teamPicture'),
														{
															type: 'textbox',
															multiline: 'true',
															'minHeight': 100,
															name: 'teamBio'+clicks,
															label: 'Bio',
															value: ''
														},
														{
															type: 'listbox',
															name: 'teamIconsStyle'+clicks,
															label: 'Social icons style',
															'values': [
																{text: 'Light', value: 'light'},
																{text: 'Dark', value: 'dark'}
															]
														},
														{
															type: 'textbox',
															name: 'teamEmail'+clicks,
															label: 'Email',
															value: ''
														},
														{
															type: 'textbox',
															name: 'teamFacebook'+clicks,
															label: 'Facebook',
															value: ''
														},
														{
															type: 'textbox',
															name: 'teamTwitter'+clicks,
															label: 'Twitter',
															value: ''
														},
														{
															type: 'textbox',
															name: 'teamGoogle'+clicks,
															label: 'Google+',
															value: ''
														},
														{
															type: 'textbox',
															name: 'teamLinkedin'+clicks,
															label: 'Linkedin',
															value: ''
														},
														{
															type: 'textbox',
															name: 'teamPinterest'+clicks,
															label: 'Pinterest',
															value: ''
														},
														{
															type: 'textbox',
															name: 'teamYoutube'+clicks,
															label: 'Youtube',
															value: ''
														},
														{
															type: 'textbox',
															name: 'teamDribbble'+clicks,
															label: 'Dribbble',
															value: ''
														},
														{
															type: 'textbox',
															name: 'teamGithub'+clicks,
															label: 'Github',
															value: ''
														},
														{
															type: 'textbox',
															name: 'teamDigg'+clicks,
															label: 'Digg',
															value: ''
														},
														{
															type: 'textbox',
															name: 'teamDelicious'+clicks,
															label: 'Delicious',
															value: ''
														},
														{
															type: 'textbox',
															name: 'teamTumblr'+clicks,
															label: 'Tumblr',
															value: ''
														},
														{
															type: 'textbox',
															name: 'teamSkype'+clicks,
															label: 'Skype',
															value: ''
														},
														{
															type: 'textbox',
															name: 'teamSoundcloud'+clicks,
															label: 'Soundcloud',
															value: ''
														},
														{
															type: 'textbox',
															name: 'teamVimeo'+clicks,
															label: 'Vimeo',
															value: ''
														},
														{
															type: 'textbox',
															name: 'teamFlickr'+clicks,
															label: 'Flickr',
															value: ''
														},
														{
															type: 'textbox',
															name: 'teamVK'+clicks,
															label: 'VK',
															value: ''
														},
														{
															type: 'button',
															text: 'Remove Team Member',
															classes: 'widget btn remove',
															name: 'teamRemove'+clicks,
															id: 'teamRemove'+clicks,
															onclick: function(){
																var removable = this.parent();
																removable.remove();
																mainShortcode.parent().reflow();
																win.reflow();
															}
														}
													]
												});
												mainShortcode.parent().reflow();
												win.reflow();
											}
										}
									],
									onclose: function() {
										clicks = 0;
									},
									onsubmit: function( e ) {

										var items = editor.windowManager.getWindows()[0].find('#teamMember');
										xclass  = ' '+e.data.teamXclass;
										if (e.data['teamAnimate'] == "yes") {
											animatedRow = ' animated-entrance';
											animatedEl = ' animated="yes"';
										} else {
											animatedRow = '';
											animatedEl = ' animated="no"';
										};
										members = '';

										for (var i = 1; i < items.length + 1; i++) {

											Email = (e.data['teamEmail'+i] !== "") ? ' email="' + e.data['teamEmail'+i] + '"' : '';
											Facebook = (e.data['teamFacebook'+i] !== "") ? ' facebook="' + e.data['teamFacebook'+i] + '"' : '';
											Twitter = (e.data['teamTwitter'+i] !== "") ? ' twitter="' + e.data['teamTwitter'+i] + '"' : '';
											Google = (e.data['teamGoogle'+i] !== "") ? ' google="' + e.data['teamGoogle'+i] + '"' : '';
											Linkedin = (e.data['teamLinkedin'+i] !== "") ? ' linkedin="' + e.data['teamLinkedin'+i] + '"' : '';
											Pinterest = (e.data['teamPinterest'+i] !== "") ? ' pinterest="' + e.data['teamPinterest'+i] + '"' : '';
											Youtube = (e.data['teamYoutube'+i] !== "") ? ' youtube="' + e.data['teamYoutube'+i] + '"' : '';
											Dribbble = (e.data['teamDribbble'+i] !== "") ? ' dribbble="' + e.data['teamDribbble'+i] + '"' : '';
											Github = (e.data['teamGithub'+i] !== "") ? ' github="' + e.data['teamGithub'+i] + '"' : '';
											Digg = (e.data['teamGithub'+i] !== "") ? ' digg="' + e.data['teamGithub'+i] + '"' : '';
											Delicious = (e.data['teamDelicious'+i] !== "") ? ' delicious="' + e.data['teamDelicious'+i] + '"' : '';
											Tumblr = (e.data['teamTumblr'+i] !== "") ? ' tumblr="' + e.data['teamTumblr'+i] + '"' : '';
											Skype = (e.data['teamSkype'+i] !== "") ? ' skype="' + e.data['teamSkype'+i] + '"' : '';
											Soundcloud = (e.data['teamSoundcloud'+i] !== "") ? ' soundcloud="' + e.data['teamSoundcloud'+i] + '"' : '';
											Vimeo = (e.data['teamVimeo'+i] !== "") ? ' vimeo="' + e.data['teamVimeo'+i] + '"' : '';
											Flickr = (e.data['teamFlickr'+i] !== "") ? ' flickr="' + e.data['teamFlickr'+i] + '"' : '';
											Vk = (e.data['teamVK'+i] !== "") ? ' vk="' + e.data['teamVK'+i] + '"' : '';

											name = e.data['teamName'+i];
											link = e.data['teamLink'+i];
											title = e.data['teamTitle'+i];
											picture = e.data['teamPicture'+i];
											bio = e.data['teamBio'+i];
											iconStyle = e.data['teamIconsStyle'+i];

											members += '[team_member name="'+name+'" link="'+link+'" title="'+title+'" picture="'+picture+'"'+animatedEl+' social_icons_style="'+iconStyle+'"'+Email+Facebook+Twitter+Google+Linkedin+Pinterest+Youtube+Dribbble+Github+Digg+Delicious+Tumblr+Skype+Soundcloud+Vimeo+Flickr+Vk+']'+bio+'[/team_member]';
										};
										if (e.data.teamRowWrapper == false) {
											editor.insertContent('[row extra_class="team-row'+animatedRow+xclass+'"]'+members+'[/row]');
										} else {
											editor.insertContent(members);
										};
										clicks = 0;
									}
								});
							}
						},
						{
							text: 'Latest Portfolio posts',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add Latest Portfolio posts',
									buttons: [
										{
											text: 'Insert',
											classes: 'widget btn primary',
											onclick: 'submit'
										},
										{
											text: 'Close',
											onclick: 'close'
										}
									],
									body: [
										{
											type: 'textbox',
											name: 'portfolioNumber',
											label: 'Posts count',
											value: '6'
										},
										{
											type: 'listbox',
											name: 'portfolioFilters',
											label: 'Show Filter Bar',
											'values': [
												{text: 'yes', value: 'true'},
												{text: 'no', value: 'false'}
											]
										},
										{
											type: 'listbox',
											name: 'portfolioFiltersSize',
											label: 'Filter buttons size',
											'values': [
												{text: 'small', value: 'small'},
												{text: 'medium', value: 'medium'},
												{text: 'big', value: 'big'},
											]
										},
										{
											type: 'listbox',
											name: 'portfolioFiltersColor',
											label: 'Filter buttons color',
											'values': [
												{text: 'blue', value: 'blue'},
												{text: 'dark blue', value: 'darkblue'},
												{text: 'red', value: 'red'},
												{text: 'orange', value: 'orange'},
												{text: 'green', value: 'green'},
												{text: 'white', value: 'white'},
												{text: 'gray', value: 'gray'},
												{text: 'light gray', value: 'lightgray'},
											]
										},
										{
											type: 'listbox',
											name: 'portfolioFiltersOutlines',
											label: 'Filter buttons style',
											'values': [
												{text: 'flat', value: 'false'},
												{text: 'outlined', value: 'true'}
											]
										},
										{
											type: 'listbox',
											name: 'portfolioShowMore',
											label: 'Show "more" button',
											'values': [
												{text: 'yes', value: 'true'},
												{text: 'no', value: 'false'}
											]
										},
										{
											type: 'textbox',
											name: 'portfolioMoreUrl',
											label: '"More" button URL',
											value: '#'
										},
										{
											type: 'textbox',
											name: 'portfolioMoreText',
											label: '"More" button text',
											value: 'More Work'
										},
										{
											type: 'listbox',
											name: 'portfolioMoreTarget',
											label: '"More" button target',
											'values': [
												{text: 'self', value: 'self'},
												{text: 'blank', value: 'blank'}
											]
										},
										{
											type: 'listbox',
											name: 'portfolioShowLinks',
											label: 'Show post links',
											'values': [
												{text: 'yes', value: 'true'},
												{text: 'no', value: 'false'}
											]
										},
									],
									onsubmit: function( e ) {
										editor.insertContent( '[portfolio posts="' + e.data.portfolioNumber + '" show_filters="' + e.data.portfolioFilters + '" filters_color="' + e.data.portfolioFiltersColor + '" filters_size="' + e.data.portfolioFiltersSize + '" filters_outlines="' + e.data.portfolioFiltersOutlines + '" more_button="' + e.data.portfolioShowMore + '" more_url="' + e.data.portfolioMoreUrl + '" more_text="' + e.data.portfolioMoreText + '" more_target="' + e.data.portfolioMoreTarget + '"  post_links="' + e.data.portfolioShowLinks + '"]' );
									}
								});
							}
						},
						{
							text: 'Latest Blog posts',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add Recent Blog Posts',
									width: 460,
									height: 480,
									autoScroll: true,
									id: 'blogPosts',
									classes: 'scrollable-content',
									buttons: [
										{
											text: 'Insert',
											classes: 'widget btn primary',
											onclick: 'submit'
										},
										{
											text: 'Close',
											onclick: 'close'
										}
									],
									body: [
										{
											type: 'textbox',
											name: 'blogCount',
											label: 'Posts count',
											value: ''
										},
										{
											type: 'listbox',
											name: 'blogLayout',
											label: 'Layout',
											id: 'blogLayout',
											values: [
												{text: 'Vertical', value: 'vertical'},
												{text: 'Horizontal', value: 'horizontal'}
											],
											onPostRender: function() {
												this.value('vertical');
											},
											onselect: function() {
												
												if (this.value() == 'vertical') {
													var win = editor.windowManager.getWindows()[0];
													var lstH = win.find('listbox')[2];
													var lstV = win.find('listbox')[1];
													lstH.disabled(true);
													lstV.disabled(false);
												} else if (this.value() == 'horizontal') {
													var win = editor.windowManager.getWindows()[0];
													var lstH = win.find('listbox')[2];
													var lstV = win.find('listbox')[1];
													lstH.disabled(false);
													lstV.disabled(true);
												}
												
											},
										},
										{
											type: 'listbox',
											name: 'blogWidthV',
											label: 'Vertical layout col width',
											id: 'verticalLayout',
											'values': [
												{text: 'One Half', value: '6'},
												{text: 'One Third', value: '4'},
												{text: 'One Fourth', value: '3'}
											]
										},
										{
											type: 'listbox',
											name: 'blogWidthH',
											label: 'Horizontal layout col width',
											id: 'horizontalLayout',
											'values': [
												{text: 'Full Width', value: '12'},
												{text: 'One Half', value: '6'}
											]
										},
										{
											type: 'textbox',
											name: 'descLength',
											label: 'Description length',
											value: ''
										},
										{
											type: 'listbox',
											name: 'blogImage',
											label: 'Show Image',
											'values': [
												{text: 'Yes', value: 'true'},
												{text: 'No', value: 'false'}
											]
										},
										{
											type: 'listbox',
											name: 'blogAnimate',
											label: 'Animated entrance',
											'values': [
												{text: 'Yes', value: 'yes'},
												{text: 'No', value: 'no'}
											],
											onPostRender: function() {
												this.value('yes');
											},
										},
										{
											type: 'container',
											classes: 'modal-shortcode-info',
											name: 'latestBlogDesc',
											html: '<div class="window-description" style="margin-top:20px; width:418px;"><p class="modal-paragraph">For all fields bellow you need to use only IDs of each entities. If you want to enter more IDs, you need to sepparate them by a single comma (without any space).</p></div>'
										},
										{
											type: 'textbox',
											name: 'blogOnlyPosts',
											label: 'Only posts',
											value: ''
										},
										{
											type: 'textbox',
											name: 'blogExcludePosts',
											label: 'Exclude posts',
											value: ''
										},
										{
											type: 'textbox',
											name: 'blogOnlyCats',
											label: 'Only categories',
											value: ''
										},
										{
											type: 'textbox',
											name: 'blogExcludeCats',
											label: 'Exclude categories',
											value: ''
										},
										{
											type: 'textbox',
											name: 'blogOnlyTags',
											label: 'Only tags',
											value: ''
										},
										{
											type: 'textbox',
											name: 'blogExcludeTags',
											label: 'Exclude tags',
											value: ''
										},
									],
									onsubmit: function( e ) {
										postWidth = (e.data.blogLayout == "horizontal") ? ' post_width="' + e.data.blogWidthH + '"' : ' post_width="' + e.data.blogWidthV + '"';
										onlyPosts = (e.data.blogOnlyPosts !== "") ? ' onlyposts="' + e.data.blogOnlyPosts + '"' : '';
										excludePosts = (e.data.blogExcludePosts !== "") ? ' exclude_posts="' + e.data.blogExcludePosts + '"' : '';
										onlyCats = (e.data.blogOnlyCats !== "") ? ' onlycats="' + e.data.blogOnlyCats + '"' : '';
										excludeCats = (e.data.blogExcludeCats !== "") ? ' exclude_cats="' + e.data.blogExcludeCats + '"' : '';
										onlyTags = (e.data.blogOnlyTags !== "") ? ' onlytags="' + e.data.blogOnlyTags + '"' : '';
										excludeTags = (e.data.blogExcludeTags !== "") ? ' exclude_tags="' + e.data.blogExcludeTags + '"' : '';
										editor.insertContent( '[latest_posts animated="'+e.data.blogAnimated+'" posts="'+e.data.blogCount+'" description_length="'+e.data.descLength+'" show_image="'+e.data.blogImage+'" layout="'+e.data.blogLayout+'"'+postWidth+onlyPosts+excludePosts+onlyCats+excludeCats+onlyTags+excludeTags+']');
									}
								});
							}
						},
						{
							text: 'Testimonials',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add Testimonials',
									buttons: [
										{
											text: 'Insert',
											classes: 'widget btn primary',
											onclick: 'submit'
										},
										{
											text: 'Close',
											onclick: 'close'
										}
									],
									body: [
										{
											type: 'container',
											html: '<div class="window-description"><p class="modal-paragraph">Please fill all fields accordingly. If you choose to display only specific testimonials by ID, all other fields will be omitted.</p></div>'
										},
										{
											type: 'textbox',
											name: 'tCount',
											label: 'Posts Count',
											value: '5'
										},
										{
											type: 'container',
											html: '<div class="field-description"><p class="modal-paragraph special-paragraph">Set the number of displayed posts.</p></div>'
										},
										{
											type: 'textbox',
											name: 'tIDs',
											label: 'Post IDs',
											value: ''
										},
										{
											type: 'container',
											html: '<div class="field-description"><p class="modal-paragraph">IDs of each post you want to display separated by a single comma.</p></div>'
										},
										{
											type: 'textbox',
											name: 'tCat',
											label: 'Categories',
											value: ''
										},
										{
											type: 'container',
											html: '<div class="field-description"><p class="modal-paragraph"">Categories slugs separated by a single comma.</p></div>'
										},
									],
									onsubmit: function( e ) {
										editor.insertContent( '[testimonials posts_count="' + e.data.tCount + '" only_posts="' + e.data.tIDs + '"  categories="' + e.data.tCat + '"]');
									}
								});
							}
						},
						{
							text: 'Slider',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add Slider',
									width: 700,
									height: 400,
									autoScroll: true,
									classes: 'scrollable-content',
									buttons: [
										{
											text: 'Insert',
											classes: 'widget btn primary',
											onclick: 'submit',
										},
										{
											text: 'Close',
											onclick: 'close'
										}
									],
									body: [
										{
											type: 'textbox',
											name: 'sliderHeight',
											label: 'Height (px)',
											value: '500',
										},
										{
											type: 'listbox',
											name: 'sliderBullets',
											label: 'Show Bullets',
											values: [
												{text: 'Yes', value: 'true'},
												{text: 'No', value: 'false'},
											],
											onPostRender: function() {
												this.value('true');
											},
										},
										{
											type: 'listbox',
											name: 'sliderArrows',
											label: 'Show Arrows',
											values: [
												{text: 'Yes', value: 'true'},
												{text: 'No', value: 'false'},
											],
											onPostRender: function() {
												this.value('true');
											},
										},
										{
											type: 'listbox',
											name: 'sliderTransition',
											label: 'Transition',
											values: [
												{text: 'Fade', value: 'fade'},
												{text: 'Scroll', value: 'scroll'},
											],
											onPostRender: function() {
												this.value('fade');
											},
										},
										{
											type: 'textbox',
											name: 'sliderSpeed',
											label: 'Transition Speed (ms)',
											value: '800'
										},
										{
											type: 'listbox',
											name: 'sliderAutoplay',
											label: 'Autoplay',
											values: [
												{text: 'Yes', value: 'true'},
												{text: 'No', value: 'false'},
											],
											onPostRender: function() {
												this.value('true');
											},
										},
										{
											type: 'textbox',
											name: 'sliderAutospeed',
											label: 'Autoplay Interval (ms)',
											value: ''
										},
										{
											type: 'textbox',
											name: 'sliderXclass',
											id: 'sliderXclass',
											label: 'Extra class',
											value: ''
										},
										{
											type: 'container',
											html: '<div class="mce-separator"></div>'
										},
										{
											type: 'button',
											name: 'sliderItems',
											id: 'sliderItems',
											classes: 'widget btn primary',
											text: 'Add Slide',
											label: 'Add Slide',
											onclick: function() {
												var win = editor.windowManager.getWindows()[0];
												var mainShortcode = win.find('#sliderXclass').parent();
												var btn = win.find('#sliderItems').parent();

												btnClick('sliderItems');

												btn.before({
													type: 'form',
													classes: 'form-insider',
													name: 'sliderItem',
													id: 'sliderItem'+clicks,
													items: [
														{
															type: 'container',
															html: '<h3 class="form-insider-title">Slide '+clicks+'</h3>',
														},
														image_upload('Background image', 'sliderBgUrl'),
														{
															type: 'textbox',
															label: 'Background color',
															name: 'sliderBgColor'+clicks,
															id: 'sliderBgColor'+clicks,
															value: '',
														},
														{
															type: 'listbox',
															label: 'Background repeat',
															name: 'sliderBgRepeat'+clicks,
															id: 'sliderBgRepeat'+clicks,
															'values': [
																{text: 'Repeat', value: 'repeat'},
																{text: 'No-Repeat', value: 'no-repeat'}
															],
															onPostRender: function() {
																this.value('no-repeat');
															},
														},
														{
															type: 'listbox',
															label: 'Background position',
															name: 'sliderBgPosition'+clicks,
															id: 'sliderBgPosition'+clicks,
															'values': [
																{text: 'Left Top', value: 'left top'},
																{text: 'Left Center', value: 'left center'},
																{text: 'Left Bottom', value: 'left bottom'},
																{text: 'Right Top', value: 'right top'},
																{text: 'Right Center', value: 'right center'},
																{text: 'Right Bottom', value: 'right bottom'},
																{text: 'Center Top', value: 'center top'},
																{text: 'Center Center', value: 'center center'},
																{text: 'Center Bottom', value: 'center bottom'}
															],
															onPostRender: function() {
																this.value('center top');
															},
														},
														{
															type: 'listbox',
															label: 'Background Attachment',
															name: 'sliderBgAttachment'+clicks,
															id: 'sliderBgAttachment'+clicks,
															'values': [
																{text: 'Scroll', value: 'scroll'},
																{text: 'Fixed', value: 'fixed'}
															],
															onPostRender: function() {
																this.value('scroll');
															},
														},
														{
															type: 'textbox',
															label: 'Content color',
															name: 'sliderContentColor'+clicks,
															id: 'sliderContentColor'+clicks,
															value: '',
														},
														{
															type: 'listbox',
															label: 'Fullwidth content',
															name: 'sliderFullContent'+clicks,
															id: 'sliderFullContent'+clicks,
															tooltip: 'If you choose Yes, then the Container wrapper will be removed.',
															'values': [
																{text: 'Yes', value: 'true'},
																{text: 'No', value: 'false'}
															],
															onPostRender: function() {
																this.value('false');
															},
														},
														{
															type: 'listbox',
															label: 'Content Animation',
															name: 'sliderContentAnimation'+clicks,
															id: 'sliderContentAnimation'+clicks,
															'values': [
																{text: 'bounceIn', value: 'bounceIn'},
																{text: 'bounceInLeft', value: 'bounceInLeft'},
																{text: 'bounceInRight', value: 'bounceInRight'},
																{text: 'bounceInDown', value: 'bounceInDown'},
																{text: 'bounceInUp', value: 'bounceInUp'},
																{text: 'fadeIn', value: 'fadeIn'},
																{text: 'fadeInLeft', value: 'fadeInLeft'},
																{text: 'fadeInRight', value: 'fadeInRight'},
																{text: 'fadeInDown', value: 'fadeInDown'},
																{text: 'fadeInUp', value: 'fadeInUp'},
																{text: 'flipInX', value: 'flipInX'},
																{text: 'flipInY', value: 'flipInY'},
																{text: 'lightSpeedIn', value: 'lightSpeedIn'},
																{text: 'rotateIn', value: 'rotateIn'},
																{text: 'rotateInDownLeft', value: 'rotateInDownLeft'},
																{text: 'rotateInDownRight', value: 'rotateInDownRight'},
																{text: 'rotateInUpLeft', value: 'rotateInUpLeft'},
																{text: 'rotateInUpRight', value: 'rotateInUpRight'},
																{text: 'rollIn', value: 'rollIn'},
																{text: 'zoomInLeft', value: 'zoomInLeft'},
																{text: 'zoomInRight', value: 'zoomInRight'},
																{text: 'zoomInDown', value: 'zoomInDown'},
																{text: 'zoomInUp', value: 'zoomInUp'},
															],
															onPostRender: function() {
																this.value('fadeIn');
															},
														},
														{
															type: 'textbox',
															label: 'Overlay color',
															name: 'sliderOvColor'+clicks,
															id: 'sliderOvColor'+clicks,
															value: '',
														},
														{
															type: 'listbox',
															label: 'Overlay Opacity',
															name: 'sliderOvOpacity'+clicks,
															id: 'sliderOvOpacity'+clicks,
															'values': [
																{text: '0.1', value: '0.1'},
																{text: '0.2', value: '0.2'},
																{text: '0.3', value: '0.3'},
																{text: '0.4', value: '0.4'},
																{text: '0.5', value: '0.5'},
																{text: '0.6', value: '0.6'},
																{text: '0.7', value: '0.7'},
																{text: '0.8', value: '0.8'},
																{text: '0.9', value: '0.9'},
																{text: '1', value: '1'},
															],
															onPostRender: function() {
																this.value('0.5');
															},
														},
														{
															type: 'listbox',
															label: 'Parallax Effect',
															name: 'sliderParallax'+clicks,
															id: 'sliderParallax'+clicks,
															'values': [
																{text: 'Yes', value: 'true'},
																{text: 'No', value: 'false'}
															],
															onPostRender: function() {
																this.value('false');
															},
														},
														{
															type: 'textbox',
															multiline: 'true',
															'minHeight': 100,
															name: 'sliderContent'+clicks,
															id: 'sliderContent'+clicks,
															label: 'Slide Content',
															value: 'Here goes the content for your slide. You can add it later and keep in mind that you can use shortcodes inside it.'
														},
														{
															type: 'button',
															text: 'Remove Slide',
															classes: 'widget btn remove',
															name: 'sliderRemove'+clicks,
															id: 'sliderRemove'+clicks,
															onclick: function(){
																var removable = this.parent();
																removable.remove();
																mainShortcode.parent().reflow();
																win.reflow();
															}
														},
													]
												});
												mainShortcode.parent().reflow();
												win.reflow();
											}
												
										},
									],
									onclose: function() {
										clicks = 0;
									},
									onsubmit: function( e ) {
										var items = editor.windowManager.getWindows()[0].find('#sliderItem');
										slides = '';

										for (var i = 1; i < items.length + 1; i++) {
											slides += '[slide background_image="'+e.data['sliderBgUrl'+i]+'" background_color="'+e.data['sliderBgColor'+i]+'" background_repeat="'+e.data['sliderBgRepeat'+i]+'" background_position="'+e.data['sliderBgPosition'+i]+'" background_attachment="'+e.data['sliderBgAttachment'+i]+'" content_color="'+e.data['sliderContentColor'+i]+'" fullwidth_content="'+e.data['sliderFullContent'+i]+'" animation="'+e.data['sliderContentAnimation'+i]+'" overlay_color="'+e.data['sliderOvColor'+i]+'" overlay_opacity="'+e.data['sliderOvOpacity'+i]+'" parallax="'+e.data['sliderParallax'+i]+'" ]'+e.data['sliderContent'+i]+'[/slide]<br><br>';
										};

										editor.insertContent('[image_slider show_bullets="'+e.data.sliderBullets+'" show_arrows="'+e.data.sliderArrows+'" height="'+e.data.sliderHeight+'" speed="'+e.data.sliderSpeed+'" autoplay="'+e.data.sliderAutoplay+'" autospeed="'+e.data.sliderAutospeed+'" extra_class="'+e.data.sliderXclass+'" transition="'+e.data.sliderTransition+'"]<br><br>'+slides+'[/image_slider]');
										clicks = 0;
									}
								});
							}
						},
						{
							text: 'Image Carousel',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add Image Carousel',
									width: 620,
									height: 400,
									autoScroll: true,
									classes: 'scrollable-content',
									buttons: [
										{
											text: 'Insert',
											classes: 'widget btn primary',
											onclick: 'submit',
										},
										{
											text: 'Close',
											onclick: 'close'
										}
									],
									body: [
										{
											type: 'listbox',
											name: 'carInfinite',
											label: 'Infinite carousel',
											values: [
												{text: 'Yes', value: 'true'},
												{text: 'No', value: 'false'},
											],
										},
										{
											type: 'listbox',
											name: 'carBullets',
											label: 'Show Bullets',
											values: [
												{text: 'Yes', value: 'true'},
												{text: 'No', value: 'false'},
											],
										},
										{
											type: 'listbox',
											name: 'carArrows',
											label: 'Show Arrows',
											values: [
												{text: 'Yes', value: 'true'},
												{text: 'No', value: 'false'},
											],
										},
										{
											type: 'textbox',
											name: 'carSpeed',
											label: 'Speed',
											value: '800'
										},
										{
											type: 'listbox',
											name: 'carShow',
											label: 'Slides to Show',
											values: [
												{text: '1', value: '1'},
												{text: '2', value: '2'},
												{text: '3', value: '3'},
												{text: '4', value: '4'},
												{text: '5', value: '5'},
											],
											onPostRender: function() {
												this.value('4');
											},
										},
										{
											type: 'listbox',
											name: 'carScroll',
											label: 'Slides to Scroll',
											values: [
												{text: '1', value: '1'},
												{text: '2', value: '2'},
												{text: '3', value: '3'},
												{text: '4', value: '4'},
												{text: '5', value: '5'},
											],
											onPostRender: function() {
												this.value('1');
											},
										},
										{
											type: 'listbox',
											name: 'carAnimatedEntrance',
											label: 'Animated entrance',
											'values': [
												{text: 'Yes', value: 'yes'},
												{text: 'no', value: 'no'}
											],
											onPostRender: function() {
												this.value('yes');
											},
										},
										{
											type: 'textbox',
											name: 'carXclass',
											id: 'carXclass',
											label: 'Extra class',
											value: ''
										},
										{
											type: 'container',
											html: '<div class="mce-separator"></div>'
										},
										{
											type: 'button',
											name: 'carItems',
											id: 'carItems',
											classes: 'widget btn primary',
											text: 'Add Carousel Item',
											label: 'Add carousel items',
											onclick: function() {
												var win = editor.windowManager.getWindows()[0];
												var mainShortcode = win.find('#carXclass').parent();
												var btn = win.find('#carItems').parent();

												btnClick('carItems');

												btn.before({
													type: 'form',
													classes: 'form-insider',
													name: 'carouselItem',
													id: 'carouselItem'+clicks,
													items: [
														{
															type: 'container',
															html: '<h3 class="form-insider-title">Carousel Item '+clicks+'</h3>',
														},
														{
															type: 'textbox',
															label: 'Image Title',
															name: 'carImageTitle'+clicks,
															id: 'carImageTitle'+clicks,
															value: '',
														},
														// {
														// 	type: 'textbox',
														// 	label: 'Image url',
														// 	name: 'carImageUrl'+clicks,
														// 	id: 'carImageUrl'+clicks,
														// 	value: '',
														// },
														image_upload('Image url', 'carImageUrl'),
														{
															type: 'listbox',
															label: 'Enable Lightbox',
															name: 'carLightbox'+clicks,
															id: 'carLightbox'+clicks,
															'values': [
																{text: 'No', value: 'false'},
																{text: 'Yes', value: 'true'}
															],
															onPostRender: function() {
																this.value('false');
															},
															onselect: function() {
																if (this.value() == 'false') {
																	var win = editor.windowManager.getWindows()[0];
																	win.find('#carUrlLightbox'+clicks).disabled(true);
																	win.find('#carLink'+clicks).disabled(false);
																	win.find('#carLinkTarget'+clicks).disabled(false);
																} else if (this.value() == 'true') {
																	var win = editor.windowManager.getWindows()[0];
																	win.find('#carUrlLightbox'+clicks).disabled(false);
																	win.find('#carLink'+clicks).disabled(true);
																	win.find('#carLinkTarget'+clicks).disabled(true);
																}
															},
														},
														{
															type: 'textbox',
															label: 'Lightbox image',
															name: 'carUrlLightbox'+clicks,
															id: 'carUrlLightbox'+clicks,
															value: '',
														},
														{
															type: 'textbox',
															label: 'Image link',
															name: 'carLink'+clicks,
															id: 'carLink'+clicks,
															value: '',
														},
														{
															type: 'listbox',
															label: 'Link target',
															name: 'carLinkTarget'+clicks,
															id: 'carLinkTarget'+clicks,
															'values': [
																{text: 'Same window', value: 'self'},
																{text: 'Another window', value: 'blank'}
															],
															onPostRender: function() {
																this.value('self');
															}
														},
														{
															type: 'textbox',
															label: 'Image Alt',
															name: 'carAlt'+clicks,
															id: 'carAlt'+clicks,
															value: '',
														},
														{
															type: 'button',
															text: 'Remove Carousel Item',
															classes: 'widget btn remove',
															name: 'carRemove'+clicks,
															id: 'carRemove'+clicks,
															onclick: function(){
																var removable = this.parent();
																removable.remove();
																mainShortcode.parent().reflow();
																win.reflow();
															}
														},
													]
												});
												mainShortcode.parent().reflow();
												win.reflow();
											}
												
										},
									],
									onclose: function() {
										clicks = 0;
									},
									onsubmit: function( e ) {
										var items = editor.windowManager.getWindows()[0].find('#carouselItem');
										animated = (e.data['carAnimatedEntrance'] == "yes") ? ' animated="yes"' : ' animated="no"';
										images = '';

										for (var i = 1; i < items.length + 1; i++) {
											images += '[carousel_item'+animated+' name="'+e.data['carImageTitle'+i]+'" image="'+e.data['carImageUrl'+i]+'" lightbox="'+e.data['carLightbox'+i]+'" lightbox_src="'+e.data['carUrlLightbox'+i]+'" link="'+e.data['carLink'+i]+'" link_target="'+e.data['carLinkTarget'+i]+'" alt="'+e.data['carAlt'+i]+'" ]';
										};

										editor.insertContent('[carousel show_bullets="'+e.data.carBullets+'" show_arrows="'+e.data.carArrows+'" infinite="'+e.data.carInfinite+'" speed="'+e.data.carSpeed+'" slides_to_show="'+e.data.carShow+'" slides_to_scroll="'+e.data.carScroll+'" extra_class="'+e.data.carXclass+'"]'+images+'[/carousel]');
										clicks = 0;
									}
								});
							}
						},
						{
							text: 'Google Map',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add Google Map',
									width: 700,
									height: 400,
									autoScroll: true,
									classes: 'scrollable-content',
									buttons: [
										{
											text: 'Insert',
											classes: 'widget btn primary',
											onclick: 'submit'
										},
										{
											text: 'Close',
											onclick: 'close'
										}
									],
									body: [
										{
											type: 'textbox',
											name: 'mapID',
											label: 'Unique ID - no space, lowercase',
											value: 'mymap'
										},
										{
											type: 'listbox',
											name: 'mapType',
											label: 'Map type',
											'values': [
												{text: 'Roadmap', value: 'roadmap'},
												{text: 'Satellite', value: 'satellite'},
												{text: 'Terrain', value: 'terrain'},
												{text: 'Hybrid', value: 'hybrid'}
											]
										},
										{
											type: 'textbox',
											name: 'mapHeight',
											label: 'Map Height (width is 100%)',
											value: '400'
										},
										{
											type: 'textbox',
											name: 'mapZoom',
											label: 'Map Zoom (0-19)',
											value: '16'
										},
										{
											type: 'textbox',
											name: 'mapLatitude',
											label: 'Map Latitude',
											value: ''
										},
										{
											type: 'textbox',
											name: 'mapLongitude',
											label: 'Map Longitude',
											value: ''
										},
										{
											type: 'textbox',
											name: 'mapMessage',
											label: 'Pin Message',
											value: 'We are here!'
										},
										{
											type: 'textbox',
											name: 'mapHue',
											label: 'Map Hue (hex code)',
											value: '#579F6A'
										},
									],
									onsubmit: function( e ) {
										editor.insertContent( '[googlemap id="' + e.data.mapID + '" type="' + e.data.mapType + '" height="' + e.data.mapHeight + '" zoom="' + e.data.mapZoom + '" latitude="' + e.data.mapLatitude + '" longitude="' + e.data.mapLongitude + '" message="' + e.data.mapMessage + '" hue="' + e.data.mapHue + '" ]');
									}
								});
							}
						}
					]
				},
				{
					text: 'Add Section',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Add Section on page',
							width: 700,
							height: 400,
							autoScroll: true,
							classes: 'scrollable-content',
							buttons: [
								{
									text: 'Insert',
									classes: 'widget btn primary',
									onclick: 'submit'
								},
								{
									text: 'Close',
									onclick: 'close'
								}
							],
							body: [
								{
									type: 'container',
									html: '<h3 style="text-align: center; font-weight: bold; font-size: 16px;">Background settings</h3>',
								},
								{
									type: 'fieldset',
									name: 'sectionBgs',
									style: 'border-color: #CCC;',
									items: [
										image_upload('Background image', 'sectionBgImage'),
										{
											type: 'textbox',
											name: 'sectionBgColor',
											label: 'Background Color',
											value: '#fff'
										},
										{
											type: 'listbox',
											name: 'sectionBgRepeat',
											label: 'Background repeat',
											'values': [
												{text: 'no-repeat', value: 'no-repeat'},
												{text: 'repeat', value: 'repeat'},
												{text: 'repeat-x', value: 'repeat-x'},
												{text: 'repeat-y', value: 'repeat-y'}
											],
											onPostRender: function() {
												this.value('no-repeat');
											},
										},
										{
											type: 'listbox',
											name: 'sectionBgAttachment',
											label: 'Background attachment',
											'values': [
												{text: 'scroll', value: 'scroll'},
												{text: 'fixed', value: 'fixed'}
											],
											onPostRender: function() {
												this.value('scroll');
											},
										},
										{
											type: 'listbox',
											label: 'Background position',
											name: 'sectionBgPosition',
											id: 'sectionBgPosition',
											'values': [
												{text: 'Left Top', value: 'left top'},
												{text: 'Left Center', value: 'left center'},
												{text: 'Left Bottom', value: 'left bottom'},
												{text: 'Right Top', value: 'right top'},
												{text: 'Right Center', value: 'right center'},
												{text: 'Right Bottom', value: 'right bottom'},
												{text: 'Center Top', value: 'center top'},
												{text: 'Center Center', value: 'center center'},
												{text: 'Center Bottom', value: 'center bottom'}
											],
											onPostRender: function() {
												this.value('center top');
											},
										},
										{
											type: 'listbox',
											name: 'sectionBgSize',
											label: 'Background size',
											'values': [
												{text: 'auto', value: 'auto'},
												{text: 'cover', value: 'cover'}
											],
											onPostRender: function() {
												this.value('cover');
											},
										},
										{
											type: 'checkbox',
											name: 'sectionParallax',
											label: 'Parallax',
											tooltip: 'This option will activate the parallax effect on background image',
											value: ''
										},
									]
								},
								{
									type: 'container',
									html: '<h3 style="text-align: center; font-weight: bold; font-size: 16px; padding-top: 10px;">Content settings</h3>',
								},
								{
									type: 'fieldset',
									name: 'sectionContent',
									style: 'border-color: #CCC;',
									items: [
										{
											type: 'checkbox',
											name: 'sectionRemoveContainer',
											label: 'Remove container',
											tooltip: 'This option will make the section content full-width',
											value: ''
										},
										{
											type: 'textbox',
											name: 'sectionContentColor',
											label: 'Content color',
											value: '#000',
										},
									]
								},
								{
									type: 'container',
									html: '<h3 style="text-align: center; font-weight: bold; font-size: 16px; padding-top: 10px;">Padding settings</h3>',
								},
								{
									type: 'fieldset',
									name: 'sectionPadding',
									style: 'border-color: #CCC;',
									items: [
										{
											type: 'textbox',
											name: 'sectionPT',
											label: 'Padding top',
											tooltip: 'Only number without px',
											value: '90'
										},
										{
											type: 'textbox',
											name: 'sectionPB',
											label: 'Padding bottom',
											tooltip: 'Only number without px',
											value: '90'
										},
									]
								},
								{
									type: 'container',
									html: '<h3 style="text-align: center; font-weight: bold; font-size: 16px; padding-top: 10px;">Overlay settings</h3>',
								},
								{
									type: 'fieldset',
									name: 'sectionOverlay',
									style: 'border-color: #CCC;',
									items: [
										{
											type: 'listbox',
											label: 'Activate Overlay',
											name: 'sectionOv',
											id: 'sectionOv',
											'values': [
												{text: 'No', value: 'false'},
												{text: 'Yes', value: 'true'}
											],
											onPostRender: function() {
												this.value('false');
											},
											onselect: function() {
												if (this.value() == 'false') {
													var win = editor.windowManager.getWindows()[0];
													win.find('#sectionOvColor').disabled(true);
													win.find('#sectionOvOpacity').disabled(true);
												} else if (this.value() == 'true') {
													var win = editor.windowManager.getWindows()[0];
													win.find('#sectionOvColor').disabled(false);
													win.find('#sectionOvOpacity').disabled(false);
												}
											},
										},
										{
											type: 'textbox',
											name: 'sectionOvColor',
											id: 'sectionOvColor',
											label: 'Overlay Color',
											value: '',
											onPostRender: function() {
												this.disabled(true);
											},
										},
										{
											type: 'listbox',
											label: 'Overlay Opacity',
											name: 'sectionOvOpacity',
											id: 'sectionOvOpacity',
											'values': [
												{text: '0.1', value: '0.1'},
												{text: '0.2', value: '0.2'},
												{text: '0.3', value: '0.3'},
												{text: '0.4', value: '0.4'},
												{text: '0.5', value: '0.5'},
												{text: '0.6', value: '0.6'},
												{text: '0.7', value: '0.7'},
												{text: '0.8', value: '0.8'},
												{text: '0.9', value: '0.9'},
												{text: '1', value: '1'},
											],
											onPostRender: function() {
												this.value('0.5').disabled(true);
											},
										},
									]
								},
								{
									type: 'spacer',
									style: 'height: 20px;'
								},
								{
									type: 'textbox',
									name: 'sectionID',
									label: 'Section ID',
									value: ''
								},
							],
							onsubmit: function( e ) {
								if (e.data.sectionRemoveContainer == true) { var remContainer = "true" } else { var remContainer = "false"};
								if (e.data.sectionParallax == true) { var prlx = "true" } else { var prlx = "false"};
								editor.insertContent( '[cf_section id="' + e.data.sectionID + '" background_image="' + e.data.sectionBgImage + '" background_color="' + e.data.sectionBgColor + '" background_repeat="' + e.data.sectionBgRepeat + '" background_attachment="' + e.data.sectionBgAttachment + '" background_position="' + e.data.sectionBgPosition + '" background_size="' + e.data.sectionBgSize + '" fullwidth_content="' + remContainer + '" content_color="' + e.data.sectionContentColor + '" parallax="' + prlx + '" padding_top="' + e.data.sectionPT + '" padding_bottom="' + e.data.sectionPB + '" overlay_color="' + e.data.sectionOvColor + '" overlay_opacity="' + e.data.sectionOvOpacity + '" ]<br><br>Here goes the section content<br><br>[/cf_section]');
							}
						});
					}
				}
			]
		});
	});
})(jQuery);