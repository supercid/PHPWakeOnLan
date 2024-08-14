<?php

namespace SuperCid\PHPWakeOnLan\Socket;

use RuntimeException;

/**
 * Class UdpBroadcastSocket.
 */
class UdpBroadcastSocket extends Socket
{
    /**
     * UDPBroadcastSocket constructor.
     */
    public function __construct()
    {
        parent::__construct(SOL_UDP);
        $optionResult = socket_set_option($this->getSocket(), SOL_SOCKET, SO_BROADCAST, true);
        if (! $optionResult) {
            throw new RuntimeException('Error: Could not set broadcast UDP socket.', 5);
        }
    }
}
