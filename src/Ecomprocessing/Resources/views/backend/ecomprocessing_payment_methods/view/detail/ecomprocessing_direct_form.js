// This tab will be shown in the Payment module



Ext.define('Shopware.apps.EcomprocessingPaymentMethods.view.detail.EcomprocessingDirectForm', {
    extend: 'Ext.form.Panel',
    title: 'E-Comprocessing Direct Config',
    autoShow: false,
    alias : 'widget.ecomprocessing-payment-direct-formpanel',
    region: 'center',
    layout: 'anchor',
    autoScroll: true,
    bodyPadding: '10px',
    name:  'ecomprocessing-direct-formpanel',
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
            title: '{s name="ecomprocessing/config/direct/form_title"}E-Comprocessing Direct Config{/s}',
            anchor: '100%',
            defaults: {
                anchor: '100%',
                labelWidth: 155
            },
            items: this.getDirectItems()
        });

        me.items  =  [ this.ecomprocessingFieldset ];

        me.callParent(arguments);
    },

    getDirectItems: function() {
        return [
            {
                xtype: 'combobox',
                fieldLabel: '{s name=ecomprocessing/config/direct/test_mode}Test Mode{/s}',
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
                fieldLabel: '{s name=ecomprocessing/config/direct/username}Username{/s}',
                name: 'username',
                translatable: false,
                allowBlank: false
            },
            {
                xtype: 'textfield',
                fieldLabel: '{s name=ecomprocessing/config/direct/password}Password{/s}',
                name: 'password',
                translatable: false,
                allowBlank: false
            },
            {
                xtype: 'textfield',
                fieldLabel: '{s name=ecomprocessing/config/direct/token}Token{/s}',
                name: 'token',
                translatable: false,
                allowBlank: false
            },
            {
                xtype: 'combobox',
                fieldLabel: '{s name=ecomprocessing/config/direct/transaction_type}Transaction Type{/s}',
                name: 'transaction_types[]',
                translatable: false,
                store: Ext.create('Shopware.apps.EcomprocessingPaymentMethods.store.EcomprocessingDirectTransactionTypesStore').load(),
                displayField: 'option',
                valueField: 'value',
                value: ['sale'],
                allowBlank: false
            },
            {
                xtype: 'hiddenfield',
                name: 'method',
                value: 'direct'
            }
        ];
    }
});
