# # Transaction

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** |  | [optional] 
**payment_token** | **string** |  | [optional] [readonly] 
**payment_folder** | **string** |  | [optional] [readonly] 
**order_id** | **string** |  | [optional] [readonly] 
**amount** | **int** | Le montant est en centimes. | [readonly] 
**currency** | **string** |  | [readonly] 
**type** | **string** |  | [optional] [readonly] 
**payment_type** | **string** |  | 
**url** | **string** | Pour effectuer une transaction en utilisant le module Insite, il faut ajouter \&quot;display&#x3D;insite\&quot; dans l&#39;URL de paiement. | [optional] [readonly] 
**test_mode** | **int** |  | [optional] [readonly] 
**result** | [**\Hraph\PaygreenApi\Model\TransactionResult**](TransactionResult.md) |  | [optional] 
**card** | [**\Hraph\PaygreenApi\Model\TransactionCard**](TransactionCard.md) |  | [optional] 
**buyer** | [**\Hraph\PaygreenApi\Model\TransactionBuyer**](TransactionBuyer.md) |  | [optional] 
**schedules** | [**\Hraph\PaygreenApi\Model\TransactionSchedules**](TransactionSchedules.md) |  | [optional] 
**donation** | [**\Hraph\PaygreenApi\Model\TransactionDonation**](TransactionDonation.md) |  | [optional] 
**metadata** | **string[]** |  | [optional] 
**eligible_amount** | **string[]** |  | [optional] 
**explanation** | **string** |  | [optional] [readonly] 
**id_fingerprint** | **int** |  | [optional] 
**created_at** | [**\DateTime**](\DateTime.md) |  | [optional] [readonly] 
**value_at** | [**\DateTime**](\DateTime.md) |  | [readonly] 
**answered_at** | [**\DateTime**](\DateTime.md) |  | [optional] [readonly] 
**ttl** | **string** |  | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)


