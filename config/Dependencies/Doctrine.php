<?php

declare(strict_types=1);

use Api\Domain\Shared\WriteModelInterface;
use Api\Infrastructure\Doctrine\Model\WriteModel;
use Api\Infrastructure\Doctrine\Type\Event\EventNameType;
use Api\Infrastructure\Doctrine\Type\Event\EventPayloadType;
use Api\Infrastructure\Doctrine\Type\Office\OfficeAddressType;
use Api\Infrastructure\Doctrine\Type\Office\OfficeNameType;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\Common\Cache\RedisCache;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Driver\XmlDriver;
use Doctrine\ORM\Tools\Setup;
use Psr\Container\ContainerInterface;
use Ramsey\Uuid\Doctrine\UuidType;

$container['EntityManager'] = function (ContainerInterface $c): EntityManagerInterface {
    $setting = $c['settings']['doctrine'];

    $config = Setup::createConfiguration($setting['dev_mode']);

    // Proxy
    $config->setAutoGenerateProxyClasses($setting['dev_mode']);
    $config->setProxyDir($setting['proxy_dir']);
    $config->setProxyNamespace('Api\Domain\Proxy');

    /*
     * Cache
     * @see https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/reference/caching.html
     */
    if ($setting['dev_mode']) {
        $cache = new FilesystemCache($setting['cache_dir']);
    } else {
        $cache = new RedisCache();
        $cache->setRedis($c['redis']);
    }

    $cache->setNamespace('housfyoffices:api:cache:doctrine:');

    // Cachea el mapeo de entidad con tabla, se realiza 1 vez, no crece
    $config->setMetadataCacheImpl($cache);

    // Cachea la conversion de DQL a SQL, se realiza 1 vez
    $config->setQueryCacheImpl($cache);

    /*
     * Cachea los resultados, solo cuando se implenta en la query expresamente:
     * $query->enableResultCache(3600, 'label_id');
     */
    $config->setResultCacheImpl($cache);

    // Mapping Types
    $config->setMetadataDriverImpl(new XmlDriver([$setting['metadata_dir']], '.orm.xml'));
    Type::addType(UuidType::NAME, UuidType::class);
    Type::addType(OfficeNameType::NAME, OfficeNameType::class);
    Type::addType(OfficeAddressType::NAME, OfficeAddressType::class);
    Type::addType(EventNameType::NAME, EventNameType::class);
    Type::addType(EventPayloadType::NAME, EventPayloadType::class);

    return EntityManager::create($setting['connection']['housfy_offices'], $config);
};


$container['WriteModel'] = function (ContainerInterface $c): WriteModelInterface {
    return new WriteModel(
        $c['EntityManager']
    );
};
