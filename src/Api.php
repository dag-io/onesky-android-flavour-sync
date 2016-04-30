<?php
namespace DAG\OneSky;

use DAG\OneSky\Model\Credentials;
use DAG\OneSky\Model\Project;
use Onesky\Api\Client;

/**
 * Class Api
 */
final class Api
{
    /** @var Credentials */
    private $credentials;

    /**
     * Api constructor.
     *
     * @param Credentials $credentials
     */
    public function __construct(Credentials $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * @param Project $project
     *
     * @throws \Exception
     */
    public function upload(Project $project)
    {
        $client = $this->getClient();

        foreach ($project->getStringFiles() as $stringFile) {
            $response = $client->files(
                'upload',
                [
                    'project_id' => $project->getId(),
                    'file' => $stringFile->getPath(),
                    'file_format' => 'ANDROID_XML',
                    'locale' => $stringFile->getLocale(),
                ]
            );
            $response = json_decode($response, true);

            if (!isset($response['meta']) || !isset($response['meta']['status'])) {
                throw new \Exception('Invalid response');
            }

            if ($response['meta']['status'] != '201') {
                throw new \Exception(sprintf('Invalid response status "%s"', $response['meta']['status']));
            }
        }
    }

    /**
     * @return Client
     */
    private function getClient()
    {
        $client = new Client();
        $client
            ->setApiKey($this->credentials->getApiKey())
            ->setSecret($this->credentials->getApiSecret());

        return $client;
    }

    /**
     * @param Project $project
     *
     * @throws \Exception
     */
    public function download(Project $project)
    {
        $client = $this->getClient();

        foreach ($project->getStringFiles() as $stringFile) {
            $response = $client->translations(
                'export',
                array(
                    'project_id' => $project->getId(),
                    'locale' => $stringFile->getLocale(),
                    'source_file_name' => basename($stringFile->getPath()),
                )
            );

            if (!file_put_contents($stringFile->getPath(), $response)) {
                throw new \Exception(sprintf('Can not write on file "%s"', $stringFile->getPath()));
            }
        }
    }
}
