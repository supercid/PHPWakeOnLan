<?php

namespace supercid\PHPWakeOnLan\Tests\Socket;

use supercid\PHPWakeOnLan\Socket\Socket;
use PHPUnit\Framework\TestCase;

/**
 * Class SocketTest.
 *
 * @covers \supercid\PHPWakeOnLan\Socket\Socket
 */
class SocketTest extends TestCase
{
    /**
     * @covers \supercid\PHPWakeOnLan\Socket\Socket::send()
     */
    public function testSend(): void
    {
        $socket = new Socket(SOL_UDP);
        socket_set_option($socket->getSocket(), SOL_SOCKET, SO_BROADCAST, true);
        $result = $socket->send('', '255.255.255.255', 7);
        $this->assertEquals(0, $result, 'Bytes sent must be 0');
    }
}
