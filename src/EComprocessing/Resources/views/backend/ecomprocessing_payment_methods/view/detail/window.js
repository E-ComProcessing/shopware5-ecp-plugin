//{block name="backend/payment/view/main/window"}
// {$smarty.block.parent}
Ext.define('Shopware.apps.EcomprocessingPaymentMethods.view.detail.Window', {
    /**
     * Override the Payment main View
     * @string
     */
    override: 'Shopware.apps.Payment.view.main.Window',

    createTabPanel: function() {
        var me = this,
            result = me.callParent();

        var snippets = {

        };

        me.ecomprocessingCheckoutForm = Ext.create('Shopware.apps.EcomprocessingPaymentMethods.view.detail.EcomprocessingCheckoutForm');
        me.ecomprocessingDirectForm = Ext.create('Shopware.apps.EcomprocessingPaymentMethods.view.detail.EcomprocessingDirectForm');

        result.add([{
            xtype: 'container',
            autoRender: true,
            title: '{s name=ecomprocessing/config/title}ecomprocessing Config{/s}',
            name: 'ecomprocessing-config',
            hidden: true,
            layout: 'fit',
            region: 'center',
            autoScroll: true,
            border: 0,
            bodyBorder: false,
            defaults: {
                layout: 'fit'
            },
            items: [me.ecomprocessingCheckoutForm, me.ecomprocessingDirectForm]
        }]);

        return result;
    }
});
//{/block}
