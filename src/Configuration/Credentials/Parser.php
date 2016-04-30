<?php
namespace DAG\OneSky\Configuration\Credentials;


use DAG\OneSky\Model\Credentials;
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
     * @return Credentials
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
        $configuration = new CredentialsConfiguration();
        $processedConfiguration = $processor->processConfiguration(
            $configuration,
            $configs
        );

        return $this->parseConfiguration($processedConfiguration);
    }

    /**
     * @param array $configuration
     *
     * @return $credentials
     *
     * @throws \InvalidArgumentException
     */
    private function parseConfiguration(array $configuration)
    {
        $credentials = new Credentials(
            $configuration['api_key'],
            $configuration['api_secret']
        );

        return $credentials;
    }
}
