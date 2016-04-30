<?php
namespace DAG\OneSky\Command;

use DAG\OneSky\Api;
use DAG\OneSky\Configuration\Credentials\Parser as CredentialsParser;
use DAG\OneSky\Configuration\Project\Parser as ProjectParser;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class UploadFileCommand
 */
final class UploadFileCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('upload')
            ->addOption('project-file', null, InputOption::VALUE_REQUIRED, '', '.onesky.strings.yml')
            ->addOption('secret-file', null, InputOption::VALUE_REQUIRED, '', '.onesky.secret.yml');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $projectParser = new ProjectParser();
        $project = $projectParser->parse($input->getOption('project-file'));

        $credentialsParser = new CredentialsParser();
        $credentials = $credentialsParser->parse($input->getOption('secret-file'));

        $output->writeln(sprintf('There are %d files to upload', count($project->getStringFiles())));

        if (count($project->getStringFiles()) > 0) {
            $api = new Api($credentials);
            $api->upload($project);

            $output->writeln('Upload finished');
        }
    }
}
