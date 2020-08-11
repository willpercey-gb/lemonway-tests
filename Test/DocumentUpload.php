<?php

namespace Tests;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Tests\Traits\Output;

class DocumentUpload extends Command
{
    use Output;

    protected function configure(): void
    {
        $this->setName('test:upload')
            ->setDescription('Test uploading a file to Lemonway')
            ->setHelp('https://documentation.lemonway.com/en/');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->setOutput($output);

        $data = json_encode([
            'p' => [
                'wallet' => 90,
                'fileName' => 'strawberries.jpg',
                'type' => 3,
                'buffer' => base64_encode(file_get_contents(dirname(__DIR__) . '/assets/strawberries.jpg')),
                'wlLogin' => $_ENV['USERNAME'],
                'wlPass' => $_ENV['PASSWORD'],
                'language' => 'en',
                'version' => 1.2,
                'walletIp' => '127.0.0.1',
                'walletUa' => 'wget',
            ]
        ]);

        $response = (\Symfony\Component\HttpClient\HttpClient::create())->request('POST', getRequestUri('/UploadFile'), [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'body' => $data
        ]);


        export($response->toArray());

        dd($response->toArray());

        return 0;
    }
}