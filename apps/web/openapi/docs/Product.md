# Product


## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** |  | [default to undefined]
**slug** | **string** |  | [default to undefined]
**name** | **string** |  | [default to undefined]
**description** | **string** |  | [optional] [default to undefined]
**price** | [**Money**](Money.md) |  | [default to undefined]
**hasLicense** | **boolean** | true if product generates a license key | [default to undefined]
**assets** | [**Array&lt;ProductAssetsInner&gt;**](ProductAssetsInner.md) |  | [optional] [default to undefined]

## Example

```typescript
import { Product } from './api';

const instance: Product = {
    id,
    slug,
    name,
    description,
    price,
    hasLicense,
    assets,
};
```

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)
