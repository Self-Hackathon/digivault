# ProductCreate


## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** |  | [default to undefined]
**slug** | **string** |  | [default to undefined]
**description** | **string** |  | [optional] [default to undefined]
**price** | [**Money**](Money.md) |  | [default to undefined]
**hasLicense** | **boolean** |  | [optional] [default to false]

## Example

```typescript
import { ProductCreate } from './api';

const instance: ProductCreate = {
    name,
    slug,
    description,
    price,
    hasLicense,
};
```

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)
