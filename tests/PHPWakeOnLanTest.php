<?php

namespace SuperCid\PHPWakeOnLan\Tests;

use SuperCid\PHPWakeOnLan\CidrNetwork;
use SuperCid\PHPWakeOnLan\PHPWakeOnLan;
use PHPUnit\Framework\TestCase;

/**
 * Class PHPWakeOnLanTest.
 *
 * @covers \SuperCid\PHPWakeOnLan\PHPWakeOnLan
 */
class PHPWakeOnLanTest extends TestCase
{

    /**
     * @covers \SuperCid\PHPWakeOnLan\PHPWakeOnLan::wake()
     *
     * @throws \Exception
     */
    public function testWake(): void
    {
        $wol = new PHPWakeOnLan();
        $result = $wol->wake('00:1B:2C:1C:DF:22', '192.168.0.1');

        $this->assertNotEmpty($result);
    }

    public function testWakeWithCidrNetwork(): void
    {
        /**
         * Network address: 192.168.50.0
         * Broadcast Address: 192.168.50.3.
         */
        $cidrNetwork = CidrNetwork::make('192.168.50.1', '255.255.255.252');

        $wol = new PHPWakeOnLan();
        $result = $wol->wake('00:1B:2C:1C:DF:22', $cidrNetwork->getNetworkAddress(), $cidrNetwork->getSubnetMask());

        $this->assertNotEmpty($result);
        $this->assertArrayHasKey('message', $result);
        $this->assertSame(
            'Magic packet sent to 00:1B:2C:1C:DF:22 through 192.168.50.3',
            $result['message']
        );
    }
}
