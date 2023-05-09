//{block name="backend/payment/controller/payment"}
Ext.define('Shopware.apps.EcomprocessingPaymentMethods.controller.EcomprocessingPaymentMethods', {
    /**
     * Override payment Controller
     */
    override: 'Shopware.apps.Payment.controller.Payment',

    onItemClick: function(view, record) {
        var me = this
        win = view.up('window')
        tabPanel = win.tabPanel
        form = win.generalForm
        ecomprocessingCheckoutForm = win.ecomprocessingCheckoutForm
        ecomprocessingTab = win.ecomprocessingCheckoutForm.up('container').tab;

        ecomprocessingTab.hide();
        form.getForm().findField('name').enable();

        if (record.data.name === 'ecomprocessing_checkout') {
            ecomprocessingTab.show();
            form.getForm().findField('name').disable();
            ecomprocessingCheckoutForm.hide();
        }

        if (record.data.name === 'ecomprocessing_checkout') {
            ecomprocessingCheckoutForm.show();
            ecomprocessingCheckoutForm.disable();
            var checkoutStore = me.getEcpConfigStore('checkout');
            checkoutStore.on('load', function () {
                me.normalizeTransactionTypes(checkoutStore);
                me.normalizeBankCodes(checkoutStore);
                ecomprocessingCheckoutForm.loadRecord(checkoutStore.getAt(0));
                ecomprocessingCheckoutForm.enable();
            });
        }

        me.callParent(arguments);
    },

    onSavePayment: function (generalForm, countryGrid, subShopGrid, surchargeGrid) {
        var me = this
            win = generalForm.up('window');

        var ecomprocessingPanel = null;
        switch (generalForm.getRecord().raw.name) {
            case 'ecomprocessing_checkout':
                ecomprocessingPanel = win.ecomprocessingCheckoutForm;
                break;
        }

        if (ecomprocessingPanel && ecomprocessingPanel.rendered) {
            if (!ecomprocessingPanel.form.isValid()) {
                Shopware.Notification.createGrowlMessage(
                    '{s name="ecomprocessing/config/form/title_failure"}Failure{/s}',
                    generalForm.getRecord().raw.description +
                    '{s name="ecomprocessing/config/form/invalid_form"} can not be saved. Invalid form data.{/s}',
                    'ecomprocessing'
                );
            }

            if (ecomprocessingPanel.form.isValid()) {
                ecomprocessingPanel.submit({
                    url: 'EcomprocessingMethodConfigs/saveConfig',
                    method: 'POST',
                    success: function(form, action) {
                        // No action for success callback
                        // Shopware shows message
                    },
                    failure: function(form, action) {
                        var message = generalForm.getRecord().raw.description +
                            '{s name="ecomprocessing/config/form/error_save"} error during form save.{/s} '
                            + action.result.message;
                        Shopware.Notification.createGrowlMessage(
                            '{s name="ecomprocessing/config/form/title_failure"}Failure{/s}',
                            message,
                            'ecomprocessing'
                        );
                    }
                });
            }
        }

        me.callParent(arguments);
    },

    getEcpConfigStore: function (method) {
        return Ext.create('Shopware.apps.EcomprocessingPaymentMethods.store.EcomprocessingConfigStore').load({
            params: {
                method: method
            }
        });
    },

    normalizeTransactionTypes: function (store) {
        store.each(function(record, index){
            var types = record.get('transaction_types');
            record.set('transaction_types[]', types);
            record.commit();
        });
    },

    normalizeBankCodes: function (store) {
        store.each(function(record, index){
            var types = record.get('bank_codes');
            record.set('bank_codes[]', types);
            record.commit();
        });
    },
});
//{/block}
