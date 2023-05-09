// This tab will be shown in the Payment module



Ext.define('Shopware.apps.EcomprocessingPaymentMethods.view.detail.EcomprocessingCheckoutForm', {
    extend: 'Ext.form.Panel',
    title: 'ecomprocessing Checkout Config',
    autoShow: false,
    alias : 'widget.ecomprocessing-payment-checkout-formpanel',
    region: 'center',
    layout: 'anchor',
    autoScroll: true,
    bodyPadding: '10px',
    name:  'ecomprocessing-checkout-formpanel',
    preventHeader: true,
    border: 0,
    defaults:{
        labelStyle:'font-weight: 700; text-align: right;',
        labelWidth:130,
        anchor:'100%'
    },
    autoSync: true,

    initComponent: function () {
        var me = this;

        this.ecomprocessingFieldset = Ext.create('Ext.form.FieldSet', {
            title: '{s name="ecomprocessing/config/checkout/form_title"}ecomprocessing Checkout Config{/s}',
            anchor: '100%',
            defaults: {
                anchor: '100%',
                labelWidth: 155
            },
            items: this.getCheckoutItems(),
        });

        me.items  =  [ this.ecomprocessingFieldset ];

        me.callParent(arguments);
    },

    getCheckoutItems: function () {
        return [
            {
                xtype: 'combobox',
                fieldLabel: '{s name="ecomprocessing/config/checkout/test_mode"}Test Mode{/s}',
                name: 'test_mode',
                translatable: false,
                store: Ext.create('Shopware.apps.EcomprocessingPaymentMethods.store.EcomprocessingTestModeStore'),
                displayField: 'option',
                valueField: 'value',
                value: 'no',
                allowBlank: false
        },
            {
                xtype: 'textfield',
                fieldLabel: '{s name="ecomprocessing/config/checkout/username"}Username{/s}',
                name: 'username',
                translatable: false,
                allowBlank: false
        },
            {
                xtype: 'textfield',
                fieldLabel: '{s name="ecomprocessing/config/checkout/password"}Password{/s}',
                name: 'password',
                translatable: false,
                allowBlank: false
        },
            {
                xtype: 'combobox',
                fieldLabel: '{s name="ecomprocessing/config/checkout/transaction_types"}Transaction Types{/s}',
                name: 'transaction_types[]',
                translatable: false,
                store: Ext.create('Shopware.apps.EcomprocessingPaymentMethods.store.EcomprocessingCheckoutTransactionTypesStore').load(),
                displayField: 'option',
                valueField: 'value',
                value: [ 'sale', 'authorize', 'sale3d', 'authorize3d' ],
                multiSelect: true,
                allowBlank: false
        },
            {
                xtype: 'combobox',
                getSubmitValue: function () {
                    let value = this.getValue();
                    if (Ext.isEmpty(value)) {
                        return '';
                    }
                    return value;
                },
                fieldLabel: '{s name="ecomprocessing/config/checkout/bank_codes"}Bank codes for Online banking{/s}',
                name: 'bank_codes[]',
                translatable: false,
                store: Ext.create('Shopware.apps.EcomprocessingPaymentMethods.store.EcomprocessingCheckoutBankCodesStore').load(),
                displayField: 'option',
                valueField: 'value',
                value: [],
                multiSelect: true,
                allowBlank: true
        },
            {
                xtype: 'combobox',
                fieldLabel: '{s name="ecomprocessing/config/checkount/checkout_language"}Checkout Language{/s}',
                name: 'checkout_language',
                translatable: false,
                store: Ext.create('Shopware.apps.EcomprocessingPaymentMethods.store.EcomprocessingCheckoutLanguagesStore').load(),
                displayField: 'option',
                valueField: 'value',
                value: 'en',
                allowBlank: false
        },
            {
                xtype: 'combobox',
                fieldLabel: '{s name="ecomprocessing/config/checkout/wpf_tokenization"}WPF Tokenization{/s}',
                name: 'wpf_tokenization',
                translatable: false,
                store: Ext.create('Shopware.apps.EcomprocessingPaymentMethods.store.EcomprocessingWPFTokenizationStore'),
                displayField: 'option',
                valueField: 'value',
                value: 'no',
                allowBlank: false
        },
            {
                xtype: 'combobox',
                fieldLabel: '{s name="ecomprocessing/config/checkout/threeds_option"}3DSv2{/s}',
                name: 'threeds_option',
                translatable: false,
                store: Ext.create('Shopware.apps.EcomprocessingPaymentMethods.store.EcomprocessingCheckoutThreedsOptionStore'),
                displayField: 'option',
                valueField: 'value',
                value: 'yes',
                allowBlank: false
        },
            {
                xtype: 'combobox',
                fieldLabel: '{s name="ecomprocessing/config/checkout/challenge_indicator"}Challenge Indicator{/s}',
                name: 'challenge_indicator',
                translatable: false,
                store: Ext.create('Shopware.apps.EcomprocessingPaymentMethods.store.EcomprocessingCheckoutChallengeIndicatorOptionStore'),
                displayField: 'option',
                valueField: 'value',
                value: 'no_preference',
                allowBlank: false
        },
            {
                xtype: 'combobox',
                fieldLabel: '{s name="ecomprocessing/config/checkout/sca_exemption_option"}SCA Exemption option{/s}',
                name: 'sca_exemption_option',
                translatable: false,
                store: Ext.create('Shopware.apps.EcomprocessingPaymentMethods.store.EcomprocessingCheckoutScaExemptionOptionStore'),
                displayField: 'option',
                valueField: 'value',
                value: 'low_risk',
                allowBlank: false
        },
            {
                xtype: 'numberfield',
                fieldLabel: '{s name="ecomprocessing/config/checkout/sca_exemption_amount"}SCA Exemption amount{/s}',
                name: 'sca_exemption_amount',
                translatable: false,
                store: Ext.create('Shopware.apps.EcomprocessingPaymentMethods.store.EcomprocessingCheckoutScaExemptionAmountStore'),
                minValue: 0,
                value: 100,
                allowBlank: true
        },
            {
                xtype: 'hiddenfield',
                name: 'method',
                value: 'checkout'
        }
        ];
    }
});
