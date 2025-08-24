# WebhooksApi

All URIs are relative to *http://localhost:4000*

|Method | HTTP request | Description|
|------------- | ------------- | -------------|
|[**webhooksPaymentPost**](#webhookspaymentpost) | **POST** /webhooks/payment | Payment gateway webhook|

# **webhooksPaymentPost**
> WebhookAck webhooksPaymentPost(paymentEvent)

Endpoint receives events from the gateway (at-least-once delivery). Handler MUST be idempotent: deduplicate by `event.id`. 

### Example

```typescript
import {
    WebhooksApi,
    Configuration,
    PaymentEvent
} from './api';

const configuration = new Configuration();
const apiInstance = new WebhooksApi(configuration);

let xSignature: string; //HMAC signature from gateway (default to undefined)
let xEventId: string; //Unique event ID from gateway (default to undefined)
let xEventTimestamp: string; //Event timestamp (default to undefined)
let paymentEvent: PaymentEvent; //

const { status, data } = await apiInstance.webhooksPaymentPost(
    xSignature,
    xEventId,
    xEventTimestamp,
    paymentEvent
);
```

### Parameters

|Name | Type | Description  | Notes|
|------------- | ------------- | ------------- | -------------|
| **paymentEvent** | **PaymentEvent**|  | |
| **xSignature** | [**string**] | HMAC signature from gateway | defaults to undefined|
| **xEventId** | [**string**] | Unique event ID from gateway | defaults to undefined|
| **xEventTimestamp** | [**string**] | Event timestamp | defaults to undefined|


### Return type

**WebhookAck**

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json


### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
|**200** | ACK received |  -  |
|**400** | Invalid payload |  -  |
|**401** | Invalid signature |  -  |

[[Back to top]](#) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to Model list]](../README.md#documentation-for-models) [[Back to README]](../README.md)

