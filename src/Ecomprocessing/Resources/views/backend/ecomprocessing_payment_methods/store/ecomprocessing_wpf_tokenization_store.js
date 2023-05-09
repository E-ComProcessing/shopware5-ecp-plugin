// Ecomprocessing WPF Tokenization




Ext.define('Shopware.apps.EcomprocessingPaymentMethods.store.EcomprocessingWPFTokenizationStore', {
    extend: 'Ext.data.Store',

    fields: [
        { name: 'option', type: 'string' },
        { name: 'value', type: 'string' }
    ],

    data: [
        { option: '{s name="ecomprocessing/config/wpf_tonkenization_yes"}Yes{/s}', value: 'yes' },
        { option: '{s name="ecomprocessing/config/wpf_tonkenization_no"}No{/s}', value: 'no' }
    ]
});
