// E-Comprocessing Direct Transaction Types Store




Ext.define('Shopware.apps.EcomprocessingPaymentMethods.store.EcomprocessingDirectTransactionTypesStore', {
    extend: 'Ext.data.Store',

    fields: [
        { name: 'option', type: 'string' },
        { name: 'value', type: 'string' }
    ],
    autoLoad: false,
    remoteSort: true,

    proxy: {
        type: 'ajax',
        url: 'ConfigDirectTypes/listTypes',
        reader: {
            type: 'json',
            root: 'data'
        }
    }
});
