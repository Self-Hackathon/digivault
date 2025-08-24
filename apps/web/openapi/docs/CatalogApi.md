# CatalogApi

All URIs are relative to *http://localhost:4000*

|Method | HTTP request | Description|
|------------- | ------------- | -------------|
|[**productsGet**](#productsget) | **GET** /products | List products|
|[**productsIdGet**](#productsidget) | **GET** /products/{id} | Get product detail|

# **productsGet**
> ProductList productsGet()


### Example

```typescript
import {
    CatalogApi,
    Configuration
} from './api';

const configuration = new Configuration();
const apiInstance = new CatalogApi(configuration);

let q: string; //Optional search query (optional) (default to undefined)
let limit: number; // (optional) (default to 20)
let cursor: string; //Opaque cursor for pagination (optional) (default to undefined)

const { status, data } = await apiInstance.productsGet(
    q,
    limit,
    cursor
);
```

### Parameters

|Name | Type | Description  | Notes|
|------------- | ------------- | ------------- | -------------|
| **q** | [**string**] | Optional search query | (optional) defaults to undefined|
| **limit** | [**number**] |  | (optional) defaults to 20|
| **cursor** | [**string**] | Opaque cursor for pagination | (optional) defaults to undefined|


### Return type

**ProductList**

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json


### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
|**200** | OK |  * x-next-cursor - Cursor for next page (if any) <br>  |

[[Back to top]](#) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to Model list]](../README.md#documentation-for-models) [[Back to README]](../README.md)

# **productsIdGet**
> Product productsIdGet()


### Example

```typescript
import {
    CatalogApi,
    Configuration
} from './api';

const configuration = new Configuration();
const apiInstance = new CatalogApi(configuration);

let id: string; // (default to undefined)

const { status, data } = await apiInstance.productsIdGet(
    id
);
```

### Parameters

|Name | Type | Description  | Notes|
|------------- | ------------- | ------------- | -------------|
| **id** | [**string**] |  | defaults to undefined|


### Return type

**Product**

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json


### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
|**200** | OK |  -  |
|**404** | Not found |  -  |

[[Back to top]](#) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to Model list]](../README.md#documentation-for-models) [[Back to README]](../README.md)

