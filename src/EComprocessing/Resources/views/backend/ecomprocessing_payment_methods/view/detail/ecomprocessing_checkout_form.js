// This tab will be shown in the Payment module



Ext.define('Shopware.apps.EcomprocessingPaymentMethods.view.detail.EcomprocessingCheckoutForm', {
    extend: 'Ext.form.Panel',
    title: 'E-Comprocessing Checkout Config',
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

    initComponent: function() {
        var me = this;

        this.ecomprocessingFieldset = Ext.create('Ext.form.FieldSet', {
            title: '{s name="ecomprocessing/config/checkout/form_title"}E-Comprocessing Checkout Config{/s}',
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

    getCheckoutItems: function() {
        return [
            {
                xtype: 'combobox',
                fieldLabel: '{s name=ecomprocessing/config/checkout/test_mode}Test Mode{/s}',
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
                fieldLabel: '{s name=ecomprocessing/config/checkout/username}Username{/s}',
                name: 'username',
                translatable: false,
                allowBlank: false
            },
            {
                xtype: 'textfield',
                fieldLabel: '{s name=ecomprocessing/config/checkout/password}Password{/s}',
                name: 'password',
                translatable: false,
                allowBlank: false
            },
            {
                xtype: 'combobox',
                fieldLabel: '{s name=ecomprocessing/config/checkout/transaction_types}Transaction Types{/s}',
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
                fieldLabel: '{s name=ecomprocessing/config/checkount/checkout_language}Checkout Language{/s}',
                name: 'checkout_language',
                translatable: false,
                store: Ext.create('Shopware.apps.EcomprocessingPaymentMethods.store.EcomprocessingCheckoutLanguagesStore').load(),
                displayField: 'option',
                valueField: 'value',
                value: 'en',
                allowBlank: false
            },
            {
                xtype: 'hiddenfield',
                name: 'method',
                value: 'checkout'
            }
        ];
    }
});
