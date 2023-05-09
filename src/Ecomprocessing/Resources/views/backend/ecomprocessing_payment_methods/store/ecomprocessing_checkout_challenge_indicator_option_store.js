// Ecomprocessing Threeds Option




Ext.define('Shopware.apps.EcomprocessingPaymentMethods.store.EcomprocessingCheckoutChallengeIndicatorOptionStore', {
    extend: 'Ext.data.Store',

    fields: [
        { name: 'option', type: 'string' },
        { name: 'value', type: 'string' }
    ],

    data: [
        { option: '{s name="ecomprocessing/config/challenge_indicator_option_no_preference"}No Preference{/s}', value: 'no_preference' },
        { option: '{s name="ecomprocessing/config/challenge_indicator_option_no_challenge_requested"}No challenge requested{/s}', value: 'no_challenge_requested' },
        { option: '{s name="ecomprocessing/config/challenge_indicator_option_preference"}Preference{/s}', value: 'preference' },
        { option: '{s name="ecomprocessing/config/challenge_indicator_option_mandate"}Mandate{/s}', value: 'mandate' }
    ]
});
