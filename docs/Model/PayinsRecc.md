# # PayinsRecc

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**order_id** | **string** |  |
**amount** | **int** | Le montant est en centimes. |
**currency** | **string** |  |
**payment_type** | **string** |  | [optional]
**returned_url** | **string** | Adresse sur laquelle il faut rediriger le client après que l&#39;action a été effectuée. | [optional]
**notified_url** | **string** | Adresse sur laquelle PayGreen peut faire des appels pour mettre à jour le statut. | [optional]
**id_fingerprint** | **int** |  | [optional]
**order_details** | [**\Hraph\PaygreenApi\Model\PayinsReccOrderDetails**](PayinsReccOrderDetails.md) |  | [optional]
**buyer** | [**\Hraph\PaygreenApi\Model\PayinsBuyer**](PayinsBuyer.md) |  | [optional]
**shipping_address** | [**\Hraph\PaygreenApi\Model\PayinsShippingAddress**](PayinsShippingAddress.md) |  | [optional]
**billing_address** | [**\Hraph\PaygreenApi\Model\PayinsShippingAddress**](PayinsShippingAddress.md) |  | [optional]
**card** | [**\Hraph\PaygreenApi\Model\PayinsCard**](PayinsCard.md) |  | [optional]
**metadata** | **array<string,string>** |  | [optional]
**eligible_amount** | **array<string,string>** |  | [optional]
**with_payment_link** | **bool** |  | [optional] [readonly]
**emails** | **string[]** |  | [optional] [readonly]
**content_mail** | **string** |  | [optional] [readonly]
**ttl** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
