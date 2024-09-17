{"version":3,"sources":["product-list.js"],"names":["BX","namespace","Crm","EntityProductListController","superclass","constructor","apply","this","productList","currencyId","_isManualOpportunity","_prevProductCount","_curProductCount","_editorModeChangeHandler","onEditorModeChange","bind","_editorControlChangeHandler","onEditorControlChange","extend","UI","EntityEditorController","prototype","doInitialize","Currency","setCurrencies","prop","getArray","_config","addCustomEvent","window","handleSetProductList","onTabShow","delegate","onEntityProgressSave","detailsProductRowSummaryLinkClickHandler","onCustomEvent","setTimeout","_editor","addModeChangeListener","_currencyId","_model","getField","opportunityControl","getOpportunityControl","addChangeAmountEditModeListener","onchangeAmountEditMode","getCurrencyId","tab","getId","handleOnTabShow","sender","data","semantic","getString","reinitializeProductList","event","getData","setProductList","notifyOpportunityControl","getProductListId","getConfigStringParam","reloadGrid","getProductList","destroy","setController","setForm","getFormElement","changeCurrencyId","getProductCount","adjustLocks","clearProductList","onAfterSave","_manualOpportunityHiddenInput","Dom","remove","removeFormFields","onBeforeSubmit","form","isManualOpportunity","findChild","tagName","attr","name","create","attrs","type","value","appendChild","isChanged","isNew","compileProductData","changeSumTotal","totals","needMarkAsChanged","enableSaveButton","adjustTotals","validate","validateSubmit","_toolPanel","disableSaveButton","productAdd","productChange","markAsChanged","productRemove","changeOffer","innerCancel","getManualOpportunityValue","popup","EditorAuxiliaryDialog","getById","close","title","messages","manualOpportunityChangeModeTitle","content","manualOpportunityChangeModeText","zIndex","overlay","buttons","id","DialogButtonType","accept","text","manualOpportunityChangeModeYes","callback","getDialog","setManualOpportunity","doAdjustTotals","cancel","manualOpportunityChangeModeNo","open","setField","currencyFormat","totalCost","enableNotification","getControlByIdRecursive","EntityEditorMoney","setHasRelatedProducts","doAdjustLocks","wasProductsInitiated","lockField","unlockField","rollback","_isChanged","getMode","EntityEditorMode","edit","addControlChangeListener","removeControlChangeListener","params","field","isManual","isItemOpened","manualOpportunityConfirmationTitle","manualOpportunityConfirmationText","manualOpportunityConfirmationYes","manualOpportunityConfirmationNo","actionUpdateTotalData","settings","self","initialize"],"mappings":"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","file":"product-list.map.js"}