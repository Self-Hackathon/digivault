# PaymentEventData


## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**orderId** | **string** |  | [optional] [default to undefined]
**amount** | [**Money**](Money.md) |  | [optional] [default to undefined]
**currency** | **string** |  | [optional] [default to undefined]
**status** | **string** |  | [optional] [default to undefined]
**txnId** | **string** |  | [optional] [default to undefined]

## Example

```typescript
import { PaymentEventData } from './api';

const instance: PaymentEventData = {
    orderId,
    amount,
    currency,
    status,
    txnId,
};
```

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)
