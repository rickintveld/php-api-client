**Basic usage**

Example:

```
use Rintveld\Clients\ApiClient;
use Rintveld\Models\ActionUrl;

class ErpClient extends ApiClient {
    public function __constructor(string $baseUri, private readonly ...$customHeaders = null) {
        parent::__constructor($baseUri);
    }

    public function headers(): array {
        return [
            "header" => [
                "API-KEY" => "xxx-xxx-xxx",
                "Authorisation" => "Bearer " + $this->customHeaders["jwt"]
            ]
        ];
    }
}

$client = new ErpClient('https://xxx-xxx.com');

$getProducts = $client->get(new ActionUrl('/products'));

$newProduct = $client->post(new ActionUrl('/product'), $payload);

$updateProdut = $client->patch(new ActionUrl('/product'), $payload);

$deleteProduct = $client->delete(new ActionUrl('/product')->addParameters(['id' => 1]));

```
