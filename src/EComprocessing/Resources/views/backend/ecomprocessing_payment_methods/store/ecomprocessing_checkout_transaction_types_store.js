// E-Comprocessing Checkout Transaction Types Store




Ext.define('Shopware.apps.EcomprocessingPaymentMethods.store.EcomprocessingCheckoutTransactionTypesStore', {
    extend: 'Ext.data.Store',

    fields: [
        { name: 'option', type: 'string' },
        { name: 'value', type: 'string' }
    ],
    autoLoad: false,
    remoteSort: true,

    proxy: {
        type: 'ajax',
        url: 'ConfigCheckoutTypes/listTypes',
        reader: {
            type: 'json',
            root: 'data'
        }
    }
});
