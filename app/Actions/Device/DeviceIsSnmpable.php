<?php

namespace App\Actions\Device;

use App\Models\Device;
use SnmpQuery;

class DeviceIsSnmpable
{
    public function execute(Device $device, ?string $context = null): bool
    {
        $query = SnmpQuery::device($device);
        if ($device->snmpver === 'v3' && $context !== null && $context !== '') {
            $query->context($context);
        }

        $response = $query->get('SNMPv2-MIB::sysObjectID.0');

        return $response->getExitCode() === 0 || $response->isValid();
    }
}
