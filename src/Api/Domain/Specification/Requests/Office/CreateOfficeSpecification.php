<?php

declare(strict_types=1);

namespace Api\Domain\Specification\Requests\Office;

use Api\Domain\Shared\Param;
use Api\Domain\Specification\Requests\RequestSpecificationInterface;
use Api\Domain\ValueObjs\OfficeAddress;
use Api\Domain\ValueObjs\OfficeAddressLine;
use Api\Domain\ValueObjs\OfficeCity;
use Api\Domain\ValueObjs\OfficeName;
use Api\Domain\ValueObjs\OfficePostalcode;
use Api\Domain\ValueObjs\OfficeProvince;
use Psr\Http\Message\RequestInterface;
use Throwable;

final class CreateOfficeSpecification implements RequestSpecificationInterface
{

    /** @inheritDoc
     * @throws Throwable
     */
    public function isSatisfiedBy(RequestInterface $request): bool
    {
        $params      = $request->getParsedBody();
        $addressData = $params[Param::OFFICE_ADDRESS];

        OfficeName::checkAssertion($params[Param::OFFICE_NAME]);

        foreach ($addressData as $address) {
            $this->checkAddress($address);
        }

        return true;
    }


    /**
     * @param $address
     * @throws Throwable
     */
    private function checkAddress(iterable $address): void
    {
        OfficeAddress::build(
            OfficePostalcode::fromString($address[Param::OFFICE_POSTALCODE]),
            OfficeProvince::fromString($address[Param::OFFICE_PROVINCE]),
            OfficeCity::fromString($address[Param::OFFICE_CITY]),
            OfficeAddressLine::fromString($address[Param::OFFICE_ADDRESS_LINE])
        );
    }
}