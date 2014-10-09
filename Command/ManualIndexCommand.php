<?php

namespace Opifer\ManualBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Manual Index Command
 *
 * Indexes the manual files for all the bundles
 * specified in the parameters.yml file.
 * in the database.
 *
 * Usage from inside root:
 * app/console opifer:manual:index
 *
 * @see  http://symfony.com/doc/current/cookbook/console/console_command.html
 * @see  http://symfony.com/doc/current/components/console/introduction.html
 */
class ManualIndexCommand extends ContainerAwareCommand
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('opifer:manual:index')
            ->setDescription('Indexes all the manual files')
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("<comment>Indexing the articles using database.</comment>");

        // Index the articles in the database
        $this->getContainer()->get('opifer.manual.help_manager')->indexArticles();

        $output->writeln("<info>Successfully created the index</info>");
    }
}