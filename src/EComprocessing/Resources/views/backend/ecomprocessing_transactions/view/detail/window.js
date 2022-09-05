//{block name="backend/order/view/detail/window"}
// {$smarty.block.parent}
Ext.define('Shopware.apps.EcomprocessingTransactions.view.detail.Window', {
    /**
     * Override the Order detail window
     * @string
     */
    override: 'Shopware.apps.Order.view.detail.Window',

    createTabPanel: function() {
        var me = this,
            result = me.callParent();

        var snippets = {
            columns: {
                id: '{s name="ecomprocessing/detail/id"}Id{/s}',
                transactionId: '{s name=ecomprocessing/detail/transaction_id}Transaction Id{/s}',
                uniqueId: '{s name=ecomprocessing/detail/unique_id}Unique Id{/s}',
                status: '{s name=ecomprocessing/detail/status}Status{/s}',
                type: '{s name=ecomprocessing/detail/type}Type{/s}',
                mode: '{s name=ecomprocessing/detail/mode}Mode{/s}',
                amount: '{s name=ecomprocessing/detail/amount}Amount{/s}',
                currency: '{s name=ecomprocessing/detail/currency}Currency{/s}',
                message: '{s name=ecomprocessing/detail/message}Message{/s}',
                createdAt: '{s name=ecomprocessing/detail/created_at}Created At{/s}',
                updatedAt: '{s name="ecomprocessing/detail/updated_at"}Updated At{/s}'
            },
            buttons: {
                capture: '{s name="ecomprocessing/detail/capture"}Capture{/s}',
                void: '{s name="ecomprocessing/detail/void"}Void{/s}',
                refund: '{s name="ecomprocessing/detail/refund"}Refund{/s}',
                reload: '{S name="ecomprocessing/detail/reload"}Reload{/s}'
            },
            messages: {
                error: '{s name="ecomprocessing/detail/error"}Error{/s}',
                success: '{s name="ecomprocessing/detail/success"}Success{/s}',
                ajax: {
                    error: '{s name="ecomprocessing/detail/ajax_error"}Something went wrong. Please try again.{/s}'
                },
                action: {
                    success: '{s name="ecomprocessing/detail/success_capture"}Successful :1.{/s}',
                    error: '{s name="ecomprocessing/detail/error_capture"}Error during :1 the amount.{/s}'
                },
                data: {
                    missing: '{s name="ecomprocessing/detail/missing_data"}Missing initial transaction data{/s}'
                }
            }
        };

        if (me.record && me.record.getPayment() instanceof Ext.data.Store && me.record.getPayment().first() instanceof Ext.data.Model) {
            var payment = me.record.getPayment().first();
        }

        if (payment && (payment.raw.name === 'ecomprocessing_checkout' || payment.raw.name === 'ecomprocessing_direct')) {
            var ecomprocessingPanel = Ext.create('Shopware.apps.EcomprocessingTransactions.view.detail.Transactions', {
                title: 'E-Comprocessing Transactions',
                record: me.record,
                snippets: snippets,
                payment: payment
            });

            result.add([ecomprocessingPanel]);
        }

        return result;
    }
});
//{/block}
