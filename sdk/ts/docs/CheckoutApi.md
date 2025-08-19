# CheckoutApi

All URIs are relative to *http://localhost:4000*

|Method | HTTP request | Description|
|------------- | ------------- | -------------|
|[**checkoutPost**](#checkoutpost) | **POST** /checkout | Create checkout session|

# **checkoutPost**
> CheckoutSession checkoutPost(checkoutRequest)

Create a **pending** order and create a payment session in the payment gateway. Use **Idempotency-Key** header to prevent double submission. 

### Example

```typescript
import {
    CheckoutApi,
    Configuration,
    CheckoutRequest
} from './api';

const configuration = new Configuration();
const apiInstance = new CheckoutApi(configuration);

let checkoutRequest: CheckoutRequest; //
let idempotencyKey: string; //Client-provided idempotency key to prevent duplicates (optional) (default to undefined)

const { status, data } = await apiInstance.checkoutPost(
    checkoutRequest,
    idempotencyKey
);
```

### Parameters

|Name | Type | Description  | Notes|
|------------- | ------------- | ------------- | -------------|
| **checkoutRequest** | **CheckoutRequest**|  | |
| **idempotencyKey** | [**string**] | Client-provided idempotency key to prevent duplicates | (optional) defaults to undefined|


### Return type

**CheckoutSession**

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json


### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
|**201** | Created |  -  |
|**400** | Bad request |  -  |

[[Back to top]](#) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to Model list]](../README.md#documentation-for-models) [[Back to README]](../README.md)

