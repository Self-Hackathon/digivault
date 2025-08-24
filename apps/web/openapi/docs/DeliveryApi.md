# DeliveryApi

All URIs are relative to *http://localhost:4000*

|Method | HTTP request | Description|
|------------- | ------------- | -------------|
|[**ordersOrderIdDeliveryGet**](#ordersorderiddeliveryget) | **GET** /orders/{orderId}/delivery | Get delivery (links &amp; license keys)|

# **ordersOrderIdDeliveryGet**
> Delivery ordersOrderIdDeliveryGet()

Returns signed URLs (short expiry) and/or license keys after successful payment.

### Example

```typescript
import {
    DeliveryApi,
    Configuration
} from './api';

const configuration = new Configuration();
const apiInstance = new DeliveryApi(configuration);

let orderId: string; // (default to undefined)

const { status, data } = await apiInstance.ordersOrderIdDeliveryGet(
    orderId
);
```

### Parameters

|Name | Type | Description  | Notes|
|------------- | ------------- | ------------- | -------------|
| **orderId** | [**string**] |  | defaults to undefined|


### Return type

**Delivery**

### Authorization

[bearerAuth](../README.md#bearerAuth)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json


### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
|**200** | OK |  -  |
|**403** | Order not paid or access denied |  -  |
|**404** | Order not found |  -  |

[[Back to top]](#) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to Model list]](../README.md#documentation-for-models) [[Back to README]](../README.md)

