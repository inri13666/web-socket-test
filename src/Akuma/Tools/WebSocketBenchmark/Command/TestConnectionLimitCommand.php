<?php

namespace Akuma\Tools\WebSocketBenchmark\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use WebSocket\Client;

class TestConnectionLimitCommand extends Command
{
    /** @var string */
    public const NAME = 'akuma:web-sockets:test';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName(self::NAME)
            ->addOption('limit', 'l', InputOption::VALUE_OPTIONAL, '', 1000)
            ->addOption('host', null, InputOption::VALUE_OPTIONAL, '', 'ws://echo.websocket.org/');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $host = $input->getOption('host');
        $limit = $input->getOption('limit');

        $clients = [];
        for ($i = 1; $i <= $limit; $i++) {
            try {
                $client = new Client($host);
                $clients[$i] = $client;
            } catch (\Throwable $e) {
                $output->writeln(sprintf('Unable to open "%d" connection to "%s"', $i, $host));
                break;
            }
        }
        $output->writeln(sprintf('Sockets Open %d', count($clients)));

        /** @var Client $client */
        foreach ($clients as $k => $client) {
            try {
                $client->send(sprintf('Hello from Client %d', $k));
                $output->writeln(sprintf(
                    'Message from "%s" received "%s"',
                    $host,
                    $client->receive()
                ));
            } catch (\Throwable $e) {
                $output->writeln(sprintf('Error accured for client "%d" with message "%s"', $k, $e->getMessage()));
            }
        }

        /** @var Client $client */
        foreach ($clients as $k => $client) {
            if ($client->isConnected()) {
                $client->close();
            }
        }
    }
}
