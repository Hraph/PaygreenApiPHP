# Hraph\PaygreenApi\LesTransactionsApi

All URIs are relative to https://paygreen.fr.

Method | HTTP request | Description
------------- | ------------- | -------------
[**apiIdentifiantPayinsTransactionCancelPost()**](LesTransactionsApi.md#apiIdentifiantPayinsTransactionCancelPost) | **POST** /api/{identifiant}/payins/transaction/cancel | Annulation
[**apiIdentifiantPayinsTransactionCashPost()**](LesTransactionsApi.md#apiIdentifiantPayinsTransactionCashPost) | **POST** /api/{identifiant}/payins/transaction/cash | Paiement comptant
[**apiIdentifiantPayinsTransactionIdDelete()**](LesTransactionsApi.md#apiIdentifiantPayinsTransactionIdDelete) | **DELETE** /api/{identifiant}/payins/transaction/{id} | Remboursement
[**apiIdentifiantPayinsTransactionIdGet()**](LesTransactionsApi.md#apiIdentifiantPayinsTransactionIdGet) | **GET** /api/{identifiant}/payins/transaction/{id} | Détails
[**apiIdentifiantPayinsTransactionIdPatch()**](LesTransactionsApi.md#apiIdentifiantPayinsTransactionIdPatch) | **PATCH** /api/{identifiant}/payins/transaction/{id} | Modification du montant
[**apiIdentifiantPayinsTransactionIdPut()**](LesTransactionsApi.md#apiIdentifiantPayinsTransactionIdPut) | **PUT** /api/{identifiant}/payins/transaction/{id} | Confirmer une transaction
[**apiIdentifiantPayinsTransactionSubscriptionPost()**](LesTransactionsApi.md#apiIdentifiantPayinsTransactionSubscriptionPost) | **POST** /api/{identifiant}/payins/transaction/subscription | Paiement abonnement
[**apiIdentifiantPayinsTransactionTokenizePost()**](LesTransactionsApi.md#apiIdentifiantPayinsTransactionTokenizePost) | **POST** /api/{identifiant}/payins/transaction/tokenize | Paiement avec confirmation
[**apiIdentifiantPayinsTransactionXtimePost()**](LesTransactionsApi.md#apiIdentifiantPayinsTransactionXtimePost) | **POST** /api/{identifiant}/payins/transaction/xtime | Paiement en plusieurs fois


## `apiIdentifiantPayinsTransactionCancelPost()`

```php
apiIdentifiantPayinsTransactionCancelPost($identifiant, $authorization, $id): \Hraph\PaygreenApi\Model\InlineResponse20012
```

Annulation

Cette requête vous permet d'annuler un paiement comptant, à la livraison, par abonnement ou en plusieurs fois. Vous devez indiquer l'id du paiement à annuler dans le champ `id`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Hraph\PaygreenApi\Api\LesTransactionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$id = 'id_example'; // string | ID de la transaction

try {
    $result = $apiInstance->apiIdentifiantPayinsTransactionCancelPost($identifiant, $authorization, $id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LesTransactionsApi->apiIdentifiantPayinsTransactionCancelPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **id** | **string**| ID de la transaction |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse20012**](../Model/InlineResponse20012.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiIdentifiantPayinsTransactionCashPost()`

```php
apiIdentifiantPayinsTransactionCashPost($identifiant, $authorization, $payins): \Hraph\PaygreenApi\Model\InlineResponse20012
```

Paiement comptant

Cette requête vous permet de créer un paiement **comptant**. Le paramètre `returned_url` est optionnel&nbsp;: le renseigner vous permettra de rediriger automatiquement votre client vers la page de votre choix (sur votre e-commerce). S'il n'est pas renseigné, le client restera sur la page de confirmation de notre interface de paiement. *Voir le schéma de flux de paiement pour visualiser le parcours client*.<br /> <br /> Le paramètre `notified_url`, quant à lui, nous permet de vous envoyer [l'IPN de la transaction](#tag/Les-transactions). Dans le cas d'un paiement comptant, l'IPN est envoyée à partir du moment où le consommateur a réglé son achat. Cela peut parfois prendre plusieurs minutes.<br /> <br /> Si vous ne proposez pas la compensation carbone à vos clients (l'option **Tree**), il est inutile de renseigner le paramètre `idFingerprint`.<br /> <br /> Le paramètre `eligibleAmount` est optionnel&nbsp;: vous n'avez à le renseigner que si vous proposez à vos clients de payer avec un moyen de paiement nécessitant la gestion du montant éligible. Pour plus de détails, consultez la section [Les moyens de paiement](#tag/Les-moyens-de-paiement).<br /> <br /> Le paramètre `card` est optionnel&nbsp;: à moins de vouloir exécuter une [empreinte de carte](#tag/L'empreinte-de-carte), ce paramètre **ne doit donc pas être envoyé** dans la requête.<br /> <br /> > **Qu'est-ce que l'option OneClick&nbsp;?** Le OneClick permet au consommateur d'enregistrer sa carte bancaire lors d'un achat sur votre plateforme afin de la réutiliser ultérieurement, sans avoir à renseigner ses codes à nouveau. Si vous souhaitez proposer cette option à vos clients, il vous suffit de demander l'activation du module OneClick sur votre boutique PayGreen à notre support.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Hraph\PaygreenApi\Api\LesTransactionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$payins = new \Hraph\PaygreenApi\Model\Payins(); // \Hraph\PaygreenApi\Model\Payins | Transaction comptant ou à la livraison

try {
    $result = $apiInstance->apiIdentifiantPayinsTransactionCashPost($identifiant, $authorization, $payins);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LesTransactionsApi->apiIdentifiantPayinsTransactionCashPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **payins** | [**\Hraph\PaygreenApi\Model\Payins**](../Model/Payins.md)| Transaction comptant ou à la livraison |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse20012**](../Model/InlineResponse20012.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiIdentifiantPayinsTransactionIdDelete()`

```php
apiIdentifiantPayinsTransactionIdDelete($identifiant, $authorization, $id): \Hraph\PaygreenApi\Model\InlineResponse20012
```

Remboursement

Cette requête vous permet de rembourser totalement ou partiellement une transaction. Si vous souhaitez effectuer un remboursement **partiel**, indiquez le montant à rembourser dans le champ `amount`. Si le paramètre `amount` n'est pas renseigné, la transaction sera **intégralement** remboursée. Le body doit être ```{\"amount\" : 500 }``` pour effectuer un remboursement de 5€. Vous recevrez en réponse le détail de la transaction concerné. Si le remboursement est intégral, la transaction passe au statut ```REFUNDED```.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Hraph\PaygreenApi\Api\LesTransactionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$id = 'id_example'; // string | ID de la transaction

try {
    $result = $apiInstance->apiIdentifiantPayinsTransactionIdDelete($identifiant, $authorization, $id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LesTransactionsApi->apiIdentifiantPayinsTransactionIdDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **id** | **string**| ID de la transaction |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse20012**](../Model/InlineResponse20012.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiIdentifiantPayinsTransactionIdGet()`

```php
apiIdentifiantPayinsTransactionIdGet($identifiant, $authorization, $id): \Hraph\PaygreenApi\Model\InlineResponse20012
```

Détails

Cette requête vous permet d'obtenir tous les détails d'une transaction. Le montant de la transaction est toujours en centimes.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Hraph\PaygreenApi\Api\LesTransactionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$id = 'id_example'; // string | ID de la transaction

try {
    $result = $apiInstance->apiIdentifiantPayinsTransactionIdGet($identifiant, $authorization, $id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LesTransactionsApi->apiIdentifiantPayinsTransactionIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **id** | **string**| ID de la transaction |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse20012**](../Model/InlineResponse20012.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiIdentifiantPayinsTransactionIdPatch()`

```php
apiIdentifiantPayinsTransactionIdPatch($identifiant, $authorization, $id, $patch_amount): \Hraph\PaygreenApi\Model\InlineResponse20012
```

Modification du montant

Cette requête vous permet de modifier le montant d'un paiement en cours. Vous pouvez uniquement modifier le montant d'un paiement en attente.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Hraph\PaygreenApi\Api\LesTransactionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$id = 'id_example'; // string | ID de la transaction
$patch_amount = new \Hraph\PaygreenApi\Model\PatchAmount(); // \Hraph\PaygreenApi\Model\PatchAmount | Le montant de la transaction doit être en centimes.

try {
    $result = $apiInstance->apiIdentifiantPayinsTransactionIdPatch($identifiant, $authorization, $id, $patch_amount);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LesTransactionsApi->apiIdentifiantPayinsTransactionIdPatch: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **id** | **string**| ID de la transaction |
 **patch_amount** | [**\Hraph\PaygreenApi\Model\PatchAmount**](../Model/PatchAmount.md)| Le montant de la transaction doit être en centimes. |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse20012**](../Model/InlineResponse20012.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiIdentifiantPayinsTransactionIdPut()`

```php
apiIdentifiantPayinsTransactionIdPut($identifiant, $authorization, $id, $execute_transaction): \Hraph\PaygreenApi\Model\InlineResponse20012
```

Confirmer une transaction

Cette requête vous permet de confirmer une transaction **e-caution** ou **à la livraison**. Le montant de la transaction doit être en centimes.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Hraph\PaygreenApi\Api\LesTransactionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$id = 'id_example'; // string | ID de la transaction
$execute_transaction = new \Hraph\PaygreenApi\Model\ExecuteTransaction(); // \Hraph\PaygreenApi\Model\ExecuteTransaction | Le montant de la transaction doit être en centimes.

try {
    $result = $apiInstance->apiIdentifiantPayinsTransactionIdPut($identifiant, $authorization, $id, $execute_transaction);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LesTransactionsApi->apiIdentifiantPayinsTransactionIdPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **id** | **string**| ID de la transaction |
 **execute_transaction** | [**\Hraph\PaygreenApi\Model\ExecuteTransaction**](../Model/ExecuteTransaction.md)| Le montant de la transaction doit être en centimes. |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse20012**](../Model/InlineResponse20012.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiIdentifiantPayinsTransactionSubscriptionPost()`

```php
apiIdentifiantPayinsTransactionSubscriptionPost($identifiant, $authorization, $payins_recc): \Hraph\PaygreenApi\Model\InlineResponse20012
```

Paiement abonnement

Cette requête vous permet de créer un **abonnement**. <br /> <br /> Le paramètre `returned_url` est optionnel&nbsp;: le renseigner vous permettra de rediriger automatiquement votre client vers la page de votre choix (sur votre e-commerce). S'il n'est pas renseigné, le client restera sur la page de confirmation de notre interface de paiement. *Voir le schéma de flux de paiement pour visualiser le parcours client*.<br /> <br /> Le paramètre `notified_url`, quant à lui, nous permet de vous envoyer [l'IPN de la transaction](#tag/Les-transactions). Dans le cas d'un abonnement, l'IPN est envoyée à chaque échéance (la première est immédiate). Cela peut parfois prendre plusieurs minutes.<br /> <br /> Si vous ne proposez pas la compensation carbone à vos clients (l'option **Tree**), il est inutile de renseigner le paramètre `idFingerprint`.<br /> <br /> Le paramètre `card` est optionnel&nbsp;: à moins de vouloir exécuter une [empreinte de carte](#tag/L'empreinte-de-carte), ce paramètre **ne doit donc pas être envoyé** dans la requête.<br /> <br /> Le paramètre `eligibleAmount` est inutile et ne doit pas être renseigné pour ce mode de paiement.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Hraph\PaygreenApi\Api\LesTransactionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$payins_recc = new \Hraph\PaygreenApi\Model\PayinsRecc(); // \Hraph\PaygreenApi\Model\PayinsRecc | Transaction abonnement ou N fois

try {
    $result = $apiInstance->apiIdentifiantPayinsTransactionSubscriptionPost($identifiant, $authorization, $payins_recc);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LesTransactionsApi->apiIdentifiantPayinsTransactionSubscriptionPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **payins_recc** | [**\Hraph\PaygreenApi\Model\PayinsRecc**](../Model/PayinsRecc.md)| Transaction abonnement ou N fois |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse20012**](../Model/InlineResponse20012.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiIdentifiantPayinsTransactionTokenizePost()`

```php
apiIdentifiantPayinsTransactionTokenizePost($identifiant, $authorization, $payins): \Hraph\PaygreenApi\Model\InlineResponse20012
```

Paiement avec confirmation

Cette requête vous permet de créer un **paiement de type comptant à la livraison**. Le paramètre `returned_url` est optionnel&nbsp;: le renseigner vous permettra de rediriger automatiquement votre client vers la page de votre choix (sur votre e-commerce). S'il n'est pas renseigné, le client restera sur la page de confirmation de notre interface de paiement. *Voir le schéma de flux de paiement pour visualiser le parcours client*.<br /> <br /> Le paramètre `notified_url`, quant à lui, nous permet de vous envoyer [l'IPN de la transaction](#tag/Les-transactions). Dans le cas d'un paiement avec confirmation, l'IPN est envoyée à la confirmation du paiement. Cela peut parfois prendre plusieurs minutes.<br /> <br /> Si vous ne proposez pas la compensation carbone à vos clients (l'option **Tree**), il est inutile de renseigner le paramètre `idFingerprint`.<br /> <br /> Le paramètre `eligibleAmount` est inutile et ne doit pas être renseigné pour ce mode de paiement.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Hraph\PaygreenApi\Api\LesTransactionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$payins = new \Hraph\PaygreenApi\Model\Payins(); // \Hraph\PaygreenApi\Model\Payins | Transaction comptant ou à la livraison

try {
    $result = $apiInstance->apiIdentifiantPayinsTransactionTokenizePost($identifiant, $authorization, $payins);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LesTransactionsApi->apiIdentifiantPayinsTransactionTokenizePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **payins** | [**\Hraph\PaygreenApi\Model\Payins**](../Model/Payins.md)| Transaction comptant ou à la livraison |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse20012**](../Model/InlineResponse20012.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiIdentifiantPayinsTransactionXtimePost()`

```php
apiIdentifiantPayinsTransactionXtimePost($identifiant, $authorization, $payins_recc): \Hraph\PaygreenApi\Model\InlineResponse20012
```

Paiement en plusieurs fois

Cette requête vous permet de créer un **paiement de type récurrent ou X fois sans frais**. Le paramètre `returned_url` est optionnel&nbsp;: le renseigner vous permettra de rediriger automatiquement votre client vers la page de votre choix (sur votre e-commerce). S'il n'est pas renseigné, le client restera sur la page de confirmation de notre interface de paiement. *Voir le schéma de flux de paiement pour visualiser le parcours client*.<br /> <br /> Le paramètre `notified_url`, quant à lui, nous permet de vous envoyer [l'IPN de la transaction](#tag/Les-transactions). Dans le cas d'un paiement en plusieurs fois, l'IPN est envoyée à chaque échéance (la première est immédiate). Cela peut parfois prendre plusieurs minutes.<br /> <br /> Si vous ne proposez pas la compensation carbone à vos clients (l'option **Tree**), il est inutile de renseigner le paramètre `idFingerprint`.<br /> <br /> Le paramètre `card` est optionnel&nbsp;: à moins de vouloir exécuter une [empreinte de carte](#tag/L'empreinte-de-carte), ce paramètre **ne doit donc pas être envoyé** dans la requête.<br /> <br /> Le paramètre `eligibleAmount` est inutile et ne doit pas être renseigné pour ce mode de paiement.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Hraph\PaygreenApi\Api\LesTransactionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$identifiant = 'identifiant_example'; // string | Votre identifiant PayGreen
$authorization = 'authorization_example'; // string | Votre clé privée PayGreen (Bearer : votre-clé-privée)
$payins_recc = new \Hraph\PaygreenApi\Model\PayinsRecc(); // \Hraph\PaygreenApi\Model\PayinsRecc | Transaction abonnement ou N fois

try {
    $result = $apiInstance->apiIdentifiantPayinsTransactionXtimePost($identifiant, $authorization, $payins_recc);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LesTransactionsApi->apiIdentifiantPayinsTransactionXtimePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **identifiant** | **string**| Votre identifiant PayGreen |
 **authorization** | **string**| Votre clé privée PayGreen (Bearer : votre-clé-privée) |
 **payins_recc** | [**\Hraph\PaygreenApi\Model\PayinsRecc**](../Model/PayinsRecc.md)| Transaction abonnement ou N fois |

### Return type

[**\Hraph\PaygreenApi\Model\InlineResponse20012**](../Model/InlineResponse20012.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
