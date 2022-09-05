// E-Comprocessing Store mode




Ext.define('Shopware.apps.EcomprocessingPaymentMethods.store.EcomprocessingTestModeStore', {
    extend: 'Ext.data.Store',

    fields: [
        { name: 'option', type: 'string' },
        { name: 'value', type: 'string' }
    ],

    data: [
        { option: "{s name=ecomprocessing/config/test_mode_yes}Yes{/s}", value: 'yes' },
        { option: "{s name=ecomprocessing/config/test_mode_no}No{/s}", value: 'no' }
    ]
});
