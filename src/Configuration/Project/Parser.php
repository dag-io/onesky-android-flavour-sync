<?php
namespace DAG\OneSky\Configuration\Project;

use DAG\OneSky\Model\Project;
use DAG\OneSky\Model\StringFile;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Yaml\Yaml;

/**
 * Class Parser
 */
final class Parser
{
    /**
     * @param string $configFilePath
     *
     * @return Project
     *
     * @throws \InvalidArgumentException
     */
    public function parse($configFilePath)
    {
        if (!file_exists($configFilePath) || !is_readable($configFilePath)) {
            throw new \InvalidArgumentException(sprintf('Can not read "%s"', $configFilePath));
        }

        $configValues = Yaml::parse(file_get_contents($configFilePath));

        $configs = [$configValues];

        $processor = new Processor();
        $configuration = new ProjectConfiguration();
        $processedConfiguration = $processor->processConfiguration(
            $configuration,
            $configs
        );

        return $this->parseConfiguration($processedConfiguration);
    }

    /**
     * @param array  $configuration
     *
     * @return Project
     *
     * @throws \InvalidArgumentException
     */
    private function parseConfiguration(array $configuration)
    {
        $files = [];

        foreach ($configuration['strings'] as $file) {
            if (!file_exists($file['path']) || !is_readable($file['path'])) {
                throw new \InvalidArgumentException(sprintf('Can not read "%s"', $file['path']));
            }

            if (is_file($file['path'])) {
                $files[] = new StringFile($file['path'], $file['locale']);
            } elseif (is_dir($file['path'])) {
                $filesFound = $this->globRecursive($file['path'], '*.xml');

                foreach ($filesFound as $fileFound) {
                    $xml = simplexml_load_file($fileFound);
                    if (isset($xml->string)) {
                        $files[] = new StringFile($fileFound, $file['locale']);
                    }
                }
            }
        }

        $project = new Project($configuration['id'], $files);

        return $project;
    }

    /**
     * @param string $path
     * @param string $find
     *
     * @return \Generator
     */
    private function globRecursive($path, $find)
    {
        $dh = opendir($path);
        while (($file = readdir($dh)) !== false) {
            if (substr($file, 0, 1) == '.') {
                continue;
            }
            $rfile = "{$path}/{$file}";
            if (is_dir($rfile)) {
                foreach ($this->globRecursive($rfile, $find) as $ret) {
                    yield $ret;
                }
            } else {
                if (fnmatch($find, $file)) {
                    yield $rfile;
                }
            }
        }
        closedir($dh);
    }
}
