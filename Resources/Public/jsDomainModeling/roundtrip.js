var roundtrip = {
		debugMode			:	false,
		renderFieldHook 	:	function(input){
									if(input.inputParams.name == 'uid' && typeof input.inputParams.value == 'undefined'){
										input.inputParams.value = this.createUniqueId();
									}
									return input;
								}
							
		,addFieldSetHook	:	function(fieldset){
									// add unique ids to inputs to track changed values
									this.addFieldsetClass(Ext.get(fieldset.divEl).child('select').dom)
									if(typeof fieldset['inputs'] !='undefined'){
										for(i = 0;i <  fieldset['inputs'].length;i++){
											fieldName =  fieldset['inputs'][i]['options']['name'];
											
											if (fieldName == 'relationName' || fieldName == 'propertyName') {
												fieldset['inputs'][i].setValue('');
											}
											else if (fieldName == 'uid') {
												fieldset['inputs'][i].setValue(this.createUniqueId());
											}
										}
									}
								}
									
		,createUniqueId		:	function(){
									var d = new Date;
									return parseInt(d.getTime() * Math.random());
								}
		
		,updateEvtListener	:	function(params){
									if(typeof params[0] != 'object'){
										if(params[1].options && params[1].options.name == 'propertyType') {
											this.addFieldsetClass(params[1].el);
										}
									}
								}
		,addFieldsetClass	:	function(selectElement) {
									// add the selected property type as classname to the parent fieldset
									// this enables show/hide of property type specific fields
									var parentFieldset = Ext.get(selectElement).up('fieldset');
									parentFieldset.dom.removeAttribute('class');
									parentFieldset.addClass(selectElement.getValue());
								}
		,onAddWire			:	function(e, params, terminal){
									var uid1 = this.getUidForTerminal(params[0].terminal1);
									var uid2 = this.getUidForTerminal(params[0].terminal2);

									this._debug('Wire added');
									if(Ext.get(params[0].terminal2.el).getAttribute('title') == 'SOURCES'){
										var moduleUID =  uid1;
										this._debug('45 moduleUID: ' + moduleUID);
										var relationUID = uid2
										this._debug('47 relationUID: ' + relationUID);
									}
									else {
										var moduleUID =  uid2
										this._debug('51 moduleUID: ' + moduleUID);
										var relationUID = uid1
										this._debug('53 relationUID: ' + relationUID);
									}
								}
		
		,onRemoveWire			:	function(e, params, terminal){
										var t1 = Ext.get(params[0].terminal1.el);
										var t2 = Ext.get(params[0].terminal2.el);
										this._debug(this.getUidForTerminal(params[0].terminal1));
										this._debug(this.getUidForTerminal(params[0].terminal2));
										this._debug('Wire removed');
										if(t1.getAttribute('title') == 'SOURCES'){
											var moduleUID =  t2.findParent("fieldset",10,true).query('div.hiddenField input')[0].value;
											this._debug('moduleUID: ' + moduleUID);
											var relationUID = t1.parent().query('div.hiddenField input')[0].value;
											this._debug('relationUID: ' + relationUID);
										}
										else {
											var moduleUID =  t1.findParent("fieldset",10,true).query('div.hiddenField input')[0].value;
											this._debug('moduleUID: ' + moduleUID);
											var relationUID = t2.parent().query('div.hiddenField input')[0].value;
											this._debug('relationUID: ' + relationUID);
										}
									}
		,onFieldRendered		:	function(fieldId){
										//console.log('onFieldRendered called: ' + fieldId);
										var l = Ext.get(
											Ext.query('div#' + fieldId + '-label label')
										);
										if(l && Ext.query('div#' + fieldId + '-desc').length){
											l.addListener(
												"mouseover",
												function(ev,target){
													roundtrip.showHelp(target,true);
												}
											);
											l.addListener(
													"mouseout",
													function(ev,target){
														roundtrip.showHelp(target,false);
													}
												);
											l.parent().addClass('helpAvailable');
										}
									}
		,getUidForTerminal		:	function(terminal){
										var t = Ext.get(terminal.el);
										if(t.getAttribute('title') == 'SOURCES'){
											return t.parent().query('div.hiddenField input')[0].value;
										}
										else {
											return t.findParent("fieldset",10,true).query('div.hiddenField input')[0].value;
										}
		}
		,showHelp				:	function(targetEl,show){
										var descriptionElement = Ext.get(targetEl.parentNode.id.replace('label','desc'));
										if(descriptionElement && descriptionElement.dom.innerHTML.length){
											if(show){
												descriptionElement.show();
											}
											else {
												descriptionElement.hide();
											}
										}
									}
		,advancedMode			:	false
		,toggleAdvancedMode	:	function() {
										if (!this.advancedMode) {
											$('domainModelEditor').addClassName('showAdvancedOptions');
											Ext.query('#toggleAdvancedOptions .simpleMode')[0].style.display = 'none';
											Ext.query('#toggleAdvancedOptions .advancedMode')[0].style.display = 'inline';
											this.advancedMode = true;
										} else {
											$('domainModelEditor').removeClassName('showAdvancedOptions');
											Ext.query('#toggleAdvancedOptions .simpleMode')[0].style.display = 'inline';
											Ext.query('#toggleAdvancedOptions .advancedMode')[0].style.display = 'none';
											this.advancedMode = false;
										}
										return false;
									}
		,_debug					:	function(o){
										if(!this.debugMode){
											return;
										}
										if(typeof console != 'undefined' && typeof console.log == 'function'){
											console.log(o);
										}
									}
		,onModuleLoaded	: 			function() {
										// set the fieldset class depending on the selected property type
										var propertyTypeSelects = Ext.query('.propertyGroup select');
										var self = this;
										if(propertyTypeSelects) {
											propertyTypeSelects.each(function(el) {
												self.addFieldsetClass(el);
											});
										}

									}
}

var versionMap = {
    '6.0' : '6.0'
}

Ext.onReady(
    function() {
        Ext.get(Ext.query('select[name=targetVersion]')[0]).addListener(
            "change",
            function(ev,target){
                var updatedDependencies = '';
                var dependencies = Ext.query('textarea[name=dependsOn]')[0].value.split("\n");
                for(i=0;i<dependencies.length;i++) {
                    parts = dependencies[i].split('=>');
                    if(parts.length==2) {
                        updatedDependencies += parts[0] + '=> ' + target.value + "\n";
                    }

                }
                Ext.query('textarea[name=dependsOn]')[0].value = updatedDependencies;
            }
         );
		Ext.get(Ext.query('body')[0]).addClass('yui-skin-sam');

		Ext.get('toggleAdvancedOptions').addListener(
			"click",
			function(ev,target){
				roundtrip.toggleAdvancedMode();
				return false;
			}
		);

    }
);