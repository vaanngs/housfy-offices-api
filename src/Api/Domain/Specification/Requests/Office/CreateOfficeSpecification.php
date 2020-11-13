<?php

declare(strict_types=1);

namespace Api\Domain\Specification\Requests\Office;

use Api\Domain\Shared\Param;
use Api\Domain\Specification\Requests\RequestSpecificationInterface;
use Api\Domain\ValueObjs\Office\OfficeAddress;
use Api\Domain\ValueObjs\Office\OfficeAddressLine;
use Api\Domain\ValueObjs\Office\OfficeCity;
use Api\Domain\ValueObjs\Office\OfficeName;
use Api\Domain\ValueObjs\Office\OfficePostalcode;
use Api\Domain\ValueObjs\Office\OfficeProvince;
use Psr\Http\Message\RequestInterface;
use Throwable;

final class CreateOfficeSpecification implements RequestSpecificationInterface
{
    /** {@inheritdoc}
     * @throws Throwable
     */
    public function isSatisfiedBy(RequestInterface $request): bool
    {
        try {
            $params      = $request->getParsedBody();
            $addressData = $params[Param::OFFICE_ADDRESS];

            OfficeName::checkAssertion($params[Param::OFFICE_NAME]);

            foreach ($addressData as $address) {
                $this->checkAddress($address);
            }

            return true;
        } catch (\Exception $exception) {
            return false;
        }
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
