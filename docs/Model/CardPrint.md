# # CardPrint

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** |  | [optional] [readonly]
**order_id** | **string** | Il s&#39;agit du token lié à votre empreinte de carte. |
**payment_type** | **string** |  | [optional]
**returned_url** | **string** | Adresse sur laquelle il faut rediriger le client après que l&#39;action a été effectuée. | [optional]
**notified_url** | **string** | Adresse sur laquelle PayGreen peut faire des appels pour mettre à jour le statut. | [optional]
**url** | **string** |  | [optional] [readonly]
**test_mode** | **int** |  | [optional] [readonly]
**result** | [**\Hraph\PaygreenApi\Model\TransactionResult**](TransactionResult.md) |  | [optional]
**card** | [**\Hraph\PaygreenApi\Model\TransactionCard**](TransactionCard.md) |  | [optional]
**buyer** | [**\Hraph\PaygreenApi\Model\PayinsBuyer**](PayinsBuyer.md) |  | [optional]
**shipping_address** | [**\Hraph\PaygreenApi\Model\PayinsShippingAddress**](PayinsShippingAddress.md) |  | [optional]
**billing_address** | [**\Hraph\PaygreenApi\Model\PayinsShippingAddress**](PayinsShippingAddress.md) |  | [optional]
**metadata** | **array<string,string>** |  | [optional] [readonly]
**explanation** | **string** |  | [optional] [readonly]
**created_at** | **\DateTime** |  | [optional] [readonly]
**value_at** | **\DateTime** |  | [optional] [readonly]
**answered_at** | **\DateTime** |  | [optional] [readonly]
**ttl** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
