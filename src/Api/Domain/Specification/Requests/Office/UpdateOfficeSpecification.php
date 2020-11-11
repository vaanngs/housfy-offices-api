<?php

declare(strict_types=1);

namespace Api\Domain\Specification\Requests\Office;

use Api\Domain\Shared\Param;
use Api\Domain\Specification\Requests\RequestSpecificationInterface;
use Api\Domain\ValueObjs\OfficeAddressLine;
use Api\Domain\ValueObjs\OfficeCity;
use Api\Domain\ValueObjs\OfficeName;
use Api\Domain\ValueObjs\OfficePostalcode;
use Api\Domain\ValueObjs\OfficeProvince;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\Uuid;
use Throwable;

final class UpdateOfficeSpecification implements RequestSpecificationInterface
{

    /** @inheritDoc
     * @throws Throwable
     */
    public function isSatisfiedBy(RequestInterface $request): bool
    {
        $params = $request->getParsedBody();

        if (empty($params[Param::UUID])) {
            return false;
        }

        Uuid::fromString($params[Param::UUID]);

        if (!empty($params[Param::OFFICE_NAME])) {
            OfficeName::checkAssertion($params[Param::OFFICE_NAME]);
        }

        if (!empty($params[Param::OFFICE_ADDRESS])) {
            $addressData = $params[Param::OFFICE_ADDRESS];

            foreach ($addressData as $address) {
                $this->checkAddress($address);
            }
        }

        return true;
    }


    /**
     * @param $address
     * @throws Throwable
     */
    private function checkAddress(iterable $address): void
    {
        if (!empty($address[Param::OFFICE_POSTALCODE])) {
            OfficePostalcode::checkAssertion($address[Param::OFFICE_POSTALCODE]);
        }

        if (!empty($address[Param::OFFICE_PROVINCE])) {
            OfficeProvince::checkAssertion($address[Param::OFFICE_PROVINCE]);
        }

        if (!empty($address[Param::OFFICE_CITY])) {
            OfficeCity::checkAssertion($address[Param::OFFICE_CITY]);
        }

        if (!empty($address[Param::OFFICE_ADDRESS_LINE])) {
            OfficeAddressLine::checkAssertion($address[Param::OFFICE_ADDRESS_LINE]);
        }
    }
}