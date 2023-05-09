// Ecomprocessing SCA Exemption option amount




Ext.define('Shopware.apps.EcomprocessingPaymentMethods.store.EcomprocessingCheckoutScaExemptionAmountStore', {
    extend: 'Ext.data.Store',

    fields: [
        { name: 'option', type: 'string' },
        { name: 'value', type: 'int' }
    ]
});
