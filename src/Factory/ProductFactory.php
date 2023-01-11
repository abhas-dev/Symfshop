<?php

namespace App\Factory;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\String\Slugger\SluggerInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Product>
 *
 * @method        Product|Proxy create(array|callable $attributes = [])
 * @method static Product|Proxy createOne(array $attributes = [])
 * @method static Product|Proxy find(object|array|mixed $criteria)
 * @method static Product|Proxy findOrCreate(array $attributes)
 * @method static Product|Proxy first(string $sortedField = 'id')
 * @method static Product|Proxy last(string $sortedField = 'id')
 * @method static Product|Proxy random(array $attributes = [])
 * @method static Product|Proxy randomOrCreate(array $attributes = [])
 * @method static ProductRepository|RepositoryProxy repository()
 * @method static Product[]|Proxy[] all()
 * @method static Product[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Product[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Product[]|Proxy[] findBy(array $attributes)
 * @method static Product[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Product[]|Proxy[] randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<Product> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<Product> createOne(array $attributes = [])
 * @phpstan-method static Proxy<Product> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<Product> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<Product> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<Product> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<Product> random(array $attributes = [])
 * @phpstan-method static Proxy<Product> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<ProductRepository> repository()
 * @phpstan-method static list<Proxy<Product>> all()
 * @phpstan-method static list<Proxy<Product>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<Product>> createSequence(array|callable $sequence)
 * @phpstan-method static list<Proxy<Product>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<Product>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<Product>> randomSet(int $number, array $attributes = [])
 */
final class ProductFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct(private SluggerInterface $slugger)
    {
        parent::__construct();

    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'category' => CategoryFactory::new(),
            'name' => self::faker()->words(3, true) ,
            'price' => self::faker()->randomNumber(5),
            'shortDescription' => self::faker()->paragraph(),
            'mainPicture' => "https://picsum.photos/200?random=" . mt_rand(1, 50)
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
             ->afterInstantiate(function(Product $product): void {
                 $product->setSlug(strtolower($this->slugger->slug($product->getName())));
             })
        ;
    }

    protected static function getClass(): string
    {
        return Product::class;
    }
}
