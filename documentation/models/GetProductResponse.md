# GetProductResponse



**Properties**

| Name | Type | Required | Description |
| :-------- | :----------| :----------| :----------|
    | brandId | string | ✅ |  |
    | businessId | string | ✅ | Unique identifier for the business to which the product belongs. |
    | createdAt | string | ✅ | Timestamp when the product was created. |
    | isRecurring | boolean | ✅ | Indicates if the product is recurring (e.g., subscriptions). |
    | licenseKeyEnabled | boolean | ✅ | Indicates whether the product requires a license key. |
    | price | model | ✅ |  |
    | productId | string | ✅ | Unique identifier for the product. |
    | taxCategory | model | ✅ | Represents the different categories of taxation applicable to various products and services. |
    | updatedAt | string | ✅ | Timestamp when the product was last updated. |
    | addons | array | ❌ | Available Addons for subscription products |
    | description | string | ❌ | Description of the product, optional. |
    | digitalProductDelivery | model | ❌ |  |
    | image | string | ❌ | URL of the product image, optional. |
    | licenseKeyActivationMessage | string | ❌ | Message sent upon license key activation, if applicable. |
    | licenseKeyActivationsLimit | integer | ❌ | Limit on the number of activations for the license key, if enabled. |
    | licenseKeyDuration | model | ❌ |  |
    | name | string | ❌ | Name of the product, optional. |




<!-- This file was generated by liblab | https://liblab.com/ -->