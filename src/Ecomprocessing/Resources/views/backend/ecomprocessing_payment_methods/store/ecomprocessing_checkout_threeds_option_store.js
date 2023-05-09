// Ecomprocessing Threeds Option




Ext.define('Shopware.apps.EcomprocessingPaymentMethods.store.EcomprocessingCheckoutThreedsOptionStore', {
    extend: 'Ext.data.Store',

    fields: [
        { name: 'option', type: 'string' },
        { name: 'value', type: 'string' }
    ],

    data: [
        { option: '{s name="ecomprocessing/config/threeds_option_yes"}Yes{/s}', value: 'yes' },
        { option: '{s name="ecomprocessing/config/threeds_option_no"}No{/s}', value: 'no' }
    ]
});
