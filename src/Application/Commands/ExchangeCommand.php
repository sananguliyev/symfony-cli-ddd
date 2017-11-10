<?php

namespace Webbala\Application\Commands;

use Symfony\Component\Console\Helper\Table;
use Webbala\Domain\Services\ProviderInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ExchangeCommand
 * @package Webbala\Application\Commands
 */
class ExchangeCommand extends Command
{
    /**
     * @var ProviderInterface
     */
    private $provider;

    /**
     * ExchangeCommand constructor.
     * @param ProviderInterface $provider
     */
    public function __construct(ProviderInterface $provider)
    {
        parent::__construct();
        $this->provider = $provider;
    }

    protected function configure()
    {
        $this->setName("exchange")
            ->setDescription("Get rates list")
            ->addArgument('date', InputArgument::REQUIRED, 'Get historical rates for any day since 1999.')
            ->addArgument('base', InputArgument::OPTIONAL, 'Rates are quoted against (Default: EUR).')
            ->addArgument('symbols', InputArgument::IS_ARRAY, 'Specific exchange rates.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $date = $input->getArgument('date');
        $base = ($input->getArgument('base')) ?: 'EUR';
        $symbols = ($input->getArgument('symbols')) ?: [];

        $rates = $this->provider->getRates($date, $base, $symbols);

        $table = new Table($output);
        $table
            ->setHeaders(['Currencies', $base])
            ->setRows($rates);

        $table->render();
    }
}