<?php

namespace Diegonz\PHPWakeOnLan;

use Diegonz\PHPWakeOnLan\Socket\UdpBroadcastSocket;
use Exception;
use RuntimeException;

/**
 * Class PHPWakeOnLan.
 */
class PHPWakeOnLan
{
    /**
     * Wake up target devices using a given mac address and IP to build magic packets
     * and send them to broadcast address.
     *
     * @param string $macAddress mac address (single string) in XX:XX:XX:XX:XX:XX hexadecimal
     *                          format. Only 0-9 and a-f are allowed
     * @param string $ipAddress IP Address in the network or Network address of the network.
     * @param string $subnetMask Subnet Mask as a string
     * @param int $port Target port to send magic packet, 7 or 9
     * @return array Detailed results array with result, bytes sent and a message for each given magic packet
     *
     * @throws Exception
     */
    public function wake(string $macAddress, string $ipAddress, string $subnetMask = '255.255.255.0', int $port = 7): array
    {
        if (!in_array($port, [7, 9], true)) {
            throw new RuntimeException('Error: Invalid port ['.$port.']. Must be 7 or 9.', 4);
        }

        $udpBroadcastSocket = new UdpBroadcastSocket();
        $magicPacket = new MagicPacket($macAddress);
        $cidr = new CidrNetwork($ipAddress, $subnetMask);

        $bytes = $udpBroadcastSocket->send($magicPacket, $cidr->getBroadcastAddress(), $port);
        $udpBroadcastSocket->close();

        $sendOk = ! empty($bytes) && $bytes > 0;
        $message = $sendOk ? 'Magic packet sent' : '0 bytes sent';
        $message .= ' to ' . $macAddress . ' through ' . $cidr->getBroadcastAddress();

        return [
            'result' => $sendOk ? 'OK' : 'KO',
            'message' => $message,
            'bytes_sent' => $bytes,
        ];
    }
}
