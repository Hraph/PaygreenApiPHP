# # PayinsMulti

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**order_id** | **string** |  | 
**amount** | **int** | Le montant est en centimes. | 
**currency** | **string** |  | 
**returned_url** | **string** | Adresse sur laquelle il faut rediriger le client après que l&#39;action a été effectuée. | [optional] 
**notified_url** | **string** | Adresse sur laquelle PayGreen peut faire des appels pour mettre à jour le statut. | [optional] 
**id_fingerprint** | **int** |  | [optional] 
**buyer** | [**\Hraph\PaygreenApi\Model\PayinsBuyer**](PayinsBuyer.md) |  | [optional] 
**billing_address** | [**\Hraph\PaygreenApi\Model\PayinsBillingAddress**](PayinsBillingAddress.md) |  | [optional] 
**metadata** | **string[]** |  | [optional] 
**card** | [**\Hraph\PaygreenApi\Model\PayinsCard**](PayinsCard.md) |  | [optional] 
**ttl** | **string** |  | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)


