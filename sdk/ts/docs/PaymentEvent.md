# PaymentEvent

Generic payment event envelope (adjust to chosen gateway).

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** |  | [default to undefined]
**type** | **string** |  | [default to undefined]
**data** | [**PaymentEventData**](PaymentEventData.md) |  | [default to undefined]

## Example

```typescript
import { PaymentEvent } from './api';

const instance: PaymentEvent = {
    id,
    type,
    data,
};
```

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)
