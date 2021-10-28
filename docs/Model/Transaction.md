# # Transaction

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** |  | [optional]
**payment_token** | **string** |  | [optional] [readonly]
**payment_folder** | **string** |  | [optional] [readonly]
**order_id** | **string** |  | [optional] [readonly]
**amount** | **int** | Le montant est en centimes. | [readonly]
**original_amount** | **int** |  | [optional] [readonly]
**currency** | **string** |  | [readonly]
**type** | **string** |  | [optional] [readonly]
**payment_type** | **string** |  |
**url** | **string** | Pour effectuer une transaction en utilisant le module Insite, il faut ajouter \&quot;display&#x3D;insite\&quot; dans l&#39;URL de paiement. | [optional] [readonly]
**test_mode** | **int** |  | [optional] [readonly]
**result** | [**\Hraph\PaygreenApi\Model\TransactionResult**](TransactionResult.md) |  | [optional]
**card** | [**\Hraph\PaygreenApi\Model\TransactionCard**](TransactionCard.md) |  | [optional]
**buyer** | [**\Hraph\PaygreenApi\Model\TransactionBuyer**](TransactionBuyer.md) |  | [optional]
**shipping_address** | [**\Hraph\PaygreenApi\Model\TransactionShippingAddress**](TransactionShippingAddress.md) |  | [optional]
**billing_address** | [**\Hraph\PaygreenApi\Model\TransactionBillingAddress**](TransactionBillingAddress.md) |  | [optional]
**schedules** | [**\Hraph\PaygreenApi\Model\TransactionSchedules**](TransactionSchedules.md) |  | [optional]
**donation** | [**\Hraph\PaygreenApi\Model\TransactionDonation**](TransactionDonation.md) |  | [optional]
**metadata** | **string[]** |  | [optional]
**eligible_amount** | **string[]** |  | [optional]
**explanation** | **string** |  | [optional] [readonly]
**id_fingerprint** | **int** |  | [optional]
**created_at** | **\DateTime** |  | [optional] [readonly]
**value_at** | **\DateTime** |  | [readonly]
**answered_at** | **\DateTime** |  | [optional] [readonly]
**ttl** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
