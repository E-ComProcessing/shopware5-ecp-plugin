// Ecomprocessing Checkout Language Store




Ext.define('Shopware.apps.EcomprocessingPaymentMethods.store.EcomprocessingCheckoutLanguagesStore', {
    extend: 'Ext.data.Store',

    fields: [
        { name: 'option', type: 'string' },
        { name: 'value', type: 'string' }
    ],
    autoLoad: false,
    remoteSort: true,

    proxy: {
        type: 'ajax',
        url: 'ConfigCheckoutLanguages/listLanguages',
        reader: {
            type: 'json',
            root: 'data'
        }
    }
});
